<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Barryvdh\DomPDF\PDF;
use App\Exports\LoansExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function create()
    {
        return view('admin.loan.create');
    }

    // public function index()
    // {
    //     $loans = Loan::all();
    //     return view('admin.loan.index', compact('loans'));
    // }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');
        $perPage = $request->query('per_page', 10);
        $loans = Loan::query()
            ->when($search, function ($query, $search) {
                return $query->where('loan_id', 'like', '%' . $search . '%');
            })
            ->orderBy($sort, $direction)
            ->paginate($perPage === 'all' ? Loan::count() : $perPage);

        return view('admin.loan.index', compact('loans'));
    }


    public function export($type)
    {
        if ($type === 'csv') {
            return Excel::download(new LoansExport, 'loans.csv');
        } elseif ($type === 'excel') {
            return Excel::download(new LoansExport, 'loans.xlsx');
        } elseif ($type === 'pdf') {
            $loans = Loan::all();
            $pdf = PDF::loadView('loans.pdf', compact('loans'));
            return $pdf->download('loans.pdf');
        }
    }


    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $loan_id = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2)) .
                       now()->format('YmdHis') .
                       rand(10, 99);
            $total_amount = $request->amount + ($request->amount * $request->interest_rate / 100);
            $monthly_pay_amount = $total_amount / $request->duration;
            Loan::create([
                'name' => $request->name,
                'loan_id' => $loan_id,
                'amount' => $request->amount,
                'duration' => $request->duration,
                'interest_rate' => $request->interest_rate,
                'total_pay_amount' => $total_amount,
                'monthly_pay_amount' => $monthly_pay_amount,
            ]);
            DB::commit();

            return redirect()->route('loans.index')->with('success', 'Loan created successfully!');
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create loan. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        return view('admin.loan.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {

            $total_amount = $request->amount + ($request->amount * $request->interest_rate / 100);

            $monthly_pay_amount = $total_amount / $request->duration;

            $loan->update([
                'name' => $request->name,
                'amount' => $request->amount,
                'duration' => $request->duration,
                'interest_rate' => $request->interest_rate,
                'total_pay_amount' => $total_amount,
                'monthly_pay_amount' => $monthly_pay_amount,
            ]);

            DB::commit();


            return redirect()->route('loans.index')->with('success', 'Loan updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update loan. Please try again.')->withInput();
        }
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        DB::beginTransaction();

        try {
            $loan->delete();

            DB::commit();

            return redirect()->route('loans.index')->with('success', 'Loan deleted successfully!');
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->route('loans.index')->with('error', 'Failed to delete loan. Please try again.');
        }
    }
}
