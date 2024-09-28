<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){
        $all = Project::where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.expense.add', compact('all'));
      }



    public function show(){
        return view('admin.Expense.show');
    }



    public function store(Request $request){
        dd($request->all());
    }



    public function edit(){
        return view('admin.Expense.edit');
    }



    public function update(Request $request){
        dd($request->all());
    }



    public function destroy(){
        return view('admin.Expense.destroy');
    }
}
