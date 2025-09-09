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
<div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold">Patient Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="list-group list-group-flush">
            <a href="{{route('patient.dashboard')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer me-2"></i> Dashboard
            </a>
            <a href="{{route('patient.appointments')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.appointments') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i> Appointments
            </a>
            <a href="{{route('patient.favorite.doctor')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.favorite.doctor') ? 'active' : '' }}">
                <i class="fas fa-heart me-2"></i> Favorite Doctor
            </a>
            <a href="{{route('patient.service.history')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.service.history') ? 'active' : '' }}">
                <i class="fas fa-history me-2"></i> Service History
            </a>
        </nav>
    </div>
</div>

<style>
    /* Offcanvas Sidebar Custom Design */

    .sidebar-offcanvas .list-group-item {
        border: none;
        padding: 14px 18px;
        font-size: 15px;
        color: #333;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .sidebar-offcanvas .list-group-item i {
        font-size: 16px;
    }

    .sidebar-offcanvas .list-group-item:hover {
        background: #f0f0f0;
        color: #007bff;
    }

    .sidebar-offcanvas .list-group-item.active {
        background: #007bff;
        color: #fff;
        font-weight: 600;
        border-radius: 0;
    }

</style>