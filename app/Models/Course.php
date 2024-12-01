<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'description', 'image_display', 'is_active'];

  public function ClassSchedule()
  {
    return $this->hasMany(ClassSchedule::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}
