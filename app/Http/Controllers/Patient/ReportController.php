<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientReportRequest;
use App\Models\PatientReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $reports = Auth::user()
            ->patientReports()
            ->latest('report_date')
            ->latest()
            ->get();

        return view('patients.reports', compact('reports'));
    }

    public function store(PatientReportRequest $request): RedirectResponse
    {
        $patient = Auth::user();
        $file = $request->file('report_file');
        $path = $file->store("patient-reports/{$patient->id}", 'public');

        $patient->patientReports()->create([
            'uploaded_by' => $patient->id,
            'title' => $request->string('title')->trim()->value(),
            'report_type' => $request->string('report_type')->trim()->value() ?: null,
            'report_date' => $request->input('report_date'),
            'description' => $request->string('description')->trim()->value() ?: null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()
            ->route('patient.reports.index')
            ->with('success', __('Report uploaded successfully.'));
    }

    public function download(PatientReport $report)
    {
        $report = $this->ownedReport($report);

        abort_unless(Storage::disk('public')->exists($report->file_path), 404);

        return Storage::disk('public')->download($report->file_path, $report->file_name);
    }

    public function destroy(PatientReport $report): RedirectResponse
    {
        $report = $this->ownedReport($report);

        if (Storage::disk('public')->exists($report->file_path)) {
            Storage::disk('public')->delete($report->file_path);
        }

        $report->delete();

        return redirect()
            ->route('patient.reports.index')
            ->with('success', __('Report deleted successfully.'));
    }

    protected function ownedReport(PatientReport $report): PatientReport
    {
        abort_unless($report->patient_id === Auth::id(), 404);

        return $report;
    }
}
