<?php

namespace App\Models;

use App\Models\User;
use App\Models\Guide;
use App\Models\Categorie;
use App\Models\Evenement;
use App\Models\SousDomaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'created_by',
        'modified_by',
        'categorie_id',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    // with(['creator', 'modifier', 'categorie'])

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    public function modifier()
    {
        return $this->belongsTo(User::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function sousDomaines()
    {
        return $this->hasMany(SousDomaine::class);
    }


    public function guides()
    {
        return $this->hasMany(Guide::class);
    }






}

