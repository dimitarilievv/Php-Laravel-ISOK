@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $recipe->title }}</h1>
  <p><strong>Категорија:</strong> {{ $recipe->category?->name }}</p>
  <h3>Опис</h3>
  <p>{{ $recipe->description }}</p>
  <h3>Состојки</h3>
  <p>{{ $recipe->ingredients }}</p>
  <a href="{{ route('recipes.index') }}" class="btn btn-link">Назад</a>
</div>
@endsection

