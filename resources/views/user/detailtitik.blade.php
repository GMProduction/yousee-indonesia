@extends('user.base')
@section('header')
    <meta name="description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="keyword" content="{{ $data->type->name }}">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="og:title" content="{{ $data ? $data->address : '' }}">
@endsection
@section('morecss')
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/titikseluruhindonesia.png') }}" />
        </div>
        <div class="detail-titik">
            <div class="detailtitik-content">
                <div class="detailtitik-wrapper">
                    @php
                        $imageUrl = !empty($data->image2) ? $dom . $data->image2 : null;
                    @endphp

                    @if($imageUrl)
                        <img id="mainPhoto" class="mb-4" src="{{ $imageUrl }}" onerror="this.onerror=null;this.outerHTML='<div class=\'mb-4\' style=\'width:100%; height:400px; background:#f8fafc; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#94a3b8; border-radius:12px; border:1px solid #e2e8f0;\'><span class=\'material-symbols-outlined mb-2\' style=\'font-size: 48px; color: #cbd5e1;\'>image_not_supported</span><span style=\'font-size: 14px; font-weight: 700; letter-spacing: 1px;\'>NO IMAGE</span></div>';" />
                    @else
                        <div id="mainPhoto" class="mb-4" style="width:100%; height:400px; background:#f8fafc; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#94a3b8; border-radius:12px; border:1px solid #e2e8f0;">
                            <span class="material-symbols-outlined mb-2" style="font-size: 48px; color: #cbd5e1;">image_not_supported</span>
                            <span style="font-size: 14px; font-weight: 700; letter-spacing: 1px;">NO IMAGE</span>
                        </div>
                    @endif

                    <div class="row g-3 mb-5">
                        <!-- Kolom 1 -->
                        <div class="col-12 col-md">
                            <button id="addToCartButton" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                class="btn btn-primary d-flex align-items-center justify-content-center w-100 w-md-auto">
                                <span class="material-symbols-outlined me-2" style="font-size: 20px;">menu_book</span>
                                <span style="font-size: 16px; font-weight: 600;">Read More</span>
                            </button>
                        </div>
                        <!-- Kolom 2 -->
                        <div class="col-12 col-md">
                            <button id="addToCartButton"
                                onclick="addToCart({{ $data->id }}, '{{ $data->address }}', '{{ $data->slug }}')"
                                class="btn btn-secondary d-flex align-items-center justify-content-center w-100 w-md-auto">
                                <span class="material-symbols-outlined me-2" style="font-size: 20px;">shopping_cart</span>
                                <span style="font-size: 16px; font-weight: 600;">{{ trans('messages.masukan_keranjang') }}</span>
                            </button>
                        </div>
                        <!-- Kolom 3 -->
                        <div class="col-12 col-md">
                            <a id="addToCartButton" href="{{ url(app()->getLocale() . '/titik-kami') }}"
                                class="btn btn-third d-flex align-items-center justify-content-center w-100 w-md-auto">
                                <span class="material-symbols-outlined me-2" style="font-size: 20px;">explore</span>
                                <span style="font-size: 16px; font-weight: 600;">{{ trans('messages.lihat_titik_lain') }}</span>
                            </a>
                        </div>
                        <div class="col-12 col-md">
                            <button type="button"
                                class="btnCobaMockup btn d-flex align-items-center justify-content-center w-100"
                                style="background-color:#168a5a;color:#fff;border:none;border-radius:8px;padding:13px 0;">
                                <span class="material-symbols-outlined me-2"
                                    style="color:#fff;font-size:20px;line-height:1;">image</span>
                                <span style="font-size: 16px; font-weight: 600;">{{ trans('messages.coba_mockup') }}</span>
                            </button>
                        </div>
                    </div>


                    <div class="collapse" id="collapseExample">

                        <p class="title mb-3 ">{{ trans('messages.sewa') }} {{ $data->type->name }}
                            {{ ucfirst(strtolower(trim(str_replace(['KOTA ', 'KABUPATEN '], '', $data->city->name)))) }}
                            <br> {{ $data->address }}
                        </p>

                            <div class="row g-3 px-3 mb-4">
                                <div class="col-md-4 col-sm-12">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #ecfeff; color: #06b6d4; flex-shrink: 0;">
                                            <span class="material-symbols-outlined" style="font-size: 20px;">location_on</span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.lokasi_titik') }}</p>
                                            <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->location }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #e0e7ff; color: #6366f1; flex-shrink: 0;">
                                            <span class="material-symbols-outlined" style="font-size: 20px;">location_city</span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.kota') }}</p>
                                            <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->city->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #ccfbf1; color: #14b8a6; flex-shrink: 0;">
                                            <span class="material-symbols-outlined" style="font-size: 20px;">map</span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.provinsi') }}</p>
                                            <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->city->province->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class=" border rounded position-relative ">
                                <div class="w-100 d-flex align-items-center justify-content-start pt-3 mb-3 px-3">
                                    <span class="spesifikasi">{{ trans('messages.spesifikasi') }}</span>
                                </div>
                                <!-- Updated Fresh Spesifikasi Grid -->
                                <!-- Updated Fresh Spesifikasi Grid -->
                                <div class="row p-3 g-3">
                                    <!-- ROW 1: Tipe Media, Posisi, Dimensi -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #eff6ff; color: #3b82f6; flex-shrink: 0;">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">mms</span>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.type_media') }}</p>
                                                <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->type->name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6">
                                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #fff7ed; color: #f97316; flex-shrink: 0;">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">view_agenda</span>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.posisi') }}</p>
                                                <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->position }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6">
                                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #f3e8ff; color: #a855f7; flex-shrink: 0;">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">aspect_ratio</span>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Dimensi (PxL)</p>
                                                <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->width }}m x {{ $data->height }}m</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ROW 2: Sisi, Alamat (Lebih Lebar) -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #fdf2f8; color: #ec4899; flex-shrink: 0;">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">layers</span>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.sisi') }}</p>
                                                <p class="mb-0 text-dark" style="font-weight: 700; font-size: 14px;">{{ $data->side }} Muka</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8 col-sm-12">
                                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: #f0fdf4; color: #22c55e; flex-shrink: 0;">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">location_on</span>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ trans('messages.alamat') }}</p>
                                                <p class="mb-0 text-dark" style="font-weight: 700; font-size: 13px; line-height: 1.3;">{{ $data->address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- LOKASI STRATEGIS SECTION -->
                            <div class="border rounded position-relative mt-4">
                                <div class="w-100 d-flex align-items-center justify-content-start pt-3 mb-3 px-3">
                                    <span class="spesifikasi">Tempat Strategis Terdekat</span>
                                </div>
                                <!-- Content Container with Row Row -->
                                <div class="p-3">
                                     <div id="strategic-locations-container" class="row g-3">
                                        <div class="col-12 text-center py-4">
                                            <div class="spinner-border text-warning" role="status"></div>
                                            <p class="text-muted small mt-2">Memuat data lokasi...</p>
                                        </div>
                                     </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="title-content text-center">{{ trans('messages.titik_kami_yang_lain') }} {{ $data->city->name }}</p>

    <div class="list-article" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; padding-bottom: 40px;">
        @php
            $sortedTitik = $titik->map(function($item) {
                $score = 0;
                $t = strtolower($item->type->name ?? '');
                if (str_contains($t, 'videotron') || str_contains($t, 'megatron') || str_contains($t, 'led')) $score += 50;
                elseif (str_contains($t, 'billboard')) $score += 30;
                
                $area = ($item->width ?? 0) * ($item->height ?? 0);
                if ($area > 100) $score += 20;
                elseif ($area > 50) $score += 10;
                
                $loc = strtolower(($item->address ?? '') . ' ' . ($item->location ?? ''));
                if (str_contains($loc, 'sudirman') || str_contains($loc, 'thamrin') || str_contains($loc, 'gatot')) $score += 30;
                elseif (str_contains($loc, 'tol') || str_contains($loc, 'arteri')) $score += 20;
                elseif (str_contains($loc, 'alun') || str_contains($loc, 'pusat')) $score += 15;
                elseif (str_contains($loc, 'simpang') || str_contains($loc, 'perempatan')) $score += 10;
                
                $item->ai_score = $score;
                return $item;
            })->sortByDesc('ai_score')->values();
        @endphp

        @foreach ($sortedTitik as $d)
            <a href="/{{ app()->getLocale() }}/listing/{{ $d->slug }}" class="d-flex flex-column h-100 text-decoration-none" 
               style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02); border-radius: 16px; overflow: hidden; transition: all 0.2s ease; min-height: 280px;"
               onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.05)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.02), 2px 4px -1px rgba(0,0,0,0.02)';">
                
                <!-- Image / Fallback -->
                <div style="aspect-ratio: 4/3; overflow: hidden; background: #f8fafc; position: relative; flex-shrink: 0;">
                    @if($loop->index < 5)
                        <div style="position:absolute; top:12px; right:12px; background:linear-gradient(90deg, #f97316, #ea580c); color:white; padding:4px 10px; border-radius:30px; font-size:9px; font-weight:700; display:flex; align-items:center; gap:4px; box-shadow:0 4px 6px rgba(249, 115, 22, 0.3); z-index:10; letter-spacing: 0.5px;">
                            <span class="material-symbols-outlined" style="font-size:12px;">verified</span> REKOMENDASI
                        </div>
                    @endif
                    @if($d->image2)
                        <img src="{{ $dom . $d->image2 }}" class="w-100 h-100 object-fit-cover" style="object-fit: cover;" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                        <div style="display:none;" class="flex-column align-items-center justify-content-center w-100 h-100 text-muted">
                            <span class="material-symbols-outlined mb-2" style="font-size: 32px; color: #cbd5e1;">image_not_supported</span>
                            <span style="font-size: 10px; font-weight: 700; color: #94a3b8; letter-spacing: 1px;">NO IMAGE</span>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center w-100 h-100 text-muted">
                            <span class="material-symbols-outlined mb-2" style="font-size: 32px; color: #cbd5e1;">image_not_supported</span>
                            <span style="font-size: 10px; font-weight: 700; color: #94a3b8; letter-spacing: 1px;">NO IMAGE</span>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <div class="mb-3">
                         <h5 class="text-dark mb-0" style="font-weight: 700; font-size: 14px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $d->address }}
                        </h5>
                    </div>
                    
                    <div class="mt-auto d-flex align-items-center gap-2 text-muted" style="border-top: 1px solid #f1f5f9; padding-top: 12px;">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 24px; height: 24px; background: #f1f5f9; color: #64748b; flex-shrink: 0;">
                            <span class="material-symbols-outlined" style="font-size: 14px;">location_on</span>
                        </div>
                        <span class="text-uppercase" style="font-size: 11px; font-weight: 600; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $d->city->province->name }}, {{ $d->city->name }}
                        </span>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
