<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipality_id')->constrained()->cascadeOnDelete();
            $table->foreignId('music_genre_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('submitted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Fecha y hora
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();

            // Lugar
            $table->string('venue');          // Nombre del recinto / plaza
            $table->string('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            // Detalles
            $table->decimal('price', 8, 2)->nullable(); // null = entrada libre
            $table->integer('min_age')->nullable();
            $table->string('website_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('cover_image')->nullable();

            // Estado
            $table->boolean('is_active')->default(true);
            $table->timestamp('approved_at')->nullable(); // null = pendiente de aprobación

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
