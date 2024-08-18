<?php

namespace App\Models;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function domaines(){
        return $this->hasMany(Domaine::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    

}




