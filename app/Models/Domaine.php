<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modifier(){
        return $this->belongsTo(User::class, 'modified_by');
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}

