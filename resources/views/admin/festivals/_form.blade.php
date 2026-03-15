@if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre *</label>
            <input type="text" name="name" value="{{ old('name', $festival->name ?? '') }}"
                   class="form-input-fl" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Municipio *</label>
            <select name="municipality_id" class="form-input-fl" required>
                <option value="">Seleccionar municipio</option>
                @foreach($municipalities as $municipality)
                    <option value="{{ $municipality->id }}"
                            {{ old('municipality_id', $festival->municipality_id ?? '') == $municipality->id ? 'selected' : '' }}>
                        {{ $municipality->name }} ({{ $municipality->province->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Categoría *</label>
            <select name="category_id" class="form-input-fl" required>
                <option value="">Seleccionar categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ old('category_id', $festival->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->icon }} {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Fecha inicio *</label>
            <input type="date" name="start_date" value="{{ old('start_date', isset($festival) ? $festival->start_date->format('Y-m-d') : '') }}"
                   class="form-input-fl" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Fecha fin *</label>
            <input type="date" name="end_date" value="{{ old('end_date', isset($festival) ? $festival->end_date->format('Y-m-d') : '') }}"
                   class="form-input-fl" required>
        </div>

        <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Descripción corta</label>
            <input type="text" name="short_description" value="{{ old('short_description', $festival->short_description ?? '') }}"
                   class="form-input-fl" maxlength="500" placeholder="Máx. 500 caracteres">
        </div>

        <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Descripción completa *</label>
            <textarea name="description" rows="6" class="form-input-fl" required>{{ old('description', $festival->description ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Dirección</label>
            <input type="text" name="address" value="{{ old('address', $festival->address ?? '') }}" class="form-input-fl">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sitio web</label>
            <input type="url" name="website_url" value="{{ old('website_url', $festival->website_url ?? '') }}" class="form-input-fl" placeholder="https://...">
        </div>

        <div class="sm:col-span-2 flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                       {{ old('is_active', $festival->is_active ?? true) ? 'checked' : '' }}>
                <span class="text-sm font-medium text-gray-700">Activa (visible en el sitio)</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                       {{ old('is_featured', $festival->is_featured ?? false) ? 'checked' : '' }}>
                <span class="text-sm font-medium text-gray-700">⭐ Destacada</span>
            </label>
        </div>
    </div>
</div>
