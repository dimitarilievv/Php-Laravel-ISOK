<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .main { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .panel { max-width: 720px; width: 100%; background: #fff; border: 1px solid #e9ecef; border-radius: .75rem; padding: 2rem; }
    </style>
</head>
<body>
    <main class="main">
        <div class="panel text-center">
            <h1 class="h3 mb-3">Recipe Manager</h1>
            <p class="text-muted mb-4">Стандарден, едноставен интерфејс за управување со категории и рецепти.</p>
            <div class="d-flex gap-2 justify-content-center mb-4">
                <a class="btn btn-primary" href="{{ route('categories.index') }}">Категории</a>
                <a class="btn btn-outline-primary" href="{{ route('recipes.index') }}">Рецепти</a>
            </div>
            <div class="row g-3 text-start">
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100">
                        <h2 class="h6 mb-2">Категории</h2>
                        <p class="mb-0 text-muted">Креирање, преглед, измена и бришење на категории. Името е задолжително и уникатно.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100">
                        <h2 class="h6 mb-2">Рецепти</h2>
                        <p class="mb-0 text-muted">Рецепт со наслов, опис, состојки и поврзана категорија.</p>
                    </div>
                </div>
            </div>
            <div class="text-muted mt-4"><small>&copy; {{ date('Y') }} Recipe Manager</small></div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
