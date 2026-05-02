<section class="team-section py-5">
    <div class="container">
        @php
            $doctorLocation = static function ($doctor) {
                return collect([
                    $doctor->area ?: $doctor->owner?->area,
                    $doctor->thana ?: $doctor->owner?->thana,
                    $doctor->district ?: $doctor->owner?->district,
                ])->filter()->implode(', ');
            };
            $sectionData = isset($featuredDoctorsSection) ? ($featuredDoctorsSection->data ?? []) : [];
            $sectionTitle = $sectionData['title'] ?? __('Open a profile, compare details, then book.');
            $sectionDescription = $sectionData['description'] ?? __('These are active doctor listings available for public browsing and direct request submission.');
        @endphp
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between gap-3 mb-4">
            <div>
                <span class="section-eyebrow mb-3">{{ __('Featured doctors') }}</span>
                <h2 class="section-title mb-2">{{ $sectionTitle }}</h2>
                <p class="muted-copy mb-0">{{ $sectionDescription }}</p>
            </div>
            <a href="{{ route('app.specialists') }}" class="btn-brand-secondary">{{ __('See All Doctors') }}</a>
        </div>
        <div class="row row-gap-4">
            @foreach ($doctores as $item)
                <div class="col-md-6 col-xl-4">
                    <article class="doctor-card h-100">
                        <a class="doctor-card-link" href="{{ route('app.doctor-profile', ['doctor' => $item->id , 'name' => \Illuminate\Support\Str::slug($item->name)]) }}">
                            <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('assets/img/default.png') }}" alt="{{ $item->name }}">
                        </a>
                        <div class="doctor-card-body">
                            <div class="doctor-card-meta">{{ $item->department?->name ?? __('Specialist Department') }}</div>
                            <h3 class="h4 mb-2">{{ $item->name }}</h3>
                            <p class="muted-copy mb-2">{{ $item->speciality ?: __('Specialist Doctor') }}</p>
                            <p class="muted-copy mb-2"><i class="fas fa-hospital me-2"></i>{{ $item->owner?->hospital_name ?? __('Hospital pending') }}</p>
                            <p class="muted-copy mb-4"><i class="fas fa-location-dot me-2"></i>{{ $doctorLocation($item) ?: ($item->owner?->hospital_location ?? __('Location will be updated soon')) }}</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('app.doctor-profile', ['doctor' => $item->id , 'name' => \Illuminate\Support\Str::slug($item->name)]) }}" class="btn-brand-secondary">{{ __('View Profile') }}</a>
                                <a href="{{ route('app.booking', ['doctor' => $item->id]) }}" class="btn-brand-primary">{{ __('Book Now') }}</a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .doctor-card {
        height: 100%;
        background: #fff;
        border-radius: 26px;
        overflow: hidden;
        border: 1px solid rgba(21, 58, 63, 0.08);
        box-shadow: 0 18px 40px rgba(15, 55, 60, 0.08);
    }

    .doctor-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        background: #edf6f7;
    }

    .doctor-card-body {
        padding: 24px;
    }

    .doctor-card-meta {
        display: inline-flex;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(244, 162, 97, 0.14);
        color: #9a5b1e;
        font-size: 0.82rem;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .doctor-card-link {
        display: block;
        color: inherit;
        text-decoration: none;
    }
</style>
