<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Categories;
class ToDos extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id','title',"description","priority","date","filepath","status"
    ];

    public function categorie()
    {
        return $this->belongsTo(Categories::class);
    }
}
