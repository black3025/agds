<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
  use HasFactory;
  
  protected $fillable = [
    'user_id',
    'course_id',
    'category_id',
    'day_start',
    'day_end',
    'time_start',
    'time_end',
  ];

  public function course()
  {
    return $this->belongsTo(Course::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  
  public function teacher()
  {
    return $this->belongsTo(Enrollment::class);
  }

  public function enrollment()
  {
    return $this->hasMany(Enrollment::class);
  }
}
