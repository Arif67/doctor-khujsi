<div class="sidebar d-none d-lg-block">
    <a href="{{route('patient.dashboard')}}" class="{{Route::is('patient.dashboard') ? 'active':''}}">
        <i class="bi bi-speedometer"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{route('patient.appointments')}}" class="{{Route::is('patient.appointments') ? 'active':''}}">
        <i class="fas fa-calendar-alt"></i>
        <span>Appointments</span>
    </a>
    <a href="{{route('patient.favorite.doctor')}}" class="{{Route::is('patient.favorite.doctor') ? 'active':''}}">
        <i class="fas fa-heart"></i>
        <span>Favorite Doctor</span>
    </a>
    <a href="{{route('patient.service.history')}}" class="{{Route::is('patient.service.history') ? 'active':''}}">
        <i class="fas fa-history"></i>
        <span>Service History</span>
    </a>
</div>

<!-- Offcanvas Sidebar for mobile -->
<div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title text-dark">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <a href="{{route('patient.profile')}}" class="d-block mb-2 text-dark">Dashboard</a>
        <a href="#" class="d-block mb-2 text-dark">Users</a>
        <a href="#" class="d-block mb-2 text-dark">Settings</a>
    </div>
</div>