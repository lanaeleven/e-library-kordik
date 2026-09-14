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
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <i class="bi bi-book-half"></i> RSISA Library
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('book.myBook') ? 'active fw-semibold' : '' }}"
                        href="{{ route('book.myBook') }}">
                            <i class="bi bi-journal-bookmark me-1"></i> Buku Saya
                        </a>
                    </li>
                </ul>

                @auth
                    <div class="d-flex align-items-center gap-3">
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