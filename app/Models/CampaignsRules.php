<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
    use HasFactory;

    protected $table = 'campagneregole';

    protected $fillable = [
        "id",
        "testo",
        "coda",
        "forzaCoda",
        "abbattimento",
        "nomeCampagna",
        "dataInizio",
        "dataFine",
        "allCustomer",
        "enabled"
    ];
}
