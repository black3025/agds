<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

  public function User()
  {
    return $this->belongsTo(User::class);
  }
  public function Reply()
  {
    return $this->hasMany(Reply::class);
  }
}
