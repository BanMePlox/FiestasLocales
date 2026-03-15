<x-app-layout>
    @section('title', 'Contacto')

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="font-display text-4xl font-bold text-gray-900 mb-4">Contacto</h1>
        <p class="text-gray-600 mb-8">¿Conoces una fiesta que debería estar en FiestasLocales? ¿Tienes alguna sugerencia o corrección? Escríbenos.</p>

        <div class="bg-white rounded-2xl border border-gray-200 p-8">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre</label>
                    <input type="text" class="form-input-fl" placeholder="Tu nombre">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" class="form-input-fl" placeholder="tu@email.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mensaje</label>
                    <textarea rows="5" class="form-input-fl" placeholder="¿En qué podemos ayudarte?"></textarea>
                </div>
                <button type="button" class="btn-primary w-full justify-center">Enviar mensaje</button>
            </div>
        </div>
    </div>
</x-app-layout>
