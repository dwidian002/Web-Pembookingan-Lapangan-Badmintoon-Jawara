<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use App\Models\Booking;
use App\Models\Lapangan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingSession extends Model {

    protected $table = "booking_session";

    protected $primaryKey = "id";

    protected $fillable = ["date", "id_lap","id_customer","id_session","status","status_bayar"];

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class,"id_session");
    }

    public function lapangan(): BelongsTo
    {
        return $this->belongsTo(Lapangan::class,"id_lap");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"id_customer");
    }
}
