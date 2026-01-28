@extends('user.base')

@section('header')
    <meta name="description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="keyword" content="{{ $data && $data->type ? $data->type->name : '' }}">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="og:title" content="{{ $data ? $data->address : '' }}">
@endsection

@section('morecss')
    {{-- CSS khusus widget Auto Mockup Baliho --}}
    <style>
        /* Shell & card */
        .mockup-shell {
            max-width: 1100px;
            margin: 24px auto 64px;
            padding: 0 1rem;
            position: relative; /* Ditambahkan untuk positioning Onboarding */
        }

        .mockup-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.10);
            overflow: hidden;
        }

        /* Toolbar atas */
        .mockup-toolbar {
            padding: 14px 20px;
            background: linear-gradient(180deg, #f9fafb, #eff6ff);
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .toolbar-header {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .toolbar-title {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            color: #1d4ed8;
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .toolbar-title .material-symbols-outlined {
            font-size: 22px;
        }

        .toolbar-actions {
            margin-top: 4px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
        }

        /* Tombol */
        .btn-lgx {
            padding: .55rem 1.1rem;
            font-size: .85rem;
            font-weight: 600;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .btn-lgx .material-symbols-outlined {
            font-size: 18px;
        }

        /* Stage / area canvas */
        .mockup-stage {
            background: #f3f4f6;
            padding: 1.25rem 1.25rem 1.5rem;
        }

        .canvas-wrap {
            position: relative;
            width: 100%;
            max-height: 70vh;
            background: #0f172a;
            border-radius: 16px;
            overflow: hidden;
        }

        /* KEDUA canvas harus saling menimpa (overlay) */
        .canvas-wrap canvas {
            position: absolute;
            inset: 0;
            /* top:0; right:0; bottom:0; left:0 */
            width: 100%;
            height: 100%;
            display: block;
        }

        /* base di bawah, design di atas */
        #baseCanvas {
            z-index: 1;
        }

        #designCanvas {
            z-index: 2;
        }


        /* Hint di tengah SEBELUMNYA – sekarang kita hilangkan saja */
        .hint {
            display: none;
        }

        /* Titik merah (handle) */
        .handle {
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 999px;
            border: 2px solid #ffffff;
            background: #ef4444;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.35);
            cursor: grab;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .handle:hover {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.45);
        }

        .handle:active {
            cursor: grabbing;
            transform: translate(-50%, -50%) scale(0.95);
        }
        
        /* --- [BARU] Gaya Onboarding Manual --- */
        #onboarding-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: 999;
            display: none; /* Dihide by default */
            border-radius: 18px; /* Samakan dengan .mockup-card */
            overflow: hidden;
        }

        .onboarding-step {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 380px;
        }

        .onboarding-content {
            background: #fff;
            border-radius: 12px;
            padding: 20px 24px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .onboarding-content h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1d4ed8;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .onboarding-content p {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #333;
            margin-bottom: 20px;
        }
        .onboarding-content p strong {
            color: #ef4444; /* Merah */
        }
        .onboarding-content p strong.blue {
            color: #1d4ed8; /* Biru */
        }
        /* --- Akhir Gaya Onboarding --- */

        /* ================================ */
        /* [MODIFIKASI] Gaya Zoom Preview Box     */
        /* ================================ */
        .zoom-preview-box {
            display: none; 
            position: absolute; /* <-- DIUBAH DARI fixed */
            width: 150px;
            height: 150px;
            border: 3px solid #ef4444; 
            border-radius: 8px;
            background: #000;
            overflow: hidden;
            z-index: 20; /* <-- DIUBAH (di atas handle 10) */
            box-shadow: 0 5px 15px rgba(0,0,0,0.4);
            pointer-events: none; /* <-- Penting agar tidak menghalangi drag */
            image-rendering: pixelated; 
        }
        .zoom-preview-box canvas {
            width: 100%;
            height: 100%;
            display: block;
        }
        /* ================================ */
        /* AKHIR GAYA ZOOM PREVIEW     */
        /* ================================ */


        /* Responsif */
        @media (max-width: 768px) {
            .mockup-shell {
                margin: 16px auto 40px;
            }

            .mockup-card {
                border-radius: 14px;
            }
            
            #onboarding-overlay {
                border-radius: 14px;
            }

            .mockup-toolbar {
                padding: 12px 14px;
            }

            .mockup-stage {
                padding: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/titikseluruhindonesia.png') }}" />
        </div>

        <div class="detail-titik">
            <div class="detailtitik-content">
                <div class="detailtitik-wrapper">
                    {{-- FOTO UTAMA / STREET VIEW --}}
                    <img id="mainPhoto" src="{{ $data ? $dom . $data->image2 : '' }}" />

                    {{-- ROW TOMBOL (hanya kalau $data ada) --}}
                    @if ($data)
                        <div class="row mb-5">
                            <div class="col">
                                <button id="addToCartButton" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    class="btn btn-primary d-flex align-items-center justify-content-center">
                                    <span>Read More</span>
                                </button>
                            </div>

                            <div class="col">
                                <button id="addToCartButton"
                                    onclick="addToCart({{ $data->id }}, '{{ $data->address }}', '{{ $data->slug }}')"
                                    class="btn btn-secondary d-flex align-items-center justify-content-center">
                                    <i class="material-symbols-outlined me-3">shopping_cart</i>
                                    <span>{{ trans('messages.masukan_keranjang') }}</span>
                                </button>
                            </div>

                            <div class="col">
                                <a id="addToCartButton" href="{{ url(app()->getLocale() . '/titik-kami') }}"
                                    class="btn btn-third d-flex align-items-center justify-content-center">
                                    <span>{{ trans('messages.lihat_titik_lain') }}</span>
                                </a>
                            </div>

                            <div class="col">
                                <button id="btnCobaMockup" type="button"
                                    class="btn d-flex align-items-center justify-content-center w-100"
                                    style="background-color:#168a5a;color:#fff;border:none;border-radius:8px;padding:13px 0;">
                                    <span class="material-symbols-outlined me-2"
                                        style="color:#fff;font-size:20px;line-height:1;">image</span>
                                    <span>{{ trans('messages.coba_mockup') }}</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- =========================
                         WIDGET AUTO MOCKUP BALIHO
                         ========================= --}}
                    <div id="mockup-baliho-widget" class="mt-4">
                        <div class="detailtitik-content">
                            <div class="detailtitik-wrapper">
                                <div class="mockup-shell">
                                
                                    {{-- [BARU] HTML UNTUK ONBOARDING --}}
                                    <div id="onboarding-overlay" style="display: none;">
                                        <div id="onboarding-step-1" class="onboarding-step">
                                            <div class="onboarding-content">
                                                <h3>Mode Manual</h3>
                                                <p>Silakan geser <strong>4 titik merah</strong> ke setiap sudut baliho di gambar.</p>
                                                <button id="onboarding-next" class="btn btn-primary btn-sm">Mengerti</button>
                                            </div>
                                        </div>
                                        <div id="onboarding-step-2" class="onboarding-step" style="display: none;">
                                            <div class="onboarding-content">
                                                <h3>Langkah Terakhir</h3>
                                                <p>Setelah 4 titik pas, klik tombol <strong class="blue">"Auto Mockup"</strong> untuk menerapkan desain Anda.</p>
                                                <button id="onboarding-done" class="btn btn-success btn-sm">Selesai</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- AKHIR HTML ONBOARDING --}}
                                
                                    {{-- [CATATAN] Kotak Zoom dipindah ke dalam .canvas-wrap di bawah --}}

                                    <div class="mockup-card">
                                        <div class="mockup-toolbar">
                                            <div class="toolbar-header">
                                                <div class="toolbar-title">
                                                    <span class="material-symbols-outlined">image</span>
                                                    <span>AUTO MOCKUP BALIHO</span>
                                                </div>
                                            </div>

                                            <div class="toolbar-actions">
                                                <label class="btn btn-outline-secondary btn-lgx">
                                                    <span class="material-symbols-outlined me-1">upload</span> Upload Desain
                                                    <input id="designInput" type="file"
                                                        accept="image/png,image/jpeg,image/webp" class="d-none">
                                                </label>

                                                <button id="redetectBtn" class="btn btn-outline-primary btn-lgx" disabled>
                                                    <span class="material-symbols-outlined me-1">auto_fix_high</span> Auto
                                                    Mockup
                                                </button>

                                                <button id="downloadBtn" class="btn btn-success btn-lgx"
                                                    style="display:none;">
                                                    <span class="material-symbols-outlined me-1">download</span> Download HD
                                                    Preview
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mockup-stage">
                                            <div class="canvas-wrap" id="canvasWrap">
                                                {{-- hint dihapus --}}
                                                <canvas id="baseCanvas"></canvas>
                                                <canvas id="designCanvas"></canvas>

                                                <div class="handle" id="h0" title="Sudut 1"></div>
                                                <div class="handle" id="h1" title="Sudut 2"></div>
                                                <div class="handle" id="h2" title="Sudut 3"></div>
                                                <div class="handle" id="h3" title="Sudut 4"></div>
                                                
                                                <div id="zoomPreview" class="zoom-preview-box">
                                                    <canvas id="zoomCanvasPreview" width="150" height="150"></canvas>
                                                </div>
                                                </div>
                                        </div>
                                        </div>

                                        {{-- TOMBOL KEMBALI --}}
                                        <div class="d-flex justify-content-center mt-3 pt-3 border-top">
                                            <button onclick="window.history.back()" class="btn btn-link text-decoration-none text-secondary d-flex align-items-center">
                                                <span class="material-symbols-outlined me-1 fs-5">arrow_back</span>
                                                <span class="fw-bold">Kembali</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    {{-- ====== AKHIR WIDGET ====== --}}

                    {{-- DETAIL TITIK (collapse) – hanya kalau $data ada --}}
                    @if ($data)
                        <div class="collapse" id="collapseExample">
                            <p class="title mb-3 ">
                                {{ trans('messages.sewa') }} {{ $data->type->name }}
                                {{ ucfirst(strtolower(trim(str_replace(['KOTA ', 'KABUPATEN '], '', $data->city->name)))) }}
                                <br> {{ $data->address }}
                            </p>

                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">location_on</span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.lokasi_titik') }}</p>
                                                <p class="content-part">{{ $data->location }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">location_city</span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.kota') }}</p>
                                                <p class="content-part">{{ $data->city->name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">area_chart</span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.provinsi') }}</p>
                                                <p class="content-part">{{ $data->city->province->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded position-relative">
                                    <div class="w-100 d-flex justify-content-start pt-3 mb-3">
                                        <span class="spesifikasi">{{ trans('messages.spesifikasi') }}</span>
                                    </div>

                                    <div class="row p-3">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="info">
                                                <span class="material-symbols-outlined">mms</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.type_media') }}</p>
                                                    <p class="content-part">{{ $data->type->name }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="info">
                                                <span class="material-symbols-outlined">output_circle</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.sisi') }}</p>
                                                    <p class="content-part">{{ $data->side }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="info">
                                                <span class="material-symbols-outlined">decimal_increase</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.alamat') }}</p>
                                                    <p class="content-part">{{ $data->address }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="info">
                                                <span class="material-symbols-outlined">move_selection_left</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.posisi') }}</p>
                                                    <p class="content-part">{{ $data->position }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="info">
                                                <span class="material-symbols-outlined">trending_flat</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.panjang') }}</p>
                                                    <p class="content-part">{{ $data->width }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="info">
                                                <span class="material-symbols-outlined">arrow_upward</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.tinggi') }}</p>
                                                    <p class="content-part">{{ $data->height }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="info">
                                                <span class="material-symbols-outlined">traffic</span>
                                                <div>
                                                    <p class="title-part">{{ trans('messages.trafik') }}</p>
                                                    <p class="content-part">
                                                        @if ($data->trafic == 0 || $data->trafic === null)
                                                            Proses Update
                                                        @else
                                                            {{ $data->trafic }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div> {{-- .row p-3 --}}
                                </div> {{-- .border rounded --}}
                            </div> {{-- .p-3 --}}
                        </div> {{-- .collapse --}}
                    @endif
                </div> {{-- .detailtitik-wrapper --}}
            </div> {{-- .detailtitik-content --}}
        </div> {{-- .detail-titik --}}
    </div> {{-- .g-hero --}}

    {{-- TITIK LAINNYA – hanya kalau $data & $titik ada --}}
    @if ($data && isset($titik) && count($titik))
        <p class="title-content text-center">
            {{ trans('messages.titik_kami_yang_lain') }} {{ $data->city->name }}
        </p>

        <div class="list-article">
            @foreach ($titik as $d)
                <a class="card-article" href="/{{ app()->getLocale() }}/listing/{{ $d->slug }}">
                    <img src="{{ $dom . $d->image2 }}" />

                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">{{ $d->address }}</p>
                            <p class="time">{{ $d->city->province->name }}, {{ $d->city->name }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection

@section('morejs')
    {{-- Animasi ScrollReveal --}}
    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('.g-hero', slideUp);
                ScrollReveal().reveal('.detail-titik', slideUp);
            }
        });
    </script>

    {{-- OpenCV.js for Client-Side Processing --}}
    <script src="https://docs.opencv.org/4.8.0/opencv.js" async onload="window.cvReady=true; console.log('OpenCV Loaded');"></script>

    {{-- Script tombol "Coba Mockup" (DIAMBIL DARI FILE detailtitik.blade.php) --}}
    {{-- Script tombol "Coba Mockup" Legacy (DIHAPUS) --}}
    {{-- Logika ini sudah dipindah ke detailtitik.blade.php dan client-side auto-detect --}}
    <script>
        // Legacy script removed for hosting safety.
    </script>

    {{-- SCRIPT WIDGET MOCKUP --}}
    <script>
        /* ===== Helper ===== */
        const qs = (sel, root = document) => root.querySelector(sel);

        function getQuery(key) {
            const u = new URL(window.location.href);
            return u.searchParams.get(key) || '';
        }

        function clamp(v, a, b) {
            return Math.max(a, Math.min(b, v));
        }

        /* ===== Elemen utama ===== */
        const baseCanvas = document.getElementById('baseCanvas');
        const designCanvas = document.getElementById('designCanvas');
        const wrap = document.getElementById('canvasWrap');
        const ctxBase = baseCanvas.getContext('2d');
        const ctxDesign = designCanvas.getContext('2d');

        ctxDesign.imageSmoothingEnabled = true;
        ctxDesign.imageSmoothingQuality = 'high';

        const handles = [0, 1, 2, 3].map(i => document.getElementById('h' + i));
        const designInput = document.getElementById('designInput');
        const redetectBtn = document.getElementById('redetectBtn');
        const downloadBtn = document.getElementById('downloadBtn');

        // [BARU] Elemen Zoom Preview
        const zoomBox = document.getElementById('zoomPreview');
        const zoomCanvas = document.getElementById('zoomCanvasPreview');
        const zoomCtx = zoomCanvas.getContext('2d');
        const zoomFactor = 4; // Tingkat zoom (misal: 4x)

        /* ===== State ===== */
        let showGuides = true;
        let baseImg = new Image();
        let baseW = 0,
            baseH = 0,
            viewScale = 1;
        
        // [BARU] Super-Sampling Factor untuk kualitas preview lebih tajam
        // Gunakan devicePixelRatio, minimal 2.0 untuk kualitas HD
        const CANVAS_SCALE = Math.max(2, window.devicePixelRatio || 1);

        let designImg = null;

        // untuk komunikasi ke Flask & tampilan
        let relativeImgSrc = ''; // contoh: /static/temp_crops/xxx.png
        let baseImgUrl = ''; // URL lengkap untuk dipakai ke <canvas>

        let pts = [{
                x: -100,
                y: -100
            },
            {
                x: -100,
                y: -100
            },
            {
                x: -100,
                y: -100
            },
            {
                x: -100,
                y: -100
            }
        ]; // TL,TR,BR,BL

        let dragging = -1;
        let autodetect = true; // <-- VARIABEL BARU UNTUK LOGIKA KOMBINASI

        /* ===== Base image & layout ===== */
        function drawBase() {
            // Setup ukuran canvas fisik (Super Sampled)
            const physicalW = Math.round(baseW * CANVAS_SCALE);
            const physicalH = Math.round(baseH * CANVAS_SCALE);
            
            baseCanvas.width = physicalW;
            baseCanvas.height = physicalH;
            
            designCanvas.width = physicalW;
            designCanvas.height = physicalH;

            // Scale context secara logika agar koordinat tetep 0..baseW
            ctxBase.setTransform(CANVAS_SCALE, 0, 0, CANVAS_SCALE, 0, 0);
            
            ctxBase.clearRect(0, 0, baseW, baseH);
            ctxBase.drawImage(baseImg, 0, 0, baseW, baseH);
        }

        function layoutFit() {
            const wrapW = wrap.clientWidth || baseW;
            viewScale = wrapW / (baseW || 1);
            const viewH = (baseH || 1) * viewScale;

            baseCanvas.style.width = wrapW + 'px';
            baseCanvas.style.height = viewH + 'px';
            designCanvas.style.width = wrapW + 'px';
            designCanvas.style.height = viewH + 'px';
            wrap.style.height = viewH + 'px';

            placeHandles();
            renderFinalDesign();
        }
        window.addEventListener('resize', layoutFit);

        function showHandles(visible) {
            const display = visible ? 'block' : 'none';
            handles.forEach(h => h.style.display = display);
        }
        
        // [BARU] Fungsi untuk update zoom preview
        function updateZoomPreview(canvasX, canvasY) {
            if (!zoomCtx || !baseCanvas) return;

            // Ukuran area sumber (di baseCanvas)
            const sWidth = zoomCanvas.width / zoomFactor;
            const sHeight = zoomCanvas.height / zoomFactor;
            
            // Titik tengah sumber (di baseCanvas)
            const sX = canvasX - sWidth / 2;
            const sY = canvasY - sHeight / 2;

            // Bersihkan canvas zoom
            zoomCtx.fillStyle = '#000'; // Latar belakang hitam
            zoomCtx.fillRect(0, 0, zoomCanvas.width, zoomCanvas.height);

            // Matikan anti-aliasing (biar pixelated & jelas)
            zoomCtx.imageSmoothingEnabled = false;

            // Gambar bagian dari baseCanvas ke zoomCanvas
            zoomCtx.drawImage(baseCanvas,
                sX, sY, sWidth, sHeight, // Source Rect (dari canvas utama)
                0, 0, zoomCanvas.width, zoomCanvas.height // Dest Rect (ke canvas zoom)
            );

            // Gambar crosshair (titik tengah)
            const midX = zoomCanvas.width / 2;
            const midY = zoomCanvas.height / 2;
            zoomCtx.strokeStyle = 'rgba(239, 68, 68, 0.7)'; // Merah transparan
            zoomCtx.lineWidth = 2;
            zoomCtx.beginPath();
            zoomCtx.moveTo(midX, 0);
            zoomCtx.lineTo(midX, zoomCanvas.height);
            zoomCtx.moveTo(0, midY);
            zoomCtx.lineTo(zoomCanvas.width, midY);
            zoomCtx.stroke();
        }
        
        // [BARU] Fungsi untuk memposisikan kotak zoom
        function updateZoomBoxPosition(ix, iy) {
            // Cek jika elemen ada
            if (!zoomBox || !wrap) return;

            const boxW = zoomBox.offsetWidth; // 150px
            const boxH = zoomBox.offsetHeight; // 150px
            const wrapW = wrap.clientWidth;   // Lebar viewport canvas (px)
            const wrapH = wrap.clientHeight;  // Tinggi viewport canvas (px)
            const padding = 10; // Jarak 10px dari sudut

            // Cek paruh/quadrant (menggunakan koordinat canvas internal, bukan pixel)
            const isTopHalf = (iy < baseH / 2);
            const isLeftHalf = (ix < baseW / 2);

            let newTop, newLeft;

            // Jika drag di atas, kotak zoom di bawah
            if (isTopHalf) {
                newTop = (wrapH - boxH - padding) + 'px';
            } else { // Jika drag di bawah, kotak zoom di atas
                newTop = padding + 'px';
            }

            // Jika drag di kiri, kotak zoom di kanan
            if (isLeftHalf) {
                newLeft = (wrapW - boxW - padding) + 'px';
            } else { // Jika drag di kanan, kotak zoom di kiri
                newLeft = padding + 'px';
            }

            zoomBox.style.top = newTop;
            zoomBox.style.left = newLeft;
        }

        /* ===== [BARU] Fungsi Onboarding Tour ===== */
        function startManualOnboarding() {
            const overlay = qs('#onboarding-overlay');
            const step1 = qs('#onboarding-step-1');
            const step2 = qs('#onboarding-step-2');
            const nextBtn = qs('#onboarding-next');
            const doneBtn = qs('#onboarding-done');

            if (!overlay || !step1 || !step2 || !nextBtn || !doneBtn) {
                console.warn('Elemen onboarding tidak ditemukan.');
                return;
            }

            // Tampilkan overlay dan langkah 1
            overlay.style.display = 'block';
            step1.style.display = 'block';
            step2.style.display = 'none';

            // Tombol Next (Langkah 1 -> 2)
            nextBtn.onclick = () => {
                step1.style.display = 'none';
                step2.style.display = 'block';
            };

            // Tombol Selesai (Tutup)
            doneBtn.onclick = () => {
                overlay.style.display = 'none';
            };
        }

        // FUNGSI BARU DARI KODE FALLBACK
        function setDefaultPoints() {
            // Set 4 titik di tengah-tengah sebagai default
            if (baseW === 0 || baseH === 0) return;

            const w = baseW;
            const h = baseH;
            const padX = w * 0.25; // 25% padding
            const padY = h * 0.25;

            pts = [{
                    x: padX,
                    y: padY
                }, // TL
                {
                    x: w - padX,
                    y: padY
                }, // TR
                {
                    x: w - padX,
                    y: h - padY
                }, // BR
                {
                    x: padX,
                    y: h - padY
                } // BL
            ];

            console.log('Mengatur titik manual default:', pts);
            placeHandles();
            
            // [BARU] Panggil Onboarding Tour
            startManualOnboarding();
        }


        /* ===== Upload desain ===== */
        designInput.addEventListener('change', () => {
            const f = designInput.files?.[0];
            if (!f) return;

            const url = URL.createObjectURL(f);
            const img = new Image();
            img.onload = async () => {
                designImg = img;
                URL.revokeObjectURL(url);
                
                // Cek apakah user sudah set titik (manual/auto sebelumnya) ?
                // Jika titik valid (tidak -100), JANGAN RESET.
                const pointsValid = pts && pts.length === 4 && pts.every(p => p.x >= 0 && p.y >= 0);
                
                if (pointsValid) {
                    console.log('Titik sudah ada, menggunakan titik yang sama untuk desain baru.');
                    redetectBtn.disabled = false;
                    renderFinalDesign(); // Render ulang dengan desain baru di quad yg sama
                    return; // STOP, jangan reset atau autodetect ulang
                }

                resetForNewUpload(); // reset state sebelumnya (hanya jika titik belum ada)
                redetectBtn.disabled = false; // tombol Auto Mockup aktif

                // --- LOGIKA KOMBINASI BARU ---
                if (autodetect) {
                    // KASUS 1: Mode Normal/Pre-cropped.
                    // Langsung deteksi kotak biru di gambar yg sudah di-crop.
                    console.log('Mode Pre-cropped, deteksi kotak biru...');
                    const ok = await detectBlueBox(true); 
                    if (!ok) {
                        // Gagal deteksi di gambar yg sudah di-crop (kotak kecil/aneh)
                        // alert('Deteksi gagal. Silakan atur 4 titik secara manual.'); // <-- DIHILANGKAN
                        setDefaultPoints(); // DIUBAH: Panggil default points
                        showHandles(true); // Tampilkan handle agar bisa di-drag
                        showGuides = true;
                        renderFinalDesign();
                    }
                } else {
                    // KASUS 2: Mode Fallback (gambar asli, autodetect=false).
                    // Coba deteksi di gambar ASLI.
                    console.log('Mode Fallback, deteksi kotak biru di gambar asli...');
                    const ok = await detectBlueBox(true);
                    if (!ok) {
                        // Gagal deteksi di gambar asli (tidak ada kotak biru).
                        // Panggil fallback manual (titik di tengah).
                        // alert('Deteksi otomatis gagal. Mengatur 4 titik di tengah. Silakan sesuaikan.'); // <-- DIHILANGKAN
                        setDefaultPoints();
                        showHandles(true);
                        showGuides = true;
                        renderFinalDesign();
                    }
                }
                // --- AKHIR LOGIKA KOMBINASI ---
            };
            img.onerror = () => {
                alert('Gagal memuat desain. Coba JPG/PNG/WEBP lain.');
            };
            img.src = url;
        });

        /* ===== Util: urutkan titik jadi TL,TR,BR,BL ===== */
        function orderQuadTLTRBRBL(raw4) {
            const p = raw4.map(p => ({
                x: Number(p.x),
                y: Number(p.y)
            }));
            p.sort((a, b) => a.y - b.y);
            const top = p.slice(0, 2).sort((a, b) => a.x - b.x);
            const bot = p.slice(2, 4).sort((a, b) => a.x - b.x);
            return [top[0], top[1], bot[1], bot[0]];
        }

        /* ===== Client-Side CV Functions (Replaces Python Server) ===== */
        
        async function waitForCV() {
            if (window.cvReady && cv.Mat) return true;
            console.log('Waiting for OpenCV...');
            for (let i = 0; i < 50; i++) { // wait up to 5s
                if (window.cvReady && cv.Mat) return true;
                await new Promise(r => setTimeout(r, 100));
            }
            return false;
        }

        /* --- Replikasi logic 'find_and_crop_by_blob' Python --- */
        async function processAutoCropCV(imgElement) {
            if (!await waitForCV()) return null;
            
            try {
                let src = cv.imread(imgElement);
                let gray = new cv.Mat();
                cv.cvtColor(src, gray, cv.COLOR_RGBA2GRAY, 0);
                
                let thresh = new cv.Mat();
                // Threshold INV (200) - Mencari area gelap/konten di background putih/terang
                cv.threshold(gray, thresh, 200, 255, cv.THRESH_BINARY_INV);
                
                let contours = new cv.MatVector();
                let hierarchy = new cv.Mat();
                cv.findContours(thresh, contours, hierarchy, cv.RETR_EXTERNAL, cv.CHAIN_APPROX_SIMPLE);
                
                let bestRect = null;
                // MIN_AREA_BLOB = 20000
                for (let i = 0; i < contours.size(); ++i) {
                    let cnt = contours.get(i);
                    let area = cv.contourArea(cnt);
                    if (area >= 20000) {
                        let rect = cv.boundingRect(cnt);
                        // Ambil yang paling atas (y paling kecil)
                        if (!bestRect || rect.y < bestRect.y) {
                            bestRect = rect;
                        }
                    }
                }
                
                // Cleanup
                src.delete(); gray.delete(); thresh.delete(); contours.delete(); hierarchy.delete();
                
                if (bestRect) {
                    console.log('AutoCrop found blob:', bestRect);
                    // Buat canvas baru hasil crop
                    let cCanvas = document.createElement('canvas');
                    cCanvas.width = bestRect.width;
                    cCanvas.height = bestRect.height;
                    let ctx = cCanvas.getContext('2d');
                    ctx.drawImage(imgElement, -bestRect.x, -bestRect.y);
                    return cCanvas;
                }
            } catch(e) {
                console.error("AutoCropCV Error:", e);
            }
            return null; // Gagal crop
        }

        /* --- Replikasi logic 'find_blue_box_corners' Python (IMPROVED) --- */
        async function detectBlueBox(showGuideOnly = true) {
            if (!await waitForCV()) {
                console.warn("OpenCV not ready for BlueBox detection");
                return false;
            }

            try {
                // Deteksi dilakukan pada area baseCanvas saat ini (bisa cropped atau full)
                let src = cv.imread(baseCanvas);
                let hsv = new cv.Mat();
                cv.cvtColor(src, hsv, cv.COLOR_RGBA2RGB); 
                cv.cvtColor(hsv, hsv, cv.COLOR_RGB2HSV);
                
                // Rentang Biru: [75, 50, 50] - [135, 255, 255]
                // [MODIFIKASI] Naikkan Saturation (S) dari 50 ke 100 untuk menghindari langit. (SUDAH)
                // [MODIFIKASI] Naikkan Value (V) dari 50 ke 120 untuk menghindari bayangan/pantulan gelap (mobil).
                let low = new cv.Mat(hsv.rows, hsv.cols, hsv.type(), [75, 100, 120, 0]);
                let high = new cv.Mat(hsv.rows, hsv.cols, hsv.type(), [135, 255, 255, 255]);
                let mask = new cv.Mat();
                cv.inRange(hsv, low, high, mask);
                
                // Morph Open & Close (5x5 kernel)
                let kernel = cv.getStructuringElement(cv.MORPH_RECT, new cv.Size(5, 5));
                cv.morphologyEx(mask, mask, cv.MORPH_OPEN, kernel);
                cv.morphologyEx(mask, mask, cv.MORPH_CLOSE, kernel);
                
                let contours = new cv.MatVector();
                let hierarchy = new cv.Mat();
                cv.findContours(mask, contours, hierarchy, cv.RETR_EXTERNAL, cv.CHAIN_APPROX_SIMPLE);
                
                let bestCnt = null;
                // [MODIFIKASI] Relax Max Area to 99% (allow fullscreen billboards)
                let maxArea = src.rows * src.cols * 0.99; 
                let maxFoundArea = -1;

                // [MODIFIKASI] Strategy:
                // 1. Cari strict 4 corners (epsilon 0.02)
                // 2. Jika gagal, cari loose 4 corners (epsilon 0.05)
                // 3. Jika gagal, ambil contour terbesar -> minAreaRect (pasti dapat 4 sudut)

                let bestStrictParams = null; // Untuk menyimpan kandidat terbaik dari loop
                
                // --- PASS 1 & 2: Cari Polygon 4 Sisi ---
                for(let i=0; i<contours.size(); i++) {
                    let cnt = contours.get(i);
                    let area = cv.contourArea(cnt);
                    
                    // Filter Area Minimal
                    if (area < 3000 || area > maxArea) continue;
                    
                    let peri = cv.arcLength(cnt, true);
                    let approx = new cv.Mat();
                    
                    // Coba strict dulu (epsilon 0.02)
                    cv.approxPolyDP(cnt, approx, 0.02 * peri, true);
                    
                    // [MODIFIKASI] Terapkan "Loose" (0.05) HANYA JIKA area cukup besar (> 1% layar)
                    // Diturunkan dari 5% -> 1% karena user lapor baliho medium terlewat.
                    let isLargeBlob = (area > (src.rows * src.cols * 0.01));
                    
                    if (approx.rows !== 4 && isLargeBlob) {
                         cv.approxPolyDP(cnt, approx, 0.05 * peri, true);
                    }

                    if (approx.rows === 4) {
                        let rect = cv.boundingRect(approx); // Pakai rect untuk rasio kasar
                        if(rect.height > 0) {
                            let ratio = rect.width / rect.height;
                            // Filter Ratio (0.3 - 3.5)
                            if (ratio > 0.3 && ratio < 3.5) {
                                if (area > maxFoundArea) {
                                    maxFoundArea = area;
                                    if(bestCnt) bestCnt.delete();
                                    bestCnt = approx; // Simpan pemenang (Mat)
                                    // Jangan delete approx ini dulu
                                    continue; 
                                }
                            }
                        }
                    }
                    approx.delete();
                }
                
                let pArray = [];
                
                if (bestCnt) {
                     console.log("Found 4-corner polygon! Area:", maxFoundArea);
                     for(let i=0; i<4; i++) {
                        pArray.push({
                            x: bestCnt.intPtr(i, 0)[0],
                            y: bestCnt.intPtr(i, 0)[1]
                        });
                    }
                    bestCnt.delete();
                } else {
                    // --- PASS 3: FALLBACK ke Largest Blob -> Rotated Rect ---
                    console.log("Strict/Loose polygon not found. Trying Fallback (Largest Blob)...");
                    
                    let maxBlobArea = -1;
                    let bestBlobIdx = -1;
                    
                    for(let i=0; i<contours.size(); i++) {
                        let cnt = contours.get(i);
                        let area = cv.contourArea(cnt);
                        if (area > 3000 && area < maxArea) {
                             if (area > maxBlobArea) {
                                 maxBlobArea = area;
                                 bestBlobIdx = i;
                             }
                        }
                    }
                    
                    if (bestBlobIdx !== -1) {
                         // [MODIFIKASI] Fallback HANYA untuk objek besar (> 1%)
                         // Jika objek kecil gagal Pass 1 (Strict), jangan dipaksa detect (anggap noise/manual).
                         if (maxBlobArea < (src.rows * src.cols * 0.01)) {
                             console.warn("Fallback rejected: Blob too small for fallback logic.");
                             src.delete(); hsv.delete(); low.delete(); high.delete(); mask.delete(); 
                             contours.delete(); hierarchy.delete(); kernel.delete();
                             return false; 
                         }

                         let cnt = contours.get(bestBlobIdx);
                         let rotRect = cv.minAreaRect(cnt);
                         let vertices = cv.RotatedRect.points(rotRect);
                         console.log("Fallback Success! Blob Area:", maxBlobArea);
                         
                         for(let i=0; i<4; i++) {
                             pArray.push({
                                 x: vertices[i].x,
                                 y: vertices[i].y
                             });
                         }
                    }
                }
                
                // Cleanup OpenCV objects
                src.delete(); hsv.delete(); low.delete(); high.delete(); mask.delete(); 
                contours.delete(); hierarchy.delete(); kernel.delete();
                
                if (pArray.length === 4) {
                    // Normalize coordinates by CANVAS_SCALE
                    let normalizedPts = [];
                    for(let i=0; i<4; i++) {
                        normalizedPts.push({
                            x: pArray[i].x / CANVAS_SCALE,
                            y: pArray[i].y / CANVAS_SCALE
                        });
                    }

                    pts = orderQuadTLTRBRBL(normalizedPts);
                    placeHandles();
                    showHandles(true);
                    showGuides = true;
                    if (showGuideOnly) renderFinalDesign();
                    
                    console.log("Blue Box Detected (Normalized):", pts);
                    return true;
                }
                
                return false; // Benar-benar gagal (tidak ada blob biru signifikan)

            } catch(e) {
                console.error("BlueBox Error:", e);
                return false;
            }
        }


        /* ===== Klik tombol Auto Mockup ===== */
        async function handleAutoMockupClick() {
            if (!designImg) {
                alert('Silakan "Upload Desain" terlebih dahulu.');
                return;
            }

            // --- LOGIKA KOMBINASI BARU ---
            // Coba deteksi HANYA JIKA titik belum ada (-100)
            if (pts.some(p => p.x < 0 || p.y < 0)) {
                console.log('Titik belum ada, mencoba deteksi otomatis...');
                const ok = await detectBlueBox(true);

                if (!ok) {
                    // Deteksi gagal. Cek mode-nya.
                    if (autodetect) {
                        // Mode Normal: Gagal deteksi, panggil titik tengah
                        // alert('Deteksi gagal. Mengatur 4 titik di tengah. Silakan sesuaikan.'); // <-- DIHILANGKAN
                        setDefaultPoints(); // DIUBAH: Panggil default points
                        showHandles(true); 
                        showGuides = true;
                        renderFinalDesign();
                        return; // Berhenti
                    } else {
                        // Mode Fallback: Gagal deteksi, panggil titik tengah.
                        // alert(
                        //     'Deteksi otomatis gagal. Mengatur 4 titik di tengah. Silakan sesuaikan dan klik "Auto Mockup" lagi untuk menerapkan.'); // <-- DIHILANGKAN
                        setDefaultPoints();
                        showHandles(true);
                        showGuides = true;
                        renderFinalDesign();
                        return; // Berhenti, biarkan user sesuaikan
                    }
                }
            }
            // --- AKHIR LOGIKA KOMBINASI ---


            // Jika kode sampai sini, berarti 'pts' SUDAH ADA
            // (baik dari deteksi, default, atau drag manual)
            // LANGSUNG LAKUKAN PROSES WARP.
            redetectBtn.disabled = true;
            const old = redetectBtn.innerHTML;
            redetectBtn.innerHTML =
                '<span class="material-symbols-outlined me-1">hourglass_top</span> Loading...';

            try {
                // efek loading di dalam quad
                startQuadLoading(1200);

                setTimeout(() => {
                    stopQuadLoading();

                    // render desain ke dalam kotak (warp)
                    // [MODIFIKASI] Di sini kita set showGuides = false DULU
                    // agar renderFinalDesign() berikutnya menggunakan gambar HD
                    showGuides = false;
                    renderFinalDesign();

                    // setelah selesai, garis & titik disembunyikan
                    showHandles(false);
                    // renderFinalDesign(); // <-- Ini tidak perlu dipanggil 2x

                    downloadBtn.style.display = 'inline-flex';
                }, 1200);
            } finally {
                setTimeout(() => {
                    redetectBtn.disabled = false;
                    redetectBtn.innerHTML = old;
                }, 1200);
            }
        }

        redetectBtn.addEventListener('click', handleAutoMockupClick);

        /* ===== Drag 4 titik ===== */
        function placeHandles() {
            const toClient = p => ({
                x: p.x * viewScale,
                y: p.y * viewScale
            });
            handles.forEach((h, i) => {
                const c = toClient(pts[i]);
                h.style.left = c.x + 'px';
                h.style.top = c.y + 'px';
            });
        }

        // [MODIFIKASI] Ganti seluruh blok 'handles.forEach' dengan ini
        handles.forEach((h, i) => {
            h.addEventListener('pointerdown', e => {
                e.preventDefault();
                dragging = i;
                h.setPointerCapture?.(e.pointerId);

                // [MODIFIKASI] Tampilkan & update zoom
                const rect = wrap.getBoundingClientRect();
                const cx = e.clientX - rect.left;
                const cy = e.clientY - rect.top;
                const ix = clamp(cx / viewScale, 0, baseW);
                const iy = clamp(cy / viewScale, 0, baseH);

                zoomBox.style.display = 'block';
                updateZoomPreview(ix, iy);
                updateZoomBoxPosition(ix, iy); // Posisikan kotak zoom
            });

            window.addEventListener('pointermove', e => {
                if (dragging !== i) return;
                const rect = wrap.getBoundingClientRect();
                const cx = e.clientX - rect.left;
                const cy = e.clientY - rect.top;
                const ix = clamp(cx / viewScale, 0, baseW);
                const iy = clamp(cy / viewScale, 0, baseH);
                pts[i] = {
                    x: ix,
                    y: iy
                };
                placeHandles();
                renderFinalDesign(); // <-- Ini akan pakai gambar Low-Res (cepat)

                // [MODIFIKASI] Update zoom & posisinya
                updateZoomPreview(ix, iy);
                updateZoomBoxPosition(ix, iy); // Posisikan kotak zoom
            });

            window.addEventListener('pointerup', () => {
                dragging = -1;
                // [BARU] Sembunyikan zoom box
                zoomBox.style.display = 'none';
            });
        });

        /* ===== Matriks & warp ===== */
        // ======================================================
        // == DI BAWAH INI ADALAH 3 FUNGSI DENGAN PERBAIKAN BUG ==
        // ======================================================
        // ... (Kode m3mul, m3inv, setTransformFromTriangle, drawMappedTriangle, warpImageToQuad tidak berubah) ...
        function m3mul(A, B) {
            return [
                [
                    A[0][0] * B[0][0] + A[0][1] * B[1][0] + A[0][2] * B[2][0],
                    A[0][0] * B[0][1] + A[0][1] * B[1][1] + A[0][2] * B[2][1],
                    A[0][0] * B[0][2] + A[0][1] * B[1][2] + A[0][2] * B[2][2],
                ],
                [
                    A[1][0] * B[0][0] + A[1][1] * B[1][0] + A[1][2] * B[2][0],
                    A[1][0] * B[0][1] + A[1][1] * B[1][1] + A[1][2] * B[2][1],
                    A[1][0] * B[0][2] + A[1][1] * B[1][2] + A[1][2] * B[2][2], 
                ],
                [
                    A[2][0] * B[0][0] + A[2][1] * B[1][0] + A[2][2] * B[2][0],
                    A[2][0] * B[0][1] + A[2][1] * B[1][1] + A[2][2] * B[2][1],
                    A[2][0] * B[0][2] + A[2][1] * B[1][2] + A[2][2] * B[2][2],
                ],
            ];
        }

        function m3inv(M) {
            const a = M[0][0],
                b = M[0][1],
                c = M[0][2];
            const d = M[1][0],
                e = M[1][1],
                f = M[1][2];
            const g = M[2][0],
                h = M[2][1],
                i = M[2][2];

            const A = e * i - f * h,
                B = -(d * i - f * g),
                C = d * h - e * g;
            const D = -(b * i - c * h),
                E = a * i - c * g,
                F = -(a * h - b * g);
            const G = b * f - c * e,
                H = -(a * f - c * d),
                I = a * e - b * d;

            const det = a * A + b * B + c * C;
            if (Math.abs(det) < 1e-10) {
                console.error('m3inv GAGAL: Determinan 0. Matriks:', M);
                return null;
            }

            return [
                [A / det, D / det, G / det],
                [B / det, E / det, H / det],
                [C / det, F / det, I / det]
            ];
        }

        function setTransformFromTriangle(ctx,
            sx0, sy0, sx1, sy1, sx2, sy2,
            dx0, dy0, dx1, dy1, dx2, dy2
        ) {
            const S = [
                [sx0, sx1, sx2],
                [sy0, sy1, sy2],
                [1, 1, 1]
            ];
            const D = [
                [dx0, dx1, dx2],
                [dy0, dy1, dy2],
                [1, 1, 1]
            ];
            const invS = m3inv(S);
            if (!invS) {
                console.error('setTransform GAGAL: m3inv mengembalikan null. Matriks S:', S);
                return false;
            }
            const T = m3mul(D, invS);
            const a = T[0][0],
                b = T[0][1],
                e = T[0][2];
            const c = T[1][0],
                d = T[1][1],
                f = T[1][2];
            ctx.setTransform(a, c, b, d, e, f);
            return true;
        }

        function drawMappedTriangle(ctx, img,
            sx0, sy0, sx1, sy1, sx2, sy2,
            dx0, dy0, dx1, dy1, dx2, dy2,
            useScale = 1
        ) {
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(dx0, dy0);
            ctx.lineTo(dx1, dy1);
            ctx.lineTo(dx2, dy2);
            ctx.closePath();
            ctx.clip();

            if (setTransformFromTriangle(ctx,
                    sx0, sy0, sx1, sy1, sx2, sy2, 
                    dx0 * useScale, dy0 * useScale, 
                    dx1 * useScale, dy1 * useScale, 
                    dx2 * useScale, dy2 * useScale)) {
                ctx.drawImage(img, 0, 0);
            } else {
                console.warn('GAGAL menggambar segitiga: setTransform return false');
            }
            ctx.restore();
        }

        function warpImageToQuad(ctx, img, q, grid = 40, outputScale = 1) {
            const [p0, p1, p2, p3] = q; // TL,TR,BR,BL
            const sw = img.naturalWidth || img.width;
            const sh = img.naturalHeight || img.height;
            const lerp = (a, b, t) => a + (b - a) * t;

            for (let iy = 0; iy < grid; iy++) {
                const ty0 = iy / grid,
                    ty1 = (iy + 1) / grid;
                for (let ix = 0; ix < grid; ix++) {
                    const tx0 = ix / grid,
                        tx1 = (ix + 1) / grid;
                    const sx0 = tx0 * sw,
                        sx1 = tx1 * sw,
                        sy0 = ty0 * sh,
                        sy1 = ty1 * sh;

                    const dstXY = (tx, ty) => {
                        const ax = lerp(p0.x, p1.x, tx),
                            ay = lerp(p0.y, p1.y, tx);
                        const bx = lerp(p3.x, p2.x, tx),
                            by = lerp(p3.y, p2.y, tx);
                        return {
                            x: lerp(ax, bx, ty),
                            y: lerp(ay, by, ty)
                        };
                    };

                    const d00 = dstXY(tx0, ty0),
                        d10 = dstXY(tx1, ty0),
                        d11 = dstXY(tx1, ty1),
                        d01 = dstXY(tx0, ty1);
                    
                    drawMappedTriangle(ctx, img, sx0, sy0, sx1, sy0, sx1, sy1,
                        d00.x, d00.y, d10.x, d10.y, d11.x, d11.y, outputScale);
                    drawMappedTriangle(ctx, img, sx0, sy0, sx1, sy1, sx0, sy1,
                        d00.x, d00.y, d11.x, d11.y, d01.x, d01.y, outputScale);
                }
            }
        }
        
        // ======================================================
        // == SISA KODE DI BAWAH INI SAMA SEPERTI ASLINYA ==
        // ======================================================
        
        // Ini adalah nilai dari kode Anda
        const DOWNLOAD_SUPER_SCALE = 5;
        const MIN_GRID = 48;
        const MAX_GRID = 160;
        const GRID_PER_100PX = 12;

        function gridForQuad(q) {
            const edge = (a, b) => Math.hypot(b.x - a.x, b.y - a.y);
            const w = (edge(q[0], q[1]) + edge(q[3], q[2])) / 2;
            const h = (edge(q[0], q[3]) + edge(q[1], q[2])) / 2;
            const base = Math.max(w, h);
            const g = Math.round((base / 100) * GRID_PER_100PX);
            return Math.max(MIN_GRID, Math.min(MAX_GRID, g));
        }

        const PREVIEW_SUPER_SCALE = 8;
        let hiCanvas = document.createElement('canvas');
        let hiCtx = hiCanvas.getContext('2d');
        hiCtx.imageSmoothingEnabled = true;
        hiCtx.imageSmoothingQuality = 'high';

        let designHi = null;

        function ensureDesignHiForQuad(q, multiplier = 1) {
            if (!designImg) return null;
            const edge = (a, b) => Math.hypot(b.x - a.x, b.y - a.y);
            // Hitung ukuran target (logical)
            const targetW = (edge(q[0], q[1]) + edge(q[3], q[2])) / 2;
            const targetH = (edge(q[0], q[3]) + edge(q[1], q[2])) / 2;
            
            // Kali dengan multiplier (misal CANVAS_SCALE) agar resolusi texture nge-match canvas fisik
            const realW = targetW * multiplier;
            const realH = targetH * multiplier;

            const sw = designImg.naturalWidth || designImg.width;
            const sh = designImg.naturalHeight || designImg.height;

            // Hitung scale berdasarkan ukuran fisik yg dibutuhkan
            const scale = Math.min(20, Math.max(1, Math.max(realW / sw, realH / sh)));
            
            if (scale <= 1.05) { 
                designHi = designImg;
                return designHi;
            }
            // ======================================================

            if (designHi && designHi._scale && Math.abs(designHi._scale - scale) < 0.1) return designHi;
            
            console.log('Membuat cache Hi-Res @', scale.toFixed(2) + 'x'); // Log untuk debug

            const cnv = document.createElement('canvas');
            cnv.width = Math.round(sw * scale);
            cnv.height = Math.round(sh * scale);
            const cctx = cnv.getContext('2d');
            cctx.imageSmoothingEnabled = true;
            cctx.imageSmoothingQuality = 'high';
            cctx.drawImage(designImg, 0, 0, cnv.width, cnv.height);
            cnv._scale = scale;
            designHi = cnv;
            return designHi;
        }
        
        function renderFinalDesign() {
            // Updated for Super-Sampling: Scale context
            ctxDesign.setTransform(CANVAS_SCALE, 0, 0, CANVAS_SCALE, 0, 0);
            
            ctxDesign.clearRect(0, 0, baseW, baseH);
            if (!designImg) {
                if (showGuides && pts && pts.length === 4 && pts.every(p => p.x >= 0 && p.y >= 0)) {
                    ctxDesign.strokeStyle = '#ef4444';
                    ctxDesign.lineWidth = 2;
                    ctxDesign.beginPath();
                    ctxDesign.moveTo(pts[0].x, pts[0].y);
                    ctxDesign.lineTo(pts[1].x, pts[1].y);
                    ctxDesign.lineTo(pts[2].x, pts[2].y);
                    ctxDesign.lineTo(pts[3].x, pts[3].y);
                    ctxDesign.closePath();
                    ctxDesign.stroke();
                }
                return;
            }

            function drawDesignCentered() {
                if (baseW === 0 || baseH === 0) return;
                const sw = designImg.naturalWidth || designImg.width;
                const sh = designImg.naturalHeight || designImg.height;
                const scale = Math.min(baseW / sw, baseH / sh);
                const dw = sw * scale;
                const dh = sh * scale;
                const dx = (baseW - dw) / 2;
                const dy = (baseH - dh) / 2;
                ctxDesign.imageSmoothingEnabled = true;
                ctxDesign.imageSmoothingQuality = 'high';
                ctxDesign.drawImage(designImg, dx, dy, dw, dh);
            }

            if (!pts || pts.length !== 4 || pts.some(p => p.x < 0 || p.y < 0 || !isFinite(p.x) || !isFinite(p.y))) {
                drawDesignCentered();
                return;
            }

            const drawGuide = () => {
                ctxDesign.strokeStyle = '#ef4444';
                ctxDesign.lineWidth = 2;
                ctxDesign.beginPath();
                ctxDesign.moveTo(pts[0].x, pts[0].y);
                ctxDesign.lineTo(pts[1].x, pts[1].y);
                ctxDesign.lineTo(pts[2].x, pts[2].y);
                ctxDesign.lineTo(pts[3].x, pts[3].y);
                ctxDesign.closePath();
                ctxDesign.stroke();
            };

            ctxDesign.imageSmoothingEnabled = true;
            ctxDesign.imageSmoothingQuality = 'high';

            try {
                const grid = gridForQuad(pts);
                
                // Logika Kualitas Ganda (Dual Quality)
                const srcImg = (showGuides) // Jika true (sedang drag), pakai gambar standar
                                ? designImg 
                                : (ensureDesignHiForQuad(pts, CANVAS_SCALE) || designImg); // Pass CANVAS_SCALE agar texture HD
                
                warpImageToQuad(ctxDesign, srcImg, pts, grid, CANVAS_SCALE); 
                
                if (showGuides) {
                    drawGuide();
                }
            } catch (e) {
                console.error('warp preview error', e);
                ctxDesign.setTransform(CANVAS_SCALE, 0, 0, CANVAS_SCALE, 0, 0);
                ctxDesign.clearRect(0, 0, baseW, baseH);
                drawDesignCentered();
            }
        }

        downloadBtn.addEventListener('click', () => {
            if (!designImg) return;
            const S = DOWNLOAD_SUPER_SCALE;
            const out = document.createElement('canvas');
            out.width = Math.round(baseW * S);
            out.height = Math.round(baseH * S);
            const octx = out.getContext('2d');
            octx.imageSmoothingEnabled = true;
            octx.imageSmoothingQuality = 'high';
            octx.drawImage(baseImg, 0, 0, out.width, out.height);
            const qHD = pts.map(p => ({
                x: p.x * S,
                y: p.y * S
            }));

            // ======================================================
            // [PERBAIKAN #2] Menggunakan 'qHD' (koordinat HD)
            // Ini adalah BUG Download.
            // ======================================================
            const src = ensureDesignHiForQuad(qHD) || designImg; 
            // ======================================================
            
            const grid = Math.min(MAX_GRID * S, gridForQuad(pts) * S);
            warpImageToQuad(octx, src, qHD, grid, 1);
            
            // [MODIFIKASI] Generate Filename: YouseeMockup-DDMMYYYY-NO.JPG
            const date = new Date();
            const dStr = String(date.getDate()).padStart(2, '0') + 
                         String(date.getMonth() + 1).padStart(2, '0') + 
                         date.getFullYear();
            // Random 2 digit (01-99)
            const rnd = String(Math.floor(Math.random() * 99) + 1).padStart(2, '0');
            const filename = `YouseeMockup-${dStr}-${rnd}.JPG`;

            if (out.toBlob) {
                out.toBlob(blob => {
                    if (!blob) { // Tambahan catch error
                         console.error('Download Gagal: canvas.toBlob() mengembalikan null.');
                         alert('Download gagal. Coba gambar yang lebih kecil.');
                         return;
                    }
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename;
                    a.click();
                    setTimeout(() => URL.revokeObjectURL(url), 0);
                }, 'image/jpeg', 0.95); // Gunakan JPEG Quality 0.95
            } else {
                const url = out.toDataURL('image/jpeg', 0.95);
                const a = document.createElement('a');
                a.href = url;
                a.download = filename;
                a.click();
            }
        });

        (function init() {
            const param = getQuery('img');
            let shouldAutoProcess = getQuery('autodetect') !== 'false'; 
            autodetect = shouldAutoProcess; // Update global state

            if (!param) {
                console.warn('Parameter ?img= tidak ditemukan.');
                return;
            }
            
            let full = param;
            try { full = decodeURIComponent(param); } catch {}
            
            baseImgUrl = full; 
            baseImg.crossOrigin = "Anonymous";
            baseImg.src = baseImgUrl;

            baseImg.onload = async function() {
                // Update dimensions
                baseW = baseImg.naturalWidth;
                baseH = baseImg.naturalHeight;
                baseCanvas.width = baseW;
                baseCanvas.height = baseH;
                designCanvas.width = baseW;
                designCanvas.height = baseH;
                
                // 1. Draw Original first
                drawBase();
                layoutFit();
                
                // 2. Auto Process Logic (Client Side)
                if (shouldAutoProcess) {
                    shouldAutoProcess = false; // Prevent loop
                    
                    console.log("Starting Auto Process...");
                    // Show loading state if possible (optional)
                    
                    // A. Auto Crop (Blob Detection)
                    try {
                         const croppedCanvas = await processAutoCropCV(baseImg);
                         if (croppedCanvas) {
                             console.log("AutoCrop success, reloading with crop...");
                             // Use the cropped result as new base
                             baseImg.src = croppedCanvas.toDataURL();
                             // Flag to run BlueBox on NEXT load
                             baseImg.dataset.needBlueBox = "true"; 
                             return; // Exit, wait for next onload
                         }
                    } catch (e) {
                         console.error("AutoCrop failed", e);
                    }
                    
                    // If no crop needed/found, proceed to BlueBox immediately
                    baseImg.dataset.needBlueBox = "true";
                }
                
                // 3. Blue Box Detection
                if (baseImg.dataset.needBlueBox === "true") {
                    baseImg.dataset.needBlueBox = "false";
                    console.log("Running Blue Box Detection...");
                    
                    const success = await detectBlueBox(true);
                    
                    if (!success) {
                         console.warn("Blue Box failed, using default points.");
                         setDefaultPoints();
                         showHandles(true);
                         showGuides = true;
                         renderFinalDesign();
                    }
                } else if (getQuery('autodetect') === 'false') {
                     // Manual mode original fallback
                     setDefaultPoints();
                }
            };
            
            baseImg.onerror = () => alert('Gambar tidak bisa dimuat. Pastikan URL valid dan mendukung CORS.'); 
        })();
    </script>


    <script>
        // ... (KODE LOADING DI DALAM QUAD) ...
        // ... (Tidak berubah) ...
        let loadingRAF = null;

        function clipQuad(ctx, q) {
            ctx.beginPath();
            ctx.moveTo(q[0].x, q[0].y);
            ctx.lineTo(q[1].x, q[1].y);
            ctx.lineTo(q[2].x, q[2].y);
            ctx.lineTo(q[3].x, q[3].y);
            ctx.closePath();
            ctx.clip();
        }

        function startQuadLoading(durationMs = 1200) {
            const q = pts;
            const t0 = performance.now();

            function frame(t) {
                // [FIX] Gunakan scaling canvas yang benar
                ctxDesign.setTransform(CANVAS_SCALE, 0, 0, CANVAS_SCALE, 0, 0);
                ctxDesign.clearRect(0, 0, baseW, baseH);
                
                ctxDesign.strokeStyle = 'rgba(239,68,68,0.9)';
                ctxDesign.lineWidth = 2;
                ctxDesign.beginPath();
                ctxDesign.moveTo(q[0].x, q[0].y);
                ctxDesign.lineTo(q[1].x, q[1].y);
                ctxDesign.lineTo(q[2].x, q[2].y);
                ctxDesign.lineTo(q[3].x, q[3].y);
                ctxDesign.closePath();
                ctxDesign.stroke();
                ctxDesign.save();
                clipQuad(ctxDesign, q);
                const grd = ctxDesign.createLinearGradient(q[0].x, q[0].y, q[2].x, q[2].y);
                grd.addColorStop(0, 'rgba(15,23,42,0.45)');
                grd.addColorStop(1, 'rgba(2,6,23,0.55)');
                ctxDesign.fillStyle = grd;
                ctxDesign.fillRect(0, 0, baseW, baseH);
                const shift = ((t - t0) * 0.20) % 30;
                ctxDesign.globalAlpha = 0.22;
                ctxDesign.lineWidth = 10;
                for (let i = -baseH; i < baseW + baseH; i += 30) {
                    ctxDesign.beginPath();
                    ctxDesign.moveTo(i + shift, 0);
                    ctxDesign.lineTo(i - baseH + shift, baseH);
                    ctxDesign.strokeStyle = '#ffffff';
                    ctxDesign.stroke();
                }
                ctxDesign.globalAlpha = 1;
                const cx = (q[0].x + q[1].x + q[2].x + q[3].x) / 4;
                const cy = (q[0].y + q[1].y + q[2].y + q[3].y) / 4;
                
                // [FIX] Hitung ukuran Quad (width/height estimasi)
                // Agar loading spinner proporsional dan tidak kepotong
                const wQuad = Math.hypot(q[1].x - q[0].x, q[1].y - q[0].y);
                const hQuad = Math.hypot(q[3].x - q[0].x, q[3].y - q[0].y);
                const minDim = Math.min(wQuad, hQuad);
                
                // Radius = 25% dari sisi terpendek quad (Diameter = 50%)
                const baseR = Math.max(10, minDim * 0.25);
                
                const pulse = 1 + 0.08 * Math.sin((t - t0) * 0.01);
                ctxDesign.beginPath();
                ctxDesign.lineWidth = 8;
                ctxDesign.strokeStyle = 'rgba(255,255,255,0.35)';
                ctxDesign.arc(cx, cy, baseR * pulse, 0, Math.PI * 2);
                ctxDesign.stroke();
                const ang = (t - t0) * 0.012;
                ctxDesign.beginPath();
                ctxDesign.lineWidth = 8;
                ctxDesign.strokeStyle = 'rgba(255,255,255,0.95)';
                ctxDesign.arc(cx, cy, baseR * 0.85, ang, ang + Math.PI * 1.35);
                ctxDesign.stroke();
                // [FIX] Text "Memuat..." dihapus sesuai request
                ctxDesign.restore();
                if (t - t0 < durationMs) {
                    loadingRAF = requestAnimationFrame(frame);
                } else {
                    loadingRAF = null;
                }
            }
            if (loadingRAF) cancelAnimationFrame(loadingRAF);
            loadingRAF = requestAnimationFrame(frame);
        }

        function stopQuadLoading() {
            if (loadingRAF) {
                cancelAnimationFrame(loadingRAF);
                loadingRAF = null;
            }
        }

        function resetForNewUpload() {
            if (typeof stopQuadLoading === 'function') stopQuadLoading();
            showHandles(false);
            downloadBtn.style.display = 'none';
            showGuides = true;
            pts = [{
                x: -100,
                y: -100
            }, {
                x: -100,
                y: -100
            }, {
                x: -100,
                y: -100
            }, {
                x: -100,
                y: -100
            }];
            ctxDesign.setTransform(1, 0, 0, 1, 0, 0);
            ctxDesign.clearRect(0, 0, baseW, baseH);
        }
    </script>
@endsection