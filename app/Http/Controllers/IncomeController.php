<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class IncomeController extends Controller
{
    public function incomeindex(){
        $all = Project::where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.Income.add', compact('all'));
    }

    // public function incomeshow(){
    //     $all = Income::where('status', 1)->orderBy('id', 'ASC')->get();
    //     return view('admin.Income.show', compact('all'));
    // }

//     public function incomeshow(){
//       // Controller code
// $all = DB::table('incomes')
// ->join('projects', 'incomes.project_id', '=', 'projects.id')
// ->join('clients', 'projects.client_id', '=', 'clients.id')
// ->select('projects.project_name', 'clients.name as client_name', DB::raw('GROUP_CONCAT(incomes.income_amount) as income_amounts'), 'incomes.created_at')
// ->groupBy('projects.project_name', 'clients.name', 'incomes.created_at')
// ->orderBy('incomes.created_at', 'asc')
// ->get();

// // Calculate total income
// $totalAmount = DB::table('incomes')
// ->sum('income_amount');


//         return view('admin.Income.show', compact('all', 'totalAmount'));
//     }

public function incomeshow(Request $request){
    // Retrieve start and end date filters from request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Build the query to get the incomes with date filtering
    $query = DB::table('incomes')
        ->join('projects', 'incomes.project_id', '=', 'projects.id')
        ->join('clients', 'projects.client_id', '=', 'clients.id')
        ->select(
            'projects.id as project_id',  // Ensure project ID is selected
            'projects.project_name',
            'clients.name as client_name',
            DB::raw('GROUP_CONCAT(incomes.income_amount) as income_amounts'),
            'incomes.created_at'
        )
        ->groupBy('projects.id', 'projects.project_name', 'clients.name', 'incomes.created_at')
        ->orderBy('incomes.created_at', 'asc');

    // Apply date filters if they exist
    if ($startDate && $endDate) {
        $query->whereBetween('incomes.created_at', [$startDate, $endDate]);
    }

    // Get the data
    $all = $query->get();

    // Calculate total income with date filtering
    $totalAmountQuery = DB::table('incomes');
    if ($startDate && $endDate) {
        $totalAmountQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $totalAmount = $totalAmountQuery->sum('income_amount');

    return view('admin.Income.show', compact('all', 'totalAmount'));
}




    public function filter(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $all = Income::whereDate('date', '>=', $start_date)->whereDate('date', '<=', $end_date)->get();
        return view('admin.Income.show', compact('all'));
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('search');

    $all = Income::where(function($query) use ($searchTerm) {
        $query->whereRaw('LOWER(income.project_name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
              ->orWhereRaw('LOWER(note) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
    })->get();

    return view('your.view.name', compact('all'));
}


    // public function incomestore(Request $request){
    //     $request->validate([
    //         'project_id' => 'required',
    //         'income_amount' => 'required',
    //         'date' => 'required',
    //         'note' => 'required',
    //         'bank_account_id' => 'required',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $insert = Income::insertGetId([
    //             'project_id' => $request->project_id,
    //             'income_amount' => $request->income_amount,
    //             'date' => $request->date,
    //             'note' => $request->note,
    //             'bank_account_id' => $request->bank_account_id,
    //             'creator' => Auth::user()->id,
    //             'slug' => $request->project_id . rand(10000, 10000000),
    //         ]);

    //         $data = Project::where('id', $request->project_id)->firstOrFail();

    //         $paid_amount = (float) $request->income_amount + (float) $data->paid_amount;
    //         $due_amount = (float) $data->project_value - (float) $paid_amount;

    //         if ($insert) {
    //             Project::where('id', $request->project_id)->update([
    //                 'paid_amount' => $paid_amount,
    //                 'due_amount' => $due_amount,
    //             ]);
    //             DB::commit();

    //             return redirect()->back()->with('success', 'Data inserted successfully');
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //     }
    // }

    // public function incomestore(Request $request) {
    //     $request->validate([
    //         'project_id' => 'required',
    //         'income_amount' => 'required',
    //         'date' => 'required',
    //         'note' => 'required',
    //         'bank_account_id' => 'required',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Insert income data
    //         $insert = Income::insertGetId([
    //             'project_id' => $request->project_id,
    //             'income_amount' => $request->income_amount,
    //             'date' => $request->date,
    //             'note' => $request->note,
    //             'bank_account_id' => $request->bank_account_id,
    //             'creator' => Auth::user()->id,
    //             'slug' => $request->project_id . rand(10000, 10000000),
    //         ]);

    //         // Fetch project data
    //         $project = Project::where('id', $request->project_id)->firstOrFail();

    //         $paid_amount = (float) $request->income_amount + (float) $project->paid_amount;
    //         $due_amount = (float) $project->project_value - (float) $paid_amount;

    //         // Update project paid and due amounts
    //         if ($insert) {
    //             Project::where('id', $request->project_id)->update([
    //                 'paid_amount' => $paid_amount,
    //                 'due_amount' => $due_amount,
    //             ]);

    //             // Generate dynamic message
    //             if ($due_amount == 0) {
    //                 $message = "Success! All dues have been cleared.";
    //             } elseif ($due_amount < 0) {
    //                 $message = "Warning! Income exceeds the project value by " . abs($due_amount) . " Taka.";
    //             } elseif ($due_amount > 0) {
    //                 $message = "Note: " . $due_amount . " Taka is still due.";
    //             } else {
    //                 $message = "Unpaid!";
    //             }

    //             DB::commit();

    //             return redirect()->back()->with('success', 'Data inserted successfully. ' . $message)
    //                                      ->with('project_value', $project->project_value)
    //                                      ->with('total_paid', $paid_amount)
    //                                      ->with('due_amount', $due_amount);
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    //     }
    // }

    public function incomestore(Request $request) {
        $request->validate([
            'project_id' => 'required',
            'income_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account_id' => 'required',
        ]);

        // Fetch the project to check due amount
        $project = Project::where('id', $request->project_id)->firstOrFail();
        $due_amount = (float) $project->project_value - (float) $project->paid_amount;

        // Check if income amount exceeds due amount
        if ($request->income_amount > $due_amount) {
            return redirect()->back()->with('error', 'Income amount cannot exceed the due amount.')->withInput();
        }

        DB::beginTransaction();

        try {
            // Insert income data
            $insert = Income::insertGetId([
                'project_id' => $request->project_id,
                'income_amount' => $request->income_amount,
                'date' => $request->date,
                'note' => $request->note,
                'bank_account_id' => $request->bank_account_id,
                'creator' => Auth::user()->id,
                'slug' => $request->project_id . rand(10000, 10000000),
            ]);

            $paid_amount = (float) $request->income_amount + (float) $project->paid_amount;
            $remaining_due = (float) $project->project_value - (float) $paid_amount;

            // Update project paid and due amounts
            if ($insert) {
                Project::where('id', $request->project_id)->update([
                    'paid_amount' => $paid_amount,
                    'due_amount' => $remaining_due,
                ]);

                // Generate dynamic message
                $message = '';
                if ($remaining_due == 0) {
                    $message = "Success! All dues have been cleared.";
                } elseif ($remaining_due > 0) {
                    $message = "Note: " . $remaining_due . " Taka is still due.";
                } else {
                    $message = "Unexpected error occurred.";
                }

                DB::commit();

                return redirect()->back()->with('success', 'Data inserted successfully. ' . $message)
                                         ->with('project_value', $project->project_value)
                                         ->with('total_paid', $paid_amount)
                                         ->with('due_amount', $remaining_due);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function fetchProjectDetails($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json([
            'project_value' => $project->project_value,
            'paid_amount' => $project->paid_amount,
            'due_amount' => $project->due_amount,
        ]);
    }




    public function edit($id){
        $all = Project::where('status', 0)->get();
        $data = Income::where('id', $id)->firstOrFail();
        return view('admin.Income.edit', compact('data', 'all'));
    }

    public function update(Request $request){
        $request->validate([
            'project_id' => 'required',
            'income_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $oldincome = Income::where('id', $request->id)->firstOrFail();

            $update = Income::where('id', $request->id)->update([
                'project_id' => $request->project_id,
                'income_amount' => $request->income_amount,
                'date' => $request->date,
                'note' => $request->note,
                'bank_account_id' => $request->bank_account,
                'editor' => Auth::user()->id,
            ]);

            $data = Project::where('id', $request->project_id)->firstOrFail();

            $paid_amount = (float) $request->income_amount + (float) $data->paid_amount - (float) $oldincome->income_amount;
            $due_amount = (float) $data->project_value - (float) $paid_amount;

            if ($update) {
                Project::where('id', $request->project_id)->update([
                    'paid_amount' => $paid_amount,
                    'due_amount' => $due_amount,
                ]);
                DB::commit();

                return redirect()->back()->with('success', 'Data updated successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    // Delete functionality
    public function destroy($id){
        DB::beginTransaction();

        try {
            $income = Income::where('id', $id)->firstOrFail();
            $project = Project::where('id', $income->project_id)->firstOrFail();

            $paid_amount = (float) $project->paid_amount - (float) $income->income_amount;
            $due_amount = (float) $project->project_value - (float) $paid_amount;

            Income::where('id', $id)->delete();

            Project::where('id', $project->id)->update([
                'paid_amount' => $paid_amount,
                'due_amount' => $due_amount,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Income record deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete the income record');
        }
    }
}
