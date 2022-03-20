<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function company() {
    return $this->belongsTo(Company::class, 'company_id');
  }

  public function users() {
    return $this->hasMany(User::class, 'division_id');
  }

  public function task() {
    return $this->hasMany(Task::class, 'division_id');
  }
}
