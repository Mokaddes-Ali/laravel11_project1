<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function incomeindex(){
        $all = Project::where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.Income.add', compact('all'));
      }

      public function incomeshow(){
        $all = Income::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('admin.Income.show', compact('all'));
      }


    public function incomestore(Request $request){
        // dd($request->all());
        $request->validate([

            'project_id' => 'required',
            'income_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account_id' => 'required',

        ]);

        DB::beginTransaction();

        try {

        $insert=Income::insertGetId([
           'project_id' => $request->project_id,
           'income_amount' => $request->income_amount,
           'date' => $request->date,
           'note' => $request->note,
           'bank_account_id' => $request->bank_account_id,
           'creator' => Auth::user()->id,
           'slug' => $request->project_id . rand(10000,10000000),

        ]);

        $data=Project::where('id',$request->project_id)->firstOrFail();

        $paid_amount = (float) $request->income_amount + (float) $data->paid_amount;
        $due_amount = (float) $data->project_value - (float)$paid_amount;

        if( $insert){
            $update = Project::where('id',$request->project_id)->update([
                'paid_amount' => $paid_amount,
                'due_amount' => $due_amount,

                ]);
                DB::commit();

         return redirect()->back()->with('success','Data inserted successfully');

        }
    } catch (\Exception $e) {
    DB::rollback();
  }
}
}