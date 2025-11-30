@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-4xl">
    <h1 class="text-2xl font-bold mb-4">Ажурирај сервисирање</h1>

    <form action="{{ route('services.update', $service) }}" method="POST" class="bg-white p-4 rounded border">
        @csrf
        @method('PUT')
        @include('services._form', ['service' => $service])
    </form>
</div>
@endsection

