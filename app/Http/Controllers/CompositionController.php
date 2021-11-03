<?php

namespace App\Http\Controllers;

use App\Composition;
use App\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompositionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user-online');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
    	$data = Composition::get();
    	return view('backend.composition.index',compact('data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id'=>'required',
            'one'=>'required|numeric',
            'two'=>'required|numeric',
            'security_password'=>'required'
        ]);

        $hasPassword = Hash::check($request->security_password, Auth::user()->trx_password);
        if($hasPassword){
        	$total = $request->one + $request->two;
        	if($total == 100){
	            $id = $request->id;
	            $comp = Composition::find($id);
	            
	            $log = array(
	                'user_id' => Auth::user()->id,
	                'activity' => 'Change Composition 1 '.$comp->name.' from '.($comp->one*100).'% to '.$request->one.'%',
	                'status' => 1
	            );

	            $log_pairing = array(
	                'user_id' => Auth::user()->id,
	                'activity' => 'Change Composition 2 '.$comp->name.' from '.($comp->two*100).'% to '.$request->two.'%',
	                'status' => 1
	            );

	            $comp->fill([
	                'one' => $request->one/100,
	                'two' => $request->two/100
	            ]);

	            $comp->save();
	            LogActivity::create($log);
	            LogActivity::create($log_pairing);
	            $request->session()->flash('success', 'Successfully, upadated composition');
            }else{
            	$request->session()->flash('failed', 'Failed, Total composition must 100%');
            }
        }else{
            $request->session()->flash('failed', 'Failed, Password is wrong');
        }
        return redirect()->back();
    }
}
