<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe_certification extends Model
{
    use HasFactory;
    protected $table = 'groupe_certifications';
    protected $fillable = [
        'date',
        'heuredeb',
        'heurefin',
        'nom_groupe_certif','certification_id','local_id','surv1_id','surv2_id','cours','langue','effectif'

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
    public function surveilant1()
    {
        return $this->belongsTo(formateur::class,'surv1_id');
    }
    public function surveilant2()
    {
        return $this->belongsTo(formateur::class,'surv2_id');
    }
    public function etudiants()
    {
        return $this->belongsToMany(etudiant::class,'etud_grp_certifs','grp_certif_id','etudiant_id');
    }
}
