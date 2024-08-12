<?php

namespace App\Models;

use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenement extends Model
{
    use HasFactory;
    protected $guarded=[];
  /*  protected $fillable = [
        'titre',
        'description',
        'online',
        'lieu',
        'domaine_id'
    ];
*/
    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'domaine_id');
}
}
