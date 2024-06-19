<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function report()
    {
        return view('admin.report.index');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $request->input('start_date');

        $endDate = $request->input('end_date');
        
        $toDate = $endDate . ' 23.59.59';

        $borrows = Borrow::with(['user', 'book'])->whereBetween('created_at', [$startDate, $toDate])->get();

        $pdf = Pdf::loadView('admin.report.report', compact('borrows', 'request'))->setPaper('a4', 'landscape');

        return $pdf->download('borrow_report.pdf');

    }
}
