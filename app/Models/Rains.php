<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rains extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'quanti_MM',
        'localiti',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
