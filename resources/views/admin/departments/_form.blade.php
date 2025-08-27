@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Name <span class="text-red-600">*</span></label>
        <input type="text" name="name" value="{{ old('name', $department->name ?? '') }}" class="w-full border rounded p-2" required>
        @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Code</label>
        <input type="text" name="code" value="{{ old('code', $department->code ?? '') }}" class="w-full border rounded p-2">
        @error('code') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Short Name</label>
        <input type="text" name="short_name" value="{{ old('short_name', $department->short_name ?? '') }}" class="w-full border rounded p-2">
        @error('short_name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Status</label>
        <select name="status" class="w-full border rounded p-2">
            <option value="active" {{ (old('status', $department->status ?? 'active') == 'active') ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ (old('status', $department->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4 col-span-2">
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" class="w-full border rounded p-2">{{ old('description', $department->description ?? '') }}</textarea>
        @error('description') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="col-span-2">
        <button type="submit" 
            class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-save mr-2"></i> @isset($department) Update @else Save @endisset
        </button>
    </div>
</div>
