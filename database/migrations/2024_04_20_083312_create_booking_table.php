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


        Schema::create('booking', function (Blueprint $table) {
            $table->integer('id_booking')->autoIncrement();
            $table->string('nama_pembooking');
//            $table->string('id_pelanggan');
            $table->integer('id_lapangan');
            $table->date('waktu_booking');
            $table->string('jam_booking');
            $table->integer('durasi_booking');
//            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
//            $table->foreign('id_lapangan')->references('id_lapangan')->on('lapangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
