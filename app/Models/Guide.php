<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'datepublication',
        'media',
        'auteur',
        'domaine_id',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
}

