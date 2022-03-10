<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  use HasFactory;

  public function division() {
    return $this->hasMany(Division::class, 'company_id');
  }

  public function users() {
    return $this->hasMany(User::class, 'company_id');
  }
}
