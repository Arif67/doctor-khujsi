@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="border-b border-gray-200 mb-4">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabs">
            <li class="mr-2">
                <a href="?section=slider" 
                   data-section="slider"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   Slider
                </a>
            </li>
            <li class="mr-2">
                <a href="?section=feature" 
                   data-section="feature"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   Feature
                </a>
            </li>
            <li class="mr-2">
                <a href="?section=about_us" 
                   data-section="about_us"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   About Us
                </a>
            </li>
            <li class="mr-2">
                <a href="?section=featured_hospitals" 
                   data-section="featured_hospitals"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   Featured Hospitals
                </a>
            </li>
            <li class="mr-2">
                <a href="?section=services"
                   data-section="services"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   Services
                </a>
            </li>
            <li class="mr-2">
                <a href="?section=featured_doctors"
                   data-section="featured_doctors"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   Featured Doctors
                </a>
            </li>
           
        </ul>
    </div>

    {{-- Tab Content --}}
    <div id="tab-contents">
    {{-- Slider --}}
    <div id="slider" class="tab-content hidden">
        @includeIf('components.admin.pages.home.hero', ['heroData' => $heroData, 'heroSliderData' => $heroSliderData])
    </div>

    {{-- Feature --}}
    <div id="feature" class="tab-content hidden">
        @includeIf('components.admin.pages.home.feature', ['featureSection' => $featureData])
    </div>

    {{-- About Us --}}
    <div id="about_us" class="tab-content hidden">
        @includeIf('components.admin.pages.home.about_us', ['aboutUsData' => $aboutUsData])
    </div>

    <div id="featured_hospitals" class="tab-content hidden">
        @includeIf('components.admin.pages.home.featured_hospitals', ['featuredHospitalsData' => $featuredHospitalsData, 'hospitalOwners' => $hospitalOwners])
    </div>

    <div id="services" class="tab-content hidden">
        @includeIf('components.admin.pages.home.services', ['homeServicesData' => $homeServicesData, 'services' => $services])
    </div>

    <div id="featured_doctors" class="tab-content hidden">
        @includeIf('components.admin.pages.home.featured_doctors', ['featuredDoctorsData' => $featuredDoctorsData, 'doctors' => $doctors])
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        let urlParams = new URLSearchParams(window.location.search);
        let section = urlParams.get('section') || 'slider';

        function activateTab(section) {
            $(".tab-link").removeClass("border-blue-500 text-blue-600");
            $(".tab-link[data-section='"+section+"']").addClass("border-blue-500 text-blue-600");

            $(".tab-content").addClass("hidden");
            $("#"+section).removeClass("hidden");
        }

        activateTab(section);
        $(".tab-link").on("click", function(e){
            e.preventDefault();
            let sec = $(this).data("section");

            window.history.pushState({}, '', '?section=' + sec);
            activateTab(sec);
        });
    });
</script>
@endpush
