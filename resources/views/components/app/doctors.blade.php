<section class="team-section">
    <div class="container px-4 px-md-0">
        <div class="team-header">
            <span class="team-tag">Our Specialists</span>
            <h2 class="heading_title">Our Dedicated & Experienced<br>Therapist Team</h2>
        </div>
        <div class="row row-gap-4">
            @foreach ($doctores as $item)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{route('app.doctor-profile', ['doctor' => $item->id , 'name' => \Illuminate\Support\Str::slug($item->name)])}}">
                        <div class="team-card">
                            <div class="team-photo-bg">
                                <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('assets/img/default.png') }}"
                                    alt="{{ $item->name }}">
                                <div class="team-contact">
                                    <a href="#"><i class="fas fa-phone"></i></a>
                                    <a href="#"><i class="fas fa-comment-dots"></i></a>
                                    <a href="#"><i class="fas fa-info-circle"></i></a>
                                </div>
                            </div>
                            <a href="{{route('app.doctor-profile', ['doctor' => $item->id , 'name' => \Illuminate\Support\Str::slug($item->name)])}}">
                                <div class="team-name">{{ $item->name }}</div>
                                <div class="team-role">{{ $item->speciality ?: ($item->department?->name ?? 'Specialist') }}</div>
                                <div class="team-role">{{ $item->owner?->hospital_name ?? 'Hospital pending' }}</div>
                                <div class="mt-2">
                                    <span class="btn btn-sm btn-outline-info">Book Now</span>
                                </div>
                            </a>
                        </div>
                    </a>
                </div>
                

            @endforeach

        </div>
    </div>
</section>
