<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Income;
use App\Models\Project;
use App\Models\Settings;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{
    // public function index($pid)
    // {
    //     $invoices = Income::where('project_id', $pid)->get();
    //     $data = Project::where('id', $pid)->first();
    //     $client = Client::where('id', $data->client_id)->first();
    //     $setting = Settings::where('status', 0)->firstOrFail();
    //     return view('admin.invoice.index', compact('invoices', 'data', 'setting'));
    // }

    public function index($pid)
{
    $invoices = Income::where('project_id', $pid)->get();
    $data = Project::where('id', $pid)->first();
    $client = Client::where('id', $data->client_id)->first();
    $setting = Settings::where('status', 0)->firstOrFail();
    return view('admin.invoice.index', compact('invoices', 'data', 'setting', 'client'));
}


    public function pdf($pid)
    {

        $invoices = Income::where('project_id', $pid)->get();
        $data = Project::where('id', $pid)->first();
        $setting = Settings::where('status', 0)->firstOrFail();
        $pdf = Pdf::loadView('admin.invoice.pdf', compact('invoices', 'data', 'setting'));
        return $pdf->download('invoice.pdf');
    }
}
