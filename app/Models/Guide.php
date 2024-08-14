<?php

namespace App\Models;

use App\Models\Domaine;
use App\Models\SousDomaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'etape',
        'datepublication',
        'media',
        'domaine_id',
        'created_by',
        'modified_by',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }

    public function sousDomaine()
    {
        return $this->belongsTo(SousDomaine::class);
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}

