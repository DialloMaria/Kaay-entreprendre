<?php

namespace App\Models;

use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SousDomaine extends Model
{
    use HasFactory;

    // guard
    protected $guarded = [];

    // Relations
    public function domaine(){
        return $this->belongsTo(Domaine::class);
    }
}
