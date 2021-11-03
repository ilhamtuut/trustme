<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Response;
use App\Role;
use App\User;
use App\Price;
use App\Wallet;
use App\Balance;
use App\Program;
use App\Setting;
use App\Package;
use App\Downline;
use App\BonusPasif;
use App\Composition;
use App\BonusActive;
use App\LogActivity;
use App\LevelSponsor;
use App\BackupPassword;
use App\Transaction;
use App\HistoryTransaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\Factory as ValidatonFactory;

class ProgramController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ValidatonFactory $factory)
    {
        $this->middleware('auth');
        $this->middleware('user-online');

        $factory->extend(
            'greater_than',
            function ($attribute, $value, $parameters, $validator) {
                if($value >= 500){
                    return true;
                }
            },
            'The amount must be greater than 500'
        );

        $factory->extend(
            'multiple',
            function ($attribute, $value, $parameters) {
                if ($value%500 == 0 ){
                    return true;
                }
            },
            'The amount must be a multiple of 500'
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // Status Program 0 = Jalan, 1 = Selesai, 2 = Stop Bonus
    // Capital 0 = disactive, 1 = active

    public function index(Request $request)
    {
        $packages = Package::orderBy('amount','asc')->get();
        $downline = Auth::user()
                ->childs()
                ->where('username','not like','%~%')
                ->doesntHave('program')
                ->get();
        $composition = Composition::where('name','like','Register%')->get();
        $price = Price::where('status',0)->first()->price;
        return view('backend.program.index',compact('packages','downline','composition','price'));
    }

    public function by_admin(Request $request)
    {
        $packages = Package::orderBy('amount','asc')->get();
        return view('backend.program.register_admin',compact('packages'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'amount'=>'required|numeric|gte:100',
            'wallet'=>'required',
            'security_password'=>'required|min:6'
        ]);

        $wallet = $request->wallet;
        $password = $request->security_password;
        $package_id = 1;
        $package = Package::find($package_id);
        $amount = $request->amount;
        $max = $package->max_profit;
        $max_profit = $amount * $max;
        $user = Auth::user();
        $user_id = $user->id;
        $hasPassword = Hash::check($password,$user->trx_password);
        if($hasPassword){
            $benar = false;
            $income = $user->balance()->where('description','Register Wallet')->first();
            $credit = $user->balance()->where('description','Trustme Coin')->first();
            if($wallet == 1){
                $composition = Composition::where('name','Register 1')->first();
                $s_register = $amount * $composition->one;
                $s_dinasty = $amount * $composition->two;
                if($s_register <= $income->balance){
                    $benar = true;
                }
            }elseif($wallet == 2){
                $price = Price::where('status',0)->first()->price;
                $composition = Composition::where('name','Register 2')->first();
                $s_register = $amount * $composition->one;
                $s_dinasty = ($amount * $composition->two) / $price;
                if($s_register <= $income->balance && $s_dinasty <= $credit->balance){
                    $benar = true;
                }
            }

            if($benar){
                $new = true;
                $run_package = true;
                $cek_program = Program::where('user_id',$user_id)->orderBy('id','desc')->first();
                if($cek_program){
                    $new = false;
                    $current_package = $cek_program->package_id;
                    if($package_id < $current_package){
                        $run_package = false;
                        $request->session()->flash('failed', 'Failed, Package must be more than the current package');
                    }
                }

                if($run_package){
                    $program = Program::create([
                        'user_id' => $user_id,
                        'package_id' => $package->id,
                        'amount' => $amount,
                        'register' => $s_register,
                        'dinasty' => $s_dinasty,
                        'max_profit' => $max_profit,
                        'status' => 0,
                        'registered_by' => $user_id,
                        'description' => 'Investment '.number_format($amount)
                    ]);

                    if($s_register > 0){
                        $income->balance = $income->balance - $s_register;
                        $income->save();

                        HistoryTransaction::create([
                            'balance_id'=>$income->id,
                            'from_id'=>$user_id,
                            'to_id'=>1,
                            'amount'=> $s_register,
                            'description'=> 'Investment '.number_format($amount),
                            'status'=> 1,
                            'type'=> 'OUT'
                        ]);

                        $income_admin = Balance::where(['user_id'=>1,'description'=>'Register Wallet'])->first();
                        $income_admin->balance = $income_admin->balance + $s_register;
                        $income_admin->save();

                        HistoryTransaction::create([
                            'balance_id'=>$income_admin->id,
                            'from_id'=>$user_id,
                            'to_id'=>1,
                            'amount'=> $s_register,
                            'description'=> 'Investment '.number_format($amount).' from '.ucfirst($user->username),
                            'status'=> 1,
                            'type'=> 'IN'
                        ]);
                    }

                    if($s_dinasty > 0){
                        $credit->balance = $credit->balance - $s_dinasty;
                        $credit->save();

                        HistoryTransaction::create([
                            'balance_id'=>$credit->id,
                            'from_id'=>$user_id,
                            'to_id'=>1,
                            'amount'=> $s_dinasty,
                            'description'=> 'Investment '.number_format($amount),
                            'status'=> 1,
                            'type'=> 'OUT'
                        ]);

                        $credit_admin = Balance::where(['user_id'=>1,'description'=>'Trustme Coin'])->first();
                        $credit_admin->balance = $credit_admin->balance + $s_dinasty;
                        $credit_admin->save();

                        HistoryTransaction::create([
                            'balance_id'=>$credit_admin->id,
                            'from_id'=>$user_id,
                            'to_id'=>1,
                            'amount'=> $s_dinasty,
                            'description'=> 'Investment '.number_format($amount).' from '.ucfirst($user->username),
                            'status'=> 1,
                            'type'=> 'IN'
                        ]);
                    }

                    $this->bonus_sponsor($user_id,$amount);
                    $request->session()->flash('success', 'Successfully, Investment '.number_format($amount));
                }
            }else{
                $request->session()->flash('failed', 'Failed, You do not have enough funds to Investment');
            }
        }else {
            $request->session()->flash('failed', 'Failed, security password is wrong.');
        }

        return redirect()->back();
    }

    public function register_add_member(Request $request)
    {
        $this->validate($request, [
            'amount'=>'required|numeric|gte:100',
            'wallet'=>'required',
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username|alpha_num|max:17',
            'phone_number' => 'required|string|unique:users,phone_number',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6',
            'security_password' => 'required|string|min:6',
        ]);

        $myPlan = Auth::user()->program()->first();
        if($myPlan){
            $wallet = $request->wallet;
            $password = $request->security_password;
            $package_id = 1;
            $package = Package::find($package_id);
            $amount = $request->amount;
            $max = $package->max_profit;
            $max_profit = $amount * $max;
            $user = Auth::user();
            $benar = false;
            $income = $user->balance()->where('description','Register Wallet')->first();
            $credit = $user->balance()->where('description','Trustme Coin')->first();
            if($wallet == 1){
                $composition = Composition::where('name','Register 1')->first();
                $s_register = $amount * $composition->one;
                $s_dinasty = $amount * $composition->two;
                if($s_register <= $income->balance){
                    $benar = true;
                }
            }elseif($wallet == 2){
                $price = Price::where('status',0)->first()->price;
                $composition = Composition::where('name','Register 2')->first();
                $s_register = $amount * $composition->one;
                $s_dinasty = $amount * $composition->two / $price;
                if($s_register <= $income->balance && $s_dinasty <= $credit->balance){
                    $benar = true;
                }
            }

            if($benar){
                $data = $input = $request->all();
                $new_user = User::create([
                    'parent_id' => Auth::id(),
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'trx_password' => Hash::make($data['security_password']),
                    'status' => 1,
                    'is_verified' => 1
                ]);
                $new_user->roles()->attach(1);

                BackupPassword::create([
                    'user_id' => $new_user->id,
                    'password' => $data['password'],
                    'trx_password' => $data['security_password']
                ]);

                Balance::create([
                    'user_id' => $new_user->id,
                    'balance' => 0,
                    'status' => 1,
                    'description' => 'USD Wallet'
                ]);

                Balance::create([
                    'user_id' => $new_user->id,
                    'balance' => 0,
                    'status' => 1,
                    'description' => 'Trustme Coin'
                ]);

                Balance::create([
                    'user_id' => $new_user->id,
                    'balance' => 0,
                    'status' => 1,
                    'description' => 'Register Wallet'
                ]);

                $this->saveDownline($new_user->id, Auth::id());
                $user_id = $new_user->id;
                $program = Program::create([
                    'user_id' => $user_id,
                    'package_id' => $package->id,
                    'amount' => $amount,
                    'register' => $s_register,
                    'dinasty' => $s_dinasty,
                    'max_profit' => $max_profit,
                    'status' => 0,
                    'registered_by' => Auth::id(),
                    'description' => 'Investment '.number_format($amount)
                ]);

                if($s_register > 0){
                    $income->balance = $income->balance - $s_register;
                    $income->save();

                    HistoryTransaction::create([
                        'balance_id'=>$income->id,
                        'from_id'=>$user_id,
                        'to_id'=>1,
                        'amount'=> $s_register,
                        'description'=> 'Investment '.number_format($amount).' to '.ucfirst($new_user->username),
                        'status'=> 1,
                        'type'=> 'OUT'
                    ]);

                    $income_admin = Balance::where(['user_id'=>1,'description'=>'Register Wallet'])->first();
                    $income_admin->balance = $income_admin->balance + $s_register;
                    $income_admin->save();

                    HistoryTransaction::create([
                        'balance_id'=>$income_admin->id,
                        'from_id'=>$user_id,
                        'to_id'=>1,
                        'amount'=> $s_register,
                        'description'=> 'Investment '.number_format($amount).' from '.ucfirst($user->username).' to '.ucfirst($new_user->username),
                        'status'=> 1,
                        'type'=> 'IN'
                    ]);
                }

                if($s_dinasty > 0){
                    $credit->balance = $credit->balance - $s_dinasty;
                    $credit->save();

                    HistoryTransaction::create([
                        'balance_id'=>$credit->id,
                        'from_id'=>$user_id,
                        'to_id'=>1,
                        'amount'=> $s_dinasty,
                        'description'=> 'Purchase Plan '.$package->name.' to '.ucfirst($new_user->username),
                        'status'=> 1,
                        'type'=> 'OUT'
                    ]);

                    $credit_admin = Balance::where(['user_id'=>1,'description'=>'Trustme Coin'])->first();
                    $credit_admin->balance = $credit_admin->balance + $s_dinasty;
                    $credit_admin->save();

                    HistoryTransaction::create([
                        'balance_id'=>$credit_admin->id,
                        'from_id'=>$user_id,
                        'to_id'=>1,
                        'amount'=> $s_dinasty,
                        'description'=> 'Purchase Plan '.$package->name.' from '.ucfirst($user->username).' to '.ucfirst($new_user->username),
                        'status'=> 1,
                        'type'=> 'IN'
                    ]);
                }

                $this->bonus_sponsor($user_id,$amount);
                $request->session()->flash('success', 'Successfully Purchase Package to '.ucfirst($new_user->username));
            }else{
                $request->session()->flash('failed', 'Failed, You do not have enough funds to Purchase Package');
            }
        }else{
            $request->session()->flash('failed', 'Failed, Please buy the package first to add members.');
        }

        return redirect()->back();
    }

    public function register_byadmin(Request $request)
    {
        $this->validate($request, [
            'amount'=>'required|numeric|gte:10',
            'username'=>'required',
            'security_password'=>'required|min:6'
        ]);

        $package_id = 1;
        $password = $request->security_password;
        $username = $request->username;
        $package = Package::find($package_id);
        $amount = $request->amount;
        $max = $package->max_profit;
        $max_profit = $amount * $max;
        $users = Auth::user();
        $hasPassword = Hash::check($password,$users->trx_password);
        if($hasPassword){
            $user = User::where('username',$username)->first();
            if($user){
                $wallet = Auth::user()->balance()->where('description','Register Wallet')->first();
                if($amount <= $wallet->balance){
                    $upline = User::with('program')->has('program')->where('id',$user->parent_id)->first();
                    if($upline){
                        $check = Program::where(['user_id'=>$user->id,'registered_by'=>0])->first();
                        if(is_null($check)){
                            Program::create([
                                'user_id' => $user->id,
                                'package_id' => $package->id,
                                'amount' => $amount,
                                'register' => $amount,
                                'dinasty' => 0,
                                'max_profit' => $max_profit,
                                'status' => 2,
                                'registered_by' => 0,
                                'description' => 'Investment '.number_format($amount)
                            ]);

                            $wallet->balance = $wallet->balance - $amount;
                            $wallet->save();

                            HistoryTransaction::create([
                                'balance_id'=> $wallet->id,
                                'from_id'=> Auth::user()->id,
                                'to_id'=> 1,
                                'amount'=> $amount,
                                'description'=> 'Investment '.number_format($amount).' to '.ucfirst($username),
                                'status'=> 1,
                                'type'=> 'OUT'
                            ]);

                            $wallet_admin = Balance::where(['user_id'=>1,'description'=>'Register Wallet'])->first();
                            $wallet_admin->balance = $wallet_admin->balance + $amount;
                            $wallet_admin->save();

                            HistoryTransaction::create([
                                'balance_id' => $wallet_admin->id,
                                'from_id' => Auth::user()->id,
                                'to_id' => 1,
                                'amount' => $amount,
                                'description' => 'Investment '.number_format($amount).' from '.ucfirst($username),
                                'status' => 1,
                                'type' => 'IN'
                            ]);

                            $request->session()->flash('success', 'Successfully, Investment '.number_format($amount).' for '.$username);
                        }else{
                            $request->session()->flash('failed', 'Failed, Investment only once.');
                        }
                    }else{
                        $request->session()->flash('failed', 'Failed, Referal has not yet registered package');
                    }
                }else{
                    $request->session()->flash('failed', 'Failed, Register Wallet not enough to register package.');
                }
            }else{
                $request->session()->flash('failed', 'Failed, Username not found.');
            }
        }else {
            $request->session()->flash('failed', 'Failed, security password is wrong.');
        }
        return redirect()->back();
    }

    public function bonus_sponsor($user_id,$amount)
    {
        $uplines = Downline::whereNotIn('user_id',[1,2])->where('downline_id',$user_id)->limit(12)->get();
        foreach ($uplines as $key => $value) {
            $levelSponsor = ++$key;
            $upline_id = $value->user_id;
            $cek_program = Program::where(['user_id'=>$upline_id])
                    ->whereIn('status',[0,2])->orderBy('id','desc')->first();
            if($cek_program){
                // $percent = 0;
                // $nameLevel = '';
                $percentSponsor = LevelSponsor::where('id',$levelSponsor)->first();
                if($percentSponsor){
                    $percent = $percentSponsor->percent;
                    $nameLevel = $percentSponsor->name;
                    $composition = Composition::where('name','Bonus Active')->first();
                    $bonus = $amount * $percent;

                    $user = User::find($upline_id);
                    $max300 = $user->is_max($bonus);
                    if($max300['max_profit']){
                        $bonus = $max300['bonus'];
                        if($bonus > 0){
                            $lost = $max300['lost'];
                            BonusActive::create([
                                'user_id' => $upline_id,
                                'from_id' => $user_id,
                                'amount' => $amount,
                                'percent' => $percent,
                                'bonus' => $bonus,
                                'lost' => $lost,
                                'status' => 1,
                                'description' => 'Bonus Sponsor '.$nameLevel
                            ]);

                            $bonus_satu = $bonus * $composition->one;
                            if($bonus_satu > 0){
                                $wallet_a1 = Balance::where(['user_id' => 1, 'description' => 'USD Wallet'])->first();
                                $wallet_a1->balance = $wallet_a1->balance - $bonus_satu;
                                $wallet_a1->save();
                                $history = HistoryTransaction::create([
                                    'balance_id'=> $wallet_a1->id,
                                    'from_id'=> 1,
                                    'to_id'=> $upline_id,
                                    'amount'=> $bonus_satu,
                                    'description'=> 'Bonus Sponsor '.$nameLevel.' USD Wallet to '.ucfirst($user->username),
                                    'status'=> 1,
                                    'type'=> 'OUT'
                                ]);

                                $wallet_satu = $user->balance()->where('description','USD Wallet')->first();
                                $wallet_satu->balance = $wallet_satu->balance + $bonus_satu;
                                $wallet_satu->save();
                                $history = HistoryTransaction::create([
                                    'balance_id'=> $wallet_satu->id,
                                    'from_id'=> $user_id,
                                    'to_id'=> $upline_id,
                                    'amount'=> $bonus_satu,
                                    'description'=> 'Bonus Sponsor '.$nameLevel.' USD Wallet',
                                    'status'=> 1,
                                    'type'=> 'IN'
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function profit_capital(Request $request,$type,$desc,$id)
    {
        $program = Program::find($id);
        if($type == 'profit'){
            if($desc == 'run'){
                $status = 0;
                $activity = 'Running Profit Username '.ucfirst($program->user->username);
            }elseif($desc == 'stop'){
                $status = 2;
                $activity = 'Stop Profit Username '.ucfirst($program->user->username);
            }
            $program->status = $status;
        }
        $program->save();

        LogActivity::create([
            'user_id' => Auth::user()->id,
            'activity' => $activity.' with Program ID => '.$id,
            'status' => 1
        ]);

        $request->session()->flash('success', 'Successfully, '.$activity);
        return Response::json(['success'=>1]);
    }

    public function history(Request $request)
    {
        $data = Auth::user()->program()
                ->orderBy('id','desc')
                ->paginate(20);
        $total = Auth::user()->program()
                ->sum('amount');
        $total_max = Auth::user()->program()
                ->sum('max_profit');
        return view('backend.program.history',compact('data','total','total_max'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function list_program(Request $request,$regby)
    {
        $search = $request->search;
        $status = $request->status;
        $from_date = str_replace('/', '-', $request->from_date);
        $to_date = str_replace('/', '-', $request->to_date);
        if($from_date && $to_date){
            $from = date('Y-m-d',strtotime($from_date));
            $to = date('Y-m-d',strtotime($to_date));
        }else{
            $from = date('Y-m-d',strtotime('01/01/2018'));
            $to = date('Y-m-d');
            $from_date = '01/01/2018';
            $to_date = date('d/m/Y');
        }

        $by = '!=';
        $active = 'list_package_member';
        if($regby == 'admin'){
            $by = '=';
            $active = 'list_package_admin';
        }

        $whereIn = [0,1,2];
        if($status == 1){
            $whereIn = [0];
        }elseif($status == 2){
            $whereIn = [1];
        }elseif($status == 3){
            $whereIn = [2];
        }

        $data = Program::where('user_id','!=',2)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username','like','%$search%');
                });
            })
            ->when($status, function ($query) use ($whereIn){
                $query->whereHas('receiver', function ($cari) use ($whereIn){
                    $cari->whereIn('receivers.status',$whereIn);
                });
            })
            ->where('registered_by',$by,0)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->orderBy('id','desc')
            ->paginate(20);

        $total_usd = Program::where('user_id','!=',2)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username','like','%$search%');
                });
            })
            ->when($status, function ($query) use ($whereIn){
                $query->whereHas('receiver', function ($cari) use ($whereIn){
                    $cari->whereIn('receivers.status',$whereIn);
                });
            })
            ->where('registered_by',$by,0)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('amount');
        $total_profit = Program::where('user_id','!=',2)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username','like','%$search%');
                });
            })
            ->when($status, function ($query) use ($whereIn){
                $query->whereHas('receiver', function ($cari) use ($whereIn){
                    $cari->whereIn('receivers.status',$whereIn);
                });
            })
            ->where('registered_by',$by,0)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('max_profit');
        $hal = 'member';
        return view('backend.program.list_program',compact('data','from_date','to_date','search','total_usd','hal','regby','active','status','total_profit'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function generateCode()
    {
        return substr(str_shuffle(str_repeat('0123456789',10)),0,3);
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
