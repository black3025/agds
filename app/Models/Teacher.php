<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  use HasFactory;
  protected $fillable = [
    'teacherID',
    'user_id',
    'is_active'
  ];

  public function user()
  {
    return $this->has(User::class);
  }
}
