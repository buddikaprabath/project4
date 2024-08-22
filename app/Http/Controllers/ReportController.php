<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        // Retrieve all reports from the database
        $reports = Report::all();

        // Pass reports data to the view
        return view('Admin.pages.Report.reportdetails', compact('reports'));
    }

    public function showGenerateForm()
    {
        return view('Admin.pages.Report.generate');
    }

    public function generate(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Generate report
        $title = $request->input('title');
        $description = $request->input('description');

        $report = $this->reportService->generateReport($title, $description);

        return redirect()->route('Admin.pages.Report.reportdetails')
            ->with('success', 'Report generated successfully.');
    }

    public function download($id)
    {
        $report = Report::findOrFail($id);

        // Example: Assuming file_path is the path to the stored report file
        $filePath = $report->file_path;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath)) {
            // Download the file
            return Storage::disk('public')->download($filePath);
        }

        // Handle case where file doesn't exist or an error occurs
        abort(404, 'File not found');
    }
}