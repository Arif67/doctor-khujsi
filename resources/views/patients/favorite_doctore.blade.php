@extends('layouts.patient')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="mb-0">Favorite Doctors</h5>
        <hr>
        <div class="row g-4 mt-3">
            @forelse ($items as $item)
              <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                       @php
                            $photo = $item->doctor->photo ? asset('storage/'.$item->doctor->photo) : asset('assets/img/doctore.png');
                        @endphp
                        <img src="{{$photo}}" 
                             class="rounded-circle mb-3" width="100" height="100" alt="Dr. Emily Brown">
                        <h6 class="fw-bold mb-1">{{ $item->doctor->name }}</h6>
                        <p class="text-muted small mb-2">{{ $item->doctor?->department?->name }}</p>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" title="Call">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary me-1" title="Chat">
                                <i class="fas fa-comment"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary" title="Video">
                                <i class="fas fa-video"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>  
            @empty
                
            @endforelse
            
        </div>
    </div>
</div>


@endsection