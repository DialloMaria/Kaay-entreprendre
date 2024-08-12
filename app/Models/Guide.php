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
        'etape',
        'datepublication',
        'media',
        'auteur',
        'domaine_id',
        'created_by',
        'modified_by',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
}

