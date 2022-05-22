<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    use HasFactory;

    protected $table = 'etudiants';
    protected $fillable = [
        'matricule',
        'cin',

    ];
    //protected  $with =['groupe_classe'];
    protected  $with=['User'];


    /************* les relations ********************/
    public function groupe_classe()
    {
        return $this->belongsTo(groupe_classe::class,'grp_classe_id');
    }
    public function User()
    {
        return $this->morphMany(User::class, 'userable');
    }
    public function groupe_formations()
    {
        return $this->belongsToMany(groupe_formation::class,'etud_grp_formas','etudiant_id','grp_forma_id');
    }
    public function groupe_certifications()
    {
        return $this->belongsToMany(groupe_certification::class,'etud_grp_certifs','etudiant_id','grp_certif_id');
    }
}
