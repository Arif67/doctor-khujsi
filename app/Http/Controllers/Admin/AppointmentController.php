<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\ServiceHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    public function index(Request $request){
         if ($request->ajax()) {
            $data = Appointment::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y, h:i A'))
                ->addColumn('patient', fn($row) => $row->patient?->first_name.'-'.$row->patient?->last_name ?? '—')
                ->addColumn('department', fn($row) => $row->department?->name ?? '—')
                ->addColumn('status', function ($row) {
                    if ($row->status == 'confirm') {
                        return '<span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Confirm</span>';
                    } elseif ($row->status == 'pending') {
                        return '<span class="px-2 py-1 text-xs font-semibold rounded-sm pending text-black">Pending</span>';
                    } else {
                        return '<span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">Cencel</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $action = '
                        <div class="flex flex-row gap-2">
                            <button
                                data-id="'.$row->patient_id.'" 
                                class="show_patient inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded-sm shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-eye"></i>
                            </button>
                             <a href="'.route('admin.appointments.assign',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded-sm shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-tasks"></i>
                            </a>
                            <button 
                                data-href="'.route("admin.attentions.destroy", $row->id).'"
                                class="confirm-delete px-2 py-1 bg-red-600 text-white rounded-sm hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->rawColumns(['action','department','patient','status'])
                ->make(true);
        }
        return view('admin.appointments.index');
    }

    public function appointmentsAssign(int $id){
        $appointment = Appointment::with(['user'])->findOrFail($id);
        $doctors = Doctor::latest()->get();
        $services = Service::latest()->get();


        return view('admin.appointments.assign',compact('appointment','doctors','services'));
    }
    public function assignService(Request $request, Appointment $appointment)
    {
        $request->validate([
            'services' => 'required|array',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.doctor_id'  => 'required|exists:doctors,id',
        ]);


        $existingIds = [];

        foreach ($request->services as $service) {
            $history = ServiceHistory::updateOrCreate(
                ['id' => $service['id'] ?? null],
                [
                    'appointment_id' => $appointment->id,
                    'patient_id' => $appointment->patient_id,
                    'service_id'     => $service['service_id'],
                    'doctor_id'      => $service['doctor_id'],
                    'status'         => $service['status'],
                    'service_date'   => $service['service_date'] ?? null,
                    'service_time'   => $service['service_time'] ?? null,
                ]
            );
            $existingIds[] = $history->id;
        }

        // Remove rows not in form
        $appointment->serviceHistory()
            ->whereNotIn('id', $existingIds)
            ->delete();

        return redirect()->back()->with('success', 'Services & Doctors updated successfully!');
    }

    public function patientProfile($id){
        $user = User::with('patientReports')->findOrFail($id); 
        return view('admin.partials.patient.profile', compact('user'));
    }
}
