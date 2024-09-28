<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Income::where('project_id', 1)->get();
        return view('admin.invoice.index', compact('invoices'));
    }
}
