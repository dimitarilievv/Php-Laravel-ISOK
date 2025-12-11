<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categories;

    public function __construct(CategoryRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }

    public function index(): View
    {
        $categories = $this->categories->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categories->create($request->validated());
        return redirect()->route('categories.index')->with('status', 'Категоријата е креирана.');
    }

    public function show(int $id): View
    {
        $category = $this->categories->find($id);
        $recipes = $this->categories->recipesPaginated($category, 10);
        return view('categories.show', compact('category', 'recipes'));
    }

    public function edit(int $id): View
    {
        $category = $this->categories->find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $category = $this->categories->find($id);
        $this->categories->update($category, $request->validated());
        return redirect()->route('categories.index')->with('status', 'Категоријата е ажурирана.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = $this->categories->find($id);
        $this->categories->delete($category);
        return redirect()->route('categories.index')->with('status', 'Категоријата е избришана.');
    }
}
