@if(session('success') || session('error'))
    <div id="toast-message" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm fixed top-5 right-5 transform translate-x-20 opacity-0" role="alert">
        <div id="toast-icon" class="inline-flex items-center justify-center shrink-0 w-8 h-8 rounded-lg">
            <svg id="toast-svg" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <!-- icon will be replaced by jQuery -->
            </svg>
            <span class="sr-only">Icon</span>
        </div>
        <div class="ms-3 text-sm font-normal" id="toast-text">
            {{ session('success') ?? session('error') }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 close-toast">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif


@push('scripts')
    <script>
        $(document).ready(function() {
            var $toast = $('#toast-message');

            if($toast.length){
                var isSuccess = "{{ session('success') ? 'true' : 'false' }}";

                // Set icon and color based on type
                if(isSuccess === 'true'){
                    $('#toast-icon').addClass('bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200');
                    $('#toast-svg').html('<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>');
                } else {
                    $('#toast-icon').addClass('bg-red-100 text-red-500 dark:bg-red-800 dark:text-red-200');
                    $('#toast-svg').html('<path d="M10 0.5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 0.5Zm3 12.707-1.414 1.414L10 11.414l-1.586 1.586-1.414-1.414L8.586 10 7 8.414l1.414-1.414L10 8.586l1.586-1.586 1.414 1.414L11.414 10l1.586 1.586Z"/>');
                }

                // Slide-in animation
                $toast.animate({opacity: 1, right: "100px", transform: "translateX(0)"}, 400);

                // Auto hide after 3 seconds
                setTimeout(function(){
                    $toast.animate({opacity: 0, right: "-100px"}, 400, function(){
                        $toast.remove();
                    });
                }, 3000);
            }

            // Close button click
            $('.close-toast').on('click', function(){
                $toast.animate({opacity: 0, right: "-100px"}, 400, function(){
                    $toast.remove();
                });
            });
        });
    </script>
@endpush