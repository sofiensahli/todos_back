<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Categories;
class utilis extends Model
{
    use HasFactory;
    protected $fillable = [
        'username', 'password',"categories"
    ];
    public function categories()
    {
        return $this->hasMany(Categories::class);
    }

}
