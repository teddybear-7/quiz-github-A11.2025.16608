<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->foreignId('id_daftar_poli')->nullable()->unique()
                ->constrained('daftar_poli')->cascadeOnDelete();
            $table->dateTime('tgl_periksa')->nullable();
            $table->text('catatan')->nullable();
            $table->unsignedInteger('biaya_periksa')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->dropForeign(['id_daftar_poli']);
            $table->dropUnique(['id_daftar_poli']);
            $table->dropColumn(['id_daftar_poli', 'tgl_periksa', 'catatan', 'biaya_periksa']);
        });
    }
};
