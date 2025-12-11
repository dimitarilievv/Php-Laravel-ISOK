<?php

namespace App\Observers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Log;

class RecipeObserver
{
    public function creating(Recipe $recipe): void
    {
        Log::info('Creating Recipe', ['title' => $recipe->title]);
    }

    public function created(Recipe $recipe): void
    {
        Log::info('Created Recipe', ['id' => $recipe->id, 'title' => $recipe->title]);
    }

    public function updating(Recipe $recipe): void
    {
        Log::info('Updating Recipe', ['id' => $recipe->id]);
    }

    public function updated(Recipe $recipe): void
    {
        Log::info('Updated Recipe', ['id' => $recipe->id]);
    }

    public function deleting(Recipe $recipe): void
    {
        Log::info('Deleting Recipe', ['id' => $recipe->id]);
    }

    public function deleted(Recipe $recipe): void
    {
        Log::info('Deleted Recipe', ['id' => $recipe->id]);
    }
}

