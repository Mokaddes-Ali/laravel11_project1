<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Loan;
use App\Models\Client;
use App\Models\Payment;
use Stripe\PaymentIntent;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;

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

// public function makePayment(Request $request, $loanApplicationId)
// {
//     $loanApplication = LoanApplication::findOrFail($loanApplicationId);
//     $amountToPay = $request->amount;

//     // Stripe Payment Logic
//     if ($request->payment_method == 'stripe') {
//         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

//         $paymentIntent = PaymentIntent::create([
//             'amount' => $amountToPay * 100, // Stripe amount in cents
//             'currency' => 'usd',
//         ]);

//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'stripe',
//         ]);

//         Transaction::create([
//             'payment_id' => $payment->id,
//             'transaction_amount' => $amountToPay,
//             'transaction_id' => $paymentIntent->id // Stripe transaction ID
//         ]);
//     }

//     // Cash Payment Logic
//     if ($request->payment_method == 'cash') {
//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'cash',
//         ]);

//         Transaction::create([
//             'payment_id' => $payment->id,
//             'transaction_amount' => $amountToPay,
//             'transaction_id' => 'CASH-' . uniqid()
//         ]);
//     }

//     // Update loan application amounts
//     $loanApplication->paid_amount += $amountToPay;
//     $loanApplication->due_amount = $loanApplication->payable_amount - $loanApplication->paid_amount;
//     $loanApplication->save();

//     return back()->with('message', ucfirst($request->payment_method) . ' Payment Successful');
// }



// public function makePayment(Request $request, $loanApplicationId)
// {
//     $loanApplication = LoanApplication::findOrFail($loanApplicationId);
//     $amountToPay = $request->amount;

//     if ($request->payment_method == 'stripe') {
//         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

//         $paymentIntent = PaymentIntent::create([
//             'amount' => $amountToPay * 100, // Stripe amount in cents
//             'currency' => 'usd',
//         ]);

//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'stripe',
//         ]);

//         Transaction::create([
//             'payment_id' => $payment->id,
//             'transaction_amount' => $amountToPay,
//             'transaction_id' => $paymentIntent->id // Stripe transaction ID
//         ]);

//         return response()->json(['clientSecret' => $paymentIntent->client_secret]); // client_secret পাঠানো হচ্ছে
//     }

//     if ($request->payment_method == 'cash') {
//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'cash',
//         ]);

//         Transaction::create([
//             'payment_id' => $payment->id,
//             'transaction_amount' => $amountToPay,
//             'transaction_id' => 'CASH-' . uniqid()
//         ]);

//         $loanApplication->paid_amount += $amountToPay;
//         $loanApplication->due_amount = $loanApplication->payable_amount - $loanApplication->paid_amount;
//         $loanApplication->save();

//         return back()->with('success', 'Cash Payment Successful!');
//     } else {
//         return back()->with('error', 'Payment failed! Please try again.');
//     }

// }

// public function makePayment(Request $request, $loanApplicationId)
// {
//     $loanApplication = LoanApplication::findOrFail($loanApplicationId);
//     $amountToPay = $request->amount;
//     $email = $request->email;
//     $cardHolderName = $request->card_holder_name;

//     if ($request->payment_method == 'stripe') {
//         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

//         $paymentIntent = PaymentIntent::create([
//             'amount' => $amountToPay * 100, // Stripe amount in cents
//             'currency' => 'usd',
//             'payment_method_types' => ['card'],
//         ]);

//         $transactionId = $paymentIntent->id;

//         // Save to database
//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'stripe',
//             'email' => $email,
//             'card_holder_name' => $cardHolderName
//         ]);

//         Transaction::create([
//             'payment_id' => $payment->id,
//             'transaction_amount' => $amountToPay,
//             'transaction_id' => $transactionId
//         ]);

//         // Send Email Notification
//         Mail::to($email)->send(new PaymentConfirmation($payment));

//         return response()->json(['message' => 'Payment successful!', 'clientSecret' => $paymentIntent->client_secret]);
//     } elseif ($request->payment_method == 'cash') {
//         // Save Cash Payment
//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'cash',
//             'email' => $email
//         ]);

//         Mail::to($email)->send(new PaymentConfirmation($payment));

//         return redirect()->back()->with('success', 'Cash payment recorded successfully!');
//     }

//     return redirect()->back()->with('error', 'Invalid payment method.');
// }






// public function makePayment(Request $request, $loanApplicationId)
// {
//     $loanApplication = LoanApplication::findOrFail($loanApplicationId);
//     $amountToPay = $request->amount;
//     $email = $request->email;
//     $cardHolderName = $request->card_holder_name;

//     $fromEmail = 'noreply@yourcompany.com'; // Company email
//     $fromName = 'Your Company Name'; // Company name

//     if ($request->payment_method == 'stripe') {
//         // Set your secret key from Stripe
//         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

//         // Create a PaymentIntent to begin the Stripe process
//         try {
//             $paymentIntent = PaymentIntent::create([
//                 'amount' => $amountToPay * 100, // Stripe amount in cents
//                 'currency' => 'usd',
//                 'payment_method_types' => ['card'],
//             ]);

