<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'text', 'estate_id'];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
