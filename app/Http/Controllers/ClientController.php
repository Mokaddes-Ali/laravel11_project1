<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('admin.client.add');
    }

    public function show(){
        $all = Client::all();
        return view('admin.client.show', compact('all'));
    }

    public function edit($id){
        $record = Client::findOrFail($id);
        return view('admin.client.edit', compact('record'));
    }

    public function update(Request $request){
        $id = $request->id;
        $validated = $request->validate([
            'name' => 'required|max:40',
            'email' => 'required',
            'number' => 'required',
            'password' => 'required',
            'pic' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        $client = Client::findOrFail($id);
        $image_rename = $client->pic;

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $extension = $image->getClientOriginalExtension();
            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $extension;
            $image->move(public_path('images'), $image_rename);

            // Delete old image
            $oldImgPath = public_path('images/' . $client->pic);
            if (file_exists($oldImgPath)) {
                unlink($oldImgPath);
            }
        }

        $update = $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => $request->password,
            'pic' => $image_rename,
        ]);

        if ($update) {
            return back()->with('success', 'Data updated successfully');
        } else {
            return back()->with('fail', 'Data update failed');
        }
    }

    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:40',
            'email' => 'required',
            'number' => 'required',
            'password' => 'required',
            'pic' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);

        $image_rename = '';
        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $extension = $image->getClientOriginalExtension();
            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $extension;
            $image->move(public_path('images'), $image_rename);
        }

        $insert = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => $request->password,
            'pic' => $image_rename,
        ]);

        if ($insert) {
            return back()->with('success', 'Data inserted successfully');
        } else {
            return back()->with('fail', 'Data insertion failed');
        }
    }

    public function destroy($id){
        $client = Client::find($id);
        if ($client) {
            $imagePath = public_path('images/' . $client->pic);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $client->delete();
            return back()->with('success', 'Data deleted successfully');
        } else {
            return back()->with('fail', 'Client not found');
        }
    }
}
