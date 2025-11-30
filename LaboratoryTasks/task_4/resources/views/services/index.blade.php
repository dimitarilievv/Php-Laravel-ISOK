@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Сервисирања</h1>
            <a href="{{ route('services.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Додади
                сервисирање</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 border">#</th>
                    <th class="px-3 py-2 border">Механичар</th>
                    <th class="px-3 py-2 border">Клиент</th>
                    <th class="px-3 py-2 border">Марка</th>
                    <th class="px-3 py-2 border">Модел</th>
                    <th class="px-3 py-2 border">Табличка</th>
                    <th class="px-3 py-2 border">Опис</th>
                    <th class="px-3 py-2 border">Цена</th>
                    <th class="px-3 py-2 border">Примено</th>
                    <th class="px-3 py-2 border">Завршено</th>
                    <th class="px-3 py-2 border">Акции</th>
                </tr>
                </thead>
                <tbody>
                @forelse($services as $service)
                    <tr>
                        <td class="px-3 py-2 border">{{ $service->id }}</td>
                        <td class="px-3 py-2 border">{{ $service->mechanicFullName() }}</td>
                        <td class="px-3 py-2 border">{{ $service->clientFullName() }}</td>
                        <td class="px-3 py-2 border">{{ $service->brand }}</td>
                        <td class="px-3 py-2 border">{{ $service->model }}</td>
                        <td class="px-3 py-2 border">{{ $service->licence_number }}</td>
                        <td class="px-3 py-2 border">{{ \Illuminate\Support\Str::limit($service->description, 60) }}</td>
                        <td class="px-3 py-2 border">{{ number_format($service->price, 2) }} ден.</td>
                        <td class="px-3 py-2 border">{{ $service->received_at?->format('Y-m-d') }}</td>
                        <td class="px-3 py-2 border">{{ optional($service->finished_at)->format('Y-m-d') }}</td>
                        <td class="px-3 py-2 border">
                            <a href="{{ route('services.edit', $service) }}" class="text-blue-600">Ажурирај</a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2"
                                        onclick="return confirm('Дали сте сигурни?')">Избриши
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-3 py-4 text-center">Нема внесени сервисирања.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="4">Вкупен број на сервисирања: </td>
                    <td colspan="2">{{ $services->count() }}</td>
                </tr>
                <tr>
                    <td colspan="4">Вкупна заработка: </td>
                    <td colspan="2">{{ number_format($services->sum('price'), 2) }} ден.</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
