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
        // Fetch invoices related to project ID 1
        $invoices = Income::where('project_id', 1)->get();

        // Fetch the first project with ID 1
        $data = Project::where('id', 1)->first();  // Use `first()` to get a single project object instead of a collection.

        // Fetch the first setting with status 0
        $setting = Settings::where('status', 0)->firstOrFail();

        // Return the view with the data compacted into variables
        return view('admin.invoice.index', compact('invoices', 'data', 'setting'));
    }
}
