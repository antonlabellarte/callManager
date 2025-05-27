<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignsLists extends Model
{
    use HasFactory;

    protected $table = "campagneliste";

    protected $fillable = [
        "id",
        "regolaid"
    ];
}
