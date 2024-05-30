<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model {
    protected $table = "galeri";

    protected $primaryKey = "id_foto";

    protected $fillable = ["judul_foto","foto_galeri"];

}