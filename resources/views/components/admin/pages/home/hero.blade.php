@php
    $slides = collect($heroSliderData->data['slides'] ?? [])->values();
@endphp

<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
        <div>
            <h4 class="text-xl font-semibold text-gray-800 mb-1">Homepage Slider</h4>
            <p class="text-sm text-gray-500 mb-0">Slider e sudhu image ar link thakbe.</p>
        </div>
        <div class="text-sm text-gray-500">
            Total Slides: <span class="font-semibold text-gray-700">{{ $slides->count() }}</span>
        </div>
    </div>

    <div class="bg-gray-50 border rounded-2xl p-5">
        <h5 class="text-lg font-semibold text-gray-800 mb-4">Create New Slide</h5>

        <form action="{{ route('admin.sections.home.hero.slider.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Image</label>
                <input type="file" name="photo" class="w-full py-[6px] border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block font-semibold mb-1">Link</label>
                <input type="text" name="link" value="{{ old('link') }}" placeholder="https://example.com"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded shadow hover:bg-emerald-700">
                    <i class="fas fa-plus mr-2"></i>Create Slide
                </button>
            </div>
        </form>
    </div>

    <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold">#</th>
                        <th class="text-left px-4 py-3 font-semibold">Image</th>
                        <th class="text-left px-4 py-3 font-semibold">Link</th>
                        <th class="text-left px-4 py-3 font-semibold">Info</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($slides as $index => $slide)
                        <tr class="border-t align-top">
                            <td class="px-4 py-4 text-slate-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-4">
                                @if (!empty($slide['photo']))
                                    <img src="{{ asset('storage/' . $slide['photo']) }}" alt="Slider image {{ $index + 1 }}" class="w-40 h-24 object-cover rounded-lg border">
                                @else
                                    <div class="w-40 h-24 rounded-lg border bg-gray-100 flex items-center justify-center text-gray-400">
                                        No image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <form action="{{ route('admin.sections.home.hero.slider.slide.update', $index) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="link" value="{{ $slide['link'] ?? '#' }}"
                                        class="w-full min-w-[260px] px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

                                    <input type="file" name="photo" class="w-full py-[6px] border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

                                    @if (!empty($slide['photo']))
                                        <label class="inline-flex items-center gap-2 text-sm text-red-600">
                                            <input type="checkbox" name="delete_photo" value="1">
                                            <span>Delete image</span>
                                        </label>
                                    @endif

                                    <div class="flex gap-2">
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
                                            <i class="fas fa-save mr-2"></i>Update
                                        </button>
                                    </div>
                                </form>

                                <form action="{{ route('admin.sections.home.hero.slider.slide.destroy', $index) }}" method="POST" onsubmit="return confirm('Delete this slide?');" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200">
                                        <i class="fas fa-trash mr-2"></i>Delete
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-4 text-slate-500">
                                Clickable image slide
                            </td>
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">
                                No slider slide added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
