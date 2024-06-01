<?php

namespace App\Models;

use Collator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function harvests()
    {
        return $this->hasMany(Collection::class);
    }
}
