<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveillant extends Model
{
    use HasFactory;
    protected $table = 'surveillants';
    protected $fillable = [
        'statut',
        'telephone',
    ];

    protected  $with=['User'];


    /************* les relations ********************/

    public function User()
    {
        return $this->morphMany(User::class, 'userable');
    }
    public function groupe_cerifications()
    {
        return $this->hasMany(groupe_certification::class,'surv1_id');
    }
}
