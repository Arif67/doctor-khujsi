@extends('layouts.admin')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .booking-page {
        font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        color: #0f172a;
    }

    .booking-page h1,
    .booking-page h2,
    .booking-page h3,
    .booking-page .font-semibold,
    .booking-page .font-medium {
        letter-spacing: -0.02em;
    }

    .booking-page .table {
        font-size: 0.925rem;
    }

    .booking-page .table thead th {
        font-size: 0.72rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .booking-page input,
    .booking-page select,
    .booking-page button,
    .booking-page a {
        font-family: inherit;
    }
</style>
@endpush

@section('content')
@php
    $isHospitalOwner = auth()->user()?->hasRole('hospital_owner');
@endphp

<div class="booking-page space-y-6">
    <section class="rounded-3xl overflow-hidden shadow-sm border border-slate-200">
        <div class="px-6 py-7 md:px-8 md:py-8 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 52%, #0f766e 100%);">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.22em] text-white/80">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                        Booking Operations
                    </div>
                    <h1 class="mt-3 text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
                        {{ $isHospitalOwner ? 'Hospital Booking Command Center' : 'Booking Command Center' }}
                    </h1>
                    <p class="mt-3 max-w-2xl text-sm md:text-base text-white/82 leading-7">
                        {{ $isHospitalOwner
                            ? 'Manage patient requests, keep booking statuses accurate, and run daily hospital operations from one focused workspace.'
                            : 'Track booking performance across hospitals, review patient demand, and handle status updates from one focused control center.' }}
                    </p>
                    <div class="mt-4 flex flex-wrap items-center gap-2.5 text-xs md:text-sm text-white/75">
                        <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1.5">Live booking feed</span>
                        <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1.5">Fast status control</span>
                        <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1.5">Export and print ready</span>
                    </div>
                </div>

                <div class="w-full sm:w-[320px] lg:w-[340px] lg:self-center rounded-3xl border border-white/10 bg-white/5 p-3 shadow-[0_8px_30px_rgba(15,23,42,0.12)] backdrop-blur">
                    <div class="mb-3 flex items-center justify-between px-1">
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-white/55">Actions</span>
                        <span class="text-xs text-white/45">Report tools</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a id="booking-print-link" target="_blank" href="{{ route('admin.doctor-bookings.print') }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/8 px-4 text-sm font-medium text-white transition hover:bg-white/12 hover:border-white/20">
                            <i class="fas fa-print text-xs opacity-90"></i>
                            Print
                        </a>
                        <a id="booking-export-link" href="{{ route('admin.doctor-bookings.export') }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-2xl border border-emerald-300/20 bg-emerald-400/15 px-4 text-sm font-semibold text-white transition hover:bg-emerald-400/22 hover:border-emerald-200/30">
                            <i class="fas fa-file-csv text-xs opacity-90"></i>
                            Export
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Bookings</p>
                    <div id="summary_total" class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">0</div>
                    <p class="mt-2 text-xs text-slate-400">All visible records</p>
                </div>
                <div class="rounded-2xl bg-slate-100 p-3 text-slate-700">
                    <i class="fas fa-clipboard-list text-lg"></i>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-amber-700">Pending</p>
                    <div id="summary_pending" class="mt-3 text-3xl font-extrabold tracking-tight text-amber-900">0</div>
                    <p class="mt-2 text-xs text-amber-600">Needs action</p>
                </div>
                <div class="rounded-2xl bg-white/70 p-3 text-amber-700">
                    <i class="fas fa-hourglass-half text-lg"></i>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-emerald-700">Confirmed</p>
                    <div id="summary_confirmed" class="mt-3 text-3xl font-extrabold tracking-tight text-emerald-900">0</div>
                    <p class="mt-2 text-xs text-emerald-600">Ready to serve</p>
                </div>
                <div class="rounded-2xl bg-white/70 p-3 text-emerald-700">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-rose-200 bg-rose-50 p-5 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-rose-700">Cancelled</p>
                    <div id="summary_cancelled" class="mt-3 text-3xl font-extrabold tracking-tight text-rose-900">0</div>
                    <p class="mt-2 text-xs text-rose-600">Dropped requests</p>
                </div>
                <div class="rounded-2xl bg-white/70 p-3 text-rose-700">
                    <i class="fas fa-times-circle text-lg"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Search and Filter</h2>
                    <p class="text-sm text-slate-500">Refine bookings by patient info, status, and date range.</p>
                </div>
                <button id="booking-filter-reset" type="button" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Reset Filters
                </button>
            </div>
        </div>

        <div class="px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="xl:col-span-2">
                    <label for="filter_q" class="mb-2 block text-sm font-medium text-slate-700">Patient Search</label>
                    <input id="filter_q" type="text" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="Search by name, phone, or email">
                </div>
                <div>
                    <label for="filter_status" class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                    <select id="filter_status" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div>
                    <label for="filter_date_from" class="mb-2 block text-sm font-medium text-slate-700">From Date</label>
                    <input id="filter_date_from" type="date" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label for="filter_date_to" class="mb-2 block text-sm font-medium text-slate-700">To Date</label>
                    <input id="filter_date_to" type="date" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 {{ $isHospitalOwner ? 'xl:grid-cols-1' : 'xl:grid-cols-2' }} gap-4">
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-900">Doctor Summary</h3>
                <p class="mt-1 text-sm text-slate-500">Top doctors by visible booking volume.</p>
            </div>
            <div id="doctor-summary-list" class="px-6 py-5 space-y-3 text-sm text-slate-700">
                <div class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-slate-400">Loading summary...</div>
            </div>
        </div>

        @unless($isHospitalOwner)
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-900">Hospital Summary</h3>
                <p class="mt-1 text-sm text-slate-500">Booking distribution across hospitals.</p>
            </div>
            <div id="hospital-summary-list" class="px-6 py-5 space-y-3 text-sm text-slate-700">
                <div class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-slate-400">Loading summary...</div>
            </div>
        </div>
        @endunless
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Booking Records</h2>
                    <p class="text-sm text-slate-500">Review all booking details and update statuses without leaving this page.</p>
                </div>
                <div class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                    Live table
                </div>
            </div>
        </div>

        <div class="px-2 pb-2 md:px-4 md:pb-4">
            <div class="overflow-x-auto">
                <table id="doctor-bookings-table" class="min-w-full table-auto">
                    <thead class="bg-slate-50">
                        <tr class="text-left">
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">SL</th>
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Patient</th>
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Phone</th>
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Age</th>
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Doctor</th>
                            @unless($isHospitalOwner)
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Hospital</th>
                            @endunless
                            <th class="px-4 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Notes</th>
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
</div>
@endsection

