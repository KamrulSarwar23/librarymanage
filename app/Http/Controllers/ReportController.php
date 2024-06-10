<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function report(){
        return view('admin.report.index');
    }


    public function generateReport(Request $request)
    {
        // Validate the date range inputs

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Fetch borrows within the date range
        $borrows = Borrow::whereBetween('returned_at', [$request->start_date, $request->end_date])->orWhere('returned_at', $request->start_date)
            ->with(['user', 'book'])
            ->get();

        // Generate the PDF
        $pdf = Pdf::loadView('admin.report.report', compact('borrows', 'request'));

        // Return the generated PDF
        return $pdf->download($request->start_date . '__' . $request->end_date . '_borrow_report.pdf');
    }
}