//             $transactionId = $paymentIntent->id;

//             // Save Payment to Database
//             $payment = Payment::create([
//                 'loan_application_id' => $loanApplication->id,
//                 'amount_paid' => $amountToPay,
//                 'payment_method' => 'stripe',
//                 'email' => $email,
//                 'card_holder_name' => $cardHolderName
//             ]);

//             // Create Transaction for Stripe Payment
//             Transaction::create([
//                 'payment_id' => $payment->id,
//                 'transaction_amount' => $amountToPay,
//                 'transaction_id' => $transactionId
//             ]);

//             // Send Email Notification for Stripe Payment
//             Mail::send('emails.payment_confirmation', ['payment' => $payment], function ($message) use ($email, $fromEmail, $fromName) {
//                 $message->from($fromEmail, $fromName)
//                         ->to($email)
//                         ->subject('Payment Confirmation - Loan Application');
//             });

//             return response()->json(['message' => 'Payment successful!', 'clientSecret' => $paymentIntent->client_secret]);

//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Payment failed: ' . $e->getMessage()]);
//         }
//     } elseif ($request->payment_method == 'cash') {
//         // Save Cash Payment
//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'cash',
//             'email' => $email,
//         ]);

//         // Send Email Notification for Cash Payment
//         Mail::send('emails.payment_confirmation', ['payment' => $payment], function ($message) use ($email, $fromEmail, $fromName) {
//             $message->from($fromEmail, $fromName)
//                     ->to($email)
//                     ->subject('Cash Payment Confirmation - Loan Application');
//         });

//         return redirect()->back()->with('success', 'Cash payment recorded successfully!');
//     }

//     return redirect()->back()->with('error', 'Invalid payment method.');
// }


// public function makePayment(Request $request, $loanApplicationId)
// {
//     // Validate the incoming request
//     $request->validate([
//         'amount' => 'required|numeric|min:1', // Ensure amount is a number and greater than 0
//         'email' => 'required|email', // Ensure email is valid
//         'payment_method' => 'required|in:stripe,cash', // Only allow 'stripe' or 'cash' as valid payment methods
//         'card_holder_name' => 'required_if:payment_method,stripe|string|max:255', // Only require card holder name if payment method is 'stripe'
//     ]);

//     $loanApplication = LoanApplication::findOrFail($loanApplicationId);
//     $amountToPay = $request->amount;
//     $email = $request->email;
//     $cardHolderName = $request->card_holder_name;

//     $fromEmail = 'noreply@yourcompany.com'; // Company email
//     $fromName = 'Your Company Name'; // Company name

//     if ($request->payment_method == 'stripe') {
//         // Set your secret key from Stripe
//         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

//         // Create a PaymentIntent to begin the Stripe process
//         try {
//             $paymentIntent = PaymentIntent::create([
//                 'amount' => $amountToPay * 100, // Stripe amount in cents
//                 'currency' => 'usd',
//                 'payment_method_types' => ['card'],
//             ]);

//             $transactionId = $paymentIntent->id;

//             // Save Payment to Database
//             $payment = Payment::create([
//                 'loan_application_id' => $loanApplication->id,
//                 'amount_paid' => $amountToPay,
//                 'payment_method' => 'stripe',
//                 'email' => $email,
//                 'card_holder_name' => $cardHolderName
//             ]);

//             // Create Transaction for Stripe Payment
//             Transaction::create([
//                 'payment_id' => $payment->id,
//                 'transaction_amount' => $amountToPay,
//                 'transaction_id' => $transactionId
//             ]);

//             // Send Email Notification for Stripe Payment
//             Mail::send('emails.payment_confirmation', ['payment' => $payment], function ($message) use ($email, $fromEmail, $fromName) {
//                 $message->from($fromEmail, $fromName)
//                         ->to($email)
//                         ->subject('Payment Confirmation - Loan Application');
//             });

//             // Return success message with client secret for Stripe
//             return response()->json([
//                 'message' => 'Payment successful!',
//                 'clientSecret' => $paymentIntent->client_secret
//             ]);

//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Payment failed: ' . $e->getMessage()]);
//         }
//     } elseif ($request->payment_method == 'cash') {
//         // Save Cash Payment
//         $payment = Payment::create([
//             'loan_application_id' => $loanApplication->id,
//             'amount_paid' => $amountToPay,
//             'payment_method' => 'cash',
//             'email' => $email,
//             'card_holder_name' => $cardHolderName
//         ]);

//         // Send Email Notification for Cash Payment
//         Mail::send('emails.payment_confirmation', ['payment' => $payment], function ($message) use ($email, $fromEmail, $fromName) {
//             $message->from($fromEmail, $fromName)
//                     ->to($email)
//                     ->subject('Cash Payment Confirmation - Loan Application');
//         });

//             $loanApplication->paid_amount += $amountToPay;
//         $loanApplication->due_amount = $loanApplication->payable_amount - $loanApplication->paid_amount;
//       $loanApplication->save();

//         // Redirect with success message for cash payment
//         return redirect()->back()->with('success', 'Cash payment recorded successfully!');
//     }

