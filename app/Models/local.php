<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;
    protected $table = 'locals';

    protected $fillable = [
        'nom',
        'capacite',
        'type',
    ];

    /************* les relations ********************/
    public function groupe_formations()
    {
        return $this->hasMany(groupe_formation::class,'local_id');
    }
    public function groupe_certifications()
    {
        return $this->hasMany(groupe_certification::class,'local_id');
    }
}
