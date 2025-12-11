<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RecipeRepository implements RecipeRepositoryInterface
{
    public function indexPaginated(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = Recipe::query()->with('category')->latest();

        if (!empty($filters['q'])) {
            $search = trim((string) $filters['q']);
            $query->where('title', 'like', "%$search%");
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        return $query->paginate($perPage)->appends($filters);
    }

    public function find(int $id): Recipe
    {
        return Recipe::query()->findOrFail($id);
    }

    public function create(array $data): Recipe
    {
        return Recipe::query()->create($data);
    }

    public function update(Recipe $recipe, array $data): Recipe
    {
        $recipe->update($data);
        return $recipe;
    }

    public function delete(Recipe $recipe): bool
    {
        return $recipe->delete();
    }

    public function categoryOptions(): Collection
    {
        return Category::orderBy('name')->pluck('name', 'id');
    }
}

