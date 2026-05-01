<div class="sidebar d-none d-lg-block">
    <a href="{{route('patient.dashboard')}}" class="{{Route::is('patient.dashboard') ? 'active':''}}">
        <i class="bi bi-speedometer"></i>
        <span>{{ __('Dashboard') }}</span>
    </a>
    <a href="{{route('patient.profile')}}" class="{{Route::is('patient.profile') ? 'active':''}}">
        <i class="bi bi-person-badge"></i>
        <span>{{ __('Profile') }}</span>
    </a>
    <a href="{{route('patient.appointments')}}" class="{{Route::is('patient.appointments') ? 'active':''}}">
        <i class="fas fa-calendar-alt"></i>
        <span>{{ __('Appointments') }}</span>
    </a>
    <a href="{{route('patient.reports.index')}}" class="{{Route::is('patient.reports.*') ? 'active':''}}">
        <i class="fas fa-file-medical"></i>
        <span>{{ __('Reports') }}</span>
    </a>
    <a href="{{route('patient.prescriptions.index')}}" class="{{Route::is('patient.prescriptions.*') ? 'active':''}}">
        <i class="bi bi-prescription2"></i>
        <span>{{ __('Prescriptions') }}</span>
    </a>
    <a href="{{route('patient.timeline')}}" class="{{Route::is('patient.timeline') ? 'active':''}}">
        <i class="bi bi-activity"></i>
        <span>{{ __('Medical Timeline') }}</span>
    </a>
    <a href="{{route('patient.favorite.doctor')}}" class="{{Route::is('patient.favorite.doctor') ? 'active':''}}">
        <i class="fas fa-heart"></i>
        <span>{{ __('Favorite Doctors') }}</span>
    </a>
    <a href="{{route('patient.service.history')}}" class="{{Route::is('patient.service.history') ? 'active':''}}">
        <i class="fas fa-history"></i>
        <span>{{ __('Service History') }}</span>
    </a>
</div>

<!-- Offcanvas Sidebar for mobile -->
<div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold">{{ __('Patient Menu') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="list-group list-group-flush">
            <a href="{{route('patient.dashboard')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer me-2"></i> {{ __('Dashboard') }}
            </a>
            <a href="{{route('patient.profile')}}"
               class="list-group-item list-group-item-action {{ Route::is('patient.profile') ? 'active' : '' }}">
                <i class="bi bi-person-badge me-2"></i> {{ __('Profile') }}
            </a>
            <a href="{{route('patient.appointments')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.appointments') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i> {{ __('Appointments') }}
            </a>
            <a href="{{route('patient.reports.index')}}"
               class="list-group-item list-group-item-action {{ Route::is('patient.reports.*') ? 'active' : '' }}">
                <i class="fas fa-file-medical me-2"></i> {{ __('Reports') }}
            </a>
            <a href="{{route('patient.prescriptions.index')}}"
               class="list-group-item list-group-item-action {{ Route::is('patient.prescriptions.*') ? 'active' : '' }}">
                <i class="bi bi-prescription2 me-2"></i> {{ __('Prescriptions') }}
            </a>
            <a href="{{route('patient.timeline')}}"
               class="list-group-item list-group-item-action {{ Route::is('patient.timeline') ? 'active' : '' }}">
                <i class="bi bi-activity me-2"></i> {{ __('Medical Timeline') }}
            </a>
            <a href="{{route('patient.favorite.doctor')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.favorite.doctor') ? 'active' : '' }}">
                <i class="fas fa-heart me-2"></i> {{ __('Favorite Doctors') }}
            </a>
            <a href="{{route('patient.service.history')}}" 
               class="list-group-item list-group-item-action {{ Route::is('patient.service.history') ? 'active' : '' }}">
                <i class="fas fa-history me-2"></i> {{ __('Service History') }}
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
