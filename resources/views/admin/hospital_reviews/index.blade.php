@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <section class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm">
        <div class="px-6 py-7 md:px-8 md:py-8 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #0f766e 55%, #155e75 100%);">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/75">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-300"></span>
                        Review Moderation
                    </div>
                    <h1 class="mt-3 text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">Hospital Review Inbox</h1>
                    <p class="mt-3 max-w-2xl text-sm md:text-base leading-7 text-white/80">
                        User feedback review kore approved, rejected, ba delete korte parben. Frontend-e sudhu approved review show hobe.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3 sm:min-w-[320px]">
                    <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                        <div class="text-xs uppercase tracking-[0.18em] text-white/55">Pending</div>
                        <div class="mt-1 text-2xl font-extrabold tracking-tight">{{ $counts['pending'] }}</div>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                        <div class="text-xs uppercase tracking-[0.18em] text-white/55">Approved</div>
                        <div class="mt-1 text-2xl font-extrabold tracking-tight">{{ $counts['approved'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-wrap items-center gap-3">
            @php
                $tabs = [
                    'all' => 'All',
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ];
            @endphp
            @foreach ($tabs as $key => $label)
                <a
                    href="{{ route('admin.hospital-reviews.index', ['status' => $key]) }}"
                    class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold transition {{ $status === $key ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
                >
                    {{ $label }}
                    <span class="ml-2 rounded-full bg-white/10 px-2 py-0.5 text-xs {{ $status === $key ? 'text-white' : 'text-slate-500' }}">
                        {{ $counts[$key] ?? $counts['all'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    @if (!empty($schemaWarning))
        <section class="rounded-3xl border border-amber-200 bg-amber-50 px-5 py-4 text-sm text-amber-800 shadow-sm">
            {{ $schemaWarning }}
        </section>
    @endif

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-semibold text-slate-900">Review Queue</h2>
            <p class="mt-1 text-sm text-slate-500">Newest review gulo upore. Admin note optional.</p>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse ($reviews as $review)
                <article class="p-6">
                    <div class="flex flex-col gap-5 xl:flex-row xl:items-start xl:justify-between">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-slate-900 mb-0">{{ $review->reviewer_name }}</h3>
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                    @if($review->status === 'approved') bg-emerald-100 text-emerald-800
                                    @elseif($review->status === 'rejected') bg-rose-100 text-rose-800
                                    @else bg-amber-100 text-amber-800 @endif">
                                    {{ ucfirst($review->status) }}
                                </span>
                                <span class="text-sm text-slate-500">{{ $review->created_at?->format('d M Y, h:i A') }}</span>
                            </div>

                            <div class="mb-3 text-sm text-slate-600">
                                <strong>Hospital:</strong>
                                {{ $review->hospital?->hospital_name ?: $review->hospital?->name ?: 'Unknown hospital' }}
                            </div>
                            <div class="mb-3 text-sm text-slate-600">
                                <strong>Email:</strong>
                                {{ $review->reviewer_email ?: 'Not provided' }}
                            </div>
                            <div class="mb-3 flex items-center gap-1 text-amber-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-slate-200' }}"></i>
                                @endfor
                                <span class="ml-2 text-sm font-semibold text-slate-700">{{ $review->rating }}/5</span>
                            </div>
                            <p class="mb-0 rounded-2xl bg-slate-50 px-4 py-4 text-sm leading-7 text-slate-700">{{ $review->review }}</p>

                            @if($review->admin_note)
                                <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                                    <strong>Admin note:</strong> {{ $review->admin_note }}
                                </div>
                            @endif

                            @if($review->moderator)
                                <div class="mt-3 text-xs text-slate-400">
                                    Moderated by {{ $review->moderator->name ?: ($review->moderator->first_name . ' ' . $review->moderator->last_name) }}{{ $review->moderated_at ? ' on ' . $review->moderated_at->format('d M Y, h:i A') : '' }}
                                </div>
                            @endif
                        </div>

                        <div class="w-full xl:max-w-sm">
                            <form action="{{ route('admin.hospital-reviews.update', $review) }}" method="POST" class="rounded-2xl border border-slate-200 p-4 space-y-3">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                                    <select name="status" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                                        <option value="approved" @selected($review->status === 'approved')>Approve</option>
                                        <option value="rejected" @selected($review->status === 'rejected')>Reject</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Admin Note</label>
                                    <textarea name="admin_note" rows="4" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="Optional moderation note...">{{ $review->admin_note }}</textarea>
                                </div>
                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                                    Update Review
                                </button>
                            </form>

                            <form action="{{ route('admin.hospital-reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review permanently?');" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-rose-100 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-200">
                                    Delete Review
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="px-6 py-14 text-center text-slate-500">
                    No hospital review found for this filter.
                </div>
            @endforelse
        </div>

        @if ($reviews->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $reviews->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
