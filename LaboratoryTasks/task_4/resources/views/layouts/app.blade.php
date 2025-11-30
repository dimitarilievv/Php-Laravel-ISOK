<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авто-сервис - Управување со сервисирања</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="bg-white border-b">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('services.index') }}" class="font-semibold">Авто-сервис</a>
        </div>
    </nav>

    <main class="px-4">
        @yield('content')
    </main>
</body>
</html>

