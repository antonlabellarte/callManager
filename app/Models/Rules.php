<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    protected $table = "rules";

    protected $fillable = [
        "id",
        "servizioPartizionato",
        "dataInizio",
        "dataFine",
        "flag",
        "oraInizio",
        "oraFine",
        "servizioUno",
        "percentualeUno",
        "servizioDue",
        "percentualeDue",
        "servizioTre",
        "percentualeTre",
        "created_at",
        "updated_at"
    ];
}
