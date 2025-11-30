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
        Schema::table('penjual_profiles', function (Blueprint $table) {
            $table->foreignId('guru_pendamping_id')->nullable()->after('shop_photo')->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjual_profiles', function (Blueprint $table) {
            $table->dropForeign(['guru_pendamping_id']);
            $table->dropColumn('guru_pendamping_id');
        });
    }
};