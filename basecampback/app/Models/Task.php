<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function creator() {
    return $this->belongsTo(User::class, 'created_by');
  }
  
  public function assign() {
    return $this->belongsToMany(User::class, 'task_assign', 'task_id', 'assign_to')->withTimestamps();
  }

  public function tags() {
    return $this->belongsToMany(Tag::class, 'task_tag', 'task_id', 'tag_id')->withTimestamps();
  }
}
