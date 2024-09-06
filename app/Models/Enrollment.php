<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
  use HasFactory;

  protected $fillable = ['referenceNo', 'user_id', 'ClassSchedule_id', 'verified', 'status'];

  public function User()
  {
    return $this->belongsTo(User::class);
  }
}
