@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="border-b border-gray-200 mb-4">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabs">
            <li class="mr-2">
                <a href="?section=hero" 
                   data-section="hero"
                   class="tab-link inline-block p-4 rounded-t-lg border-b-2">
                   Hero
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
           
        </ul>
    </div>

    {{-- Tab Content --}}
    <div id="tab-contents">
    {{-- Hero --}}
    <div id="hero" class="tab-content hidden">
        @includeIf('components.admin.pages.home.hero', ['heroData' => $heroData])
    </div>

    {{-- Feature --}}
    <div id="feature" class="tab-content hidden">
        @includeIf('components.admin.pages.home.feature', ['featureSection' => $featureData])
    </div>

    {{-- About Us --}}
    <div id="about_us" class="tab-content hidden">
        @includeIf('components.admin.pages.home.about_us', ['featureSection' => $featureData])
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        let urlParams = new URLSearchParams(window.location.search);
        let section = urlParams.get('section') || 'hero'; // default hero

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
