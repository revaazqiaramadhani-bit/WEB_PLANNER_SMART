<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // Satu kategori punya banyak plans (One to Many)
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}

