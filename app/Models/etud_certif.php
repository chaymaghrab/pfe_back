<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etud_certif extends Model
{
    use HasFactory;
    protected $table = 'etud_certif';
    protected $fillable = [
        'certif_id',
        'etud_id',
        'langue_certif',
    ];
}
