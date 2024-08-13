<?php

namespace App\Models;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forum extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'nombre_de_message',
        'nombre_de_vue',
        'dateCreation',
        'domaine_id',
        'created_by',
        'modified_by',
    ];
public function creator(){
    return $this->belongsTo(User::class, 'created_by');
}

public function modifier(){
    return $this->belongsTo(User::class, 'modidied_by');
}

public function domaine(){
    return $this->belongsTo(Domaine::class);
}

public function messages(){
    return $this->hasMany(Message::class);
}

}
