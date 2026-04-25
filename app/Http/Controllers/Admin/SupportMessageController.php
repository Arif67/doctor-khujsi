<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class SupportMessageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ContactMessage::query()
                ->with(['user', 'handledBy'])
                ->where('type', 'support')
                ->latest();

            if (Auth::user()?->hasRole('hospital_owner')) {
                $query->where('user_id', Auth::id());
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('hospital', fn ($row) => $row->user?->hospital_name ?? '-')
                ->addColumn('sender', fn ($row) => $row->name ?: ($row->user?->name ?? '-'))
                ->addColumn('priority', function ($row) {
                    $classes = match ($row->priority) {
                        'urgent' => 'bg-rose-100 text-rose-800',
                        'high' => 'bg-amber-100 text-amber-800',
                        default => 'bg-slate-100 text-slate-700',
                    };

                    return '<span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold '.$classes.'">'.ucfirst($row->priority ?? 'normal').'</span>';
                })
                ->addColumn('status', function ($row) {
                    $classes = match ($row->status) {
                        'closed' => 'bg-slate-100 text-slate-700',
                        'replied' => 'bg-emerald-100 text-emerald-800',
                        default => 'bg-amber-100 text-amber-800',
                    };

                    return '<span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold '.$classes.'">'.ucfirst($row->status ?? 'open').'</span>';
                })
                ->editColumn('created_at', fn ($row) => $row->created_at?->format('d M Y, h:i A'))
                ->addColumn('action', function ($row) {
                    if (Auth::user()?->hasRole('hospital_owner')) {
                        return $row->admin_reply
                            ? '<span class="text-emerald-700 text-sm font-medium">Replied</span>'
                            : '<span class="text-slate-400 text-sm">Waiting for response</span>';
                    }

                    return '
                        <button
                            type="button"
                            data-id="'.$row->id.'"
                            data-subject="'.e($row->subject ?? '').'"
                            data-message="'.e($row->message ?? '').'"
                            data-email="'.e($row->email ?? '').'"
                            data-status="'.e($row->status ?? 'open').'"
                            class="open-support-reply-modal inline-flex items-center rounded-xl bg-slate-900 px-3 py-2 text-sm font-medium text-white transition hover:bg-slate-800">
                            Reply
                        </button>';
                })
                ->rawColumns(['priority', 'status', 'action'])
                ->make(true);
        }

        $openCount = ContactMessage::query()
            ->where('type', 'support')
            ->where('status', 'open')
            ->when(Auth::user()?->hasRole('hospital_owner'), fn ($query) => $query->where('user_id', Auth::id()))
            ->count();

        $repliedCount = ContactMessage::query()
            ->where('type', 'support')
            ->where('status', 'replied')
            ->when(Auth::user()?->hasRole('hospital_owner'), fn ($query) => $query->where('user_id', Auth::id()))
            ->count();

        return view('admin.support.index', compact('openCount', 'repliedCount'));
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()?->hasRole('hospital_owner'), 403);

        $data = $request->validate([
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10'],
            'priority' => ['required', 'in:normal,high,urgent'],
        ]);

        $message = ContactMessage::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()?->name ?: Auth::user()?->hospital_name,
            'email' => Auth::user()?->email,
            'subject' => $data['subject'],
            'type' => 'support',
            'priority' => $data['priority'],
            'status' => 'open',
            'message' => $data['message'],
        ]);

        $adminEmails = User::role('admin')
            ->whereNotNull('email')
            ->pluck('email')
            ->filter()
            ->all();

        if ($adminEmails !== []) {
            try {
                Mail::raw(
                    "New hospital support request\n\nHospital: ".(Auth::user()?->hospital_name ?? 'N/A')."\nSubject: {$message->subject}\nPriority: {$message->priority}\n\nMessage:\n{$message->message}",
                    function ($mail) use ($adminEmails, $message) {
                        $mail->to($adminEmails)->subject('New hospital support request: '.$message->subject);
                    }
                );
            } catch (\Throwable $exception) {
                Log::warning('Failed to send support request email to admins.', [
                    'contact_message_id' => $message->id,
                    'admin_emails' => $adminEmails,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Your message has been sent to the super admin.');
    }

    public function reply(Request $request, ContactMessage $supportMessage)
    {
        abort_unless(Auth::user()?->hasRole('admin'), 403);
        abort_unless($supportMessage->type === 'support', 404);

        $data = $request->validate([
            'status' => ['required', 'in:replied,closed'],
            'admin_reply' => ['required', 'string', 'min:10'],
        ]);

        $supportMessage->update([
            'handled_by_id' => Auth::id(),
            'status' => $data['status'],
            'admin_reply' => $data['admin_reply'],
            'replied_at' => now(),
        ]);

        if ($supportMessage->email) {
            try {
                Mail::raw(
                    "Hello {$supportMessage->name},\n\n{$data['admin_reply']}\n\nRegards,\nSuper Admin",
                    function ($mail) use ($supportMessage, $data) {
                        $mail->to($supportMessage->email)->subject('Re: '.$supportMessage->subject);
                    }
                );
            } catch (\Throwable $exception) {
                Log::warning('Failed to send support reply email.', [
                    'contact_message_id' => $supportMessage->id,
                    'recipient_email' => $supportMessage->email,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Reply sent successfully.');
    }
}
