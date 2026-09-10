@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ route('book.page', ['book' => $book->id, 'pageNumber' => 1]) }}"
                     class="img-fluid rounded-start h-100 w-100" style="object-fit: cover;" alt="{{ $book->title }}">
            </div>

            <div class="col-md-8">
                <div class="card-body p-4">
                    <h2 class="fw-bold">{{ $book->title }}</h2>

                    <ul class="list-unstyled text-muted mb-3">
                        <li><i class="bi bi-file-earmark-text"></i> {{ $book->total_pages }} halaman</li>
                        @if ($book->author ?? false)
                            <li><i class="bi bi-person"></i> {{ $book->author }}</li>
                        @endif
                        @if ($book->category ?? false)
                            <li><i class="bi bi-tag"></i> {{ \App\Enums\Category::name($book->category) }}</li>
                        @endif
                        @if (!$loan)
                        <li>
                            <i class="bi bi-stack"></i> Stok:
                            <span class="badge {{ $bookStock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $bookStock > 0 ? $bookStock . ' tersedia' : 'Habis' }}
                            </span>
                        </li>
                        @endif
                    </ul>

                    @if ($book->description ?? false)
                        <p class="text-secondary">{{ $book->description }}</p>
                    @endif

                    <hr>

                    @if ($loan)
                        <div class="alert alert-info d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-clock-history fs-4"></i>
                            <div>
                                <strong>Sedang kamu pinjam</strong><br>
                                <small>Sisa waktu baca: {{ now()->diffInDays($loan->expires_at, true) }} hari lagi</small>
                            </div>
                        </div>
                        <a href="{{ route('book.read', $book->id) }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-book"></i> Baca Sekarang
                        </a>
                    @else
                        @if ($bookStock > 0 && $canBorrow)
                            <p class="text-muted small">Masa pinjam berlaku 14 hari sejak buku dipinjam.</p>
                            <form action="{{ route('book.borrow', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-bookmark-plus"></i> Pinjam Buku
                                </button>
                            </form>
                        @elseif ($bookStock < 1)
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="bi bi-x-circle"></i> Stok Habis
                            </button>
                        @elseif (!$canBorrow)
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="bi bi-x-circle"></i> Kuota Peminjaman Habis
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection