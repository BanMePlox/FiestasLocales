<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // festivals
        // scopeActive filtra is_active; scopeUpcoming ordena por start_date;
        // el compuesto cubre la consulta más frecuente: activos próximos.
        Schema::table('festivals', function (Blueprint $table) {
            $table->index(['is_active', 'start_date'], 'festivals_active_date');
            $table->index(['is_active', 'is_featured'], 'festivals_active_featured');
            // deleted_at: acelera las queries con SoftDeletes (whereNull por defecto)
            $table->index('deleted_at', 'festivals_deleted_at');
        });

        // events
        // scopeActive = is_active + approved_at NOT NULL;
        // scopeUpcoming añade starts_at >= now() ORDER BY starts_at.
        // El compuesto de tres columnas cubre todos los casos a la vez.
        Schema::table('events', function (Blueprint $table) {
            $table->index(['is_active', 'approved_at', 'starts_at'], 'events_active_approved_date');
            $table->index('deleted_at', 'events_deleted_at');
        });

        // municipalities
        // Se usa en orderBy('name') en todos los selects de admin y formularios.
        Schema::table('municipalities', function (Blueprint $table) {
            $table->index('name', 'municipalities_name');
        });
    }

    public function down(): void
    {
        Schema::table('festivals', function (Blueprint $table) {
            $table->dropIndex('festivals_active_date');
            $table->dropIndex('festivals_active_featured');
            $table->dropIndex('festivals_deleted_at');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex('events_active_approved_date');
            $table->dropIndex('events_deleted_at');
        });

        Schema::table('municipalities', function (Blueprint $table) {
            $table->dropIndex('municipalities_name');
        });
    }
};
