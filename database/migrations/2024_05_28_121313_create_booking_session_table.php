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
        Schema::create('booking_session', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('id_lap');
            $table->integer('id_customer')->nullable();
            $table->integer('id_session');
            $table->boolean('status');
            $table->boolean('status_bayar')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_session');
    }
};
