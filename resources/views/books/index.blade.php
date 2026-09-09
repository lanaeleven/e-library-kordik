@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0"><i class="bi bi-collection"></i> Koleksi Buku</h3>
        <form action="/" method="get">
            <div class="d-flex">
                <input type="text" class="form-control" name="search" id="search" value="{{  request('search')  }}" placeholder="find by title or author">
                <button type="submit" class="btn btn-sm btn-secondary ms-2"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>

    <div class="row g-3">
        @forelse ($books as $book)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('book.detail', $book->id) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ route('book.page', ['book' => $book->id, 'pageNumber' => 1]) }}"
                             class="card-img-top rounded-top" alt="{{ $book->title }}">
                        <div class="card-body p-2">
                            <p class="card-title mb-0 small fw-semibold text-truncate">{{ $book->title }}</p>
                        </div>
                        <div class="card-body p-2">
                            <p class="card-title mb-0 small fst-italic text-truncate">{{ $book->author }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center">Belum ada buku tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection