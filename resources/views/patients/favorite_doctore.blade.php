@extends('layouts.patient')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="mb-0">Favorite Doctors</h5>
        <hr>
        <div class="row g-4 mt-3">
            <!-- Doctor Card 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small_2x/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg" 
                             class="rounded-circle mb-3" width="100" height="100" alt="Dr. Emily Brown">
                        <h6 class="fw-bold mb-1">Dr. Emily Brown</h6>
                        <p class="text-muted small mb-2">Senior Physiotherapist</p>
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

            <!-- Doctor Card 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <img src="https://thumbs.dreamstime.com/b/female-doctor-23301058.jpg" 
                             class="rounded-circle mb-3" width="100" height="100" alt="Dr. Lisa White">
                        <h6 class="fw-bold mb-1">Dr. Lisa White</h6>
                        <p class="text-muted small mb-2">General Physician</p>
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

            <!-- Doctor Card 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <img src="https://img.freepik.com/premium-photo/male-female-doctor-portrait-healthcare-medical-staff-concept-confident-doctor-portrait_1108314-405796.jpg" 
                             class="rounded-circle mb-3" width="100" height="100" alt="Dr. Alex Green">
                        <h6 class="fw-bold mb-1">Dr. Alex Green</h6>
                        <p class="text-muted small mb-2">Orthopedic Specialist</p>
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

            <!-- Doctor Card 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" 
                             class="rounded-circle mb-3" width="100" height="100" alt="Dr. John Smith">
                        <h6 class="fw-bold mb-1">Dr. John Smith</h6>
                        <p class="text-muted small mb-2">Cardiologist</p>
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
        </div>
    </div>
</div>


@endsection