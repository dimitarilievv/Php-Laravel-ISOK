@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Рецепти</h1>
  <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Нов рецепт</a>
  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <form method="GET" action="{{ route('recipes.index') }}" class="row g-2 mb-3">
    <div>
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Пребарај по наслов...">
    <div>
      <select name="category_id">
        <option value="">Сите категории</option>
        @foreach ($categories as $id => $name)
          <option value="{{ $id }}" {{ (string)$id === (string)request('category_id') ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
      </select>
    </div>
    </div>
    <div class="col-md-2">
      <button type="submit">Филтрирај</button>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Наслов</th>
        <th>Категорија</th>
        <th>Дејства</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($recipes as $recipe)
        <tr>
          <td>{{ $recipe->id }}</td>
          <td><a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a></td>
          <td>{{ $recipe->category?->name }}</td>
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
        <tr>
          <td colspan="4" class="text-center text-muted">Нема резултати според критериумите.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  @include('layouts.pagination', ['paginator' => $recipes])
</div>
@endsection
