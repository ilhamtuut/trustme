<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Role;
use App\User;
use App\Balance;
use App\Program;
use App\Downline;
use App\BackupPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'referal' => 'required',
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username|alpha_num|max:17',
            'phone_number' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:6',
            'security_password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        $upline = User::where('username',$data['referal'])->first();
        $upline_id = $upline->id;
        $user = User::create([
            'parent_id' => $upline_id,
            'name' => $data['name'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'trx_password' => Hash::make($data['security_password']),
        ]);

        BackupPassword::create([
            'user_id' => $user->id,
            'password' => $data['password'],
            'trx_password' => $data['security_password']
        ]);

        Balance::create([
            'user_id' => $user->id,
            'balance' => 0,
            'status' => 1,
            'description' => 'USD Wallet'
        ]);

        Balance::create([
            'user_id' => $user->id,
            'balance' => 0,
            'status' => 1,
            'description' => 'Trustme Coin'
        ]);

        Balance::create([
            'user_id' => $user->id,
            'balance' => 0,
            'status' => 1,
            'description' => 'Register Wallet'
        ]);

        $memberRole = Role::where('name', 'member')->first();
        $user->attachRole($memberRole);
        $this->saveDownline($user->id, $upline_id);
        $user->verify();
        // $user->sendVerification();
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $upline = User::with('program')->has('program')->where('username',$request->referal)->first();
        if($upline){
                event(new Registered($user = $this->create($request->all())));

                $this->registered($request, $user)
                            ?: redirect($this->redirectPath());
                $request->session()->flash('success', 'Successfully register account, please login to account.');
                // $request->session()->flash('success', 'Successfully register account, Please click on the activation link that we sent to your email.');
                return redirect('/login');
        }else{
            $request->session()->flash('failed', 'Referral has not yet registered plan or not found.');
            return redirect()->back();
        }
    }

    public function verify(Request $request, $token)
    {
        $email = $request->get('email');
        $user = User::where('verification_token', $token)->where('email', $email)->first();
        if ($user) {
            $user->verify();
            $request->session()->flash('success', 'Your account is activated, please login');
        }
        return redirect('/login');
    }

    public function sendVerification(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ($user && !$user->is_verified) {
            $user->sendVerification();
            $request->session()->flash('success', 'Please click on the activation link that we sent to your email.');
        }
        return redirect()->back();
    }

    public function referal(Request $request,$username)
    {
        $upline = User::with('program')->has('program')->where('username',$username)->first();
        if($upline){
            $request->session()->put('ref:user:username', $username);
            return redirect()->route('register');
        }else{
            $request->session()->flash('failed', 'Referal has not yet registered program or not found');
            return redirect()->route('login');
        }
    }

    public function saveDownline($user_id, $upline_id)
    {
        $upline = $upline_id;
        Downline::create([
            'user_id' => $upline,
            'downline_id' => $user_id,
            'status' => 1
        ]);
        for($i = 1; $i <= 5000; $i++){
            $upline =  $this->downlines($upline,$user_id);
            if(is_null($upline)){
                break;
            }else{
                $upline = $upline;
            }
        }
    }

    public function downlines($upline_id,$user_id)
    {
        $check_downline = Downline::where('downline_id',$upline_id)->orderBy('id','asc')->first();
        if($check_downline){
            $upline = $check_downline->user_id;
            Downline::create([
                'user_id' => $upline,
                'downline_id' => $user_id,
                'status' => 1
            ]);
        }else{
            $upline = null;
        }
        return $upline;
    }
}
