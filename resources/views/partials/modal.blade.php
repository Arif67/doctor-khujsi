<!-- Global Delete Modal -->
<div id="deleteModal"
    x-data="{ open: false, deleteRoute: '' }" 
    x-show="open"
    x-cloak
    class="fixed deleteModal inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

    <!-- Backdrop Transition -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-black bg-opacity-50">
    </div>

    <!-- Modal Box Transition -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-4"
        class="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        
        <h2 class="text-lg font-bold text-gray-800">Confirm Delete</h2>
        <p class="mt-2 text-sm text-gray-600">
            Are you sure you want to delete this item?
        </p>

        <div class="flex justify-end space-x-3 mt-4">
            <button @click="open=false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Cancel
            </button>
            <form :action="deleteRoute" method="POST" x-ref="deleteForm">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
