@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row g-3">
            @foreach ($books as $book)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="card h-100">
                        <img src="{{ route('book.page', ['book' => $book->id, 'pageNumber' => 1]) }}"
                            class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ $book->title }}</h6>
                            <a href="{{ route('book.read', $book->id) }}" class="btn btn-sm btn-primary w-100">Baca</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection