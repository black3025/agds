<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_schedule_id',
        'start_time',
        'finish_time',
        'comments',
        'client_id',
    ];
}
