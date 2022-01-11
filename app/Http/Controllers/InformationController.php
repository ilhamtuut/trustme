<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $data = Information::first();
        return view('backend.info.index',compact('data'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string',
        ]);

        $data = Information::first();
        if($data){
            $data->content = $request->content;
            $data->save();
        }else{
            Information::create([
                'content' =>$request->content
            ]);
        }

        $request->session()->flash('success', 'Successfully, updated information');
        return redirect()->back();
    }
}
