<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryObserver
{
    public function creating(Category $category): void
    {
        Log::info('Creating Category', ['name' => $category->name]);
    }

    public function created(Category $category): void
    {
        Log::info('Created Category', ['id' => $category->id, 'name' => $category->name]);
    }

    public function updating(Category $category): void
    {
        Log::info('Updating Category', ['id' => $category->id]);
    }

    public function updated(Category $category): void
    {
        Log::info('Updated Category', ['id' => $category->id]);
    }

    public function deleting(Category $category): void
    {
        Log::info('Deleting Category', ['id' => $category->id]);
    }

    public function deleted(Category $category): void
    {
        Log::info('Deleted Category', ['id' => $category->id]);
    }
}

