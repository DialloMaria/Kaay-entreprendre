<?php

namespace App\Models;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domaine extends Model
{
    use HasFactory;



    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    protected $table = 'domaines';

}
