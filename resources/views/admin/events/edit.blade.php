<x-admin-layout>

<div class="mb-6">
    <a href="{{ route('admin.eventos.index') }}" class="text-sm text-gray-500 hover:text-gray-800">← Eventos</a>
    <h1 class="text-xl font-bold text-gray-950 mt-2">Editar evento</h1>
</div>

@if($errors->any())
    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.eventos.update', $event) }}" class="max-w-2xl space-y-5">
    @csrf @method('PUT')

    <div>
        <label class="section-label block mb-1">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $event->name) }}" class="form-input-fl" required>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label block mb-1">Municipio</label>
            <select name="municipality_id" class="form-input-fl" required>
                @foreach($municipalities as $m)
                    <option value="{{ $m->id }}" {{ old('municipality_id', $event->municipality_id) == $m->id ? 'selected' : '' }}>
                        {{ $m->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="section-label block mb-1">Género</label>
            <select name="music_genre_id" class="form-input-fl">
                <option value="">—</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('music_genre_id', $event->music_genre_id) == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label block mb-1">Inicio</label>
            <input type="datetime-local" name="starts_at"
                   value="{{ old('starts_at', $event->starts_at->format('Y-m-d\TH:i')) }}"
                   class="form-input-fl" required>
        </div>
        <div>
            <label class="section-label block mb-1">Fin</label>
            <input type="datetime-local" name="ends_at"
                   value="{{ old('ends_at', $event->ends_at?->format('Y-m-d\TH:i')) }}"
                   class="form-input-fl">
        </div>
    </div>

    <div>
        <label class="section-label block mb-1">Recinto</label>
        <input type="text" name="venue" value="{{ old('venue', $event->venue) }}" class="form-input-fl" required>
    </div>

    <div>
        <label class="section-label block mb-1">Dirección</label>
        <input type="text" name="address" value="{{ old('address', $event->address) }}" class="form-input-fl">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label block mb-1">Precio (€)</label>
            <input type="number" name="price" value="{{ old('price', $event->price) }}"
                   class="form-input-fl" min="0" step="0.01" placeholder="Vacío = libre">
        </div>
        <div>
            <label class="section-label block mb-1">Edad mínima</label>
            <input type="number" name="min_age" value="{{ old('min_age', $event->min_age) }}"
                   class="form-input-fl" min="0" max="99">
        </div>
    </div>

    <div>
        <label class="section-label block mb-1">Descripción</label>
        <textarea name="description" rows="4" class="form-input-fl resize-none">{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label block mb-1">Web</label>
            <input type="url" name="website_url" value="{{ old('website_url', $event->website_url) }}" class="form-input-fl">
        </div>
        <div>
            <label class="section-label block mb-1">Instagram</label>
            <input type="url" name="instagram_url" value="{{ old('instagram_url', $event->instagram_url) }}" class="form-input-fl">
        </div>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" id="is_active" name="is_active" value="1"
               {{ old('is_active', $event->is_active) ? 'checked' : '' }}
               class="rounded border-gray-300">
        <label for="is_active" class="text-sm text-gray-700">Activo</label>
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-primary">Guardar cambios</button>
        <a href="{{ route('admin.eventos.index') }}" class="btn-ghost">Cancelar</a>
    </div>
</form>

</x-admin-layout>
