@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-5">

                    <div class="mb-4">
                        <span class="display-1 fw-bold text-danger">
                            403
                        </span>
                    </div>

                    <h3 class="fw-semibold mb-3">
                        Akses Ditolak
                    </h3>

                    <p class="text-muted mb-4">
                        Maaf, Anda tidak memiliki izin untuk mengakses
                        halaman ini.
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-primary px-4">
                        Kembali ke Beranda
                    </a>

                </div>
            </div>

            <p class="text-center text-muted small mt-3">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </p>

        </div>
    </div>
</div>
@endsection