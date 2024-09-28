<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Project;
use App\Models\Settings;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Income::where('project_id', 1)->get();
        $data = Project::where('project_id', 1)->get();
        $setting = Settings::where('status', 0) firstOrFail();

        return view('admin.invoice.index', compact('invoices', 'data', 'setting'));
    }
}
