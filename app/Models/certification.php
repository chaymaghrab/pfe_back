<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certification extends Model
{
    use HasFactory;


    protected $table = 'certifications';

    protected $fillable = [
        'nom_formation',
        'nbheure',
        'score_de_passage',
        'nbquestion',
        'type_examan',
        'duree',
    ];


             /************* les relations ********************/
    public function groupe_formations()
    {
        return $this->hasMany(groupe_formation::class,'certification_id');
    }
    public function groupe_certifications()
    {
        return $this->hasMany(groupe_certification::class,'certification_id');
    }
    public function groupes_classes()
    {
        return $this->belongsToMany(groupe_classe::class,'grp_classe_certifs','certif_id','grp_classe_id');
    }
}
