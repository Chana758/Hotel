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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->nullable()->change();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('room_id')->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['room_id', 'user_id']);
        });
    }
};
