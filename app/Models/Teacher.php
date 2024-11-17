<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  use HasFactory;
  protected $fillable = ['teacherID', 'user_id', 'is_active', 'mastery'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function ClassSchedules()
  {
    return $this->hasMany(ClassSchedule::class);
  }
}
