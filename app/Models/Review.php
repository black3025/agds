<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  use HasFactory;
  protected $fillable = ['class_schedule_id', 'user_id', 'star_rating', 'comments', 'is_private'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function ClassSchedule()
  {
    return $this->belongsTo(ClassSchedule::class);
  }
}
