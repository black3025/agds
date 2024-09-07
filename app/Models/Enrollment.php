<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
  use HasFactory;

  protected $fillable = ['referenceNo', 'user_id', 'ClassSchedule_id', 'verified', 'status'];

  public function ClassSchedule()
  {
    return $this->has(ClassSchedule::class);
  }

  public function User()
  {
    return $this->belongsTo(User::class);
  }
}
