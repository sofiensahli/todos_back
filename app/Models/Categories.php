<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ToDos; 
use utilis; 
class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','utilis_id'
    ];

    public function todos()
    {
        return $this->hasMany(ToDos::class);
    }

    public function utils()
    {
        return $this->belongsTo(utilis::class);
    }
}
