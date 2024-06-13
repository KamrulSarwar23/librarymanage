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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $startDate = Carbon::parse($request->input('start_date'));

        $endDate = Carbon::parse($request->input('end_date'));

        $query = Borrow::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('created_at', $startDate);
        } elseif ($endDate) {
            $query->whereDate('created_at', $endDate);
        }
        
        $borrows = $query->with(['user', 'book'])->get();

        $borrows = Pdf::loadView('admin.report.report', compact('borrows', 'request'))->setPaper('a4', 'landscape');

        return $borrows->download('borrow_report.pdf');
    }
}
