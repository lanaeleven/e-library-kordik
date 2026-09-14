@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div class="d-flex align-items-center gap-2">
            <h3 class="mb-0"><i class="bi bi-collection"></i> Koleksi Buku</h3>
            @auth
                @if(auth()->user()->username === 'administrator')
                    <a class="btn btn-success btn-sm" href="{{ route('book.create') }}">
                        <i class="bi bi-plus-lg"></i> Tambah buku
                    </a>
                @endif
            @endauth
        </div>

        <form action="/" method="get" class="d-flex" role="search">
            <div class="input-group input-group-sm" style="min-width: 260px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" name="search" id="search"
                       value="{{ request('search') }}" placeholder="Cari judul atau penulis">
                @if(request('search'))
                    <a href="/" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if(request('search'))
        <p class="text-muted small mb-3">
            Menampilkan hasil untuk "<strong>{{ request('search') }}</strong>" — {{ $books->count() }} buku ditemukan
        </p>
    @endif

    <div class="row g-3">
        @forelse ($books as $book)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('book.detail', $book->id) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0 book-card">
                        <img src="{{ route('book.page', ['book' => $book->id, 'pageNumber' => 1]) }}"
                             class="card-img-top rounded-top" alt="{{ $book->title }}" loading="lazy">
                        <div class="card-body p-2 pb-1">
                            <p class="card-title mb-1 small fw-semibold text-truncate" title="{{ $book->title }}">
                                {{ $book->title }}
                            </p>
                            <p class="card-text mb-0 small text-muted fst-italic text-truncate" title="{{ $book->author }}">
                                <i class="bi bi-person"></i> {{ $book->author }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center text-muted py-5">
                    <i class="bi bi-inbox display-4"></i>
                    <p class="mt-2 mb-0">
                        @if(request('search'))
                            Tidak ada buku yang cocok dengan pencarian "{{ request('search') }}".
                        @else
                            Belum ada buku tersedia.
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .book-card {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .book-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.1) !important;
    }
</style>
@endsection