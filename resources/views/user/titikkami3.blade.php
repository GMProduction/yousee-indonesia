@extends('user.base')

@section('morecss')
    <style>
        .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container .select2-selection--single {
            height: 36px !important;
            border: 1px solid #ddd;
        }

        .select2-selection__arrow {
            height: 36px !important;
        }

        #main-map {
            position: relative;
            height: calc(100vh - 180px);
            min-height: 420px;
            width: 100%;
        }

        #single-map-container {
            height: 450px;
            width: 100%;
        }

        .chip-btn {
            padding: .5rem .9rem;
            border: 1px solid #e5e7eb;
            border-radius: 9999px;
            background: #fff;
            font-size: 14px
        }

        .chip-btn.active {
            background: #1d4ed8;
            color: #fff;
            border-color: #1d4ed8
        }

        #filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            margin: 0;
            padding: 4px 0;
        }

        #filter-chips .chip-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 9999px;
            background: #fff;
            font-size: 14px;
            line-height: 1;
            white-space: nowrap;
            box-shadow: 0 1px 0 rgba(0, 0, 0, .02);
        }

        #filter-chips .chip-btn.active {
            background: #1d4ed8;
            color: #fff;
            border-color: #1d4ed8;
        }

        @media (hover:hover) {
            #filter-chips .chip-btn:hover {
                background: #f8fafc;
            }
        }

        @media (max-width:520px) {
            #filter-chips {
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x proximity;
                gap: 8px;
                padding: 6px 6px 10px;
            }

            #filter-chips .chip-btn {
                flex: 0 0 auto;
                scroll-snap-align: center;
                font-size: 13px;
                padding: 8px 12px;
            }

            #filter-chips::-webkit-scrollbar {
                height: 0;
            }

            #filter-chips {
                scrollbar-width: none;
            }
        }

        #savedSearches .chip-btn {
            display: inline-flex;
            align-items: center;
            max-width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #374151;
        }

        #savedSearches .chip-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1 1 auto;
        }

        #savedSearches .chip-close {
            flex: 0 0 auto;
            cursor: pointer;
            margin-left: 6px;
            font-size: 18px;
            font-weight: bold;
            line-height: 1;
            padding: 0 4px;
            color: #dc2626;
        }

        #savedSearches .chip-close:hover {
            color: #b91c1c;
        }

        #savedSearches>div {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        .loading-overlay {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 90%;
            max-width: 360px;
        }

        .progress-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            background: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .progress-bar {
            height: 20px;
            width: 0%;
            background: #1d4ed8;
            color: #fff;
            text-align: center;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/carititik' . (app()->getLocale() === 'en' ? '_engver' : '') . '.png') }}"
                class="img-titikseluruhindonesia" />
        </div>

        <div class="pencarian-container peta">
            <div class="pencarian-content w-100">
                <div class="pencarian-wrapper">

                    <div class="d-flex justify-content-between align-items-center">
                        <p class="title">{{ trans('messages.tersedia_titik_seluruh_indonesia') }}</p>
                        <button type="button" class="btn-detail-item d-flex align-items-center btn-cara-pesan"
                            data-bs-toggle="modal" data-bs-target="#caraPesanModal">
                            Cara Pesan <span class="material-symbols-outlined ms-1">help_outline</span>
                        </button>
                    </div>



                    <div id="loading" class="loading-overlay">
                        <div class="progress-container">
                            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <p class="loading-text mt-2">{{ trans('messages.mohon_tunggu_sebentar') }}</p>
                    </div>

                    <div id="searchArea" class="row g-3 justify-content-center my-3">
                        <div class="col-12 col-lg-2">
                            <select class="form-select" id="provinsiSelect">
                                <option value="">{{ __('Pilih Provinsi') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-2">
                            <select class="form-select" id="kotaSelect" disabled>
                                <option value="">{{ __('Pilih Kota') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="d-flex justify-content-center">
                                <div class="input-group w-100" style="max-width:720px">
                                    <span class="input-group-text">🔎</span>
                                    <input class="form-control" id="searchInput"
                                        placeholder="{{ __('Contoh: Dekat Kampus ITB Bandung') }}">
                                    <button class="btn btn-primary" id="searchBtn">{{ __('Cari') }}</button>
                                    <button class="btn btn-success ms-2" id="addPointBtn"
                                        style="display:none;">{{ __('Tambah Titik') }}</button>
                                </div>
                            </div>
                        </div>

                        <div class="w-100 px-5 mt-3">
                            <div id="filter-chips" class="d-flex flex-wrap gap-2 justify-content-center">
                                <button class="chip-btn active" data-type="">{{ __('Semua') }}</button>
                                <button class="chip-btn" data-type="1">Baliho</button>
                                <button class="chip-btn" data-type="2">Billboard</button>
                                <button class="chip-btn" data-type="3">Bando Jalan</button>
                                <button class="chip-btn" data-type="4">LED Banner</button>
                                <button class="chip-btn" data-type="5">JPO</button>
                                <button class="chip-btn" data-type="6">Videotron</button>
                                <button class="chip-btn" data-type="7">Megatron</button>
                                <button class="chip-btn" data-type="8">Vertikal Banner</button>
                                <button class="chip-btn" data-type="9">Minibaliho</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 mx-auto d-none" id="radiusGroup">
                        <div class="d-flex justify-content-center">
                            <div class="d-flex align-items-center gap-2 w-100" style="max-width:720px">
                                <small class="text-muted">Radius (km)</small>
                                <input class="form-range" id="radiusSlider" type="range" min="0.5" max="30"
                                    step="0.5" disabled style="flex:1">
                                <input class="form-control text-end" id="radiusNumber" type="number" min="0.5"
                                    max="30" step="0.5" disabled style="width:90px">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <div class="d-none" id="savedSearches">
                            <div class="d-flex flex-wrap justify-content-center gap-2"></div>
                        </div>
                    </div>

                    <div id="pillSearch" class="mb-2 pillsearch"></div>

                    <section class="container px-3 px-lg-4 my-3" id="yousee-map-card">
                        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                            <div id="main-map"></div>
                            <div class="p-3 p-md-4 border-top bg-white">
                                <div class="small text-muted mt-2 d-none" id="searchMeta"></div>
                                <div id="results" class="p-3 p-md-4" style="max-height: 42vh; overflow:auto;"></div>
                            </div>
                        </div>
                    </section>
                    <div class="mx-4">
                        <p class="fw-bold mt-3" style="text-align:left">{{ trans('messages.keterangan') }} :</p>
                        <div class="row">
                            @foreach ($type as $d)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3" style="text-align:left">
                                    <img src="{{ $dom . $d->icon }}" />
                                    <span class="ms-3">{{ $d->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('user.item-modal')

        <p class="title-content text-center">{{ trans('messages.titik_kami') }}</p>
        <div class="section-description">
            <p>{{ trans('messages.kami_bangga_memiliki_jaringan') }}</p>
        </div>
        <div class="w-100">
            <div class="list-titik"></div>
        </div>
        <div id="list-container"></div>
        <div id="pagination"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="caraPesanModal" tabindex="-1" aria-labelledby="caraPesanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- ubah ke xl biar lebih besar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="caraPesanLabel">Cara Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center p-0"> <!-- hilangkan padding agar video penuh -->
                    <div class="ratio ratio-16x9">
                        <iframe id="caraPesanVideo" src="https://www.youtube.com/embed/x1fvbSEYFho?si=JEhSS9MgYvKhMKKv"
                            title="Cara Pesan" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        window.translations = Object.assign({
            tanya_ketersediaan_titik: "Tanya Ketersediaan titik",
            keranjang_kosong: "Keranjang Kosong",
            semua_provinsi: "Semua Provinsi",
            semua_kota: "Semua Kota",
            semua_tipe: "Semua Tipe",
        }, window.translations || {});
    </script>

    <script src="{{ asset('js/map-control6.js') }}?v=2"></script>

    <script>
        document.addEventListener('hidden.bs.modal', function(event) {
            if (event.target.id === 'caraPesanModal') {
                const iframe = document.getElementById('caraPesanVideo');
                if (iframe) {
                    const src = iframe.src;
                    iframe.src = ''; // kosongkan dulu
                    iframe.src = src; // lalu kembalikan untuk reload (berhenti otomatis)
                }
            }
        });
    </script>


    <script>
        window.MAP_FILTERS = window.MAP_FILTERS || {
            province: '',
            city: '',
            type: '',
            position: ''
        };

        function setLoading(v) {
            const ld = document.getElementById('loading');
            if (ld) ld.style.display = v ? 'block' : 'none';
            const b = document.getElementById('searchBtn');
            if (b) b.disabled = !!v;
        }

        function updateProgress(p) {
            const bar = document.getElementById('progress-bar');
            if (!bar) return;
            const x = Math.min(100, Math.max(0, p));
            bar.style.width = x + '%';
            bar.setAttribute('aria-valuenow', x);
            bar.innerText = x + '%';
        }

        function showRadiusUI() {
            document.getElementById('radiusGroup')?.classList.remove('d-none');
            document.getElementById('radiusSlider').disabled = false;
            document.getElementById('radiusNumber').disabled = false;
        }

        function hideRadiusUI() {
            document.getElementById('radiusGroup')?.classList.add('d-none');
            document.getElementById('radiusSlider').disabled = true;
            document.getElementById('radiusNumber').disabled = true;
        }

        window.ACTIVE_MARKERS = window.ACTIVE_MARKERS || [];
        window.ACTIVE_PAYLOAD = window.ACTIVE_PAYLOAD || [];
        window.RADIUS_CIRCLE = window.RADIUS_CIRCLE || null;
        window.SEARCH_CENTER = window.SEARCH_CENTER || null;
        window.SEARCH_RADIUS_KM = (typeof window.SEARCH_RADIUS_KM !== 'undefined') ? window.SEARCH_RADIUS_KM : null;
        window.__resetting = window.__resetting || false;

        window.MARKER_BY_ID = window.MARKER_BY_ID || new Map();
        window.MARKER_BY_SLUG = window.MARKER_BY_SLUG || new Map();

        function nearestIdx(pool, lat, lng) {
            let best = -1,
                score = Infinity;
            for (let i = 0; i < pool.length; i++) {
                const m = pool[i];
                if (!m) continue;
                try {
                    const pos = m.getPosition();
                    const s = Math.abs((pos.lat() || 0) - lat) + Math.abs((pos.lng() || 0) - lng);
                    if (s < score) {
                        score = s;
                        best = i;
                    }
                } catch {}
            }
            return best;
        }

        function buildMarkerMapping(payload) {
            window.MARKER_BY_ID.clear();
            window.MARKER_BY_SLUG.clear();
            const pool = (window.multi_marker || []).slice();
            (payload || []).forEach(p => {
                const idx = nearestIdx(pool, p.latitude, p.longitude);
                const marker = idx >= 0 ? pool.splice(idx, 1)[0] : null;
                if (marker) {
                    if (p.id != null) window.MARKER_BY_ID.set(String(p.id), marker);
                    if (p.slug) window.MARKER_BY_SLUG.set(String(p.slug), marker);
                }
            });
        }

        function getMarkerForItem(d) {
            if (!d) return null;
            if (d.id != null && window.MARKER_BY_ID.has(String(d.id))) return window.MARKER_BY_ID.get(String(d.id));
            if (d.slug && window.MARKER_BY_SLUG.has(String(d.slug))) return window.MARKER_BY_SLUG.get(String(d.slug));
            const all = window.multi_marker || [];
            const idx = nearestIdx(all, d.latitude, d.longitude);
            return idx >= 0 ? all[idx] : null;
        }

        window.generateGoogleMapData = async function() {
            try {
                setLoading(true);
                updateProgress(5);

                const progressTimer = setInterval(() => {
                    const now = parseInt(document.getElementById('progress-bar').getAttribute(
                        'aria-valuenow') || '0', 10);
                    if (now < 90) updateProgress(now + 10);
                }, 300);

                const selectedTypes = (MAP_FILTERS.type || '')
                    .split(',').map(s => s.trim()).filter(Boolean);

                const query = {
                    province: MAP_FILTERS.province || '',
                    city: MAP_FILTERS.city || '',
                    position: MAP_FILTERS.position || ''
                };
                if (selectedTypes.length === 1) query.type = selectedTypes[0];

                const response = await $.get('/map/data?' + $.param(query));
                let payload = (response && response.payload) ? response.payload : [];

                payload = payload.filter(item => {
                    const lat = item.latitude,
                        lng = item.longitude;
                    return lat >= -11.0 && lat <= 6.1 && lng >= 95.0 && lng <= 141.0;
                });

                if (selectedTypes.length > 1) {
                    const pick = new Set(selectedTypes.map(String));
                    const getTypeId = (p) => {
                        return String(
                            (p.type && (p.type.id ?? p.type.type_id ?? p.type.typeId)) ??
                            p.type_id ?? p.typeId ?? p.type ?? ''
                        );
                    };
                    payload = payload.filter(p => pick.has(getTypeId(p)));
                }

                removeMultiMarker?.();
                if (payload.length > 0) {
                    window.currentPage = 1;
                    await createGoogleMapMarker(payload);
                    updateListTitik?.(payload);
                }

                window.ACTIVE_MARKERS = (window.multi_marker || []).slice();
                window.ACTIVE_PAYLOAD = payload.slice();
                buildMarkerMapping(window.ACTIVE_PAYLOAD);

                if (!window.__resetting && window.SEARCH_CENTER && window.SEARCH_RADIUS_KM) {
                    applyRadiusFilter(window.SEARCH_CENTER, window.SEARCH_RADIUS_KM);
                } else if (window.__resetting) {
                    forceShowAllMarkers();
                }

                clearInterval(progressTimer);
                updateProgress(100);
            } catch (e) {
                console.error('[generateGoogleMapData override] error:', e);
            } finally {
                setTimeout(() => setLoading(false), 300);
            }
        };

        function forceShowAllMarkers() {
            const mapObj = window.map_container || window.map;
            if (!mapObj) return;
            (window.multi_marker || []).forEach(m => m?.setMap?.(mapObj));
            (window.ACTIVE_MARKERS || []).forEach(m => m?.setMap?.(mapObj));
            if (window.markerCluster) {
                try {
                    markerCluster.clearMarkers();
                    markerCluster.addMarkers(window.multi_marker || []);
                } catch (e) {}
            }
        }

        const provCache = new Map();

        async function loadProvinces() {
            try {
                const res = await fetch('/data/province');
                const data = await res.json();
                const sel = document.getElementById('provinsiSelect');
                sel.innerHTML = `<option value="">${window.translations?.semua_provinsi || 'Pilih Provinsi'}</option>`;
                provCache.clear();
                (data || []).forEach(p => {
                    const id = String(p.id);
                    provCache.set(id, p.name);
                    sel.insertAdjacentHTML('beforeend',
                        `<option value="${id}" data-name="${p.name}">${p.name}</option>`);
                });
            } catch (e) {
                console.error('Gagal load provinsi', e);
                const sel = document.getElementById('provinsiSelect');
                if (sel) sel.innerHTML =
                    `<option value="">${window.translations?.semua_provinsi || 'Pilih Provinsi'}</option>`;
            }
        }

        window.ALL_CITIES_CACHE = window.ALL_CITIES_CACHE || null;

        function populateCitySelect(list) {
            const kota = document.getElementById('kotaSelect');
            if (!kota) return;
            kota.removeAttribute('disabled');
            kota.innerHTML = `<option value="">${window.translations?.semua_kota || 'Pilih Kota'}</option>`;
            (list || []).forEach(c => {
                const id = String(c.id);
                const name = String(c.name || c.nama || '').trim();
                const prov = c.province_id || c.provinceId || '';
                kota.insertAdjacentHTML('beforeend',
                    `<option value="${id}" data-name="${name}" data-province-id="${prov}">${name}</option>`);
            });
        }

        async function loadAllCities() {
            if (Array.isArray(window.ALL_CITIES_CACHE) && window.ALL_CITIES_CACHE.length) {
                populateCitySelect(window.ALL_CITIES_CACHE);
                return;
            }
            try {
                const res = await fetch('/data/city', {
                    cache: 'no-cache'
                });
                if (res.ok) {
                    const json = await res.json();
                    window.ALL_CITIES_CACHE = Array.isArray(json) ? json : (json.data || []);
                    populateCitySelect(window.ALL_CITIES_CACHE);
                    return;
                }
            } catch (e) {
                console.warn('Endpoint /data/city tidak ada, fallback ke agregasi /province/{id}/city');
            }

            try {
                if (!provCache.size) await loadProvinces();
                const ids = Array.from(provCache.keys());
                const chunks = await Promise.all(ids.map(id =>
                    fetch(`/data/province/${id}/city`).then(r => (r.ok ? r.json() : [])).catch(() => [])
                ));
                window.ALL_CITIES_CACHE = chunks.flat();
                populateCitySelect(window.ALL_CITIES_CACHE);
            } catch (e) {
                console.error('Gagal memuat semua kota', e);
                populateCitySelect([]);
            }
        }

        async function loadCities(provId) {
            const kota = document.getElementById('kotaSelect');
            if (kota) kota.removeAttribute('disabled');
            if (!provId) {
                await loadAllCities();
                return;
            }
            try {
                const res = await fetch(`/data/province/${provId}/city`);
                if (!res.ok) throw new Error('Gagal load kota');
                const data = await res.json();
                populateCitySelect(data || []);
            } catch (e) {
                console.error(e);
                if (kota) kota.innerHTML = '<option value="">Gagal load kota</option>';
            }
        }

        function hookFilterChips() {
            const MAX_TYPES = 3;
            const chips = document.querySelectorAll('#filter-chips .chip-btn');

            function activeTypeIds() {
                return Array.from(document.querySelectorAll('#filter-chips .chip-btn.active'))
                    .map(b => b.dataset.type).filter(Boolean);
            }

            function setSemuaActive(on) {
                const allBtn = document.querySelector('#filter-chips .chip-btn[data-type=""]');
                if (allBtn) allBtn.classList.toggle('active', !!on);
            }

            chips.forEach(btn => {
                btn.addEventListener('click', () => {
                    const isAll = (btn.dataset.type || '') === '';

                    if (isAll) {
                        chips.forEach(b => {
                            if (b !== btn) b.classList.remove('active');
                        });
                        btn.classList.add('active');
                    } else {
                        setSemuaActive(false);

                        if (btn.classList.contains('active')) {
                            btn.classList.remove('active');
                            if (activeTypeIds().length === 0) setSemuaActive(true);
                        } else {
                            const count = activeTypeIds().length;
                            if (count >= MAX_TYPES) {
                                alert(`Maksimal pilih ${MAX_TYPES} tipe ya 😊`);
                                return;
                            }
                            btn.classList.add('active');
                        }
                    }

                    const types = activeTypeIds();
                    MAP_FILTERS.type = types.join(',');

                    if (types.length) localStorage.setItem('s_tipe', MAP_FILTERS.type);
                    else localStorage.removeItem('s_tipe');

                    if (typeof datatableItem === 'function') datatableItem();
                    generateGoogleMapData();
                });
            });
        }

        function kmBetween(lat1, lon1, lat2, lon2) {
            const R = 6371,
                dLat = (lat2 - lat1) * Math.PI / 180,
                dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(
                dLon / 2) ** 2;
            return 2 * R * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        }

        function renderRadiusResults(items, center, radiusKm, displayName) {
            const meta = document.getElementById('searchMeta');
            const results = document.getElementById('results');
            if (meta) {
                meta.classList.remove('d-none');
                meta.textContent = `Lokasi: ${displayName || '-'} • Radius: ${radiusKm} km • Ditemukan: ${items.length}`;
            }
            if (!results) return;
            if (!items.length) {
                results.innerHTML = '<div class="text-muted small">Tidak ada titik dalam radius tersebut.</div>';
                return;
            }

            const html = items.slice(0, 200).map((d, i) => `
    <div class="border rounded-3 p-3 mb-2">
      <div class="fw-semibold">${d.location || d.name || '-'}</div>
      <div class="text-muted small">${d.address || ''}</div>
      <div class="mt-2 d-flex justify-content-center gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-go="${i}">Pergi ke Lokasi</button>
        <a class="btn btn-sm btn-primary" target="_blank" rel="noopener noreferrer" href="/${(window.location.pathname.split('/')[1]||'id')}/listing/${d.slug}">Lihat Detail</a>
      </div>
    </div>
  `).join('');
            results.innerHTML = html;

            results.querySelectorAll('[data-go]').forEach(btn => {
                btn.addEventListener('click', e => {
                    const idx = +e.currentTarget.getAttribute('data-go');
                    const d = items[idx];
                    if (!d || !window.map_container) return;

                    const marker = getMarkerForItem(d);
                    if (marker) {
                        try {
                            if (!marker.getMap()) marker.setMap(window.map_container);
                        } catch (_) {}
                        const pos = marker.getPosition ? marker.getPosition() : new google.maps.LatLng(d
                            .latitude, d.longitude);

                        if (window.__OPEN_INFO_WINDOW) {
                            try {
                                window.__OPEN_INFO_WINDOW.close();
                            } catch (e) {}
                        }

                        window.map_container.setCenter(pos);
                        window.map_container.setZoom(16);
                        google.maps.event.trigger(marker, 'click');
                    } else {
                        window.map_container.setCenter({
                            lat: d.latitude,
                            lng: d.longitude
                        });
                        window.map_container.setZoom(16);
                    }
                });
            });
        }

        function applyRadiusFilter(center, radiusKm, displayName) {
            if (!window.map_container) return;
            window.SEARCH_CENTER = {
                lat: center.lat,
                lng: center.lng
            };
            window.SEARCH_RADIUS_KM = radiusKm;

            if (window.RADIUS_CIRCLE) window.RADIUS_CIRCLE.setMap(null);
            window.RADIUS_CIRCLE = new google.maps.Circle({
                strokeColor: '#4F46E5',
                strokeOpacity: 0.7,
                strokeWeight: 1,
                fillColor: '#6366F1',
                fillOpacity: 0.09,
                map: window.map_container,
                center: window.SEARCH_CENTER,
                radius: radiusKm * 1000
            });

            const inside = [];
            window.ACTIVE_PAYLOAD.forEach((p) => {
                const m = getMarkerForItem(p);
                if (!m) return;
                const dist = kmBetween(center.lat, center.lng, p.latitude, p.longitude);
                if (dist <= radiusKm) {
                    m.setMap(window.map_container);
                    inside.push(p);
                } else {
                    m.setMap(null);
                }
            });

            window.map_container.fitBounds(window.RADIUS_CIRCLE.getBounds());
            renderRadiusResults(inside, center, radiusKm, displayName);
        }

        function geocodeAddress(addr) {
            return new Promise((resolve) => {
                const g = new google.maps.Geocoder();
                g.geocode({
                    address: addr
                }, (res, status) => {
                    if (status === 'OK' && res && res[0]) {
                        const r = res[0];
                        resolve({
                            lat: r.geometry.location.lat(),
                            lng: r.geometry.location.lng(),
                            displayName: r.formatted_address
                        });
                    } else resolve(null);
                });
            });
        }

        async function runSearch() {
            const q = (document.getElementById('searchInput').value || '').trim();
            if (!q) {
                alert('Pastikan nama lokasi yang kamu input sudah benar ya');
                return;
            }
            setLoading(true);
            updateProgress(15);

            const geo = await geocodeAddress(q);
            if (!geo) {
                alert('Lokasi tidak ditemukan');
                setLoading(false);
                return;
            }

            const initR = (window.SEARCH_RADIUS_KM ?? 30);
            document.getElementById('radiusSlider').value = initR;
            document.getElementById('radiusNumber').value = initR;
            showRadiusUI();

            applyRadiusFilter({
                lat: geo.lat,
                lng: geo.lng
            }, initR, geo.displayName);

            document.getElementById('addPointBtn').style.display = 'inline-block';
            setLoading(false);
        }

        const savedContainer = () => document.querySelector('#savedSearches > div');
        const savedWrap = () => document.getElementById('savedSearches');
        const SAVED = [];

        function onSavedChipsEmpty() {
            const wrap = document.getElementById('savedSearches');
            const cont = document.querySelector('#savedSearches > div');
            if (!wrap || !cont) return;
            if (!cont.querySelector('.saved-chip')) {
                wrap.classList.add('d-none');
                if (typeof window.resetUIToInitial === 'function') window.resetUIToInitial();
            }
        }

        function addSavedChip(state) {
            const wrap = savedWrap();
            const cont = savedContainer();
            if (!wrap || !cont) return;

            wrap.classList.remove('d-none');
            const chip = document.createElement('button');
            chip.className = 'chip-btn saved-chip';
            chip.innerHTML = `<span class="chip-text">${state.q}</span><span class="chip-close ms-1">&times;</span>`;

            chip.addEventListener('click', async () => {
                document.getElementById('searchInput').value = state.q;
                document.getElementById('radiusSlider').value = state.radius;
                document.getElementById('radiusNumber').value = state.radius;

                document.querySelectorAll('#filter-chips .chip-btn').forEach(b => b.classList.remove('active'));

                const types = (state.type || '').split(',').filter(Boolean);
                if (types.length === 0) {
                    const allBtn = document.querySelector('#filter-chips .chip-btn[data-type=""]');
                    if (allBtn) allBtn.classList.add('active');
                } else {
                    types.forEach(t => {
                        const b = document.querySelector(`#filter-chips .chip-btn[data-type="${t}"]`);
                        if (b) b.classList.add('active');
                    });
                }

                MAP_FILTERS.type = (types.join(',') || '');

                const provSel = document.getElementById('provinsiSelect');
                const kotaSel = document.getElementById('kotaSelect');
                provSel.value = state.province || '';
                await loadCities(state.province || '');
                kotaSel.value = state.city || '';

                MAP_FILTERS.province = state.province || '';
                MAP_FILTERS.city = state.city || '';
                MAP_FILTERS.type = state.type || '';

                if (MAP_FILTERS.province) localStorage.setItem('s_provinsi', MAP_FILTERS.province);
                else localStorage.removeItem('s_provinsi');
                if (MAP_FILTERS.city) localStorage.setItem('s_kota', MAP_FILTERS.city);
                else localStorage.removeItem('s_kota');
                if (MAP_FILTERS.type) localStorage.setItem('s_tipe', MAP_FILTERS.type);
                else localStorage.removeItem('s_tipe');

                await generateGoogleMapData();

                const geo = await geocodeAddress(state.q);
                if (geo) {
                    showRadiusUI();
                    applyRadiusFilter({
                        lat: geo.lat,
                        lng: geo.lng
                    }, state.radius, geo.displayName);
                }
            });

            chip.querySelector('.chip-close').addEventListener('click', (e) => {
                e.stopPropagation();
                chip.remove();
                const idx = SAVED.findIndex(s => s.chipEl === chip);
                if (idx >= 0) SAVED.splice(idx, 1);
                onSavedChipsEmpty();
            });

            cont.appendChild(chip);
            SAVED.push({
                chipEl: chip,
                state
            });
            if (SAVED.length > 5) {
                alert('Maaf Ka, maksimal pencarian 5x. Silakan hapus yang lama dulu ya 😊');
                const last = SAVED.pop();
                last.chipEl.remove();
            }
        }

        async function resetUIToInitial() {
            const prov = document.getElementById('provinsiSelect');
            const kota = document.getElementById('kotaSelect');
            const input = document.getElementById('searchInput');
            const radiusGroup = document.getElementById('radiusGroup');
            const slider = document.getElementById('radiusSlider');
            const number = document.getElementById('radiusNumber');
            const meta = document.getElementById('searchMeta');
            const results = document.getElementById('results');

            if (prov) prov.value = '';
            if (kota) {
                kota.value = '';
                kota.innerHTML = `<option value="">${window.translations?.semua_kota || 'Pilih Kota'}</option>`;
                kota.removeAttribute('disabled');
                await loadAllCities();
            }
            if (input) input.value = '';

            if (radiusGroup) radiusGroup.classList.add('d-none');
            if (slider) {
                slider.value = 5;
                slider.disabled = true;
            }
            if (number) {
                number.value = 5;
                number.disabled = true;
            }

            try {
                if (window.RADIUS_CIRCLE) {
                    RADIUS_CIRCLE.setMap(null);
                    RADIUS_CIRCLE = null;
                }
            } catch {}
            if (Array.isArray(window.ACTIVE_MARKERS)) {
                try {
                    ACTIVE_MARKERS.forEach(m => m?.setMap && m.setMap(null));
                } catch {}
                ACTIVE_MARKERS = [];
            }

            window.SEARCH_CENTER = null;
            window.SEARCH_RADIUS_KM = null;

            document.querySelectorAll('#filter-chips .chip-btn').forEach(btn => {
                const isSemua = (btn.dataset.type || '') === '' || (btn.textContent || '').trim()
                    .toLowerCase() === 'semua';
                btn.classList.toggle('active', isSemua);
            });

            if (meta) {
                meta.classList.add('d-none');
                meta.textContent = '';
                meta.dataset.loc = '';
            }
            if (results) results.innerHTML = '';

            if (typeof MAP_FILTERS === 'object') {
                MAP_FILTERS.province = '';
                MAP_FILTERS.city = '';
                MAP_FILTERS.type = '';
                MAP_FILTERS.position = '';
            }

            if (typeof removeMultiMarker === 'function') removeMultiMarker();

            window.__resetting = true;
            if (typeof generateGoogleMapData === 'function') await generateGoogleMapData();
            forceShowAllMarkers();

            const centerIndonesia = () => {
                const m = window.map_container || window.map;
                if (m) {
                    m.setCenter({
                        lat: -2.5,
                        lng: 118
                    });
                    m.setZoom(5);
                }
            };
            centerIndonesia();
            setTimeout(centerIndonesia, 50);
            setTimeout(centerIndonesia, 200);
            window.__resetting = false;
        }
        window.resetUIToInitial = resetUIToInitial;

        (function enforceSingleInfoWindow() {
            let timer = null;

            function patch() {
                if (!(window.google && google.maps && google.maps.InfoWindow)) return;
                if (google.maps.InfoWindow.__singlePatched) return;

                const proto = google.maps.InfoWindow.prototype;
                const _open = proto.open;
                const _close = proto.close;

                proto.open = function(map, anchor) {
                    try {
                        if (window.__OPEN_INFO_WINDOW && window.__OPEN_INFO_WINDOW !== this) {
                            window.__OPEN_INFO_WINDOW.close();
                        }
                    } catch (e) {}
                    window.__OPEN_INFO_WINDOW = this;
                    return _open.call(this, map, anchor);
                };

                proto.close = function() {
                    if (window.__OPEN_INFO_WINDOW === this) window.__OPEN_INFO_WINDOW = null;
                    return _close.call(this);
                };

                google.maps.InfoWindow.__singlePatched = true;
                if (timer) clearInterval(timer);
            }
            timer = setInterval(patch, 100);
            document.addEventListener('DOMContentLoaded', patch);
        })();

        document.addEventListener('DOMContentLoaded', async () => {
            hideRadiusUI();

            await loadProvinces();
            await loadAllCities();
            document.getElementById('kotaSelect').removeAttribute('disabled');

            const provSel = document.getElementById('provinsiSelect');
            const kotaSel = document.getElementById('kotaSelect');

            provSel.addEventListener('change', async () => {
                const val = provSel.value || '';
                MAP_FILTERS.province = val;
                if (val) localStorage.setItem('s_provinsi', val);
                else localStorage.removeItem('s_provinsi');

                await loadCities(val);
                MAP_FILTERS.city = '';
                localStorage.removeItem('s_kota');

                const q = [
                    kotaSel.selectedOptions[0]?.dataset.name,
                    provSel.selectedOptions[0]?.dataset.name,
                ].filter(Boolean).join(', ');
                document.getElementById('searchInput').value = q;

                document.getElementById('radiusSlider').value = 30;
                document.getElementById('radiusNumber').value = 30;
                window.SEARCH_RADIUS_KM = 30;
                showRadiusUI();

                if (typeof datatableItem === 'function') datatableItem();
                await generateGoogleMapData();
                await runSearch();
                document.getElementById('addPointBtn').style.display = 'inline-block';
            });

            kotaSel.addEventListener('change', async () => {
                const val = kotaSel.value || '';
                MAP_FILTERS.city = val;
                if (val) localStorage.setItem('s_kota', val);
                else localStorage.removeItem('s_kota');

                const q = [
                    kotaSel.selectedOptions[0]?.dataset.name,
                    provSel.selectedOptions[0]?.dataset.name,
                ].filter(Boolean).join(', ');
                document.getElementById('searchInput').value = q;

                document.getElementById('radiusSlider').value = 30;
                document.getElementById('radiusNumber').value = 30;
                window.SEARCH_RADIUS_KM = 30;
                showRadiusUI();

                if (typeof datatableItem === 'function') datatableItem();
                await generateGoogleMapData();
                await runSearch();
                document.getElementById('addPointBtn').style.display = 'inline-block';
            });

            hookFilterChips();

            document.getElementById('searchBtn').addEventListener('click', runSearch);
            document.getElementById('searchInput').addEventListener('keydown', e => {
                if (e.key === 'Enter') runSearch();
            });

            const syncRadius = v => {
                const num = Math.max(0.5, Math.min(30, parseFloat(v) || 5));
                document.getElementById('radiusSlider').value = num;
                document.getElementById('radiusNumber').value = num;
                if (window.SEARCH_CENTER) applyRadiusFilter(window.SEARCH_CENTER, num);
            };
            document.getElementById('radiusSlider').addEventListener('input', e => syncRadius(e.target.value));
            document.getElementById('radiusNumber').addEventListener('input', e => syncRadius(e.target.value));

            document.getElementById('addPointBtn').addEventListener('click', () => {
                const q = (document.getElementById('searchInput').value || '').trim();
                const radius = parseFloat(document.getElementById('radiusSlider').value || '30');
                const state = {
                    q,
                    radius,
                    type: MAP_FILTERS.type || '',
                    province: MAP_FILTERS.province || '',
                    city: MAP_FILTERS.city || ''
                };
                if (q) addSavedChip(state);
                if (typeof window.resetUIToInitial === 'function') window.resetUIToInitial();
            });

            if (typeof datatableItem === 'function') {
                datatableItem();
            }
        });
    </script>

    <script src="{{ asset('js/currency.js') }}"></script>
    <script src="{{ asset('js/item3.js?v=5') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs_QwyMszHel8sTA19mwfeVYgvvBPK0-0&callback=initMap&v=weekly"
        async defer></script>
@endsection
