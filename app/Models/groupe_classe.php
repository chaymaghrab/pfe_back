<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe_classe extends Model
{
    use HasFactory;
    protected $table = 'groupe_classes';
    protected $fillable = [
        'nom_groupe',
        'niveau',
        'code_groupe',
        'ecole',
        'departement',
        'parcours',
        'cours',
        'langue',
    ];
    protected  $with=['etudiants'];

    /************* les relations ********************/

    public function certifications()
    {
        return $this->belongsToMany(certification::class,'grp_classe_certifs','grp_classe_id','certif_id');
    }

    public function etudiants()
    {
        return $this->hasMany(etudiant::class,'grp_classe_id');
    }
}
