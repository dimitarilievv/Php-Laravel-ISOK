<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Recipe::query()->with('category')->latest();

        if ($search = trim((string) $request->query('q'))) {
            $query->where('title', 'like', "%$search%");
        }

        if ($categoryId = $request->query('category_id')) {
            $query->where('category_id', $categoryId);
        }

        $recipes = $query->paginate(10)->appends($request->query());
        $categories = Category::orderBy('name')->pluck('name', 'id');

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('recipes.create', compact('categories'));
    }

    public function store(RecipeRequest $request): RedirectResponse
    {
        Recipe::create($request->validated());
        return redirect()->route('recipes.index')->with('status', 'Рецептот е креиран.');
    }

    public function show(Recipe $recipe): View
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe): View
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(RecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        $recipe->update($request->validated());
        return redirect()->route('recipes.index')->with('status', 'Рецептот е ажуриран.');
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('status', 'Рецептот е избришан.');
    }
}
