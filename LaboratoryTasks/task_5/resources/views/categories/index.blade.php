@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Категории</h1>
  <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Нова категорија</a>
  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Име</th>
        <th>Акции</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></td>
          <td>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-secondary">Измени</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Дали сте сигурни?')">Избриши</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @include('layouts.pagination', ['paginator' => $categories])
</div>
@endsection
