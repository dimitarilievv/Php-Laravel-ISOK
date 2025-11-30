@php
    $isEdit = $service && $service->exists;
@endphp

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul class="list-disc pl-6">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Име на механичар</label>
        <input type="text" name="mechanic_first_name" value="{{ old('mechanic_first_name', $service->mechanic_first_name) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Презиме на механичар</label>
        <input type="text" name="mechanic_last_name" value="{{ old('mechanic_last_name', $service->mechanic_last_name) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Име на клиент</label>
        <input type="text" name="client_first_name" value="{{ old('client_first_name', $service->client_first_name) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Презиме на клиент</label>
        <input type="text" name="client_last_name" value="{{ old('client_last_name', $service->client_last_name) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Марка</label>
        <input type="text" name="brand" value="{{ old('brand', $service->brand) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Модел</label>
        <input type="text" name="model" value="{{ old('model', $service->model) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Рег. табличка</label>
        <input type="text" name="licence_number" value="{{ old('licence_number', $service->licence_number) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Цена (ден.)</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $service->price) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Датум на прием</label>
        <input type="date" name="received_at" value="{{ old('received_at', optional($service->received_at)->format('Y-m-d')) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Датум на завршување</label>
        <input type="date" name="finished_at" value="{{ old('finished_at', optional($service->finished_at)->format('Y-m-d')) }}" class="mt-1 w-full border rounded px-3 py-2">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium">Опис</label>
        <textarea name="description" rows="4" class="mt-1 w-full border rounded px-3 py-2" required>{{ old('description', $service->description) }}</textarea>
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ $isEdit ? 'Ажурирај' : 'Зачувај' }}</button>
    <a href="{{ route('services.index') }}" class="text-gray-700">Откажи</a>
</div>

