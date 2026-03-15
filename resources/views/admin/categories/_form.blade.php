@if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700 mb-4">
        @foreach($errors->all() as $error)<p>• {{ $error }}</p>@endforeach
    </div>
@endif

<div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre *</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="form-input-fl" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Icono (emoji)</label>
        <input type="text" name="icon" value="{{ old('icon', $category->icon ?? '') }}" class="form-input-fl" placeholder="🎉">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Color (hex)</label>
        <div class="flex gap-2">
            <input type="color" name="color" value="{{ old('color', $category->color ?? '#c0392b') }}" class="h-10 w-16 rounded-lg border border-gray-300 cursor-pointer p-0.5">
            <input type="text" value="{{ old('color', $category->color ?? '#c0392b') }}" class="form-input-fl flex-1" placeholder="#c0392b" readonly>
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Descripción</label>
        <textarea name="description" rows="3" class="form-input-fl">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
</div>
