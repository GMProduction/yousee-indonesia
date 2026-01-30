<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Intelligence - {{ $item->name }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- HTML2Canvas -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            -webkit-print-color-adjust: exact;
        }

        .bg-gradient-violet {
            background: linear-gradient(135deg, #ede9fe 0%, #f3e8ff 100%);
        }

        .text-violet-main {
            color: #7c3aed;
        }

        .bg-violet-main {
            background-color: #7c3aed;
        }

        .card-shadow {
            box-shadow: 0 4px 20px -2px rgba(124, 58, 237, 0.1);
        }

        .map-container {
            height: 350px;
            width: 100%;
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 p-8 min-h-screen">

    <!-- MAIN CONTAINER (Target for Capture) -->
    <div id="capture-target" class="max-w-[1000px] mx-auto bg-white rounded-3xl shadow-xl overflow-hidden card-shadow">

        <!-- HEADER -->
        <!-- HEADER -->
        <div
            class="bg-gradient-to-r from-violet-50 via-purple-50 to-white p-8 border-b border-violet-100 flex justify-between items-start">
            <div class="flex flex-col">
                <img src="https://www.yousee-indonesia.com/images/local/logo-yousee2.png"
                    onerror="this.src='https://placehold.co/120x40?text=Yousee'" class="h-16 mb-2" alt="Logo">
                <!-- <div class="bg-white px-3 py-1.5 rounded-lg border border-violet-100 shadow-sm inline-block w-fit">
                    <span class="text-[10px] font-bold text-violet-400 uppercase tracking-wider block">Generated On</span>
                    <span class="text-sm font-bold text-slate-600">{{ date('d/m/Y') }}</span>
                </div> -->
            </div>
            <div class="text-right pt-2">
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-1">Location Intelligence</h1>
                <!-- <p class="text-slate-500 text-sm font-medium">Comprehensive Site Analysis Report</p> -->
            </div>
        </div>

        <!-- CONTENT GRID -->
        <div class="grid grid-cols-12 gap-0">

            <!-- LEFT COLUMN (Info & Stats) -->
            <div class="col-span-5 bg-gradient-violet p-8 border-r border-violet-100 relative overflow-hidden">
                <!-- Inputs Section (Mocked UI) -->
                <div class="space-y-5 relative z-10">
                    <div>
                        <label class="text-[10px] uppercase font-bold text-violet-400 block mb-1">Area Name</label>
                        <div
                            class="bg-white/80 backdrop-blur px-4 py-3 rounded-xl border border-violet-200/50 shadow-sm min-h-[72px] flex flex-col justify-center">
                            <h2 class="font-bold text-lg text-slate-800 leading-snug">{{ $item->name }}</h2>
                            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed opacity-80">{{ $item->address }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] uppercase font-bold text-violet-400 block mb-1">Latitude</label>
                            <div class="bg-white/60 px-3 py-2 rounded-lg border border-violet-100">
                                <span
                                    class="font-mono text-xs font-semibold text-slate-600">{{ number_format($item->latitude, 6) }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold text-violet-400 block mb-1">Longitude</label>
                            <div class="bg-white/60 px-3 py-2 rounded-lg border border-violet-100">
                                <span
                                    class="font-mono text-xs font-semibold text-slate-600">{{ number_format($item->longitude, 6) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- PRIMARY METRICS -->
                    <div class="pt-4">
                        <div class="bg-white rounded-2xl p-5 shadow-sm border border-violet-100 mb-4">
                            <div class="flex items-center gap-3 mb-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center text-violet-600">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 uppercase">Avg. Views/Day</span>
                            </div>
                            <!-- Use DB value or fallback -->
                            <h3 class="text-4xl font-extrabold text-slate-800 mb-2 mt-1 leading-none" id="metric-views">
                                {{ number_format($item->trafic > 0 ? $item->trafic : 15000) }}
                            </h3>
                            <p
                                class="text-[10px] text-green-600 font-bold mt-1 bg-green-50 inline-block px-2 py-0.5 rounded-full">
                                <i class="fa-solid fa-chart-line"></i> Consistent Growth
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl p-5 shadow-sm border border-violet-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                                    <i class="fa-solid fa-fingerprint"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 uppercase">Total Impressions (Mo)</span>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800" id="metric-impressions">
                                {{ number_format(($item->trafic > 0 ? $item->trafic : 15000) * 30) }}
                            </h3>
                            <p class="text-xs text-slate-400 mt-1">Estimated monthly exposure</p>
                        </div>
                    </div>

                    <!-- Additional Details Table -->
                    <div class="bg-white/50 rounded-xl p-4 border border-violet-100 mt-4">
                        <table class="w-full text-xs">
                            <tr class="border-b border-violet-100/50">
                                <td class="py-2 text-slate-500">Media Type</td>
                                <td class="py-2 font-bold text-right">{{ $item->type->name ?? 'Billboard' }}</td>
                            </tr>
                            <tr class="border-b border-violet-100/50">
                                <td class="py-2 text-slate-500">Size (WxH)</td>
                                <td class="py-2 font-bold text-right">{{ $item->width }}m x {{ $item->height }}m</td>
                            </tr>
                            <tr class="border-b border-violet-100/50">
                                <td class="py-2 text-slate-500">Orientation</td>
                                <td class="py-2 font-bold text-right">{{ $item->orientation ?? 'Vertical' }} /
                                    {{ $item->side ?? 1 }} Sisi</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-slate-500">AI Score</td>
                                <td class="py-2 font-bold text-right text-indigo-600" id="val-score">Calculating...</td>
                            </tr>
                        </table>
                    </div>

                </div>

                <!-- Decorative Circles -->
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-violet-200/30 rounded-full blur-3xl z-0"></div>
                <div class="absolute top-20 -right-20 w-40 h-40 bg-purple-200/30 rounded-full blur-2xl z-0"></div>
            </div>

            <!-- RIGHT COLUMN (Visuals & Analysis) -->
            <div class="col-span-7 p-8 bg-white">

                <!-- MAP -->
                <div class="mb-6">
                    <label class="text-[10px] uppercase font-bold text-slate-400 block mb-2 flex justify-between">
                        <span>Radius Analysis (3 KM)</span>
                        <span class="text-violet-500"><i class="fa-solid fa-map-location-dot"></i> Live Map</span>
                    </label>
                    <div id="print-map" class="map-container shadow-inner border border-slate-100 bg-slate-100"></div>
                </div>

                <!-- CONTEXT ROW -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- POI -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 mb-3 pb-2 border-b border-slate-100">
                            <i class="fa-solid fa-location-crosshairs text-blue-500 mr-2"></i>Place Near Location
                        </h4>
                        <div id="poi-list" class="space-y-2 text-xs min-h-[140px] relative">
                            <!-- JS Populated -->
                            <div class="animate-pulse h-4 bg-slate-100 rounded w-full mb-2"></div>
                            <div class="animate-pulse h-4 bg-slate-100 rounded w-3/4 mb-2"></div>
                            <div class="animate-pulse h-4 bg-slate-100 rounded w-1/2"></div>
                            <p class="text-[10px] text-slate-400 italic mt-2">Scanning area...</p>
                        </div>
                    </div>

                    <!-- AUDIENCE -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 mb-3 pb-2 border-b border-slate-100">
                            <i class="fa-solid fa-users-viewfinder text-purple-500 mr-2"></i>Audience Profile
                        </h4>
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-slate-500">Dominant Age</span>
                                <span class="text-xs font-bold text-slate-800 bg-white px-2 py-0.5 rounded shadow-sm"
                                    id="aud-age">Loading...</span>
                            </div>
                            <!-- Gender Bar -->
                            <div class="mt-3">
                                <div class="flex justify-between text-[10px] text-slate-400 mb-1">
                                    <span>Male</span>
                                    <span>Female</span>
                                </div>
                                <div class="h-2 w-full bg-pink-100 rounded-full overflow-hidden flex">
                                    <div class="h-full bg-blue-400 w-[55%]"></div>
                                </div>
                                <div class="flex justify-between text-[10px] font-bold text-slate-600 mt-1">
                                    <span>55%</span>
                                    <span>45%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CHARTS ROW -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Vehicle Chart -->
                    <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
                        <h5 class="text-[10px] font-bold text-slate-500 uppercase mb-3">Vehicle Distribution</h5>
                        <div class="h-[120px] relative">
                            <canvas id="vehicleChart"></canvas>
                        </div>
                    </div>

                    <!-- Vehicle Details (Updated) -->
                    <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
                        <h5 class="text-[10px] font-bold text-slate-500 uppercase mb-3">Vehicle Data Detail</h5>
                        <div id="vehicle-details-list" class="space-y-3">
                            <!-- Populated by JS -->
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <div class="bg-slate-50 p-4 border-t border-slate-200 text-center text-[10px] text-slate-400">
            &copy; {{ date('Y') }} Yousee Indonesia.
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Load Google Maps API (Reuse key)
        (function(g) {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })({
            key: "{{ config('services.google.maps_key') }}",
            v: "weekly"
        });

        // Data from PHP
        const ITEM = {
            id: {{ $item->id }},
            lat: {{ $item->latitude ?? 0 }},
            lng: {{ $item->longitude ?? 0 }},
            name: "{{ $item->name }}",
            type: "{{ $item->type->name ?? 'Billboard' }}",
            address: "{{ $item->address ?? '' }}",
            trafic: {{ $item->trafic ?? 0 }},
            width: {{ $item->width ?? 0 }},
            height: {{ $item->height ?? 0 }}
        };

        async function initReport() {
            // --- SYNCED LOGIC WITH ANALYSIS MODE ---
            const now = new Date();
            let day = 1;
            // Match Geospasial logic: Snap to 1st or 15th
            if (now.getDate() >= 15) {
                day = 15;
            } else {
                day = 1;
            }

            // 1. TRAFFIC LOGIC (Exact Match to Map Card Analysis Mode)
            let baseVolume = parseInt(ITEM.trafic || 0);
            if (baseVolume === 0) baseVolume = calculateSmartProfileImpl(ITEM, true);

            // OVERRIDE: If traffic passed via URL (from Analysis Mode), use it strictly
            const urlParams = new URLSearchParams(window.location.search);
            const overrideTraffic = urlParams.get('traffic');

            const currentVolume = overrideTraffic ? parseInt(overrideTraffic) : baseVolume;

            document.getElementById('metric-views').innerText = currentVolume.toLocaleString();
            document.getElementById('metric-impressions').innerText = (currentVolume * 30).toLocaleString();

            // 2. SCORE LOGIC
            const aiScore = calculateSmartProfileImpl(ITEM);
            document.getElementById('val-score').innerText = aiScore;

            // 3. AUDIENCE LOGIC (Synced with Map Analysis 2026)
            const audiences = ["20-29 Thn", "25-34 Thn", "30-45 Thn", "18-24 Thn"];
            const audIndex = ITEM.id % audiences.length;
            document.getElementById('aud-age').innerText = audiences[audIndex];

            // 4. Init Map & Places
            const {
                Map
            } = await google.maps.importLibrary("maps");
            const {
                PlacesService
            } = await google.maps.importLibrary("places");

            const position = {
                lat: parseFloat(ITEM.lat),
                lng: parseFloat(ITEM.lng)
            };
            const map = new Map(document.getElementById("print-map"), {
                zoom: 16,
                center: position,
                mapId: "DEMO_MAP_ID",
                disableDefaultUI: true,
                zoomControl: false
            });

            new google.maps.Marker({
                position: position,
                map: map,
                animation: google.maps.Animation.DROP
            });

            // 5. Init Charts (Pass calculated traffic)
            renderVehicleChart(currentVolume);

            // 6. Fetch POI & Auto Download
            fetchRealPlaces(ITEM, map, PlacesService, () => {
                // Trigger download after places are rendered
                // Small delay to ensure images/icons load
                setTimeout(downloadImage, 1000);
            });
        }

        // --- REAL PLACES LOGIC ---
        function fetchRealPlaces(item, map, PlacesService, onComplete = null) {
            const list = document.getElementById('poi-list');
            const service = new PlacesService(map);
            const latlng = {
                lat: parseFloat(item.lat),
                lng: parseFloat(item.lng)
            };

            // Smart Context
            let searchContext = 'Sekitar';
            if (item.address.toLowerCase().includes('tol')) searchContext = 'Area Tol';

            const query = `landmark, hospital, mall, school, university, office, bank, market near ${item.address}`;

            const request = {
                query: query,
                location: latlng,
                radius: 3000 // Synced with Analysis Mode (3KM)
            };

            service.textSearch(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                    // Filter & Sort by POPULARITY (Ratings), same as Analysis Mode
                    const validPlaces = results.map(p => {
                            const placeLoc = p.geometry.location;
                            const distKm = haversineDistance(latlng.lat, latlng.lng, placeLoc.lat(), placeLoc
                                .lng());
                            p._realDistance = distKm;
                            return p;
                        }).filter(p => p._realDistance <= 3.0)
                        .sort((a, b) => b.user_ratings_total - a.user_ratings_total) // Sort by Popularity
                        .slice(0, 6); // Top 6

                    list.innerHTML = validPlaces.map(p => {
                        let icon = 'fa-map-pin';
                        let color = 'text-slate-400';
                        const t = p.types || [];

                        if (t.includes('school') || t.includes('university')) {
                            icon = 'fa-graduation-cap';
                            color = 'text-blue-500';
                        } else if (t.includes('shopping_mall')) {
                            icon = 'fa-bag-shopping';
                            color = 'text-pink-500';
                        } else if (t.includes('hospital')) {
                            icon = 'fa-hospital';
                            color = 'text-red-500';
                        } else if (t.includes('bank') || t.includes('finance')) {
                            icon = 'fa-building-columns';
                            color = 'text-green-600';
                        } else if (t.includes('train_station')) {
                            icon = 'fa-subway';
                            color = 'text-orange-500';
                        }

                        return `
                            <div class="flex justify-between items-center border-b border-slate-50 pb-1 mb-1 last:border-0">
                                <div class="flex items-center gap-2 overflow-hidden w-[70%]">
                                    <i class="fa-solid ${icon} ${color} w-3 text-center text-[9px] shrink-0"></i>
                                    <span class="font-semibold text-slate-700 truncate text-[10px]" title="${p.name}">${p.name}</span>
                                </div>
                                <span class="text-[9px] font-bold text-slate-400 whitespace-nowrap">${p._realDistance.toFixed(2)} km</span>
                            </div>
                         `;
                    }).join('');

                } else {
                    list.innerHTML =
                        `<span class="text-xs text-slate-400 italic">No specific strategic locations data available via API.</span>`;
                }
            });
        }

        function haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * (Math.PI / 180);
            const dLon = (lon2 - lon1) * (Math.PI / 180);
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        // Shared Logic (renamed to avoid conflict if any, but in isolated view)
        function calculateSmartProfileImpl(item, returnTraffic = false) {
            // Replicating geospasial logic
            let base = 7.0;
            // Mock Traffic Estimate if 0
            let trafficEst = 15000;

            if (item.type.toLowerCase().includes('videotron')) {
                base += 0.5;
                trafficEst += 5000;
            }
            const area = item.width * item.height;
            if (area > 50) {
                base += 0.5;
                trafficEst += 2000;
            }
            if (area > 100) {
                base += 0.5;
                trafficEst += 5000;
            }

            // Location Keywords
            const text = (item.address + ' ' + item.name).toLowerCase();
            if (text.includes('tol') || text.includes('highway')) {
                base += 1.0;
                trafficEst += 20000;
            }
            if (text.includes('kota') || text.includes('alun')) {
                base += 0.8;
                trafficEst += 10000;
            }

            if (base > 9.8) base = 9.8;

            if (returnTraffic) return trafficEst;
            return base.toFixed(1) + "/10";
        }

        // Update renderVehicleChart to accept specific traffic volume
        function renderVehicleChart(trafficVolume) {
            const ctx = document.getElementById('vehicleChart').getContext('2d');

            // --- CONTEXT AWARE LOGIC (MATCHING ANALYSIS MODE) ---
            const text = ((ITEM.address || '') + ' ' + (ITEM.name || '')).toLowerCase();
            const type = (ITEM.type || '').toLowerCase();

            // BASELINE: Indonesia is heavy on Motorbikes
            let sCar = 1;
            let sMotor = 2.5;
            let sBus = 0.5;

            let isToll = false;

            // CONTEXT 1: ROAD TYPE
            if (text.includes('tol') || text.includes('highway') || text.includes('bebas hambatan')) {
                sCar += 5;
                sMotor = 0;
                sBus += 3;
                isToll = true;
            } else if (text.includes('arteri') || text.includes('protokol') || text.includes('bypass')) {
                sCar += 3;
                sMotor += 1;
                sBus += 1;
            } else if (text.includes('gang') || text.includes('jalan tikus') || text.includes('permukiman')) {
                sCar += 0;
                sMotor += 5;
                sBus += 0;
            }

            // CONTEXT 2: POI
            if (text.includes('pasar') || text.includes('sekolah') || text.includes('kampus')) {
                sMotor += 3;
            }
            if (text.includes('mall') || text.includes('plaza') || text.includes('perkantoran') || text.includes(
                'office')) {
                sCar += 3;
                sMotor += 1;
            }
            if (text.includes('terminal') || text.includes('stasiun') || text.includes('bandara') || text.includes(
                'pabrik') || text.includes('industri')) {
                sBus += 4;
            }

            // CONTEXT 3: MEDIA TYPE
            if (type.includes('videotron') || type.includes('megatron')) {
                sCar += 2;
            }

            // FINAL ENFORCEMENT
            if (isToll) {
                sMotor = 0;
            }

            // Calculate Percentage
            const totalScore = sCar + sMotor + sBus;
            let pCar = Math.round((sCar / totalScore) * 100);
            let pBus = Math.round((sBus / totalScore) * 100);
            let pMotor = 100 - pCar - pBus;

            if (pMotor < 0) {
                pMotor = 0;
                pCar -= pMotor;
            }

            // Calculate absolute numbers using passed trafficVolume (Synced with displayed Avg Views)
            const refTraffic = trafficVolume || (ITEM.traffic > 0 ? ITEM.traffic : 15000);
            const countCar = Math.round(refTraffic * (pCar / 100));
            const countMotor = Math.round(refTraffic * (pMotor / 100));
            const countBus = Math.round(refTraffic * (pBus / 100));

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Mobil', 'Motor', 'Bus/Truk'],
                    datasets: [{
                        data: [pCar, pMotor, pBus],
                        backgroundColor: ['#3B82F6', '#10B981', '#F59E0B'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Populate Breakdown List
            const listContainer = document.getElementById('vehicle-details-list');
            const data = [{
                    label: 'Mobil',
                    count: countCar,
                    pct: pCar,
                    color: 'bg-blue-500'
                },
                {
                    label: 'Motor',
                    count: countMotor,
                    pct: pMotor,
                    color: 'bg-green-500'
                },
                {
                    label: 'Bus/Truk',
                    count: countBus,
                    pct: pBus,
                    color: 'bg-amber-500'
                }
            ];

            listContainer.innerHTML = data.map(d => `
                <div>
                     <div class="flex justify-between text-[10px] text-slate-600 mb-1">
                         <span class="font-bold flex items-center gap-1.5"><div class="w-2 h-2 rounded-full ${d.color}"></div> ${d.label}</span>
                         <span class="font-bold">${d.count.toLocaleString()} <span class="text-slate-400 font-normal">(${d.pct}%)</span></span>
                     </div>
                     <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                         <div class="h-full ${d.color} opacity-80" style="width: ${d.pct}%"></div>
                     </div>
                </div>
            `).join('');
        }

        // Run
        window.onload = initReport;
    </script>
</body>

</html>
