@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="text-center mb-3">
        <h5 class="mb-3">{{ $book->title }}</h5>

        <div class="d-inline-flex align-items-center gap-2 bg-white shadow-sm rounded-pill px-3 py-2 mb-2">
            <button onclick="prevPage()" class="btn btn-sm btn-outline-secondary rounded-circle">
                <i class="bi bi-chevron-left"></i>
            </button>

            <input type="number" id="pageJumpInput" value="1" min="1" max="{{ $book->total_pages }}"
                   class="form-control form-control-sm text-center"
                   style="width: 60px;"
                   onkeydown="if(event.key === 'Enter') jumpToPage()">
            <span class="text-muted small">/ {{ $book->total_pages }}</span>

            <button onclick="jumpToPage()" class="btn btn-sm btn-primary">Go</button>

            <button onclick="nextPage()" class="btn btn-sm btn-outline-secondary rounded-circle">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <div class="d-inline-flex align-items-center gap-2 bg-white shadow-sm rounded-pill px-3 py-2 mb-3 ms-2">
            <button onclick="zoomOut()" class="btn btn-sm btn-outline-secondary rounded-circle">
                <i class="bi bi-dash"></i>
            </button>
            <span id="zoomLabel" class="small text-muted" style="width: 45px;">100%</span>
            <button onclick="zoomIn()" class="btn btn-sm btn-outline-secondary rounded-circle">
                <i class="bi bi-plus"></i>
            </button>
            <button onclick="resetZoom()" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-counterclockwise"></i>
            </button>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="bg-white shadow rounded" style="overflow: auto; max-height: 78vh; max-width: 100%;">
            <canvas id="pdfCanvas" class="d-block mx-auto"></canvas>
        </div>
    </div>
</div>

<script>
    const bookId = {{ $book->id }};
    const totalPages = {{ $book->total_pages }};
    let currentPage = 1;
    let scale = 1;
    let currentImage = null;

    function drawCanvas() {
        if (!currentImage) return;
        const canvas = document.getElementById('pdfCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = currentImage.width * scale;
        canvas.height = currentImage.height * scale;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(currentImage, 0, 0, canvas.width, canvas.height);
        document.getElementById('zoomLabel').innerText = Math.round(scale * 100) + '%';
    }

    function renderPage(pageNumber) {
        const img = new Image();
        img.onload = function () {
            currentImage = img;
            drawCanvas();
        };
        img.src = `/books/${bookId}/page/${pageNumber}`;
        document.getElementById('pageJumpInput').value = pageNumber;
    }

    function jumpToPage() {
        const input = document.getElementById('pageJumpInput');
        let target = parseInt(input.value, 10);
        if (isNaN(target)) return;
        target = Math.max(1, Math.min(target, totalPages));
        currentPage = target;
        renderPage(currentPage);
    }

    function nextPage() {
        if (currentPage < totalPages) { currentPage++; renderPage(currentPage); }
    }

    function prevPage() {
        if (currentPage > 1) { currentPage--; renderPage(currentPage); }
    }

    function zoomIn() { scale = Math.min(scale + 0.25, 3); drawCanvas(); }
    function zoomOut() { scale = Math.max(scale - 0.25, 0.25); drawCanvas(); }
    function resetZoom() { scale = 1; drawCanvas(); }

    document.addEventListener('contextmenu', e => e.preventDefault());
    document.addEventListener('keydown', function (e) {
        if (e.ctrlKey && ['s', 'S', 'p', 'P'].includes(e.key)) e.preventDefault();
    });

    renderPage(currentPage);
</script>
@endsection