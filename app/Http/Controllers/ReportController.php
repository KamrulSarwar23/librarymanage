<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
    
        // Parse the start and end dates
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        
        $endDate = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();
    
        // Fetch borrows within the date range
        $borrows = Borrow::whereBetween('created_at', [$startDate, $endDate])
            ->with(['user', 'book'])
            ->get();
    
        // Generate the PDF
        $pdf = Pdf::loadView('admin.report.report', compact('borrows', 'request'))->setPaper('a4', 'landscape');
    
        // Return the generated PDF
        return $pdf->download($startDate->format('Y-m-d') . '__' . $endDate->format('Y-m-d') . '_borrow_report.pdf');
    }
    
}
