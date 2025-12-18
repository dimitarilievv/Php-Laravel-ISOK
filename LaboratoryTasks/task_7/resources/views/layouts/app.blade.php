<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <style>
        :root {
            /* Softer, balanced palette */
            --bg: #f1f2f4;         /* warm light grey */
            --panel: #fbfbfc;      /* off-white panel */
            --card: #fbfbfc;
            --text: #2a2f36;       /* neutral dark */
            --muted: #7a818a;      /* muted grey */
            --border: #dddfe3;     /* gentle border */
            --accent: #4f7ddc;     /* muted blue accent */
            --accent-weak: #e9efff;/* very light accent */
            --success: #1f8a4c;    /* toned green */
            --danger: #c23a3a;     /* toned red */
            --shadow: 0 2px 8px rgba(20,24,30,0.06);
            --inset: inset 0 1px 0 rgba(255,255,255,0.35);
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Helvetica, Arial, sans-serif; margin: 0; background: var(--bg); color: var(--text); }
        a { color: var(--accent); text-decoration: none; }
        a:hover { text-decoration: underline; }
        .container { max-width: 960px; margin: 0 auto; padding: 1.25rem; }
        header { background: var(--panel); border-bottom: 1px solid var(--border); box-shadow: var(--shadow); }
        .nav { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .75rem 1.25rem; }
        .brand { font-weight: 700; letter-spacing: .2px; }
        .nav a { margin-right: 1rem; }
        .panel { background: var(--panel); border: 1px solid var(--border); border-radius: 12px; padding: 1rem; box-shadow: var(--shadow); }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1rem; box-shadow: var(--shadow); }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; }
        .mb-3 { margin-bottom: 1rem; }
        .mt-2 { margin-top: .5rem; }
        .mt-3 { margin-top: 1rem; }
        .mt-4 { margin-top: 1.5rem; }
        .badge { display: inline-block; padding: .15rem .5rem; border-radius: 999px; border: 1px solid var(--border); font-size: .8rem; color: var(--muted); background: #f6f7f9; box-shadow: var(--inset); }
        .btn { display: inline-block; padding: .5rem .9rem; border-radius: 8px; border: 1px solid var(--border); background: #f6f7f9; color: var(--text); cursor: pointer; box-shadow: var(--inset); }
        .btn:hover { background: #eef0f3; }
        .btn-primary { background: var(--accent-weak); border-color: #d7e1fb; color: var(--accent); font-weight: 600; }
        .btn-success { background: #e8f6ef; border-color: #d3efe0; color: var(--success); font-weight: 600; }
        .btn-danger { background: #f9eaea; border-color: #f2d6d6; color: var(--danger); font-weight: 600; }
        .btn-muted { background: #f6f7f9; color: var(--muted); }
        form .field { margin-bottom: .9rem; }
        label { display: block; margin-bottom: .35rem; color: var(--muted); font-size: .9rem; }
        input[type=text], input[type=number], select, textarea { width: 100%; padding: .6rem .7rem; border-radius: 8px; border: 1px solid var(--border); background: #ffffff; color: var(--text); box-shadow: inset 0 1px 0 rgba(255,255,255,0.3); }
        textarea { min-height: 120px; }
        .list { list-style: none; margin: 0; padding: 0; }
        .list li { padding: .8rem; border-radius: 12px; border: 1px solid var(--border); background: var(--card); margin-bottom: .75rem; box-shadow: var(--shadow); }
        .status { font-weight: 600; color: var(--muted); }
        .muted { color: var(--muted); }
        .actions { display: inline-flex; gap: .5rem; }
        .alert { background:#e8f6ef; border:1px solid #d3efe0; padding:.75rem 1rem; margin:1rem auto; border-radius: 8px; color:#1f4b36; box-shadow: var(--inset); }
    </style>
</head>
<body>
<header>
    <div class="nav">
        <div class="brand"><a href="{{ route('home') }}" style="color:inherit; text-decoration:none;">CourseHub</a></div>
        <nav>
            <a href="{{ route('courses.index') }}">All Courses</a>
            <a href="{{ route('courses.create') }}">Create Course</a>
        </nav>
    </div>
</header>
<main class="container">
    @if(session('status'))
        <div class="alert">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>

