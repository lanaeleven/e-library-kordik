<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@isset($pageTitle){{ $pageTitle }} — @endisset RSISA Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f5f6f8; }
        .card-img-top { aspect-ratio: 3 / 4; object-fit: cover; }
        .navbar-brand { font-weight: 600; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <div class="d-flex">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                    <i class="bi bi-book-half"></i> RSISA Library
                </a>
                <a class="btn btn-secondary" href="{{ route('book.myBook') }}">Buku Saya</a>
            </div>

            @auth
                <div class="d-flex align-items-center gap-3 ms-auto">
                    <span class="text-light small">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->nama }}
                    </span>
                    <form action="/logout" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    @isset($routeBack)
        <div class="container mt-3">
            <a href="{{ $routeBack }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    @endisset

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>