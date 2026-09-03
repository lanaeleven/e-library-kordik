{{-- resources/views/books/read.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h4>{{ $book->title }}</h4>

    <div style="margin-bottom: 10px;">
        <button onclick="prevPage()" class="btn btn-secondary">‹ Prev</button>

        <span id="pageInfo">
            Halaman
            <input
                type="number"
                id="pageJumpInput"
                value="1"
                min="1"
                max="{{ $book->total_pages }}"
                style="width: 70px; text-align: center;"
                onkeydown="if(event.key === 'Enter') jumpToPage()"
            >
            / {{ $book->total_pages }}
        </span>

        <button onclick="jumpToPage()" class="btn btn-primary btn-sm">Go</button>
        <button onclick="nextPage()" class="btn btn-secondary">Next ›</button>
    </div>

    <div style="margin-bottom: 10px;">
        <button onclick="zoomOut()" class="btn btn-outline-secondary">− Zoom Out</button>
        <span id="zoomLabel">100%</span>
        <button onclick="zoomIn()" class="btn btn-outline-secondary">+ Zoom In</button>
        <button onclick="resetZoom()" class="btn btn-outline-secondary">Reset</button>
    </div>

    <div style="overflow: auto; max-height: 80vh; border: 1px solid #ddd; display: inline-block;">
        <canvas id="pdfCanvas"></canvas>
    </div>
</div>

<script>
    const bookId = {{ $book->id }};
    const totalPages = {{ $book->total_pages }};
    let currentPage = 1;
    let scale = 1; // 1 = 100%
    let currentImage = null; // simpan gambar yang sedang di-load, supaya zoom tidak perlu fetch ulang

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

        // batasi supaya tidak keluar range halaman
        target = Math.max(1, Math.min(target, totalPages));

        currentPage = target;
        renderPage(currentPage);
    }

    function nextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            renderPage(currentPage);
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            renderPage(currentPage);
        }
    }

    function zoomIn() {
        scale = Math.min(scale + 0.25, 3); // maksimal 300%
        drawCanvas();
    }

    function zoomOut() {
        scale = Math.max(scale - 0.25, 0.25); // minimal 25%
        drawCanvas();
    }

    function resetZoom() {
        scale = 1;
        drawCanvas();
    }

    // blokir klik kanan & shortcut save/print
    document.addEventListener('contextmenu', e => e.preventDefault());
    document.addEventListener('keydown', function (e) {
        if (e.ctrlKey && ['s', 'S', 'p', 'P'].includes(e.key)) {
            e.preventDefault();
        }
    });

    renderPage(currentPage);
</script>
@endsection