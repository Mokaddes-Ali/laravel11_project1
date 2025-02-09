<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\Payment;
use App\Models\Transaction;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class LoanApplicationController extends Controller
{
    // Index
    public function index()
    {
        $loanApplications = LoanApplication::with(['client', 'loan'])->get();
        return view('admin.loan_applications.index', compact('loanApplications'));
    }

    // Create
    public function create()
    {
        $clients = Client::where('user_id', auth()->id())->get();
        $loans = Loan::all();
        return view('admin.loan_applications.create', compact('clients', 'loans'));
    }

    public function getLoanDetails($id)
{
    $loan = Loan::find($id);

    if (!$loan) {
        return response()->json(['error' => 'Loan not found'], 404);
    }

    return response()->json([
        'amount' => $loan->amount,
        'interest_rate' => $loan->interest_rate,
        'duration' => $loan->duration,
        'total_payable' => $loan->total_pay_amount,
        'monthly_installment' => $loan->monthly_pay_amount
    ]);
}


    // // Store
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'client_id' => 'required|exists:clients,id',
    //         'loan_id' => 'required|exists:loans,id',
    //         'application_id' => 'required|unique:loan_applications',
    //         'payable_amount' => 'required|numeric',
    //         'loan_purpose' => 'required|in:Business,Personal,Education,Medical,Other',
    //         'loan_perporse' => 'required|string',
    //     ]);

    //     LoanApplication::create($request->all());

    //     return redirect()->route('loan-applications.index')->with('success', 'Loan application created successfully.');
    // }

    public function store(Request $request)
{
    try {
        // Validate incoming request
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'loan_id' => 'required|exists:loans,id',
            'application_id' => 'required|unique:loan_applications',
            'loan_purpose' => 'required|in:Business,Personal,Education,Medical,Other',
            'loan_perporse' => 'required|string',
            'collateral_details' => 'nullable|string',
        ]);

        // Check if the loan exists
        $loan = Loan::find($request->loan_id);
        if (!$loan) {
            return redirect()->back()->with('error', 'Invalid Loan ID.');
        }

        // Set Payable Amount
        $payable_amount = $loan->amount ?? 0;

        // Loan Application তৈরি করা
        $loanApplication = LoanApplication::create([
            'client_id' => $request->client_id,
            'loan_id' => $request->loan_id,
            'application_id' => $request->application_id,
            'payable_amount' => $payable_amount,
            'monthly_installment' => $loan->monthly_pay_amount,
            'loan_purpose' => $request->loan_purpose,
            'loan_perporse' => $request->loan_perporse,
            'collateral_details' => $request->collateral_details,
        ]);

        if ($loanApplication) {
            return redirect()->route('loan-applications.index')->with('success', 'Loan application created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create loan application.');
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function showPaymentForm($id)
{
    // ID দিয়ে LoanApplication খুঁজে বের করা
    $loanApplication = LoanApplication::findOrFail($id);

    // ভিউতে loanApplication পাঠানো
    return view('admin.loan_applications.payment_form', compact('loanApplication'));
}

public function makePayment(Request $request, $loanApplicationId)
{
    $loanApplication = LoanApplication::findOrFail($loanApplicationId);
    $amountToPay = $request->amount;

    // Stripe Payment Logic
    if ($request->payment_method == 'stripe') {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $amountToPay * 100, // Stripe amount in cents
            'currency' => 'usd',
        ]);

        $payment = Payment::create([
            'loan_application_id' => $loanApplication->id,
            'amount_paid' => $amountToPay,
            'payment_method' => 'stripe',
        ]);

        Transaction::create([
            'payment_id' => $payment->id,
            'transaction_amount' => $amountToPay,
            'transaction_id' => $paymentIntent->id // Stripe transaction ID
        ]);
    }

    // Cash Payment Logic
    if ($request->payment_method == 'cash') {
        $payment = Payment::create([
            'loan_application_id' => $loanApplication->id,
            'amount_paid' => $amountToPay,
            'payment_method' => 'cash',
        ]);

        Transaction::create([
            'payment_id' => $payment->id,
            'transaction_amount' => $amountToPay,
            'transaction_id' => 'CASH-' . uniqid()
        ]);
    }

    // Update loan application amounts
    $loanApplication->paid_amount += $amountToPay;
    $loanApplication->due_amount = $loanApplication->payable_amount - $loanApplication->paid_amount;
    $loanApplication->save();

    return back()->with('message', ucfirst($request->payment_method) . ' Payment Successful');
}


    // Show
    public function show(LoanApplication $loanApplication)
    {
        return view('loan_applications.show', compact('loanApplication'));
    }

    // Edit
    public function edit(LoanApplication $loanApplication)
    {
        return view('loan_applications.edit', compact('loanApplication'));
    }

    // Update
    public function update(Request $request, LoanApplication $loanApplication)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'loan_id' => 'required|exists:loans,id',
            'application_id' => 'required|unique:loan_applications,application_id,' . $loanApplication->id,
            'due_amount' => 'required|numeric',
            'repayment_schedule' => 'required|in:Monthly,Quarterly,Yearly',
            'loan_purpose' => 'required|in:Business,Personal,Education,Medical,Other',
            'loan_perporse' => 'required|string',
            'status' => 'required|in:pending,approved,rejected,closed',
        ]);

        $loanApplication->update($request->all());

        return redirect()->route('loan-applications.index')->with('success', 'Loan application updated successfully.');
    }

    // Destroy
    public function destroy(LoanApplication $loanApplication)
    {
        $loanApplication->delete();
        return redirect()->route('loan-applications.index')->with('success', 'Loan application deleted successfully.');
    }
}
