<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    protected $table = "rules";

    protected $fillable = [
        "servizio",
        "data_iniziale",
        "data_finale",
        "flag",
        "ora_iniziale",
        "ora_finale",
        "coda_uno",
        "partizione_uno",
        "coda_due",
        "partizione_due",
        "coda_tre",
        "partizione_tre",
        "created_at",
        "updated_at"
    ];
}
