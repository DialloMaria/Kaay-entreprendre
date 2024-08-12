<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $guarded = [];



    // public function evenement()
    // {
    //     return $this->belongsTo(Evenement::class);
    // }
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    // Relation avec le modèle User pour 'created_by'
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
