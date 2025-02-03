<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function create()
    {
        return view('admin.loan.create');
    }

    // Display a listing of loans
    public function index()
    {
        $loans = Loan::all();
        return view('admin.loan.index', compact('loans'));
    }

    // Store a newly created loan in the database
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Generate loan_id (2 letters + date + time + 6 digits)
            $loan_id = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2)) .
                       now()->format('YmdHis') .
                       rand(100000, 999999);

            // Calculate total pay amount based on the interest rate
            $total_amount = $request->amount + ($request->amount * $request->interest_rate / 100);

            // Calculate monthly payment
            $monthly_pay_amount = $total_amount / $request->duration;

            // Create loan record
            Loan::create([
                'loan_id' => $loan_id,
                'amount' => $request->amount,
                'duration' => $request->duration,
                'interest_rate' => $request->interest_rate,
                'total_pay_amount' => $total_amount,
                'monthly_pay_amount' => $monthly_pay_amount,
            ]);

            // Commit the transaction
            DB::commit();

            // Flash success message
            return redirect()->route('loans.index')->with('success', 'Loan created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            // Flash error message
            return redirect()->back()->with('error', 'Failed to create loan. Please try again.')->withInput();
        }
    }

    // Update the specified loan
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Calculate total pay amount based on the interest rate
            $total_amount = $request->amount + ($request->amount * $request->interest_rate / 100);

            // Calculate monthly payment
            $monthly_pay_amount = $total_amount / $request->duration;

            // Update the loan
            $loan->update([
                'amount' => $request->amount,
                'duration' => $request->duration,
                'interest_rate' => $request->interest_rate,
                'total_pay_amount' => $total_amount,
                'monthly_pay_amount' => $monthly_pay_amount,
            ]);

            // Commit the transaction
            DB::commit();

            // Flash success message
            return redirect()->route('loans.index')->with('success', 'Loan updated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            // Flash error message
            return redirect()->back()->with('error', 'Failed to update loan. Please try again.')->withInput();
        }
    }

    // Remove the specified loan
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        // Begin transaction
        DB::beginTransaction();

        try {
            // Delete the loan
            $loan->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message
            return redirect()->route('loans.index')->with('success', 'Loan deleted successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            // Flash error message
            return redirect()->route('loans.index')->with('error', 'Failed to delete loan. Please try again.');
        }
    }
}
