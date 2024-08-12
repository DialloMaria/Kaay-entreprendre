<?php

namespace App\Models;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Temoignage extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'guide_id',
        'created_by',
        'modified_by',
    ];
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
