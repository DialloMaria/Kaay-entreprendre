<?php

namespace App\Models;

use App\Models\Guide;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SousDomaine extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'nom',
        'description',
        'image',
        'domaine_id',
        'created_by',
        'modified_by',
    ];


    // Relations
public function creator(){
    return $this->belongsTo(User::class, 'created_by');
}

public function modifier(){
    return $this->belongsTo(User::class, 'modidied_by');
}

public function domaine(){
    return $this->belongsTo(Domaine::class);
}
public function guides()
{
    return $this->hasMany(Guide::class);
}
// entrepreneurs
public function users(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'domaine_user');
}
}

