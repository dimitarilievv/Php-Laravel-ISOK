<?php

namespace App\Repositories;

use App\Models\Recipe;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RecipeRepositoryInterface
{
    public function indexPaginated(array $filters, int $perPage = 10): LengthAwarePaginator;

    public function find(int $id): Recipe;

    public function create(array $data): Recipe;

    public function update(Recipe $recipe, array $data): Recipe;

    public function delete(Recipe $recipe): bool;

    public function categoryOptions(): Collection;
}

