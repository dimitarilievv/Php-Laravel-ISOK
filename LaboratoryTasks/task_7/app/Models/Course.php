<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'difficulty_level',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function feedbacks(): HasMany
    {
        return $this->hasMany(\App\Models\Feedback::class);
    }
}
