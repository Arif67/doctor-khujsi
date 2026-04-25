@extends('layouts.admin')

@section('content')
@php
    $isHospitalOwner = auth()->user()?->hasRole('hospital_owner');
@endphp

<div class="space-y-6">
    <section class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm">
        <div class="px-6 py-7 md:px-8 md:py-8 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 55%, #0f766e 100%);">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/75">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                        Support Channel
                    </div>
                    <h1 class="mt-3 text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
                        {{ $isHospitalOwner ? 'Contact Super Admin' : 'Support Inbox' }}
                    </h1>
                    <p class="mt-3 max-w-2xl text-sm md:text-base leading-7 text-white/80">
                        {{ $isHospitalOwner
                            ? 'Send issues, approval questions, or workflow requests directly to the super admin team and track the response here.'
                            : 'Review hospital support requests, respond from the inbox, and keep operational communication organized.' }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3 sm:min-w-[280px]">
                    <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                        <div class="text-xs uppercase tracking-[0.18em] text-white/55">Open</div>
                        <div class="mt-1 text-2xl font-extrabold tracking-tight">{{ $openCount }}</div>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                        <div class="text-xs uppercase tracking-[0.18em] text-white/55">Replied</div>
                        <div class="mt-1 text-2xl font-extrabold tracking-tight">{{ $repliedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($isHospitalOwner)
        <section class="grid grid-cols-1 xl:grid-cols-12 gap-6">
            <div class="xl:col-span-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5">
                    <h2 class="text-xl font-semibold text-slate-900">New Support Request</h2>
                    <p class="mt-1 text-sm text-slate-500">Write clearly so the super admin can act quickly.</p>
                </div>

                <form action="{{ route('admin.support.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Hospital</label>
                        <input type="text" value="{{ auth()->user()?->hospital_name }}" disabled class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                    </div>
                    <div>
                        <label for="subject" class="mb-2 block text-sm font-medium text-slate-700">Subject</label>
                        <input id="subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="e.g. Approval status or doctor issue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('subject')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="priority" class="mb-2 block text-sm font-medium text-slate-700">Priority</label>
                        <select id="priority" name="priority" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="normal" @selected(old('priority') === 'normal' || old('priority') === null)>Normal</option>
                            <option value="high" @selected(old('priority') === 'high')>High</option>
                            <option value="urgent" @selected(old('priority') === 'urgent')>Urgent</option>
                        </select>
                        @error('priority')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="message" class="mb-2 block text-sm font-medium text-slate-700">Message</label>
                        <textarea id="message" name="message" rows="7" placeholder="Explain the issue in detail..." class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Send to Super Admin
                    </button>
                </form>
            </div>

            <div class="xl:col-span-8 rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold text-slate-900">My Support Requests</h2>
                    <p class="mt-1 text-sm text-slate-500">Track every request and see when the admin responds.</p>
                </div>
                <div class="px-2 pb-2 md:px-4 md:pb-4">
                    <div class="overflow-x-auto">
                        <table id="support-table" class="min-w-full table-auto">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">SL</th>
                                    <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Subject</th>
                                    <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Priority</th>
                                    <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                                    <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Reply</th>
                                    <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Created</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-semibold text-slate-900">Hospital Requests</h2>
                <p class="mt-1 text-sm text-slate-500">Reply to requests directly from the inbox.</p>
            </div>
            <div class="px-2 pb-2 md:px-4 md:pb-4">
                <div class="overflow-x-auto">
                    <table id="support-table" class="min-w-full table-auto">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">SL</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Hospital</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Sender</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Subject</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Priority</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Created</th>
                                <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white"></tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif
</div>

@if(! $isHospitalOwner)
<div class="modal fade" id="support-reply-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title">Reply to Support Request</h5>
                    <p class="mb-0 text-sm text-muted">Send a direct response and update the ticket status.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="support-reply-form" method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input id="reply-subject" type="text" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="replied">Replied</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reply Message</label>
                        <textarea name="admin_reply" id="reply-message" rows="6" class="form-control" placeholder="Write the response to the hospital..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
$(function () {
    const isHospitalOwner = @json($isHospitalOwner);

    const table = $('#support-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: "{{ route('admin.support.index') }}",
        columns: isHospitalOwner ? [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'subject', name: 'subject'},
            {data: 'priority', name: 'priority', orderable: false, searchable: false},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at'},
        ] : [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'hospital', name: 'hospital', orderable: false, searchable: false},
            {data: 'sender', name: 'sender'},
            {data: 'email', name: 'email'},
            {data: 'subject', name: 'subject'},
            {data: 'priority', name: 'priority', orderable: false, searchable: false},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });

    $(document).on('click', '.open-support-reply-modal', function () {
        $('#support-reply-form').attr('action', "{{ url('/admin/support') }}/" + $(this).data('id') + "/reply");
        $('#reply-subject').val($(this).data('subject'));
        $('#reply-message').val('');
        $('#support-reply-modal').modal('show');
    });
});
</script>
@endpush
