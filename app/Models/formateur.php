<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formateur extends Model
{
    use HasFactory;
    protected $table = 'formateurs';
    protected $fillable = [
        'statut',
        'telephone',
        ];
    protected  $with=['User'];

    /************* les relations ********************/
    public function groupe_formations()
    {
        return $this->hasMany(groupe_formation::class,'formateur_id');
    }
    public function User()
    {
        return $this->morphMany(User::class, 'userable');
    }
}
