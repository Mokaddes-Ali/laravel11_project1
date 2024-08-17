<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('admin.client.add');
    }
     public function create(Request $request){
        // dd($request -> all());

        // $validated = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|max:255',
        //     'number' => 'required|max:255',
        //     'password' => 'required|max:255',
        //     'pic' => 'required|image|mimes:jpeg,png,gif|max:2048',
        // ]);

        // if($request -> hasFile('pic')){
        //     $image = $request -> file('pic');
            // $filename = date('YmdHi').$file -> getClientOriginalName();
            // $file -> move(public_path('public/client'), $filename);
        // }

        $insert = Client :: insertGetId([
            'name' => $request ['name'],
            'email' => $request ['email'],
            'number' => $request ['number'],
            'password' => $request ['password'],
        ]);

    if($insert){
        return back()->with('success', 'Data inserted Successfully');
    }
    else{
        return back()->with('fail', 'Data not inserted');
    }
    }

}
