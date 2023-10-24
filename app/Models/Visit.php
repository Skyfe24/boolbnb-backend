<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'estate_id'];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
