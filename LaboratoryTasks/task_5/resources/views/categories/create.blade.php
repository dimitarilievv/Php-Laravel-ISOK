@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Нова категорија</h1>
  <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Име</label>
      <input type="text" name="name" value="{{ old('name') }}" class="form-control">
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Зачувај</button>
    <a href="{{ route('categories.index') }}" class="btn btn-link">Назад</a>
  </form>
</div>
@endsection

