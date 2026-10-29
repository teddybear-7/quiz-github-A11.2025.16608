<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status_pembayaran', 25)->default('Belum Dibayar');
        });
    }


    public function down(): void
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->dropColumn(['bukti_pembayaran', 'status_pembayaran']);
        });
    }
};
