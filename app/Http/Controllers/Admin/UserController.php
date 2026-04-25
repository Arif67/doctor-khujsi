<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('roles');

            $loggedUser = Auth::user();
            if (!$loggedUser->hasRole('admin')) {
                $query->whereDoesntHave('roles', function($q){
                    $q->where('name', 'admin');
                });
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    return $row->roles->map(function($role) {
                        return '<span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">' . $role->name . '</span>';
                    })->implode(' ');
                })
                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d M Y, h:i A');
                })
                ->addColumn('approval_status', function ($row) {
                    if (! $row->hasRole('hospital_owner')) {
                        return '<span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded">N/A</span>';
                    }

                    $status = $row->approval_status ?: 'pending';
                    $classes = match ($status) {
                        'approved' => 'bg-green-100 text-green-800',
                        'rejected' => 'bg-red-100 text-red-800',
                        default => 'bg-yellow-100 text-yellow-800',
                    };
                    $reason = $status === 'rejected' && $row->rejection_reason
                        ? '<div class="text-xs text-red-700 mt-1 max-w-xs">'.e($row->rejection_reason).'</div>'
                        : '';

                    return '<div><span class="px-2 py-1 '.$classes.' text-xs rounded">'.ucfirst($status).'</span>'.$reason.'</div>';
                })
                ->addColumn('action', function ($row) {
                    $action = '
                        <div class="flex flex-row gap-2">
                             <a href="'.route('admin.users.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                             <button 
                                data-href="'.route("admin.users.destroy", $row->id).'"
                                class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    if ($row->hasRole('hospital_owner') && $row->approval_status !== 'approved') {
                        $action = '
                            <div class="flex flex-row gap-2">
                                <form action="'.route('admin.users.approve-hospital', $row->id).'" method="POST">
                                    '.csrf_field().'
                                    '.method_field('PATCH').'
                                    <button type="submit" class="px-3 py-2 bg-green-600 text-white text-sm font-medium rounded shadow hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>
                                <button 
                                    type="button"
                                    data-href="'.route('admin.users.reject-hospital', $row->id).'"
                                    class="open-reject-hospital-modal px-3 py-2 bg-red-600 text-white text-sm font-medium rounded shadow hover:bg-red-700 transition">
                                        Reject
                                </button>
                                <a href="'.route('admin.users.edit',$row->id).'" 
                                    class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button 
                                    data-href="'.route("admin.users.destroy", $row->id).'"
                                    class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>';
                    }

                    return $action;
                })
                ->rawColumns(['roles','approval_status','action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereIn('name', ['admin', 'user'])->latest()->get();

        return view('admin.users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['admin', 'user'])->latest()->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function profile($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return view('admin.users.profile', compact('user', 'roles'));
    }

    public function profileUpdate(Request $request,$id)  {
        $user = User::findOrFail($id);
    }

    public function approveHospital(User $user)
    {
        abort_if(! $user->hasRole('hospital_owner'), 404);

        $user->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        $this->sendHospitalApprovalStatusMail(
            $user,
            'approved',
            'Hospital account approved',
            'Your hospital account has been approved. You can now log in and manage your doctors and bookings.'
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Hospital account approved successfully.');
    }

    public function rejectHospital(User $user)
    {
        abort_if(! $user->hasRole('hospital_owner'), 404);

        $data = request()->validate([
            'rejection_reason' => ['required', 'string', 'max:1000'],
        ]);

        $user->update([
            'approval_status' => 'rejected',
            'approved_at' => null,
            'rejection_reason' => $data['rejection_reason'],
        ]);

        $this->sendHospitalApprovalStatusMail(
            $user,
            'rejected',
            'Hospital account rejected',
            "Your hospital account has been rejected.\nReason: {$data['rejection_reason']}\n\nPlease contact support or the administrator for the next steps."
        );

        return redirect()
            ->route('admin.users.index')
            ->with('warning', 'Hospital account rejected successfully.');
    }

    private function sendHospitalApprovalStatusMail(User $user, string $status, string $subject, string $body): void
    {
        if (! $user->email) {
            return;
        }

        Mail::raw(
            "Hello {$user->hospital_name},\n\n{$body}\n\nCurrent status: {$status}\n\nRegards,\nAdmin",
            function ($message) use ($user, $subject) {
                $message->to($user->email)->subject($subject);
            }
        );
    }
}
