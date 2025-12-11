<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Repositories\RecipeRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    protected RecipeRepositoryInterface $recipes;

    public function __construct(RecipeRepositoryInterface $recipes)
    {
        $this->recipes = $recipes;
    }

    public function index(Request $request): View
    {
        $filters = $request->only(['q', 'category_id']);
        $recipes = $this->recipes->indexPaginated($filters, 10);
        $categories = $this->recipes->categoryOptions();
        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create(): View
    {
        $categories = $this->recipes->categoryOptions();
        return view('recipes.create', compact('categories'));
    }

    public function store(RecipeRequest $request): RedirectResponse
    {
        $this->recipes->create($request->validated());
        return redirect()->route('recipes.index')->with('status', 'Рецептот е креиран.');
    }

    public function show(int $id): View
    {
        $recipe = $this->recipes->find($id);
        return view('recipes.show', compact('recipe'));
    }

    public function edit(int $id): View
    {
        $recipe = $this->recipes->find($id);
        $categories = $this->recipes->categoryOptions();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(RecipeRequest $request, int $id): RedirectResponse
    {
        $recipe = $this->recipes->find($id);
        $this->recipes->update($recipe, $request->validated());
        return redirect()->route('recipes.index')->with('status', 'Рецептот е ажуриран.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $recipe = $this->recipes->find($id);
        $this->recipes->delete($recipe);
        return redirect()->route('recipes.index')->with('status', 'Рецептот е избришан.');
    }
}
