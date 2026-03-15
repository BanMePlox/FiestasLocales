<x-app-layout>
@section('title', 'Proponer evento')

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="mb-8">
        <p class="section-label">Comunitat Valenciana</p>
        <h1 class="text-3xl font-bold text-gray-950 tracking-tight">Proponer un evento</h1>
        <p class="text-sm text-gray-400 mt-2">
            Rellena los datos de tu fiesta o evento con música. Lo revisaremos y lo publicaremos en breve.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <label class="section-label block mb-1">Nombre del evento <span class="text-accent">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-input-fl" placeholder="Ej. Fiesta Mayor de Llíria" required>
        </div>

        {{-- Municipality + genre --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="section-label block mb-1">Municipio <span class="text-accent">*</span></label>
                <select name="municipality_id" class="form-input-fl" required>
                    <option value="">Selecciona...</option>
                    @foreach($municipalities as $m)
                        <option value="{{ $m->id }}" {{ old('municipality_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="section-label block mb-1">Género musical</label>
                <select name="music_genre_id" class="form-input-fl">
                    <option value="">Sin especificar</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ old('music_genre_id') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Starts at + ends at --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="section-label block mb-1">Inicio <span class="text-accent">*</span></label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}"
                       class="form-input-fl" required>
            </div>
            <div>
                <label class="section-label block mb-1">Fin (opcional)</label>
                <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}"
                       class="form-input-fl">
            </div>
        </div>

        {{-- Venue --}}
        <div>
            <label class="section-label block mb-1">Recinto / Lugar <span class="text-accent">*</span></label>
            <input type="text" name="venue" value="{{ old('venue') }}"
                   class="form-input-fl" placeholder="Ej. Plaza del Ayuntamiento" required>
        </div>

        {{-- Address --}}
        <div>
            <label class="section-label block mb-1">Dirección (opcional)</label>
            <input type="text" name="address" value="{{ old('address') }}"
                   class="form-input-fl" placeholder="Ej. Av. de la Constitución, 1">
        </div>

        {{-- Price + min age --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="section-label block mb-1">Precio (€)</label>
                <input type="number" name="price" value="{{ old('price') }}"
                       class="form-input-fl" placeholder="Déjalo vacío si es entrada libre"
                       min="0" max="999" step="0.01">
                <p class="text-xs text-gray-400 mt-1">Vacío = entrada libre</p>
            </div>
            <div>
                <label class="section-label block mb-1">Edad mínima</label>
                <input type="number" name="min_age" value="{{ old('min_age') }}"
                       class="form-input-fl" placeholder="Ej. 18"
                       min="0" max="99">
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label class="section-label block mb-1">Descripción (opcional)</label>
            <textarea name="description" rows="4"
                      class="form-input-fl resize-none"
                      placeholder="Cuéntanos más sobre el evento, artistas, line-up...">{{ old('description') }}</textarea>
        </div>

        {{-- Website + Instagram --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="section-label block mb-1">Web oficial</label>
                <input type="url" name="website_url" value="{{ old('website_url') }}"
                       class="form-input-fl" placeholder="https://...">
            </div>
            <div>
                <label class="section-label block mb-1">Instagram</label>
                <input type="url" name="instagram_url" value="{{ old('instagram_url') }}"
                       class="form-input-fl" placeholder="https://instagram.com/...">
            </div>
        </div>

        {{-- Cover image --}}
        <div>
            <label class="section-label block mb-1">Imagen del evento (opcional)</label>
            <input type="file" name="cover_image" accept="image/*" class="form-input-fl py-2">
            <p class="text-xs text-gray-400 mt-1">Máx. 3 MB. JPG, PNG o WebP.</p>
        </div>

        {{-- Submit --}}
        <div class="pt-2 flex gap-3">
            <button type="submit" class="btn-primary">Enviar propuesta</button>
            <a href="{{ route('events.index') }}" class="btn-ghost">Cancelar</a>
        </div>

        <p class="text-xs text-gray-400">
            Tu propuesta será revisada antes de publicarse. Te avisaremos por email una vez aprobada.
        </p>
    </form>

</div>
</x-app-layout>
