<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousDomaine extends Model
{
    use HasFactory;
    // guard
    protected $guarded = [];

    public function domaine(){
        return $this->hasMany(Domaine::class);
    }
}
