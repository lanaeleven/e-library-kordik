@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0 mt-5">
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input name="title" type="text" class="form-control" id="title" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Penulis</label>
                            <input name="author" type="text" class="form-control" id="author">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" name="category" id="category">
                                <option value="">Pilih kategori</option>
                                @foreach (\App\Enums\Category::all() as $value => $name)
                                    <option value="{{ $value }}">
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="totalPages" class="form-label">Total Halaman</label>
                            <input name="totalPages" type="number" class="form-control" id="totalPages">
                        </div>
                        <div class="mb-3">
                            <label for="bookFile" class="form-label">Upload Buku    </label>
                            <input name="bookFile" class="form-control @error('bookFile') is-invalid @enderror"
                                type="file" id="bookFile" required>
                            @error('bookFile')
                                <div id="bookFile" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-floppy2-fill"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection