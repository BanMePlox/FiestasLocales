<x-admin-layout>
    @section('title', 'Editar municipio')

    <div class="max-w-lg">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.municipios.index') }}" class="text-gray-400 hover:text-gray-600">← Volver</a>
            <h1 class="font-display text-3xl font-bold text-gray-900">{{ $municipality->name }}</h1>
        </div>

        <form action="{{ route('admin.municipios.update', $municipality) }}" method="POST">
            @csrf @method('PUT')
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $municipality->name) }}" class="form-input-fl" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Provincia</label>
                    <select name="province_id" class="form-input-fl" required>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ $municipality->province_id == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Latitud</label>
                        <input type="number" step="any" name="lat" value="{{ old('lat', $municipality->lat) }}" class="form-input-fl">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Longitud</label>
                        <input type="number" step="any" name="lng" value="{{ old('lng', $municipality->lng) }}" class="form-input-fl">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Población</label>
                    <input type="number" name="population" value="{{ old('population', $municipality->population) }}" class="form-input-fl">
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.municipios.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-admin-layout>
