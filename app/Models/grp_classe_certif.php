<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grp_classe_certif extends Model
{
    use HasFactory;
    protected $table = 'grp_classe_certifs';

    protected $fillable = [
        'semestre',
        'langue',
    ];
}
