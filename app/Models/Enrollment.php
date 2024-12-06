<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Enrollment extends Model
{
  use HasFactory, Notifiable;

  protected $fillable = ['referenceNo', 'user_id', 'class_schedule_id', 'verified', 'status', 'amount'];

  public function ClassSchedule()
  {
    return $this->belongsTo(ClassSchedule::class);
  }

  public function User()
  {
    return $this->belongsTo(User::class);
  }
}