@endsection

@section('morejs')
    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.detail-titik', slideUp);
        });
    </script>

    <!-- GOOGLE MAPS API (Async Load) -->
    <script>
        (function() {
            var script = document.createElement('script');
            script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCKgDP4LOkniDYckfr3FuRW45G56yVhnnI&loading=async&libraries=places&callback=initStrategicLocations";
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        })();

        function initStrategicLocations() {
            const itemData = {
                latitude: {{ $data->latitude ?? 0 }},
                longitude: {{ $data->longitude ?? 0 }},
                address: "{{ $data->address ?? '' }}",
                location: "{{ $data->location ?? '' }}",
                city: "{{ $data->city->name ?? '' }}"
            };

            const container = document.getElementById('strategic-locations-container');
            if (!container || !itemData.latitude) return;

            const dummyMap = document.createElement('div');
            const service = new google.maps.places.PlacesService(dummyMap);
            const latlng = { lat: parseFloat(itemData.latitude), lng: parseFloat(itemData.longitude) };

            // Helper: Haversine
            function haversineDistance(lat1, lon1, lat2, lon2) {
                const R = 6371; 
                const dLat = (lat2 - lat1) * (Math.PI / 180);
                const dLon = (lon2 - lon1) * (Math.PI / 180);
                const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                          Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
                          Math.sin(dLon / 2) * Math.sin(dLon / 2);
                return 2 * R * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            }

            // Fallback Logic
            const renderFallback = (existingItems = []) => {
                const text = (itemData.address + ' ' + itemData.location).toLowerCase();
                let fallbacks = [...existingItems];
                
                const keywords = [
                    { key: 'tol', label: 'Akses Jalan Tol' },
                    { key: 'terminal', label: 'Transportasi Umum' },
                    { key: 'stasiun', label: 'Transportasi Umum' },
                    { key: 'pasar', label: 'Pasar Modern/Tradisional' },
                    { key: 'mall', label: 'Pusat Perbelanjaan' },
                    { key: 'plaza', label: 'Pusat Perbelanjaan' },
                    { key: 'kampus', label: 'Kawasan Pendidikan' },
                    { key: 'univ', label: 'Kawasan Pendidikan' },
                    { key: 'sekolah', label: 'Kawasan Pendidikan' },
                    { key: 'rs', label: 'Fasilitas Kesehatan' },
                    { key: 'sakit', label: 'Fasilitas Kesehatan' },
                    { key: 'bank', label: 'Fasilitas Perbankan' },
                    { key: 'kantor', label: 'Area Perkantoran' },
                    { key: 'wisata', label: 'Kawasan Wisata' }
                ];

                // distinct categories
                keywords.forEach(k => {
                    if (text.includes(k.key) && fallbacks.length < 6) {
                        // Avoid adding same category multiple times loosely
                        if(!fallbacks.find(f => f.name === k.label)) {
                            fallbacks.push({ name: k.label, specifics: 'Area Sekitar', dist: 'Dekat Lokasi', isFallback: true });
                        }
                    }
                });

                if (itemData.city && fallbacks.length < 6) {
                    fallbacks.push({ name: 'Pusat Kota', specifics: itemData.city, dist: '2-5 km', isFallback: true });
                    fallbacks.push({ name: 'Kawasan Bisnis', specifics: itemData.city, dist: 'Area Strategis', isFallback: true });
                }

                renderList(fallbacks.slice(0, 6));
            };

            const renderList = (places) => {
                if (!places.length) {
                    container.innerHTML = '<div class="col-12"><div class="text-muted text-center py-3">Tidak ada data lokasi strategis.</div></div>';
                    return;
                }
                
                const html = places.map((p, i) => {
                    // Determine Category & Specific Name
                    let category = p.name; 
                    let specificName = p.name;
                    
                    // If it is a fallback item, it has structure pre-defined
                    if(p.isFallback) {
                        category = p.name;
                        specificName = p.specifics || '';
                    } else {
                        // Real Google Data Mapping
                        const types = p.types || [];
                        const n = p.name.toLowerCase();
                        
                        if (n.includes('tol') || types.includes('highway_entry')) category = 'Akses Jalan Tol';
                        else if (types.includes('shopping_mall') || n.includes('mall') || n.includes('plaza')) category = 'Pusat Perbelanjaan';
                        else if (types.includes('bank') || types.includes('finance')) category = 'Fasilitas Perbankan';
                        else if (types.includes('school') || types.includes('university') || n.includes('kampus')) category = 'Kawasan Pendidikan';
                        else if (types.includes('hospital') || types.includes('doctor') || n.includes('rs')) category = 'Fasilitas Kesehatan';
                        else if (types.includes('tourist_attraction') || types.includes('park')) category = 'Kawasan Wisata';
                        else if (types.includes('train_station') || types.includes('bus_station') || n.includes('stasiun')) category = 'Transportasi Umum';
                        else if (types.includes('local_government_office') || n.includes('kantor')) category = 'Area Perkantoran';
                        else if (types.includes('market') || n.includes('pasar')) category = 'Pasar Modern/Tradisional';
                        else if (n.includes('masjid') || n.includes('gereja')) category = 'Tempat Ibadah';
                        else category = 'Area Lainnya'; // Fallback category
                    }

                    const distDisplay = p.dist || (p._realDistance ? p._realDistance.toFixed(1) + ' km' : '-');
                    
                    // ICON Styling
                    let iconName = 'near_me';
                    let bgColor = '#fff7ed'; let color='#f97316';
                    
                    if(category === 'Pusat Perbelanjaan') { iconName='local_mall'; bgColor='#f0fdf4'; color='#16a34a'; }
                    else if(category === 'Kawasan Pendidikan') { iconName='school'; bgColor='#eff6ff'; color='#2563eb'; }
                    else if(category === 'Fasilitas Kesehatan') { iconName='local_hospital'; bgColor='#fef2f2'; color='#dc2626'; }
                    else if(category === 'Transportasi Umum') { iconName='train'; bgColor='#f5f3ff'; color='#7c3aed'; }
                    else if(category === 'Akses Jalan Tol') { iconName='toll'; bgColor='#fff7ed'; color='#c2410c'; }
                    else if(category === 'Fasilitas Perbankan') { iconName='account_balance'; bgColor='#ecfccb'; color='#4d7c0f'; }
                    else if(category === 'Area Perkantoran' || category === 'Kawasan Bisnis') { iconName='business'; bgColor='#f8fafc'; color='#475569'; }
                    else if(category === 'Kawasan Wisata') { iconName='attractions'; bgColor='#fff1f2'; color='#be123c'; }
                    else if(category === 'Tempat Ibadah') { iconName='church'; bgColor='#fefce8'; color='#ca8a04'; }

                    return `
                    <div class="col-md-4 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 h-100" style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition:transform 0.2s;" onmouseover="this.style.borderColor='${color}'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#f1f5f9'; this.style.transform='translateY(0)'">
                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 42px; height: 42px; background: ${bgColor}; color: ${color}; flex-shrink: 0;">
                                <span class="material-symbols-outlined" style="font-size: 20px;">${iconName}</span>
                            </div>
                            <div class="w-100 text-center">
                                <p class="mb-1 text-dark" style="font-weight: 700; font-size: 13px; line-height: 1.3;">${category}</p>
                                <div class="d-flex flex-column align-items-center justify-content-center text-muted" style="font-size: 11px; font-weight: 600;">
                                     <span style="font-size:10px; color:#64748b; margin-bottom:2px;">${specificName !== category ? specificName : ''}</span>
                                     <div class="d-flex align-items-center gap-1">
                                         <span class="material-symbols-outlined" style="font-size:12px;">distance</span> 
                                         <span>${distDisplay}</span>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                }).join('');
                container.innerHTML = html;
            };

            // SEARCH (Aligned with Map Popup Logic)
            const context = itemData.location || itemData.address || itemData.city || '';
            const query = `landmark, hospital, mall, school, university, office, bank, market near ${context}`;
            const request = {
                query: query,
                location: latlng,
                radius: 2500 // Aligned with Map Popup (2.5 KM)
            };

            service.textSearch(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                    const validPlaces = results.map(p => {
                        const placeLoc = p.geometry.location;
                        const distKm = haversineDistance(latlng.lat, latlng.lng, placeLoc.lat(), placeLoc.lng());
                        p._realDistance = distKm;
                        return p;
                    })
                    .filter(p => p._realDistance <= 3.0) // Strict 3.0 KM Limit (Matches Map)
                    .sort((a,b) => b.user_ratings_total - a.user_ratings_total)
                    .slice(0, 6); // Max 6

                     if (validPlaces.length === 0) {
                         renderFallback([]);
                     } else {
                         renderList(validPlaces);
                     }
                } else {
                    renderFallback([]);
                }
            });
        }
    </script>
    <script>
        // UPDATED: Langsung redirect ke Mockup (karena deteksi dipindah ke Client-Side)
        // Menggunakan Class Selector agar support multiple button (Mobile/Desktop)
        const imgEl = document.getElementById('mainPhoto');
        const btns = document.querySelectorAll('.btnCobaMockup');

        function absUrl(u) {
            try { return new URL(u, location.href).href; } 
            catch { return u; }
        }

        if (btns.length > 0 && imgEl) {
            btns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // [VALIDASI] Cek apakah gambar benar-benar ada/terload
                    if (!imgEl.src || imgEl.naturalWidth === 0) {
                        return alert('Maaf gambar kosong blm bisa diproses');
                    }
                    
                    const fullImgUrl = absUrl(imgEl.src);
                    
                    // Cek apakah domain gambar beda dengan domain sekarang
                    const imgDomain = new URL(fullImgUrl).hostname;
                    const currentDomain = location.hostname;
                    
                    let finalUrl = fullImgUrl;
                    if (imgDomain !== currentDomain) {
                        finalUrl = `{{ route('image.proxy') }}?url=${encodeURIComponent(fullImgUrl)}`;
                    }
                    
                    location.href = `{{ route('mockup') }}?img=${encodeURIComponent(finalUrl)}`;
                });
            });
        }
    </script>
@endsection
