<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $table = "booking";

    protected $primaryKey = "id_booking";

    protected $fillable = ["nama_pembooking", "id_lapangan", "waktu_booking", "jam_booking", "durasi_booking","iduser"];

//    public function pelanggan(){
//        return $this->belongsTo(Pelanggan::class,"id_pelanggan");
//    }

    public function lapangan(){
        return $this->belongsTo(Lapangan::class,"id_lapangan");
    }
}
