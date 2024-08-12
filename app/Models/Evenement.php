<?php

namespace App\Models;

use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenement extends Model
{
    use HasFactory;
protected $fillable = [
        'titre',
        'description',
        'online',
        'lieu',
        'domaine_id',
        'created_by',
        'modified_by',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
}


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_events')->withTimestamps();
    }
}
