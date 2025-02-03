<?php
namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LoansExport implements FromCollection
{
    public function collection()
    {
        return Loan::all();
    }
}
