<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id', 'admin_id','status','assign_by','isActive'];
    // Task.php
public function user()
{
    return $this->belongsTo(User::class);
}
public function users()
{
    return $this->belongsToMany(User::class);
}

   
}
