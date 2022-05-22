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
        return $this->belongsTo(surveillant::class,'surv1_id');
    }
    public function surveilant2()
    {
        return $this->belongsTo(surveillant::class,'surv2_id');
    }
    public function etudiants()
    {
        return $this->belongsToMany(etudiant::class,'etud_grp_certifs','grp_certif_id','etudiant_id');
    }
}
