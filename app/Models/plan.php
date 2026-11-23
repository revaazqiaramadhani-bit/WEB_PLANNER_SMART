<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Plan extends Model
{
    use HasFactory;

    // Daftar kolom yang diizinkan untuk diisi dari form
    protected $fillable = [
        'activity_name',
        'target_city',
        'activity_date',
        'status',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
};