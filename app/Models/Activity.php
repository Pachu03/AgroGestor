<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_activity',
        'description',
        'start_date',
        'end_date',
        'state_activity',
        'worker_user_id',
        'boss_user_id',
    ];

    public function isDelayed()
{
    return now()->greaterThan($this->end_date);
}
}
