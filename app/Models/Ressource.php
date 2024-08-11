<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'lien',
        'type',
        'guide_id',
        'created_by',
        'modified_by',
    ];

      // Relation avec le modèle Guide
      public function guide()
      {
          return $this->belongsTo(Guide::class);
      }

      // Relation avec le modèle User pour 'created_by'
      public function creator()
      {
          return $this->belongsTo(User::class, 'created_by');
      }

      // Relation avec le modèle User pour 'modified_by'
      public function modifier()
      {
          return $this->belongsTo(User::class, 'modified_by');
      }
}
