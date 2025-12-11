<?php

namespace App\Models;

use App\Observers\RecipeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(RecipeObserver::class)]
class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'ingredients', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

