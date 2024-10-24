<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'username',
    'email',
    'password',
    'role_id',
    'fname',
    'mname',
    'lname',
    'birthday',
    'is_active',
    'email_verified_at',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  public function role()
  {
    return $this->belongsTo(Role::class);
  }

  public function inquiry()
  {
    return $this->hasMany(Inquiry::class);
  }

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }

  public function enrollment()
  {
    return $this->hasMany(Enrollment::class);
  }
}
