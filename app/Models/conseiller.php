<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conseiller extends Model
{
    use HasFactory;
    protected $table = 'conseillers';
    protected $fillable = [
        'statut',
        'parcours',
    ];


    /************* les relations ********************/
    public function User()
    {
        return $this->morphMany(User::class, 'userable');
    }
}
