@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('categories.index') }}" class="btn btn-link">Назад</a>
    <h1>Категорија: {{ $category->name }}</h1>

  <h2 class="mt-4">Рецепти во оваа категорија</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Наслов</th>
        <th>Акции</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($recipes as $recipe)
        <tr>
          <td>{{ $recipe->id }}</td>
          <td><a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a></td>
          <td>
            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-sm btn-secondary">Измени</a>
            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display:inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Дали сте сигурни?')">Избриши</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="3">Нема рецепти.</td></tr>
      @endforelse
    </tbody>
  </table>
  {{ $recipes->links() }}
</div>
@endsection

