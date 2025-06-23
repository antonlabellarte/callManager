<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersList extends Model
{
    use HasFactory;

    protected $table = "campagneliste";

    protected $fillable = [
        "id",
        "campaignID"
    ];
}
