<?php

namespace App\Models;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modifier(){
        return $this->belongsTo(User::class, 'modidied_by');
    }

    public function forum(){
        return $this->belongsTo(Forum::class);
    }
}
