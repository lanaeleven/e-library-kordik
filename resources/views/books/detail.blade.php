@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Cover --}}
        <div class="col-md-4">
            <img src="{{ route('book.page', ['book' => $book->id, 'pageNumber' => 1]) }}"
                 class="img-fluid rounded shadow-sm" alt="{{ $book->title }}">
        </div>

        {{-- Detail --}}
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>

            <ul class="list-unstyled text-muted mb-4">
                <li><strong>Jumlah Halaman:</strong> {{ $book->total_pages }}</li>
                @if ($book->author ?? false)
                    <li><strong>Penulis:</strong> {{ $book->author }}</li>
                @endif
                @if ($book->category ?? false)
                    <li><strong>Kategori:</strong> {{ $book->category }}</li>
                    @endif
                <li><strong>Stok buku:</strong> {{ $bookStock }}</li>


            </ul>

            @if ($book->description ?? false)
                <p>{{ $book->description }}</p>
            @endif

            <hr>

            {{-- Status & Tombol Aksi --}}
            @if ($loan)
                <div class="alert alert-info d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Sedang dipinjam</strong><br>
                        <small>Sisa waktu baca: {{ now()->diffForHumans($loan->expires_at, true) }} lagi</small>
                    </div>
                </div>
                <a href="{{ route('book.read', $book->id) }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-book"></i> Baca Sekarang
                </a>
            @else
                @if ($bookStock > 0)
                    <p class="text-muted">Pinjam buku ini untuk mulai membaca. Masa pinjam berlaku 14 hari.</p>
                    <form action="{{ route('book.borrow', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            Pinjam Buku
                        </button>
                    </form>
                @else
                    <p class="text-muted">Anda tidak bisa meminjam buku ini karena stok habis.</p>
                @endif
            @endif
        </div>
    </div>

</div>
@endsection