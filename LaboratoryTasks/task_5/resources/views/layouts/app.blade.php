<!doctype html>
<html lang="mk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Рецепти</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Лаб 5</a>
      <div>
        <a class="nav-link d-inline text-white" href="{{ route('categories.index') }}">Категории</a>
        <a class="nav-link d-inline text-white" href="{{ route('recipes.index') }}">Рецепти</a>
      </div>
    </div>
  </nav>
  @yield('content')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

