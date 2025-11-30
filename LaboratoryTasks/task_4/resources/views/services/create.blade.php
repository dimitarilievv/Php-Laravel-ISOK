@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-4xl">
    <h1 class="text-2xl font-bold mb-4">Додади сервисирање</h1>

    <form action="{{ route('services.store') }}" method="POST" class="bg-white p-4 rounded border">
        @csrf
        @include('services._form', ['service' => $service])
    </form>
</div>
@endsection

