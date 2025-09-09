<form action="{{ route('admin.sections.home.feature.update', $featureSection->id ?? 0) }}" 
      method="POST">
    @csrf
    @method('PUT')

    <h4 class="text-xl font-semibold text-gray-800 mb-3">Feature Section</h4>
    <hr class="mb-5">

    <div id="feature-items">
        @if(!empty($featureSection->data['features']))
            @foreach($featureSection->data['features'] as $index => $item)
                <div class="feature-item border mb-2 relative">
                    <button type="button" class="remove-feature absolute top-2 right-2 text-red-600">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">Icon (class)</label>
                            <input type="text" name="features[{{ $index }}][icon]" 
                                   value="{{ $item['icon'] ?? '' }}"
                                   class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Name</label>
                            <input type="text" name="features[{{ $index }}][name]" 
                                   value="{{ $item['name'] ?? '' }}"
                                   class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Description</label>
                            <input type="text" name="features[{{ $index }}][description]" 
                                   value="{{ $item['description'] ?? '' }}"
                                   class="w-full px-3 py-2 border rounded">
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="my-3">
        <button type="button" id="add-feature" 
                class="px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">
            <i class="fas fa-plus"></i> Add Feature
        </button>
    </div>

    <div>
        <button type="submit" 
                class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            <i class="fas fa-save mr-2"></i> Save
        </button>
    </div>
</form>

{{-- jQuery for Add/Remove --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let index = {{ !empty($featureSection->data['features']) ? count($featureSection->data['features']) : 0 }};

        // Add Feature
        $('#add-feature').click(function () {
            let html = `
            <div class="feature-item mb-3 relative">
                <button type="button" class="remove-feature mb-1 absolute top-1 right-2 text-red-600">
                    <i class="fas fa-times"></i>
                </button>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Icon (class)</label>
                        <input type="text" name="features[${index}][icon]" 
                               class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Name</label>
                        <input type="text" name="features[${index}][name]" 
                               class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Description</label>
                        <input type="text" name="features[${index}][description]" 
                               class="w-full px-3 py-2 border rounded">
                    </div>
                </div>
            </div>
            `;
            $('#feature-items').append(html);
            index++;
        });

        // Remove Feature
        $(document).on('click', '.remove-feature', function () {
            $(this).closest('.feature-item').remove();
        });
    });
</script>
