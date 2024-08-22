<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Report;
use PDF;
use Illuminate\Support\Facades\Storage;

class ReportService
{
    public function generateReport($title, $description)
    {
        // Example: Generate report data (customize this based on your requirements)
        $invoices = Invoice::all();
        $orders = Order::with('user', 'vehicle', 'payment')->get();
        $vehicles = Vehicle::with('orders')->get();

        $reportData = [
            'title' => $title,
            'description' => $description,
            'invoices' => $invoices,
            'orders' => $orders,
            'vehicles' => $vehicles,
        ];

        // Convert array to JSON string
        $reportDataJson = json_encode($reportData);

        // Example: Generate and store PDF file
        $pdfFilePath = $this->generatePdfReport($reportData);

        // Save report to database
        $report = new Report();
        $report->title = $title;
        $report->description = $description;
        $report->data = $reportDataJson; // Save JSON string
        $report->file_path = $pdfFilePath; // Store PDF file path
        $report->save();

        return $report;
    }

    private function generatePdfReport($reportData)
    {
        // Example logic to generate and store PDF file
        $fileName = 'report_' . time() . '.pdf'; // Example file name
        $pdfFilePath = 'pdfs/' . $fileName; // Example storage path

        // Logic to generate PDF file using Dompdf
        $pdf = PDF::loadView('pdf.report', compact('reportData'));
        Storage::disk('public')->put($pdfFilePath, $pdf->output());

        return $pdfFilePath;
    }
}