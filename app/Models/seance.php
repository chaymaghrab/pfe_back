<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seance extends Model
{
    use HasFactory;
    protected $table = 'seances';
    protected $fillable = [
        'datedeb',
        'datefin',
        'type',
        'groupe_formation_id',
    ];


    /**************** les relations *******************/

    public function groupe_formation()
    {
        return $this->belongsTo(groupe_formation::class,'groupe_formation_id');
    }


}
