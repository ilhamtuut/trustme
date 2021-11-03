<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
	public function index(Request $request)
	{
		$data = Bank::orderBy('name','asc')->paginate(20);
		return view('backend.bank.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'country' => 'required'
        ]);

        Bank::create([
	        'name' => $request->name,
	        'code' => $request->code,
	    	'country' => $request->country,
	    	'status' => 1
        ]);

        $request->session()->flash('success', 'Success, Add Bank');
        return redirect()->back();
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'country' => 'required'
        ]);

        Bank::find($id)->update([
	        'name' => $request->name,
	        'code' => $request->code,
	    	'country' => $request->country
        ]);

        $request->session()->flash('success', 'Successfully, Update data Bank');
        return redirect()->back();
	}

    public function mybank(Request $request)
    {
    	$user = Auth::user();
    	$data = $user->mybank()->get();
        $bank = Bank::get();
        return view('backend.bank.mybank',compact('data','bank'));
    }

    public function addBankUser(Request $request)
    {
		$this->validate($request, [
            'bank_name' => 'required',
            'bank_account' => 'required',
            'bank_username' => 'required'
        ]);
		$status = 0;
		if(Auth::user()->mybank()->count() == 0){
			$status = 1;
		}
        BankUser::create([
        	'user_id' => Auth::id(),
	        'bank_id' => $request->bank_name,
	        'account' => $request->bank_account,
	        'username' => $request->bank_username,
	    	'status' => $status
        ]);

        $request->session()->flash('success', 'Successfully, Add New Bank');
        return redirect()->back();
    }

    public function changeActive(Request $request, $id)
    {
    	BankUser::where('user_id', Auth::id())->update(['status'=>0]);
    	BankUser::find($id)->update(['status'=>1]);

        $request->session()->flash('success', 'Successfully, Shange Setting Active Bank');
        return redirect()->back();
    }

	public function list(Request $request)
	{
		$search = $request->search;
		$data = BankUser::when($search, function ($query) use ($search){
					$query->whereHas('user', function ($q) use ($search){
						$q->where('users.username', 'like', '%'.$search.'%');
					});
				})->paginate(20);
		return view('backend.bank.list', compact('data'))->with('i', (request()->input('page', 1) - 1) * 20);
	}
}