//     // If an invalid payment method is selected, return an error
//     return redirect()->back()->with('error', 'Invalid payment method.');
// }



public function makePayment(Request $request, $loanApplicationId)
{
    // Validate the incoming request
    $request->validate([
        'amount' => 'required|numeric|min:1', // Ensure amount is a number and greater than 0
        'email' => 'required|email', // Ensure email is valid
        'payment_method' => 'required|in:stripe,cash', // Only allow 'stripe' or 'cash' as valid payment methods
        'card_holder_name' => 'required_if:payment_method,stripe|string|max:255', // Only require card holder name if payment method is 'stripe'
    ]);

    $loanApplication = LoanApplication::findOrFail($loanApplicationId);
    $amountToPay = $request->amount;
    $email = $request->email;
    $cardHolderName = $request->card_holder_name;

    $fromEmail = 'noreply@yourcompany.com'; // Company email
    $fromName = 'Your Company Name'; // Company name

    if ($request->payment_method == 'stripe') {
        // Set your secret key from Stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Create a PaymentIntent to begin the Stripe process
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amountToPay * 100, // Stripe amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            $transactionId = $paymentIntent->id;

            // Save Payment to Database
            $payment = Payment::create([
                'loan_application_id' => $loanApplication->id,
                'amount_paid' => $amountToPay,
                'payment_method' => 'stripe',
                'email' => $email,
                'card_holder_name' => $cardHolderName
            ]);

            // Create Transaction for Stripe Payment
            Transaction::create([
                'payment_id' => $payment->id,
                'transaction_amount' => $amountToPay,
                'transaction_id' => $transactionId
            ]);

            // // Send Email Notification for Stripe Payment
            // Mail::send('emails.payment_confirmation', ['payment' => $payment], function ($message) use ($email, $fromEmail, $fromName) {
            //     $message->from($fromEmail, $fromName)
            //             ->to($email)
            //             ->subject('Payment Confirmation - Loan Application');
            // });

            // Calculate and update loan application status
            $loanApplication->paid_amount += $amountToPay;
            $loanApplication->due_amount = $loanApplication->payable_amount - $loanApplication->paid_amount;
            $loanApplication->save();

            // Create notification for the user
            Notification::create([
                'loan_application_id' => $loanApplication->id,
                'message' => "A payment of \${$amountToPay} was successfully made via Stripe.",
                'type' => 'payment',
                'status' => 'unread',
            ]);

            // Return success message with client secret for Stripe
            return response()->json([
                'message' => 'Payment successful!',
                'clientSecret' => $paymentIntent->client_secret
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    } elseif ($request->payment_method == 'cash') {
        // Save Cash Payment
        $payment = Payment::create([
            'loan_application_id' => $loanApplication->id,
            'amount_paid' => $amountToPay,
            'payment_method' => 'cash',
            'email' => $email,
            'card_holder_name' => $cardHolderName
        ]);

        // // Send Email Notification for Cash Payment
        // Mail::send('emails.payment_confirmation', ['payment' => $payment], function ($message) use ($email, $fromEmail, $fromName) {
        //     $message->from($fromEmail, $fromName)
        //             ->to($email)
        //             ->subject('Cash Payment Confirmation - Loan Application');
        // });

        // Update loan application status after cash payment
        $loanApplication->paid_amount += $amountToPay;
        $loanApplication->due_amount = $loanApplication->payable_amount - $loanApplication->paid_amount;
        $loanApplication->save();

        // Create notification for the user
        Notification::create([
            'loan_application_id' => $loanApplication->id,
            'message' => "A cash payment of \${$amountToPay} was successfully recorded.",
            'type' => 'payment',
            'status' => 'unread',
        ]);

        // Redirect with success message for cash payment
        return redirect()->back()->with('success', 'Cash payment recorded successfully!');
    }

    // If an invalid payment method is selected, return an error
    return redirect()->back()->with('error', 'Invalid payment method.');
}


// public function makePayment(Request $request, $loanApplicationId)
//     {
//         $loanApplication = LoanApplication::findOrFail($loanApplicationId);
//         $amountToPay = $request->amount * 100; // Convert to cents

//         if ($request->payment_method === 'stripe') {
//             Stripe::setApiKey(env('STRIPE_SECRET'));

//             $paymentIntent = PaymentIntent::create([
//                 'amount' => $amountToPay,
//                 'currency' => 'usd',
//                 'payment_method_types' => ['card'],
//             ]);

//             return response()->json(['clientSecret' => $paymentIntent->client_secret]);
//         }

//         // Cash Payment Logic
//         if ($request->payment_method === 'cash') {
//             $payment = Payment::create([
//                 'loan_application_id' => $loanApplication->id,
//                 'amount_paid' => $amountToPay / 100,
//                 'payment_method' => 'cash',
//             ]);

//             Transaction::create([
//                 'payment_id' => $payment->id,
//                 'transaction_amount' => $amountToPay / 100,
//                 'transaction_id' => 'CASH-' . uniqid(),
//             ]);

//             return response()->json(['message' => 'Cash Payment Successful']);
//         }

//         return response()->json(['error' => 'Invalid payment method'], 400);
//     }



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
