<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe_formation extends Model
{
    use HasFactory;
    protected $table = 'groupe_formations';
    protected $fillable = [
        'nom_groupe_forma','certification_id','local_id','formateur_id','cours','langue'

    ];


    /************* les relations ********************/

    public function certification()
    {
        return $this->belongsTo(certification::class,'certification_id');
    }
    public function local()
    {
        return $this->belongsTo(local::class,'local_id');
    }
    public function formateur()
    {
        return $this->belongsTo(formateur::class,'formateur_id');
    }
    public function seance()
    {
        return $this->hasMany(seance::class,'groupe_formation_id');
    }

    public function etudiants()
    {
        return $this->belongsToMany(etudiant::class,'etud_grp_formas','grp_forma_id','etudiant_id');
    }
}
