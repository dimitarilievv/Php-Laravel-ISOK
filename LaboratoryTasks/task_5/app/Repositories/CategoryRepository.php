<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Category::query()->orderBy('name')->paginate($perPage);
    }

    public function find(int $id): Category
    {
        return Category::query()->findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::query()->create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    public function recipesPaginated(Category $category, int $perPage = 10): LengthAwarePaginator
    {
        return $category->recipes()->latest()->paginate($perPage);
    }
}

