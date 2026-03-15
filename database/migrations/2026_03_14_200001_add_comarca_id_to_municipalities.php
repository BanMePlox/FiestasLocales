<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('municipalities', function (Blueprint $table) {
            $table->foreignId('comarca_id')->nullable()->after('province_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('municipalities', function (Blueprint $table) {
            $table->dropForeign(['comarca_id']);
            $table->dropColumn('comarca_id');
        });
    }
};