@push('scripts')
<script>
$(function(){
    function currentFilters() {
        return {
            q: $('#filter_q').val(),
            status: $('#filter_status').val(),
            date_from: $('#filter_date_from').val(),
            date_to: $('#filter_date_to').val(),
        };
    }

    function syncExportLink() {
        const params = new URLSearchParams(currentFilters());
        $('#booking-export-link').attr('href', '{{ route('admin.doctor-bookings.export') }}?' + params.toString());
        $('#booking-print-link').attr('href', '{{ route('admin.doctor-bookings.print') }}?' + params.toString());
    }

    function renderSummaryList(selector, items) {
        const container = $(selector);

        if (!items.length) {
            container.html('<div class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-slate-400">No data found.</div>');
            return;
        }

        container.html(items.map(function (item, index) {
            return `
                <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white">
                            ${index + 1}
                        </div>
                        <span class="truncate text-sm font-medium text-slate-800">${item.label}</span>
                    </div>
                    <span class="rounded-full bg-white px-3 py-1 text-sm font-semibold text-slate-700 shadow-sm">${item.total}</span>
                </div>
            `;
        }).join(''));
    }

    function loadSummary() {
        $.get('{{ route('admin.doctor-bookings.summary') }}', currentFilters(), function (response) {
            $('#summary_total').text(response.totals.all);
            $('#summary_pending').text(response.totals.pending);
            $('#summary_confirmed').text(response.totals.confirmed);
            $('#summary_cancelled').text(response.totals.cancelled);
            renderSummaryList('#doctor-summary-list', response.doctor_summary);
            @unless($isHospitalOwner)
            renderSummaryList('#hospital-summary-list', response.hospital_summary);
            @endunless
        });
    }

    const table = $('#doctor-bookings-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: '{!! route('admin.doctor-bookings.index') !!}',
            data: function (d) {
                Object.assign(d, currentFilters());
            }
        },
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
            {data:'patient_name',name:'patient_name'},
            {data:'patient_phone',name:'patient_phone'},
            {data:'patient_email',name:'patient_email'},
            {data:'patient_age',name:'patient_age'},
            {data:'doctor',name:'doctor.name',orderable:false},
            @unless($isHospitalOwner)
            {data:'hospital',name:'hospital_owner.hospital_name',orderable:false},
            @endunless
            {data:'notes',name:'notes',defaultContent:'-'},
            {data:'status',name:'status'},
            {data:'created_at',name:'created_at'},
            {data:'action',name:'action',orderable:false,searchable:false},
        ],
        order:[[9,'desc']],
        language: {
            search: '',
            searchPlaceholder: 'Search bookings',
            lengthMenu: 'Show _MENU_ rows',
            info: 'Showing _START_ to _END_ of _TOTAL_ bookings',
            infoEmpty: 'No bookings found',
            zeroRecords: 'No matching bookings found',
            processing: 'Loading bookings...'
        }
    });

    $('#filter_q').on('input', function () {
        syncExportLink();
        table.ajax.reload();
        loadSummary();
    });

    $('#filter_status, #filter_date_from, #filter_date_to').on('change', function () {
        syncExportLink();
        table.ajax.reload();
        loadSummary();
    });

    $('#booking-filter-reset').on('click', function () {
        $('#filter_q').val('');
        $('#filter_status').val('');
        $('#filter_date_from').val('');
        $('#filter_date_to').val('');
        syncExportLink();
        table.ajax.reload();
        loadSummary();
    });

    syncExportLink();
    loadSummary();
});
</script>
@endpush
