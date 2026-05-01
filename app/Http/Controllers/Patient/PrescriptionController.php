<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientPrescriptionRequest;
use App\Models\PatientPrescription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PrescriptionController extends Controller
{
    public function index(): View
    {
        $prescriptions = Auth::user()
            ->patientPrescriptions()
            ->latest('prescription_date')
            ->latest()
            ->get();

        return view('patients.prescriptions', compact('prescriptions'));
    }

    public function store(PatientPrescriptionRequest $request): RedirectResponse
    {
        $patient = Auth::user();
        $file = $request->file('prescription_file');
        $path = $file->store("patient-prescriptions/{$patient->id}", 'public');

        $patient->patientPrescriptions()->create([
            'uploaded_by' => $patient->id,
            'title' => $request->string('title')->trim()->value(),
            'doctor_name' => $request->string('doctor_name')->trim()->value() ?: null,
            'prescription_date' => $request->input('prescription_date'),
            'medicines' => $request->string('medicines')->trim()->value() ?: null,
            'notes' => $request->string('notes')->trim()->value() ?: null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()
            ->route('patient.prescriptions.index')
            ->with('success', __('Prescription uploaded successfully.'));
    }

    public function download(PatientPrescription $prescription)
    {
        $prescription = $this->ownedPrescription($prescription);

        abort_unless(Storage::disk('public')->exists($prescription->file_path), 404);

        return Storage::disk('public')->download($prescription->file_path, $prescription->file_name);
    }

    public function destroy(PatientPrescription $prescription): RedirectResponse
    {
        $prescription = $this->ownedPrescription($prescription);

        if (Storage::disk('public')->exists($prescription->file_path)) {
            Storage::disk('public')->delete($prescription->file_path);
        }

        $prescription->delete();

        return redirect()
            ->route('patient.prescriptions.index')
            ->with('success', __('Prescription deleted successfully.'));
    }

    protected function ownedPrescription(PatientPrescription $prescription): PatientPrescription
    {
        abort_unless($prescription->patient_id === Auth::id(), 404);

        return $prescription;
    }
}
