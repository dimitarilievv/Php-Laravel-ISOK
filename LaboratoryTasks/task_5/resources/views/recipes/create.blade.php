@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Нов рецепт</h1>
  <form action="{{ route('recipes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Наслов</label>
      <input type="text" name="title" value="{{ old('title') }}" class="form-control">
      @error('title')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Опис (минимум 50 карактери)</label>
      <textarea name="description" rows="6" class="form-control">{{ old('description') }}</textarea>
      @error('description')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Состојки</label>
      <textarea name="ingredients" rows="4" class="form-control">{{ old('ingredients') }}</textarea>
      @error('ingredients')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Категорија</label>
      <select name="category_id" class="form-select">
        <option value="">-- Одберете категорија --</option>
        @foreach ($categories as $id => $name)
          <option value="{{ $id }}" @selected(old('category_id') == $id)>{{ $name }}</option>
        @endforeach
      </select>
      @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Зачувај</button>
    <a href="{{ route('recipes.index') }}" class="btn btn-link">Назад</a>
  </form>
</div>
@endsection

