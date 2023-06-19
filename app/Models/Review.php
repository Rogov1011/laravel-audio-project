<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'sound_id',
        'user_surname',
        'user_name',
        'email',
        'content'
    ];

    public function sound()
    {
        return $this->belongsTo(Sound::class);
    }
}
