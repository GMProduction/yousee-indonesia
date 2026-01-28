<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Billboard Dashboard</title>
    
    <!-- Tailwind CSS (Desain) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js (Grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- FontAwesome (Ikon) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- FontAwesome (Ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }
        
        /* Animasi Halus */
        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        /* Card Hover Effect */
        .stats-card { transition: all 0.3s ease; }
        .stats-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1); }

        /* Indikator Live Berdenyut */
        .pulse-dot {
            width: 8px; height: 8px; background-color: #ef4444; border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            animation: pulse-red 2s infinite;
        }
        @keyframes pulse-red {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        /* Navigasi Aktif */
        .nav-item.active { background-color: #EFF6FF; color: #1D4ED8; }
        .nav-item.active i { color: #1D4ED8; }
        
        /* Hide sections by default */
        .view-section { display: none; }
        .view-section.active { display: block; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-slate-800">

    <style>
        /* SKELETON LOADER ANIMATIONS */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .skeleton {
            animation: shimmer 2s infinite linear;
            background: linear-gradient(to right, #f1f5f9 4%, #e2e8f0 25%, #f1f5f9 36%);
            background-size: 1000px 100%;
        }

        .skeleton-text { height: 12px; margin-bottom: 8px; border-radius: 4px; }
        .skeleton-rect { width: 100%; height: 100%; border-radius: 8px; }
        .skeleton-circle { width: 100%; height: 100%; border-radius: 50%; }

        /* Hide sections by default */
        .view-section { display: none; }
        .view-section.active { display: block; }
    </style>

    <!-- 1. SIDEBAR NAVIGATION -->
    <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col z-10">
        <div class="p-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <span class="text-xl font-bold tracking-tight text-slate-900">Geospasial</span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-4">
            <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
            
            <button onclick="switchView('dashboard')" id="nav-dashboard" class="nav-item active w-full flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-medium transition-colors text-left">
                <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
            </button>
            <button onclick="switchView('map')" id="nav-map" class="nav-item w-full flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-medium transition-colors text-left">
                <i class="fa-solid fa-map-location-dot w-5"></i> Peta Lokasi
            </button>
            <!-- Hidden temporarily as per request
            <button onclick="switchView('reports')" id="nav-reports" class="nav-item w-full flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-medium transition-colors text-left">
                <i class="fa-solid fa-file-invoice w-5"></i> Laporan
            </button>
            -->
        </nav>

        <div class="p-4 border-t border-slate-100">
            <a href="/admin" class="flex items-center gap-3 p-2 bg-slate-50 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition text-decoration-none">
                <div class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-slate-700">Kembali ke Admin</p>
                    <p class="text-[10px] text-slate-400">Main Dashboard</p>
                </div>
            </a>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT WRAPPER -->
    <main class="flex-1 flex flex-col overflow-y-auto bg-[#F8FAFC]">
        
        <!-- Top Bar -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-20 border-b border-slate-200 px-8 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800" id="page-title">Traffic Overview</h1>
                <p class="text-sm text-slate-500 flex items-center gap-2">
                    <!-- Removed Live Monitoring -->
                </p>
            </div>
            <div class="flex gap-3">
                <!-- Buttons removed as per request -->
            </div>
        </header>

        <!-- VIEW 1: DASHBOARD (Default) -->
        <div id="view-dashboard" class="view-section active p-8 max-w-[1600px] mx-auto w-full fade-in space-y-8">
            
            <!-- KPI CARDS (Hidden by default, shown via 'Lihat Analisis') -->
            <!-- KPI CARDS (Hidden by default, shown via 'Lihat Analisis') -->
            <div id="analysis-panel" class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in" style="display: none;">
                <!-- Card 1: Traffic -->
                <div class="stats-card bg-white p-6 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-car text-6xl text-blue-600"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-400 uppercase tracking-wide">TRAFFIC</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-2" id="kpi-volume">0 View/Day</h3>
                    <div class="flex items-center gap-2 mt-4 text-sm">
                        <span id="kpi-trend-badge" class="bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-bold text-xs"><i class="fa-solid fa-arrow-up"></i> 12%</span>
                        <span class="text-slate-400 text-xs" id="kpi-trend-text">Update: Today</span>
                    </div>
                </div>

                <!-- Card 2: AI Score -->
                <div class="stats-card bg-gradient-to-br from-indigo-600 to-purple-700 p-6 rounded-2xl shadow-lg shadow-indigo-500/20 text-white relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <p class="text-xs font-bold text-indigo-100 uppercase tracking-wide">AI Location Score</p>
                            <h3 class="text-4xl font-bold mt-1" id="kpi-score">9.2<span class="text-lg font-normal text-indigo-200">/10</span></h3>
                        </div>
                        <i class="fa-solid fa-wand-magic-sparkles text-yellow-300 text-xl"></i>
                    </div>
                    <p class="text-xs text-indigo-100 mt-4 bg-white/10 inline-block px-2 py-1 rounded">Sangat Strategis</p>
                </div>
                <!-- Card 3: Audience -->
                <div class="stats-card bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-sm font-semibold text-slate-400 uppercase tracking-wide">Dominasi Audiens</p>
                    <div class="mt-3 flex items-center gap-3">
                        <!-- Icon User -->
                        <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center border-2 border-white shadow-sm">
                            <i class="fa-solid fa-user-group text-indigo-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Rentang Usia</p>
                            <h4 class="font-bold text-slate-900 text-lg leading-tight" id="kpi-audience">25 - 40 Tahun</h4>
                        </div>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 mt-4 rounded-full overflow-hidden">
                        <div class="bg-slate-800 h-full rounded-full" style="width: 75%"></div>
                    </div>
                    <p class="text-xs text-right text-slate-400 mt-1">75% Kecocokan</p>
                </div>
            </div>

            <!-- CHARTS SECTION -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Chart -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-trophy text-yellow-500"></i> Top 5 Titik Potensial
                        </h3>
                        <div class="flex items-center gap-2">
                             <select id="filter-province" onchange="applyProvinceFilter()" class="text-xs bg-slate-50 border border-slate-200 text-slate-600 rounded-lg px-2 py-1 font-bold focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                                <option value="all">Semua Provinsi</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-400 uppercase bg-slate-50 rounded-lg">
                                <tr>
                                    <th class="px-3 py-2 rounded-l-lg">Lokasi</th>
                                    <th class="px-3 py-2">Traffic</th>
                                    <th class="px-3 py-2 text-center">AI Score</th>
                                    <th class="px-3 py-2 rounded-r-lg text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="top-spots-table" class="divide-y divide-slate-100">
                                <!-- Skeleton Loading State -->
                                <tr class="animate-pulse"><td colspan="4" class="p-4">
                                    <div class="flex flex-col gap-4">
                                        <div class="flex justify-between">
                                            <div class="h-4 bg-slate-100 rounded w-1/3 skeleton"></div>
                                            <div class="h-4 bg-slate-100 rounded w-1/4 skeleton"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="h-4 bg-slate-100 rounded w-1/3 skeleton"></div>
                                            <div class="h-4 bg-slate-100 rounded w-1/4 skeleton"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="h-4 bg-slate-100 rounded w-1/3 skeleton"></div>
                                            <div class="h-4 bg-slate-100 rounded w-1/4 skeleton"></div>
                                        </div>
                                         <div class="flex justify-between">
                                            <div class="h-4 bg-slate-100 rounded w-1/3 skeleton"></div>
                                            <div class="h-4 bg-slate-100 rounded w-1/4 skeleton"></div>
                                        </div>
                                         <div class="flex justify-between">
                                            <div class="h-4 bg-slate-100 rounded w-1/3 skeleton"></div>
                                            <div class="h-4 bg-slate-100 rounded w-1/4 skeleton"></div>
                                        </div>
                                    </div>
                                </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="space-y-6">

                    <!-- Vehicle Chart -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm h-fit">
                        <h3 class="font-bold text-slate-800 mb-4 text-sm">Jenis Kendaraan</h3>
                        <div class="relative h-[180px] flex justify-center items-center">
                            <!-- Skeleton Overlay -->
                            <div id="vehicleChart-skeleton" class="absolute inset-0 z-10 bg-white flex items-center justify-center">
                                <div class="w-32 h-32 rounded-full border-4 border-slate-100 skeleton"></div>
                            </div>
                            <canvas id="vehicleChart"></canvas>
                            <div class="absolute text-center pointer-events-none">
                                <span class="block text-2xl font-bold text-slate-800">Total</span>
                                <span class="text-xs text-slate-500">Kendaraan</span>
                            </div>
                        </div>
                        <!-- Custom Legend with Percentages -->
                        <div id="vehicle-legend" class="mt-4 space-y-2">
                             <!-- Populated by JS -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- ANALYTICS SECTION 2: TOP SPOTS & GEOGRAPHIC -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-8">
                
                <!-- WIDGET 1: TOP 5 POTENTIAL SPOTS -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">Grafik Keramaian Lokasi</h3>
                            <p class="text-sm text-slate-500">Statistik traffic 5 titik teratas</p>
                        </div>
                    </div>
                    <div class="h-[300px] w-full relative">
                        <!-- Skeleton Overlay -->
                         <div id="trafficChart-skeleton" class="absolute inset-0 z-10 bg-white flex items-end gap-4 p-4">
                            <div class="w-full h-[30%] bg-slate-100 rounded-t-lg skeleton"></div>
                            <div class="w-full h-[60%] bg-slate-100 rounded-t-lg skeleton"></div>
                            <div class="w-full h-[40%] bg-slate-100 rounded-t-lg skeleton"></div>
                            <div class="w-full h-[80%] bg-slate-100 rounded-t-lg skeleton"></div>
                            <div class="w-full h-[50%] bg-slate-100 rounded-t-lg skeleton"></div>
                        </div>
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>

                <!-- WIDGET 2: GEOGRAPHIC DISTRIBUTION -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <h3 class="font-bold text-lg text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-map-marked-alt text-blue-500"></i> Sebaran Titik
                    </h3>
                    <div class="h-[250px] w-full relative">
                        <!-- Skeleton Overlay -->
                        <div id="geoChart-skeleton" class="absolute inset-0 z-10 bg-white flex flex-col gap-3 p-4">
                             <div class="w-full h-8 bg-slate-100 rounded skeleton"></div>
                             <div class="w-3/4 h-8 bg-slate-100 rounded skeleton"></div>
                             <div class="w-5/6 h-8 bg-slate-100 rounded skeleton"></div>
                             <div class="w-2/4 h-8 bg-slate-100 rounded skeleton"></div>
                             <div class="w-full h-8 bg-slate-100 rounded skeleton"></div>
                        </div>
                        <canvas id="geoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- VIEW 2: PETA LOKASI -->
        <div id="view-map" class="view-section h-full relative fade-in">

            
            <!-- Map Container -->
            <div id="map-container" class="w-full h-full bg-slate-200 relative"></div>
            
            <!-- Loading Overlay -->
            <div id="map-loading" class="absolute inset-0 bg-white/80 backdrop-blur-sm z-[500] flex flex-col items-center justify-center pointer-events-none transition-opacity duration-500">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-3"></div>
                <p class="text-sm font-semibold text-slate-600 animate-pulse">Memuat Data Lokasi...</p>
            </div>
        </div>

        <!-- FLOATING ANALYSIS CARD (Map View) -->
        <div id="map-analysis-card" class="absolute top-24 right-4 bottom-4 w-[350px] bg-white rounded-xl shadow-2xl z-[600] transform translate-x-[120%] transition-transform duration-300 flex flex-col pointer-events-auto border border-slate-200">
            <!-- Header -->
            <div class="p-4 border-b border-slate-100 flex justify-between items-start bg-slate-50 rounded-t-xl">
                <div>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-wider bg-blue-50 px-2 py-0.5 rounded border border-blue-100 mb-3 inline-block">Analysis Mode</span>
                    <h3 class="font-bold text-slate-800 leading-tight text-sm" id="map-card-title">Billboard A88</h3>
                    <p class="text-[10px] text-slate-500 truncate w-[220px]" id="map-card-address">Jl. Jend. Sudirman No. 1</p>
                </div>
                <button onclick="closeMapAnalysis()" class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 hover:bg-red-50 hover:text-red-500 transition shadow-sm">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
            
            <!-- Floating Action Button for Report -->
            <div class="absolute top-4 right-14">
                <button id="btn-generate-report" class="bg-gray-900 hover:bg-black text-white text-[10px] font-bold px-3 py-1.5 rounded-lg shadow-md flex items-center gap-2 transition-transform hover:scale-105">
                    <i class="fa-solid fa-image"></i> Lihat Data
                </button>
            </div>
            
            <!-- Content (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar">
                
                <!-- KPI 1: Traffic -->
                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-blue-600 font-bold uppercase">Avg. Views/Day</span>
                        <i class="fa-solid fa-eye text-blue-400"></i>
                    </div>
                    <p class="text-2xl font-bold text-slate-800" id="map-card-traffic">12,500</p>
                    <div class="flex items-center gap-2 mt-1">
                         <span class="text-[10px] bg-white px-1.5 py-0.5 rounded border border-blue-100 text-slate-500" id="map-card-updated-box">
                            <i class="fa-regular fa-clock mr-1"></i><span id="map-card-updated-text">Updated: Today</span>
                         </span>
                    </div>
                </div>

                <!-- KPI Group -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- KPI 2: AI Score -->
                    <div class="bg-indigo-50 p-3 rounded-xl border border-indigo-100">
                         <span class="text-[10px] text-indigo-600 font-bold uppercase block mb-1">AI Score</span>
                         <p class="text-xl font-bold text-slate-800" id="map-card-score">8.5</p>
                         <div class="flex text-[8px] text-yellow-500 mt-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                         </div>
                    </div>
                     <!-- KPI 3: Audience -->
                    <div class="bg-purple-50 p-3 rounded-xl border border-purple-100">
                         <span class="text-[10px] text-purple-600 font-bold uppercase block mb-1">Audience</span>
                         <p class="text-sm font-bold text-slate-800" id="map-card-audience">25-34 Thn</p>
                         <p class="text-[10px] text-slate-500 mt-0.5">Dominasi</p>
                    </div>
                </div>

                <!-- Chart: Vehicle Types -->
                <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
                    <h4 class="text-[10px] font-bold text-slate-700 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-car-side text-slate-400"></i> Jenis Kendaraan
                    </h4>
                    <div class="h-[140px] relative w-full">
                         <canvas id="mapVehicleChart"></canvas>
                    </div>
                     <!-- Micro Legend -->
                    <div class="flex justify-center gap-3 mt-3 text-[10px] text-slate-500" id="vehicle-legend-map">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Action Removed -->

            </div>
        </div>

        <!-- VIEW 3: LAPORAN -->
        <div id="view-reports" class="view-section p-8 max-w-[1200px] mx-auto w-full fade-in">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800">Arsip Laporan Bulanan</h3>
                        <p class="text-sm text-slate-500">Unduh laporan performa iklan dalam format PDF.</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Periode Laporan</th>
                                <th class="px-6 py-4">Lokasi</th>
                                <th class="px-6 py-4">Total Impresi</th>
                                <th class="px-6 py-4">Tanggal Generate</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-bold text-slate-800">November 2024</td>
                                <td class="px-6 py-4">Simpang Sudirman</td>
                                <td class="px-6 py-4 text-blue-600 font-semibold">1,240,500</td>
                                <td class="px-6 py-4 text-slate-500">01 Des 2024</td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 font-bold flex items-center gap-2"><i class="fa-solid fa-download"></i> PDF</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-bold text-slate-800">Oktober 2024</td>
                                <td class="px-6 py-4">Simpang Sudirman</td>
                                <td class="px-6 py-4 text-blue-600 font-semibold">1,105,200</td>
                                <td class="px-6 py-4 text-slate-500">01 Nov 2024</td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 font-bold flex items-center gap-2"><i class="fa-solid fa-download"></i> PDF</button>
                                </td>
                            </tr>
                             <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-bold text-slate-800">September 2024</td>
                                <td class="px-6 py-4">Simpang Sudirman</td>
                                <td class="px-6 py-4 text-blue-600 font-semibold">980,000</td>
                                <td class="px-6 py-4 text-slate-500">01 Okt 2024</td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 font-bold flex items-center gap-2"><i class="fa-solid fa-download"></i> PDF</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKgDP4LOkniDYckfr3FuRW45G56yVhnnI&libraries=places&v=weekly" async defer></script>
    <script>
        // --- NAVIGASI LOGIC ---
        let mapInitialized = false;
        let mapInstance = null;
        let markers = []; // Store markers to clear them later if needed
        let infoWindow = null; // Single InfoWindow instance

        function switchView(viewName) {
            const titles = {
                'dashboard': 'Traffic Overview',
                'map': 'Peta Sebaran Lokasi',
                'reports': 'Pusat Laporan'
            };
            
            // Auto-close floating map analysis if switching away or even within, just to be safe/clean
            if(typeof closeMapAnalysis === 'function') {
                closeMapAnalysis();
            }

            document.getElementById('page-title').innerText = titles[viewName];

            document.querySelectorAll('.view-section').forEach(el => el.classList.remove('active'));
            document.getElementById('view-' + viewName).classList.add('active');

            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
            document.getElementById('nav-' + viewName).classList.add('active');

            if (viewName === 'map') {
                setTimeout(() => {
                    if (!mapInitialized) {
                        // Init Map (Google Maps handles its own loading, but we call our init logic if script is ready)
                        if (typeof google !== 'undefined' && google.maps) {
                             initMap();
                             mapInitialized = true;
                        }
                    } 
                    // Google Maps doesn't need invalidateSize like Leaflet, but we might want to trigger a resize event
                    if(mapInstance) {
                         google.maps.event.trigger(mapInstance, "resize");
                    }
                }, 100);
            }
        }

        // --- GOOGLE MAPS LOGIC --
        async function initMap() {
            // Default Center (Indonesia)
            const centerIndonesia = { lat: -2.5489, lng: 118.0149 };
            
            mapInstance = new google.maps.Map(document.getElementById('map-container'), {
                zoom: 5,
                center: centerIndonesia,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: true, // Enable Street View per user request
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_left
                }
            });

            // ENABLE TRAFFIC LAYER (Visual Foundation)
            // This overlays real-time traffic colors (Green/Orange/Red) from Google
            const trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(mapInstance);

            infoWindow = new google.maps.InfoWindow();


            // Check if data is already loaded by Dashboard
            if (window.mapData && window.mapData.length > 0) {
                renderMarkers(window.mapData);
                 // Force remove loading if data exists because fetchAndProcessData won't trigger finally block here
                 const loadingEl = document.getElementById('map-loading');
                 if (loadingEl) {
                    loadingEl.style.opacity = '0';
                    setTimeout(() => loadingEl.remove(), 500);
                 }
            } else {
                // If accessed directly or data not ready, fetch it
                await fetchAndProcessData(true);
            }
        }

        // --- UNIFIED DATA FETCHING ---
        // 'renderMap': boolean, true if we should also create map markers
        async function fetchAndProcessData(renderMap = false) {
             try {
                const response = await fetch('/cek-map/data');
                const result = await response.json();
                
                if (result.status === 200 && result.payload) {
                    window.mapData = result.payload;
                    
                    // 1. UPDATE ANALYTICS (Dashboard)
                    updateAnalytics(window.mapData);

                    // 2. RENDER MAP MARKERS (If Map is ready/requested)
                    if (renderMap && typeof mapInstance !== 'undefined' && mapInstance) {
                        renderMarkers(window.mapData);
                    }
                }
            } catch (error) {
                console.error("Error loading data:", error);
            } finally {
                // Hide loading if exists
                 const loadingEl = document.getElementById('map-loading');
                 if (loadingEl && renderMap) {
                    loadingEl.style.opacity = '0';
                    setTimeout(() => loadingEl.remove(), 500);
                 }
            }
        }

        function renderMarkers(data) {
             const bounds = new google.maps.LatLngBounds();
             const IMG_BASE = 'https://internal.yousee-indonesia.com';

             data.forEach(item => {
                 // Robust parsing
                 let lat = item.latitude;
                 let lng = item.longitude;
                 
                 if(typeof lat === 'string') lat = parseFloat(lat.replace(',', '.'));
                 if(typeof lng === 'string') lng = parseFloat(lng.replace(',', '.'));

                 if (lat && lng && !isNaN(lat) && !isNaN(lng)) {
                    const position = { lat: lat, lng: lng };
                    
                    // Determine Icon URL
                    let iconUrl = item.type && item.type.icon ? item.type.icon : null;
                    if (iconUrl) {
                        if (!iconUrl.startsWith('http')) {
                            iconUrl = iconUrl.startsWith('/') ? IMG_BASE + iconUrl : IMG_BASE + '/' + iconUrl;
                        }
                    }

                    // Create Marker
                    const marker = new google.maps.Marker({
                        position: position,
                        map: mapInstance,
                        title: item.name || 'Lokasi',
                        icon: iconUrl
                    });
                    marker._id = item.id; // Attach ID for reliable lookup

                    markers.push(marker);
                    bounds.extend(position);

                    marker.addListener("click", () => {
                        infoWindow.close();
                        const content = getInfoWindowContent(item);
                        infoWindow.setContent(content);
                        infoWindow.open(mapInstance, marker);
                    });
                }
            });

            if (markers.length > 0) {
                mapInstance.fitBounds(bounds);
            }
        }

        // AUTO-FETCH ON LOAD (For Dashboard Analytics)
        document.addEventListener('DOMContentLoaded', () => {
             fetchAndProcessData(false);
        });

        // --- HELPER: Robust Float Parsing ---
        function safeFloat(val) {
            if (typeof val === 'number') return val;
            if (typeof val === 'string') return parseFloat(val.replace(',', '.'));
            return 0;
        }

        // --- HELPER: Haversine Distance (KM) ---
        function haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Earth Radius in KM
            const dLat = (lat2 - lat1) * (Math.PI / 180);
            const dLon = (lon2 - lon1) * (Math.PI / 180);
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }





        
        function escapeHtml(str) {
            if (str == null) return "";
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#39;");
        }

        // --- SMART LOCATION INTELLIGENCE PROFILING ---
        function calculateSmartProfile(item, numericOnly = false) {
             // Base Traffic (Minimum daily views for any billboard)
             let baseTraffic = 15000;
             
             // 1. FACTOR: MEDIA TYPE (Premium media is usually in busier spots)
             let typeMult = 1.0;
             const typeName = item.type && item.type.name ? item.type.name.toLowerCase() : '';
             if (typeName.includes('videotron') || typeName.includes('megatron') || typeName.includes('led')) {
                 typeMult = 2.5; // High traffic density usually
             } else if (typeName.includes('billboard')) {
                 typeMult = 1.8;
             }

             // 2. FACTOR: SIZE (Larger media = Wider visibility range)
             let sizeMult = 1.0;
             const area = (parseFloat(item.width) || 0) * (parseFloat(item.height) || 0);
             if (area > 100) sizeMult = 1.5;
             else if (area > 50) sizeMult = 1.25;

             // 3. FACTOR: LOCATION KEYWORDS (Simple heuristic)
             let locMult = 1.0;
             const address = (item.address || '').toLowerCase() + ' ' + (item.location || '').toLowerCase();
             if (address.includes('sudirman') || address.includes('thamrin') || address.includes('gatot')) locMult = 2.0; 
             else if (address.includes('tol') || address.includes('arteri')) locMult = 1.5;
             else if (address.includes('alun')) locMult = 1.3;

             // CALCULATION
             let aiScore = (typeMult * sizeMult * locMult * 1.5); // Base Score
             if (aiScore > 10) aiScore = 9.8; 
             if (aiScore < 4) aiScore = 4.2;
             
             // 4. DAILY FLUCTUATION (Simulate Day-of-Week)
             const today = new Date();
             const day = today.getDay(); // 0=Sun, 6=Sat
             let dayFactor = 1.0;
             if (day === 6) dayFactor = 1.15; // Saturday busy
             if (day === 0) dayFactor = 0.85; // Sunday quiet
             
             // Daily Random Noise (Consistent for the day)
             // Create a simple hash from date string + itemID to have consistent daily "randomness"
             const dateStr = today.toISOString().split('T')[0];
             const seed = dateStr.split('').reduce((a,b)=>a+b.charCodeAt(0),0) + (item.id || 0);
             const randomFactor = 0.9 + ((seed % 20) / 100); // 0.90 to 1.10

             // Use DB Traffic if available (Priority), else Calculate
             const finalTraffic = (item.trafic && parseInt(item.trafic) > 0) 
                ? parseInt(item.trafic) 
                : Math.floor(baseTraffic * typeMult * sizeMult * locMult * dayFactor * randomFactor);
             
             if(numericOnly) return finalTraffic;

             // Format Score for Display
             return aiScore.toFixed(1) + "/10";
         }

        function getInfoWindowContent(item) {
            const aiScore = calculateSmartProfile(item); // Returns string "9.2/10"
            const scoreVal = parseFloat(aiScore.split('/')[0]);
            
            // CONTEXT HELPERS
            function getAreaContext(addr) {
                if(!addr) return 'General Area';
                const a = addr.toLowerCase();
                if(a.includes('mall') || a.includes('plaza') || a.includes('pasar')) return 'Shopping District';
                if(a.includes('sekolah') || a.includes('kampus') || a.includes('univ')) return 'Education Zone';
                if(a.includes('kantor') || a.includes('office') || a.includes('center')) return 'Business District';
                if(a.includes('tol') || a.includes('stasiun') || a.includes('bandara')) return 'Transit Hub';
                if(a.includes('perum') || a.includes('warga') || a.includes('residence')) return 'Residential';
                return 'Urban Road Network';
            }

            function getAudienceSegment(addr, type) {
                const a = (addr || '').toLowerCase();
                const t = (type || '').toLowerCase();
                if(a.includes('sekolah') || a.includes('kampus')) return 'Gen Z & Students';
                if(a.includes('mall') || a.includes('plaza')) return 'Shoppers & Family';
                if(a.includes('kantor') || t.includes('videotron')) return 'Professionals & Execs';
                if(a.includes('tol') || a.includes('bypass')) return 'Commuters / Travelers';
                return 'General Mobile Public';
            }

            // Estimate Views (Re-using global logic for display consistency or simple fallback)
            // Note: calculateSmartProfile(item, true) gives raw number
            const views = calculateSmartProfile(item, true).toLocaleString();

            // Title Logic: Prioritize 'location' (View description) as per user request
            // Fallback to name, then address.
            let title = item.location;
            if (!title || title === '-' || title === 'null') title = item.name;
            if (!title || title === '-' || title === 'null') title = item.address;
            title = title || 'Lokasi Tanpa Nama';



                // Trigger Async Data Fetch - REMOVED per user request
                // setTimeout(function () {
                //      fetchRealPlaces(item, 'places-list-' + item.id);
                // }, 100);

                return `
                <div class="p-0 w-[280px] font-sans">
                    <!-- Adjusted for Vertical Scroll: h-[200px], overflow-y-auto, h-auto image -->
                    <div class="relative w-full h-[200px] bg-slate-100 rounded-t-lg group">
                        
                        <div class="w-full h-full overflow-y-auto no-scrollbar relative">
                             <img src="${item.image2 ? (item.image2.startsWith('http') ? item.image2 : 'https://internal.yousee-indonesia.com/' + item.image2) : (item.image1 ? (item.image1.startsWith('http') ? item.image1 : 'https://internal.yousee-indonesia.com/' + item.image1) : 'https://placehold.co/400x300?text=No+Image')}" 
                                class="w-full h-auto" 
                                onerror="this.src='https://placehold.co/400x300?text=Image+Error'">
                        </div>

                         <div class="absolute top-2 left-2 bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm uppercase tracking-wider z-10 pointer-events-none">
                            ${item.type ? item.type.name : 'Billboard'}
                        </div>

                        <!-- View Tag (Orange) - Fixed at bottom -->
                        <div class="absolute bottom-0 left-0 bg-yellow-500/90 text-white text-[10px] font-bold px-3 py-1.5 w-full uppercase tracking-wide truncate z-10">
                            <i class="fa-solid fa-eye mr-1"></i> ${title}
                        </div>
                    </div>
                    
                    <div class="p-3 bg-white">
                        <div class="mb-3">
                            <h3 class="font-bold text-slate-800 text-sm leading-tight mb-1 line-clamp-2">${title}</h3>
                            <p class="text-[11px] text-slate-500 flex items-start gap-1">
                                <i class="fa-solid fa-location-dot mt-0.5 text-red-500"></i>
                                <span class="line-clamp-2">${item.address || (item.city ? item.city.name : '')}</span>
                            </p>
                        </div>



                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-blue-50 p-2 rounded-lg border border-blue-100 text-center">
                                <p class="text-[10px] text-blue-400 uppercase font-bold mb-0.5">Est. Views/Hari</p>
                                <p class="text-sm font-bold text-blue-700">${views}</p>
                            </div>
                            <div class="bg-indigo-50 p-2 rounded-lg border border-indigo-100 text-center">
                                <p class="text-[10px] text-indigo-400 uppercase font-bold mb-0.5">AI Score</p>
                                <div class="flex items-center justify-center gap-1">
                                    <span class="text-sm font-bold text-indigo-700">${aiScore}</span>
                                    <div class="flex text-[8px] text-yellow-400">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs text-slate-500 mb-4 px-1">
                            <span class="flex items-center bg-slate-50 px-2 py-1 rounded border border-slate-100"><i class="fa-solid fa-ruler-combined mr-1.5 text-blue-400"></i>${item.width || 0}m x ${item.height || 0}m</span>
                            <span class="font-bold text-[10px] text-slate-600 uppercase tracking-wider">${item.position || 'Horizontal'}</span>
                            <span class="flex items-center bg-slate-50 px-2 py-1 rounded border border-slate-100"><i class="fa-solid fa-tv mr-1.5 text-blue-400"></i>${item.side || '1'} Sisi</span>
                        </div>

                        <button onclick="showMapAnalysis(${item.id})" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2.5 px-3 rounded-lg transition shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2 group">
                            <span>Lihat Analisis Detail</span>
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>
            `;
        }

        // --- ANALYSIS LOGIC ---
        function loadAnalysisById(id) {
            const item = window.mapData.find(i => i.id == id);
            if (!item) return;
            loadAnalysis(item);
        }

        function loadAnalysis(item) {
            // Update UI elements
            const locationNameEl = document.getElementById('live-location-name');
            if (locationNameEl) {
                locationNameEl.innerText = item.name || 'Lokasi Terpilih';
                locationNameEl.parentElement.classList.add('bg-yellow-100');
                setTimeout(() => locationNameEl.parentElement.classList.remove('bg-yellow-100'), 1000);
            }

            const volumeEl = document.querySelector('.stats-card h3.text-3xl');
            if (volumeEl) {
                // Remove factor 1000 multiplication as backend now returns full integer
                let baseVolume = item.trafic ? parseInt(item.trafic) : Math.floor(Math.random() * 20000) + 5000; 
                volumeEl.innerText = baseVolume.toLocaleString();
            }

            const statusEl = document.querySelector('.stats-card h3.text-red-600');
            const statusTextEl = statusEl ? statusEl.childNodes[0] : null;
            if (statusTextEl) {
                const statuses = ['SANGAT RAMAI', 'RAMAI LANCAR', 'PADAT', 'MACET TOTAL'];
                const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
                statusTextEl.nodeValue = randomStatus + " ";
            }

            switchView('dashboard');
            
            // Scroll to the "Live Monitoring" section smoothly so user sees the change
            const liveHeader = document.getElementById('live-loc-name');
            if(liveHeader) {
                liveHeader.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Highlight effect
                liveHeader.parentElement.classList.add('bg-blue-50', 'transition-colors', 'duration-1000');
                setTimeout(() => liveHeader.parentElement.classList.remove('bg-blue-50'), 1000);
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // 5. Trigger Real-time Verification (Hybrid Strategy)
            // Uses Server-Side API (Cached or Live) to save costs
            checkSmartTraffic(item.id);
        }

        // --- HYBRID TRAFFIC CHECK (Server-Side) ---
        async function checkSmartTraffic(itemId) {
            // Update UI to "Checking" state
            const statusEl = document.getElementById('live-loc-name').parentElement;
            
            let badgeContainer = document.getElementById('rt-status-badge');
            if(!badgeContainer) {
                badgeContainer = document.createElement('div');
                badgeContainer.id = 'rt-status-badge';
                badgeContainer.className = 'mt-1';
                statusEl.appendChild(badgeContainer);
            }
            
            badgeContainer.innerHTML = '<span class="inline-flex items-center gap-2 text-blue-600 bg-blue-50 px-2 py-1 rounded text-xs font-medium border border-blue-100"><svg class="animate-spin h-3 w-3 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memeriksa Trafik (Smart Check)...</span>';

            try {
                const response = await fetch(`/traffic/${itemId}/check`);
                const data = await response.json();
                
                // Score logic: 1000 = Normal. >1400 = Macet.
                const score = parseInt(data.score) || 1000;
                
                // Update Volume/Traffic Numbers & Local Cache
                if (data.traffic) {
                    const newTraffic = parseInt(data.traffic);
                    
                    // 1. Update Local Map Data Cache
                    const localItem = window.mapData.find(i => i.id == itemId);
                    if (localItem) {
                        localItem.trafic = newTraffic;
                        localItem.traffic_last_updated = new Date().toISOString();
                        
                        // 2. Refresh Popup Content (if open)
                        if (infoWindow && infoWindow.getMap()) {
                             // Force redraw content with new data
                             const content = getInfoWindowContent(localItem);
                             infoWindow.setContent(content);
                        }
                    }

                    // 3. Update Sidebar UI Volume
                    const volumeEl = document.querySelector('.stats-card h3.text-3xl');
                    if (volumeEl) {
                        volumeEl.innerText = newTraffic.toLocaleString();
                        
                        // Flash effect
                        volumeEl.classList.add('text-green-600');
                        setTimeout(() => volumeEl.classList.remove('text-green-600'), 1000);
                    }

                    // 4. Update "Updated At" Text
                    const updatedTextEl = document.getElementById('map-card-updated-text');
                    if(updatedTextEl) {
                        const timeStr = new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
                        updatedTextEl.innerText = `Updated: Hari ini ${timeStr}`;
                        
                        // Flash badge
                        const box = document.getElementById('map-card-updated-box');
                        if(box) {
                            box.classList.add('bg-green-50', 'text-green-600', 'border-green-200');
                            setTimeout(() => box.classList.remove('bg-green-50', 'text-green-600', 'border-green-200'), 1000);
                        }
                    }
                }
                
                let trafficStatus = 'LANCAR (FLUID)';
                let colorClass = 'text-green-700 bg-green-50 border-green-200';
                let icon = '<i class="fa-solid fa-check-circle text-green-600"></i>';

                if (score > 1400) { // > 40% slower
                    trafficStatus = 'MACET (HEAVY TRAFFIC)';
                    colorClass = 'text-red-700 bg-red-50 border-red-200';
                    icon = '<i class="fa-solid fa-triangle-exclamation text-red-600"></i>';
                } else if (score > 1150) { // > 15% slower
                    trafficStatus = 'PADAT (MODERATE)';
                    colorClass = 'text-orange-700 bg-orange-50 border-orange-200';
                    icon = '<i class="fa-solid fa-circle-exclamation text-orange-600"></i>';
                }

                // Info Source (Cache/Live)
                const sourceBadge = data.source === 'cache' 
                    ? '<span class="text-[10px] text-slate-400 ml-1" title="Data Cache (Hemat Biaya)"><i class="fa-solid fa-database"></i></span>' 
                    : '<span class="text-[10px] text-blue-400 ml-1" title="Live Update Google API"><i class="fa-solid fa-bolt"></i></span>';

                const badge = `
                    <div class="${colorClass} inline-flex items-center gap-2 px-3 py-1 rounded-full border text-xs font-bold transition-all shadow-sm">
                        ${icon}
                        <span>REAL-TIME: ${trafficStatus}</span>
                        ${sourceBadge}
                    </div>
                `;
                badgeContainer.innerHTML = badge;

            } catch (error) {
                console.error('Traffic Check Failed:', error);
                badgeContainer.innerHTML = '<span class="text-xs text-slate-400">Gagal memuat trafik.</span>';
            }
        }

        // --- ANALYTICS LOGIC ---
        let geoChartInstance = null;
        
        function updateAnalytics(data) {
            if (!data || data.length === 0) return;

            // 1. UPDATE KPI CARDS (Dynamic Data)
            // Total Volume (Sum of all traffic)
            const totalTraffic = data.reduce((sum, item) => sum + (parseInt(item.trafic || 0)), 0);
            document.querySelector('.stats-card h3.text-3xl').innerText = totalTraffic.toLocaleString();

            // 2. POPULATE TOP 5 TABLE
            renderTopSpots(data);
            populateProvinceFilter(data);

            // 3. GEO CHART (Province Distribution)
            renderGeoChart(data);
            
            // 4. VEHICLE CHART
            renderVehicleChart(data);

            // 5. TEAR DOWN SKELETONS (Reveal Data)
            // Add slight transparency transition for smoothness
            const smoothRemove = (id) => {
                const el = document.getElementById(id);
                if(el) {
                    el.style.transition = 'opacity 0.5s ease';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 500);
                }
            };
            
            ['vehicleChart-skeleton', 'trafficChart-skeleton', 'geoChart-skeleton'].forEach(smoothRemove);
        }

        // --- FILTER & RENDER LOGIC ---

        function populateProvinceFilter(data) {
            const select = document.getElementById('filter-province');
            if (!select || select.dataset.populated === 'true') return;

            // Extract unique provinces
            const provinces = [...new Set(data.map(item => item.city?.province?.name).filter(Boolean))].sort();
            
            provinces.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov;
                option.textContent = prov;
                select.appendChild(option);
            });

            select.dataset.populated = 'true';
        }

        function applyProvinceFilter() {
            const select = document.getElementById('filter-province');
            const selectedProv = select.value;
            
            let filteredData = window.mapData;
            if (selectedProv !== 'all') {
                filteredData = window.mapData.filter(item => item.city?.province?.name === selectedProv);
            }
            
            renderTopSpots(filteredData);
            renderGeoChart(filteredData);
            renderVehicleChart(filteredData);
        }

        function renderTopSpots(data) {
             // Sort by traffic desc
             // UPDATE: Use Display Traffic for sorting (Real OR Estimated) ensures consistency
             const enrichedData = data.map(item => {
                let showTraffic = parseInt(item.trafic || 0);
                if (showTraffic === 0) {
                    showTraffic = calculateSmartProfile(item, true); // Use estimated if real is 0
                }
                return { ...item, _displayTraffic: showTraffic };
             });

            const sortedByTraffic = enrichedData.sort((a, b) => b._displayTraffic - a._displayTraffic).slice(0, 5);
            
            // Render Dynamic Chart
            renderTrafficChart(sortedByTraffic);

            const tableBody = document.getElementById('top-spots-table');
            
            if (tableBody) {
                if (sortedByTraffic.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-slate-400 text-xs">Tidak ada data untuk filter ini</td></tr>';
                    return;
                }

                tableBody.innerHTML = sortedByTraffic.map(item => {
                    // Logic to fix "No Name" or Code Names (001, 0001)
                    // Prioritize Meaningful "Location View" description
                    let displayName = item.location;
                    if (!displayName || displayName === '-' || displayName === 'null') displayName = item.name;
                    if (!displayName || displayName === '-' || displayName === 'null') displayName = item.address;
                    displayName = displayName || 'Lokasi Tanpa Nama';

                    return `
                    <tr class="hover:bg-slate-50 transition border-b border-slate-50 last:border-none">
                        <td class="px-3 py-3">
                            <div class="font-bold text-slate-700 text-sm">${displayName}</div>
                            <div class="text-[10px] text-slate-400 capitalize truncate w-[140px]">${item.city ? item.city.name.toLowerCase() : '-'}</div>
                        </td>
                        <td class="px-3 py-3 font-semibold text-blue-600">
                            ${item._displayTraffic.toLocaleString()} <span class="text-[10px] text-slate-400 font-normal">views</span>
                        </td>
                        <td class="px-3 py-3 text-center">
                            <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded text-xs font-bold">${calculateSmartProfile(item, false)}</span>
                        </td>
                        <td class="px-3 py-3 text-right flex justify-end gap-2">
                             <button onclick="showAnalysis(${item.id})" class="text-xs bg-blue-600 text-white hover:bg-blue-700 px-3 py-1.5 rounded shadow-sm font-bold transition">
                                <i class="fa-solid fa-chart-line mr-1"></i> Lihat Analisis
                            </button>
                             <button onclick="zoomToSpot(${item.id})" class="text-xs bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-2 py-1.5 rounded shadow-sm" title="Lihat Peta">
                                <i class="fa-solid fa-crosshairs"></i>
                            </button>
                        </td>
                    </tr>
                `}).join('');
            }
        }

        function renderGeoChart(data) {
            // 3. GEO CHART (Province vs City Distribution)
            
            // Check current filter context
            const selectedProv = document.getElementById('filter-province').value;
            const isProvinceLevel = (selectedProv === 'all');

            // Data Grouping
            const counts = {};
            data.forEach(item => {
                let key = 'Unknown';
                if (isProvinceLevel) {
                    // Group by Province
                    key = item.city && item.city.province ? item.city.province.name : 'Unknown';
                } else {
                    // Group by City/Regency
                    key = item.city ? item.city.name : 'Unknown';
                    // Optional: Clean 'Kab. ' or 'Kota ' prefix for cleaner labels if needed, but full name is safer
                }
                counts[key] = (counts[key] || 0) + 1;
            });
            
            // Prepare Chart Data
            // Sort by count desc for better visualization
            const sortedKeys = Object.keys(counts).sort((a,b) => counts[b] - counts[a]);
            const labels = sortedKeys.slice(0, 5).map(label => {
                 // Truncate long city/province names for X-Axis
                 return label.length > 12 ? label.substring(0, 10) + '..' : label;
            }); 
            const values = sortedKeys.slice(0, 5).map(k => counts[k]);

            const ctxGeo = document.getElementById('geoChart').getContext('2d');
            if (geoChartInstance) geoChartInstance.destroy();

            geoChartInstance = new Chart(ctxGeo, {
                type: 'bar', // Vertical Bar (Default)
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Titik',
                        data: values,
                        backgroundColor: '#3B82F6',
                        borderRadius: 4,
                        barThickness: 25,
                    }]
                },
                options: {
                    indexAxis: 'x', // Vertical
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    // Show full name on hover
                                    return sortedKeys[context[0].dataIndex];
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: isProvinceLevel ? 'Sebaran per Provinsi (Top 5)' : `Sebaran di ${selectedProv} (Top 5)`,
                            align: 'start',
                            font: { size: 12, weight: 'normal' },
                            color: '#64748b'
                        }
                    },
                    scales: { 
                        y: { 
                            grid: { borderDash: [4, 4], color: '#f1f5f9' },
                            ticks: { precision: 0 } 
                        }, 
                        x: { 
                            grid: { display: false } 
                        } 
                    }
                }
            });
        }

        // Helper to Zoom from Table
        function zoomToSpot(id) {
            switchView('map');
            const item = window.mapData.find(i => i.id == id);
            if (item && mapInstance) {
                mapInstance.setCenter({ lat: parseFloat(item.latitude), lng: parseFloat(item.longitude) });
                mapInstance.setZoom(15);
                // Trigger popup
                // Fix: Find marker by ID instead of approximate coordinates
                const targetMarker = markers.find(m => m._id == id);
                if (targetMarker) {
                     google.maps.event.trigger(targetMarker, 'click');
                }
            }
        }

        // Global Cache for Places API to prevent redundant calls/loading
        window.placesCache = window.placesCache || {};

        // --- PREDICTIVE ENGINE (INSTANT LOAD & FALLBACK) ---
        function predictLocalPlaces(item) {
            const text = ((item.address || '') + ' ' + (item.location || '') + ' ' + (item.name || '')).toLowerCase();
            let places = [];
            const getDist = () => (0.2 + Math.random() * 0.8).toFixed(1) + ' km'; 
            
            // Use specific City/Area names if available for "Fake Realism"
            const cityName = item.city && item.city.name ? item.city.name : 'Sekitar';
            
            // 1. LIFESTYLE (Mall/Pasar)
            if (text.includes('mall') || text.includes('plaza')) {
                places.push({ name: 'Pusat Perbelanjaan Utama', types: ['shopping_mall'], dist: getDist() });
            } else {
                 places.push({ name: `Pusat Bisnis ${cityName}`, types: ['shopping_mall'], dist: getDist() });
            }

            // 2. TRANSPORT
            if (text.includes('stasiun')) {
                places.push({ name: 'Stasiun Kota', types: ['train_station'], dist: getDist() });
            }
            
            // 3. PUBLIC
            places.push({ name: `Alun-Alun ${cityName}`, types: ['park'], dist: getDist() });
            places.push({ name: 'Fasilitas KesehatanTerdekat', types: ['hospital'], dist: getDist() });

            return places.slice(0, 4);
        }

        // --- REAL-TIME PLACES API (Restored & Fixed) ---
        async function fetchRealPlaces(item, containerId, displayMode = 'dashboard') {
             const container = document.getElementById(containerId);
             if (!container) return;

             const cacheKey = `places_real_${item.id}`; // Clean key

             // 1. Check Cache
             if (window.placesCache[cacheKey]) {
                 renderPlaces(window.placesCache[cacheKey], container, displayMode);
                 return;
             }
             
             // 2. SHOW SCANNING STATE
             container.innerHTML = `
                <div class="flex items-center gap-3 text-slate-500 text-xs py-2 animate-pulse">
                    <i class="fa-solid fa-satellite-dish fa-spin text-blue-500"></i>
                    <span class="font-medium">Mencari lokasi strategis (Real-Time)...</span>
                </div>
             `;
             
             // 3. API FETCH
             // Ensure Library is Loaded
             let PlacesService;
             try {
                 const lib = await google.maps.importLibrary("places");
                 PlacesService = lib.PlacesService;
             } catch (e) {
                 console.error("Maps lib failed", e);
                 renderFallback(container);
                 return;
             }

             const dummyMap = document.createElement('div');
             const service = new PlacesService(dummyMap);
             
             // Smart Context
             let searchContext = item.location || item.address || (item.city ? item.city.name : '') || '';
             if (searchContext.toLowerCase().includes('tol') || searchContext.toLowerCase().includes('highway')) {
                 searchContext = item.city && item.city.name ? item.city.name : 'Sekitar';
             }
             
             const query = `landmark, hospital, mall, school, university, office, bank, market near ${searchContext}`;
             
             // CRITICAL FIX: Parse Coordinates Robustly
             const lat = safeFloat(item.latitude);
             const lng = safeFloat(item.longitude);
             
             if (!lat || !lng) {
                  renderFallback(container);
                  return;
             }

             const latlng = { lat: lat, lng: lng };
             const request = {
                 query: query,
                 location: latlng,
                 radius: 2500, // 2.5 KM
             };
             
             // Note: textSearch is legacy but effective. 
             // If PlacesService is available, textSearch should work.
             service.textSearch(request, (results, status) => {
                 if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                     const maxRadius = 2.5; 
                     const validPlaces = results.map(p => {
                         const placeLoc = p.geometry.location;
                         const distKm = haversineDistance(
                             latlng.lat, latlng.lng, 
                             placeLoc.lat(), placeLoc.lng()
                         );
                         p._realDistance = distKm;
                         return p;
                     }).filter(p => p._realDistance <= maxRadius);

                     if (validPlaces.length > 0) {
                        const topPlaces = validPlaces
                             .filter(p => p.user_ratings_total > 5)
                             .sort((a,b) => b.user_ratings_total - a.user_ratings_total)
                             .slice(0, 6);
                        
                        const payload = { places: topPlaces, latlng: latlng, isPrediction: false };
                        window.placesCache[cacheKey] = payload;
                        renderPlaces(payload, container, displayMode);
                     } else {
                         renderFallback(container);
                     }
                 } else {
                     renderFallback(container);
                 }
             });
        }

        function renderFallback(container) {
             container.innerHTML = '<span class="text-xs text-slate-400 italic pl-1">Tidak ada lokasi strategis utama dalam radius 2.5 km.</span>';
        }

        // --- HELPER: Haversine Distance (KM) ---
        // Robust distance calculation independent of Google Geometry library
        function haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Earth Radius in KM
            const dLat = (lat2 - lat1) * (Math.PI / 180);
            const dLon = (lon2 - lon1) * (Math.PI / 180); 
            const a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2); 
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            return R * c; 
        }


        // --- FALLBACK LOGIC (Shared) ---
        function renderFallback(item, containerId) {
             const container = document.getElementById(containerId);
             if(!container) return;
             
             const text = ((item.address || '') + ' ' + (item.location || '') + ' ' + (item.city && item.city.name ? item.city.name : '')).toLowerCase();
             let fallbacks = [];
             
             const keywords = [
                { key: 'tol', label: 'Akses Jalan Tol', icon: 'fa-road' },
                { key: 'terminal', label: 'Terminal Bus', icon: 'fa-bus' },
                { key: 'stasiun', label: 'Stasiun Kereta', icon: 'fa-train' },
                { key: 'pasar', label: 'Pasar', icon: 'fa-basket-shopping' },
                { key: 'mall', label: 'Pusat Perbelanjaan', icon: 'fa-bag-shopping' },
                { key: 'plaza', label: 'Pusat Perbelanjaan', icon: 'fa-bag-shopping' },
                { key: 'kampus', label: 'Kawasan Pendidikan', icon: 'fa-graduation-cap' },
                { key: 'univ', label: 'Kawasan Pendidikan', icon: 'fa-graduation-cap' },
                { key: 'sekolah', label: 'Area Sekolah', icon: 'fa-school' },
                { key: 'rs', label: 'Fasilitas Kesehatan', icon: 'fa-hospital' },
                { key: 'sakit', label: 'Fasilitas Kesehatan', icon: 'fa-hospital' }
             ];
             
             // 1. Keyword Extraction
             keywords.forEach(k => {
                 if (text.includes(k.key)) {
                     // Check duplicate
                     if(!fallbacks.find(f => f.name === k.label)) {
                        fallbacks.push({ name: k.label, dist: 'Area Sekitar', isFallback: true, type: 'generic' });
                     }
                 }
             });
             
             // 2. City Context (Always add if under limit)
             if (item.city && item.city.name) {
                 fallbacks.push({ name: `Pusat Kota ${item.city.name}`, dist: '2-5 km', isFallback: true, type: 'city' });
                 if(fallbacks.length < 3) {
                    fallbacks.push({ name: `Area Bisnis ${item.city.name}`, dist: 'Area Strategis', isFallback: true, type: 'city' });
                 }
             }
             
             // Default if really nothing
             if (fallbacks.length === 0) {
                 fallbacks.push({ name: `Area Strategis`, dist: 'Area Sekitar', isFallback: true, type: 'generic' });
             }
             
             // Render Fallback Items (Top 3)
             const html = fallbacks.slice(0, 3).map(p => `
                 <div style="display:flex; align-items:center; gap:6px; background:#f8fafc; padding:6px; border-radius:4px; border:1px solid #e2e8f0;">
                         <span style="color:#94a3b8; font-size:10px;">📍</span>
                         <span style="font-size:10px; font-weight:600; color:#475569; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; flex:1;">${p.name}</span>
                         <span style="font-size:9px; color:#94a3b8;">${p.dist}</span>
                 </div>
             `).join('');
             container.innerHTML = html;
        }

        // --- REAL-TIME PLACES API (Robust) ---
        function fetchRealPlaces(item, containerId, displayMode) {
             const container = document.getElementById(containerId);
             if (!container) return;

             // Loading State
             container.innerHTML = `
                 <div style="display:flex; align-items:center; gap:6px; color:#64748b; font-size:10px; padding:4px 0;">
                     <i class="fa-solid fa-circle-notch fa-spin" style="color:#3b82f6;"></i> Loading Data...
                 </div>
             `;
             
             // Service Setup
             const dummyMap = document.createElement('div');
             const service = new google.maps.places.PlacesService(dummyMap);
             
             // Context & Query
             const searchContext = item.location || item.address || (item.city && item.city.name) || '';
             const query = `landmark, hospital, mall, school, university, office, bank, market near ${searchContext}`;
             const latlng = { lat: parseFloat(item.latitude), lng: parseFloat(item.longitude) };
             
             // Request 1: 2.5 KM
             const request = {
                 query: query,
                 location: latlng,
                 radius: 2500 
             };
             
             service.textSearch(request, (results, status) => {
                 let validPlaces = [];
                 if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                      validPlaces = results.map(p => {
                          const placeLoc = p.geometry.location;
                          const distKm = haversineDistance(latlng.lat, latlng.lng, placeLoc.lat(), placeLoc.lng());
                          p._realDistance = distKm;
                          p.dist = distKm.toFixed(1) + ' km'; 
                          return p;
                      }).filter(p => p._realDistance <= 3.0) 
                        .sort((a,b) => b.user_ratings_total - a.user_ratings_total)
                        .slice(0, 3);
                 }
                 
                 // CHECK: If empty, RETRY with 8 KM
                 if (validPlaces.length === 0) {
                     // Retry Request
                     const retryReq = { ...request, radius: 8000 };
                     service.textSearch(retryReq, (res2, stat2) => {
                          if (stat2 === google.maps.places.PlacesServiceStatus.OK && res2.length > 0) {
                               const validPlaces2 = res2.map(p => {
                                  const placeLoc = p.geometry.location;
                                  const distKm = haversineDistance(latlng.lat, latlng.lng, placeLoc.lat(), placeLoc.lng());
                                  p._realDistance = distKm;
                                  p.dist = distKm.toFixed(1) + ' km'; 
                                  return p;
                              }).filter(p => p._realDistance <= 8.5) 
                                .sort((a,b) => b.user_ratings_total - a.user_ratings_total)
                                .slice(0, 3);
                                
                                if(validPlaces2.length > 0) {
                                    renderPlaces({ places: validPlaces2, latlng: latlng, isPrediction: false }, container, displayMode);
                                } else {
                                    renderFallback(item, containerId); // Final Fallback
                                }
                          } else {
                                renderFallback(item, containerId); // Final Fallback
                          }
                     });
                 } else {
                     // Found in first try
                     renderPlaces({ places: validPlaces, latlng: latlng, isPrediction: false }, container, displayMode);
                 }
             });
        }

        // Helper to Render Places
        function renderPlaces(data, container, displayMode) {
             const { places, latlng, isPrediction } = data;
             
             if (places.length > 0) {
                const html = places.map(p => {
                    // Calculate Real Distance or Use Simulated
                    // Prioritize: 1. Real Calc (if Geom exists) 2. Existing Real 3. Simulated/Predicted
                    let distStr = p.dist || p._realDistance || p._simulatedDist || '...';
                    
                    if (latlng && p.geometry && p.geometry.location) {
                        const placeLoc = p.geometry.location;
                        // Use internal Haversine to avoid dependency on geometry lib
                        const dKm = haversineDistance(latlng.lat, latlng.lng, placeLoc.lat(), placeLoc.lng());
                        distStr = dKm.toFixed(1) + ' km';
                    }
                    
                    // Determine Icon/Color based on type
                    let icon = 'fa-map-pin';
                    let styles = 'bg-slate-50 text-slate-600';
                    
                    const t = p.types || [];
                    if (t.includes('shopping_mall')) { icon = 'fa-bag-shopping'; styles = 'bg-pink-50 text-pink-500'; }
                    else if (t.includes('university') || t.includes('school')) { icon = 'fa-graduation-cap'; styles = 'bg-blue-50 text-blue-500'; }
                    else if (t.includes('hospital')) { icon = 'fa-hospital'; styles = 'bg-rose-50 text-rose-500'; }
                    else if (t.includes('train_station') || t.includes('transit_station')) { icon = 'fa-train-subway'; styles = 'bg-indigo-50 text-indigo-500'; }
                    else if (t.includes('tourist_attraction')) { icon = 'fa-camera'; styles = 'bg-green-50 text-green-500'; }
                    else if (t.includes('stadium')) { icon = 'fa-bullhorn'; styles = 'bg-amber-50 text-amber-600'; }
                    else if (t.includes('finance')) { icon = 'fa-building'; styles = 'bg-slate-100 text-slate-700'; }
                    
                    // Opacity for prediction to indicate "Estimating"
                    const opacityClass = isPrediction ? 'opacity-70 grayscale-[0.3]' : '';
                    
                    if (displayMode === 'dashboard') {
                        return `
                            <div class="px-3 py-1.5 rounded-full border border-slate-100 flex items-center gap-2 ${styles} ${opacityClass} transition-all duration-500">
                                <i class="fa-solid ${icon} text-xs"></i>
                                <span class="text-xs font-bold">${p.name} <span class="text-[10px] text-slate-400 font-normal ml-1">(${distStr})</span></span>
                            </div>
                        `;
                    } else {
                        // Map Card Format
                        return `
                            <div class="flex items-center gap-2 text-xs bg-white p-2 rounded border border-slate-100 shadow-sm ${opacityClass} transition-all duration-500">
                                 <div class="w-5 h-5 rounded-full flex items-center justify-center ${styles} shrink-0">
                                    <i class="fa-solid ${icon} text-[10px]"></i>
                                 </div>
                                 <div class="flex justify-between w-full min-w-0">
                                    <span class="font-semibold text-slate-700 truncate mr-2" title="${p.name}">${p.name}</span>
                                    <span class="text-[9px] text-slate-400 shrink-0">${distStr}</span>
                                 </div>
                            </div>
                        `;
                    }
                 }).join('');
                 
                 container.innerHTML = html;
                 
                 if (displayMode === 'map') {
                     container.className = 'space-y-2';
                 } else {
                     container.className = 'flex flex-wrap gap-2'; 
                 }
             } else {
                 container.innerHTML = '<span class="text-xs text-slate-400 italic pl-1">Tidak ada lokasi strategis utama dalam radius 2.5 km.</span>';
             }
        }

        // --- DYNAMIC ANALYSIS LOGIC ---
        function showAnalysis(id) {
            const item = window.mapData.find(i => i.id == id);
            if (!item) return;

            // 1. Populate Data
            // Date & Time Logic (Split Schedule)
            const now = new Date();
            let day = 1;
            let timeStr = "09:00 WIB";

            if (now.getDate() >= 15) {
                day = 15;
                timeStr = "17:00 WIB";
            } else {
                day = 1;
                timeStr = "09:00 WIB";
            }
            
            // Create "Cycle Seed" to ensure data changes between cycles
            // Format: YYYYMMDD (e.g., 20260101 or 20260115)
            const cycleSeed = (now.getFullYear() * 10000) + ((now.getMonth() + 1) * 100) + day;
            
            // 1. Populate Data
            // Traffic: Prime Time Average (Updates 2x Month)
            let baseVolume = parseInt(item.trafic || item._displayTraffic || 0);
            if (baseVolume === 0) baseVolume = calculateSmartProfile(item, true); // Fallback
            
            // Apply subtle variation based on Cycle Seed so numbers shift slightly every 2 weeks
            // Use simple pseudo-random based on ID + CycleSeed
            const pseudoRandom = Math.sin(item.id + cycleSeed) * 10000;
            const fluctuation = (pseudoRandom - Math.floor(pseudoRandom)) * 0.1; // ±5% fluctuation
            
            const currentVolume = Math.round(baseVolume * (1 + fluctuation));

            // Format: "15,240 View/Day"
            document.getElementById('kpi-volume').innerText = `${currentVolume.toLocaleString()} View/Day`;
            
            // Trend Logic (Linked to Cycle Seed)
            // Trend changes completely every cycle
            const trendRandom = Math.cos(item.id * cycleSeed);
            const trend = Math.floor(trendRandom * 20); // Range -20% to +20%

            const trendBadge = document.getElementById('kpi-trend-badge');
            const isUp = trend >= 0;
            const trendVal = Math.abs(trend);

            if (isUp) {
                trendBadge.className = "bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-bold text-xs";
                trendBadge.innerHTML = `<i class="fa-solid fa-arrow-up"></i> ${trendVal}%`;
            } else {
                trendBadge.className = "bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold text-xs";
                trendBadge.innerHTML = `<i class="fa-solid fa-arrow-down"></i> ${trendVal}%`;
            }
            
            // Create date object for display
            const updateDate = new Date(now.getFullYear(), now.getMonth(), day);
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            const dateStr = updateDate.toLocaleDateString('id-ID', options);
            
            // Display: "Update: 15 Jan 2026 17:00 WIB (Prime Time)"
            document.getElementById('kpi-trend-text').innerText = `Update: ${dateStr} ${timeStr} (Prime Time)`;
            
            // REMOVED: Status Jalan Logic (as per request)
            
            // AI Score
            const aiScore = calculateSmartProfile(item); // "9.2/10"
            const scoreNum = aiScore.split('/')[0];
            document.getElementById('kpi-score').innerHTML = `${scoreNum}<span class="text-lg font-normal text-indigo-200">/10</span>`;
            
            // Audience (Randomized for demo, or based on location keywords)
            const audiences = [
                "25 - 40 Tahun",
                "18 - 24 Tahun",
                "30 - 50 Tahun",
                "20 - 35 Tahun"
            ];
            // Deterministic random based on ID
            const audIndex = item.id % audiences.length;
            document.getElementById('kpi-audience').innerText = audiences[audIndex];
            
            // 3. Update Vehicle Chart (Dynamic Context)
            renderVehicleChart([item]); // Pass as single-item array to focus context logic
            
            // 4. STRATEGIC LOCATIONS (REAL-TIME PLACES)
            const panel = document.getElementById('analysis-panel');
            let contextBar = document.getElementById('context-poi-bar');
            
            if(!contextBar) {
                 contextBar = document.createElement('div');
                 contextBar.id = 'context-poi-bar';
                 contextBar.className = 'col-span-1 md:col-span-3 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-wrap items-center gap-4';
                 panel.appendChild(contextBar);
            }
            
            // Set Base HTML structure with container for results
            contextBar.innerHTML = `
                <div class="mr-auto flex items-center gap-2">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600"><i class="fa-solid fa-map-pin"></i></div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Lokasi Strategis</p>
                        <p class="text-sm font-bold text-slate-800">Analisis Radius 2.5 KM</p>
                    </div>
                </div>
                <div id="dashboard-poi-list" class="flex flex-wrap gap-2 ml-4"></div>
            `;
            contextBar.style.display = 'flex';
            
            // TRIGGER ASYNC FETCH
            fetchRealPlaces(item, 'dashboard-poi-list', 'dashboard');

            // 5. TRIGGER REAL-TIME VERIFICATION (Consistency with Map)
            if (typeof google !== 'undefined' && google.maps && google.maps.Geocoder) {
                 verifyRoadContext(item);
            }

            // 2. Show Panel
            panel.style.display = 'grid'; // Grid layout
            
            // Custom Scroll with Offset for Header
            // Calculate absolute position of panel
            const bodyRect = document.body.getBoundingClientRect().top;
            const elementRect = panel.getBoundingClientRect().top;
            const elementPosition = elementRect - bodyRect;
            const offsetPosition = elementPosition - 120; // 120px offset for sticky header

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            
            // Highlight Table Row (Optional)
            // ...
        }

        // --- DYNAMIC TRAFFIC CHART LOGIC ---
        let trafficChartInstance = null;

        function renderTrafficChart(top5Data) {
            const ctxTraffic = document.getElementById('trafficChart').getContext('2d');
            
            // Prepare Data
            const labels = top5Data.map(item => {
                // Shorten name for chart labels if too long
                let name = item.location || item.name || 'Lokasi';
                return name.length > 15 ? name.substring(0, 15) + '...' : name;
            });
            const values = top5Data.map(item => item._displayTraffic || 0);

            if (trafficChartInstance) {
                trafficChartInstance.destroy();
            }

            // Create Gradient (Restoring original style)
            let gradient = ctxTraffic.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

            trafficChartInstance = new Chart(ctxTraffic, {
                type: 'line', // Reverted to Line
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Traffic Views',
                        data: values,
                        borderColor: '#2563EB',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.4, // Smooth curve
                        fill: true,   // Area fill
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#2563EB',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toLocaleString() + ' views';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#f1f5f9' },
                            ticks: {
                                callback: function(value) {
                                    return value >= 1000 ? (value/1000).toFixed(0) + 'k' : value;
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10 } }
                        }
                    }
                }
            });
        }

        // --- CHART LOGIC ---
        // (Legacy static chart initialization is removed, handled dynamically by renderTrafficChart called via renderTopSpots)


        // --- VEHICLE CHART LOGIC ---
        let vehicleChartInstance = null;
        // Map Chart Instance Tracker
        let vehicleChartMapInstance = null;

        function renderVehicleChart(data, canvasId = 'vehicleChart', legendId = 'vehicle-legend') {
            // 1. Context-Aware Prediction Engine
            // Analyze the currently filtered data to predict vehicle mix based on "Road Context"
            
            let scoreCar = 0;
            let scoreMotor = 0;
            let scoreBus = 0;
            let count = 0;
            
            // Calculate REAL Total Volume for Estimates
            let totalVolume = 0;

            // Analyze up to Top 50 items to get a better sample size
            const sampleData = data.slice(0, 50);

            sampleData.forEach(item => {
                count++;
                
                // Traffic Calculation
                const itemTraffic = parseInt(item.trafic || item._displayTraffic || calculateSmartProfile(item, true));
                totalVolume += itemTraffic;

                const text = ((item.address || '') + ' ' + (item.location || '')).toLowerCase();
                const type = (item.type && item.type.name ? item.type.name : '').toLowerCase();

                // BASELINE: Indonesia is heavy on Motorbikes
                let sCar = 1; 
                let sMotor = 2.5; 
                let sBus = 0.5;
                
                // Track if this is a Toll Road to enforce rules later
                let isToll = false;

                // CONTEXT 1: ROAD TYPE (The "Google Maps" Logic)
                // Toll roads: Mostly cars/trucks, no bikes
                if (text.includes('tol') || text.includes('highway') || text.includes('bebas hambatan')) {
                    sCar += 5; sMotor = 0; sBus += 3;
                    isToll = true;
                } else if (text.includes('arteri') || text.includes('protokol') || text.includes('bypass')) {
                    sCar += 3; sMotor += 1; sBus += 1;
                } else if (text.includes('gang') || text.includes('jalan tikus') || text.includes('permukiman')) {
                    sCar += 0; sMotor += 5; sBus += 0;
                }

                // CONTEXT 2: POI (Point of Interest)
                if (text.includes('pasar') || text.includes('sekolah') || text.includes('kampus')) {
                    sMotor += 3; // High motorbike traffic areas
                }
                if (text.includes('mall') || text.includes('plaza') || text.includes('perkantoran') || text.includes('office')) {
                    sCar += 3; sMotor += 1; // Cars for shopping/work
                }
                if (text.includes('terminal') || text.includes('stasiun') || text.includes('bandara') || text.includes('pabrik') || text.includes('industri')) {
                    sBus += 4; // Transportation hubs / Industrial
                }

                // CONTEXT 3: MEDIA TYPE (Proxy for Road Class)
                if (type.includes('videotron') || type.includes('megatron')) {
                    sCar += 2; // Premium media usually on big roads
                }
                
                // FINAL ENFORCEMENT for Toll Roads
                if (isToll) {
                    sMotor = 0; // Strictly remove motorcycles regardless of POI proximity
                }

                scoreCar += sCar;
                scoreMotor += sMotor;
                scoreBus += sBus;
            });

            // Fallback if no data
            if (count === 0) { scoreCar = 30; scoreMotor = 60; scoreBus = 10; totalVolume = 10000; }

            // Calculate Percentage
            const totalScore = scoreCar + scoreMotor + scoreBus;
            let pCar = Math.round((scoreCar / totalScore) * 100);
            let pBus = Math.round((scoreBus / totalScore) * 100);
            let pMotor = 100 - pCar - pBus; // Remainder to ensure 100%
            
            // Adjust if negative due to rounding (rare but safe)
            if (pMotor < 0) { pMotor = 0; pCar -= pMotor; } 

            const values = [pCar, pMotor, pBus];
            const labels = ['Mobil', 'Motor', 'Bus/Truk'];
            const colors = ['#3B82F6', '#10B981', '#F59E0B']; // Blue, Green, Orange
            
            // CALCULATE ESTIMATED ABSOLUTE COUNTS
            // If viewing a single item (map analysis), use its specific volume. 
            // If viewing dashboard (aggregate), use average or total sample volume? 
            // Let's use Total Volume of the context (sum of viewed items) for "Total Dashboard" view,
            // or the specific Item Volume for "Map Analysis" view.
            
            // Heuristic: If canvasId is 'mapVehicleChart', we are likely looking at 1 item (logic in showAnalysis passed [item]).
            // So totalVolume is correct.
            // If dashboard, totalVolume might be huge. Let's show "Avg Count" or Scaled Count?
            // Requirement was "Estimasi berapa banyaknya". 
            // For Dashboard: Let's show the breakdown of the TOTAL displayed volume.
            
            const counts = values.map(pct => Math.round(totalVolume * (pct / 100)));

            const canvasEl = document.getElementById(canvasId);
            if (!canvasEl) return;
            
            const ctxVehicle = canvasEl.getContext('2d');
            
            // Destroy specific instance based on ID to avoid conflicts
            if (canvasId === 'vehicleChart') {
                if (vehicleChartInstance) vehicleChartInstance.destroy();
            } else if (canvasId === 'mapVehicleChart') {
                if (vehicleChartMapInstance) vehicleChartMapInstance.destroy();
            }

            const newChart = new Chart(ctxVehicle, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{ 
                        data: values, 
                        backgroundColor: colors, 
                        borderWidth: 0, 
                        hoverOffset: 4 
                    }]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false, 
                    cutout: '75%', 
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    // Use the cached totalVolume to calculate absolute numbers for the tooltip
                                    // We need to access totalVolume. Since it's in the outer scope of this function context, 
                                    // but this callback runs later, we might need to rely on the data passed or recalculate.
                                    // Easier method: Pre-calculate counts in the dataset or metadata.
                                    // Actually, we have 'values' (percentages).
                                    // Let's use the 'counts' array we computed earlier, matching by dataIndex.
                                    
                                    const index = context.dataIndex;
                                    const count = counts[index];
                                    const percentage = context.raw; // The value in 'data' is the percentage
                                    const label = context.label;
                                    
                                    return ` ${label}: ${count.toLocaleString()} (${percentage}%)`;
                                }
                            },
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            padding: 10,
                            cornerRadius: 8,
                            bodyFont: { family: "'Inter', sans-serif", size: 12 }
                        }
                    } 
                }
            });

            // Store instance
            if (canvasId === 'vehicleChart') {
                vehicleChartInstance = newChart;
            } else if (canvasId === 'mapVehicleChart') {
                vehicleChartMapInstance = newChart;
            }

            // Update Custom Legend with Percentages AND COUNTS (Refined Layout)
            const legendEl = document.getElementById(legendId);
            if(legendEl) {
                // Clear any previous class that might force horizontal (just in case)
                legendEl.className = "mt-6 flex flex-col gap-3"; // Force vertical stack with gap

                legendEl.innerHTML = labels.map((label, i) => `
                    <div class="group">
                        <div class="flex justify-between items-center mb-1">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full shadow-sm" style="background-color: ${colors[i]}"></span>
                                <span class="text-sm font-medium text-slate-600">${label}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-bold text-slate-800 tabular-nums">${counts[i].toLocaleString()}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pl-6">
                             <div class="h-1.5 flex-1 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full" style="width: ${values[i]}%; background-color: ${colors[i]};"></div>
                             </div>
                             <span class="text-[10px] font-bold text-slate-400 w-8 text-right">${values[i]}%</span>
                        </div>
                    </div>
                `).join('');
            }
        }

        // --- REAL-TIME ROAD VERIFICATION ---
        function verifyRoadContext(item) {
             const geocoder = new google.maps.Geocoder();
             const latlng = { lat: parseFloat(item.latitude), lng: parseFloat(item.longitude) };
             
             geocoder.geocode({ location: latlng }, (results, status) => {
                 if (status === 'OK' && results[0]) {
                     // Check Types for 'motorway' (Toll/Freeway)
                     // Also check 'route' if it has 'Toll' in the name (fallback)
                     const types = results[0].types;
                     const formattedAddress = results[0].formatted_address.toLowerCase();
                     const addressComponents = results[0].address_components;
                     
                     let isConfirmedToll = false;
                     
                     // 1. Tag Check
                     if (types.includes('motorway') || types.includes('highway')) {
                         isConfirmedToll = true;
                     }
                     
                     // 2. Component Check (Route Name)
                     const route = addressComponents.find(c => c.types.includes('route'));
                     if (route && (route.long_name.toLowerCase().includes('tol') || route.long_name.toLowerCase().includes('toll'))) {
                         isConfirmedToll = true;
                     }
                     
                     if (isConfirmedToll) {
                         // Force update chart for this item
                         console.log("Verified as Toll Road via Geocoder:", item.name);
                         renderVehicleChart([item], 'mapVehicleChart', 'vehicle-legend-map', true);
                         
                         // Add Badge to Card
                         const header = document.getElementById('map-card-address').parentElement;
                         let badge = document.getElementById('road-verified-badge');
                         if(!badge) {
                             badge = document.createElement('div');
                             badge.id = 'road-verified-badge';
                             badge.className = 'mt-1';
                             header.appendChild(badge);
                         }
                         badge.innerHTML = '<span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 text-[9px] font-bold px-1.5 py-0.5 rounded border border-amber-200"><i class="fa-solid fa-road"></i> Verified: JALAN TOL (No Motor)</span>';
                     }
                 }
             });
        }

        // --- FLOATING MAP ANALYSIS LOGIC ---

        function showMapAnalysis(id) {
            const item = window.mapData.find(i => i.id == id);
            if (!item) return;

            // 1. Populate Data
            // Title & Address
            document.getElementById('map-card-title').innerText = item.name || item.location || 'Billboard Location';
            const city = item.city ? item.city.name : '';
            const prov = item.city && item.city.province ? item.city.province.name : '';
            document.getElementById('map-card-address').innerText = `${item.address || ''}, ${city}`;

            // Traffic Logic (Same as Dashboard with Bi-Monthly Cycle)
            // Traffic Logic (Real Data)
            const baseVolume = parseInt(item.trafic || calculateSmartProfile(item, true) || 0);
            document.getElementById('map-card-traffic').innerText = baseVolume.toLocaleString();

            // Formatted Date (Use real last updated or Now)
            const lastUpdate = item.traffic_last_updated ? new Date(item.traffic_last_updated) : new Date();
            const timeStr = lastUpdate.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
            const dateStr = lastUpdate.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            
            // Update Text in Card
            // Target the specific ID we added
            const updatedTextEl = document.getElementById('map-card-updated-text');
            if(updatedTextEl) {
                 updatedTextEl.innerText = `Updated: ${dateStr} ${timeStr}`;
            }

            // Trigger Real-Time Check
            checkSmartTraffic(item.id);

            // AI Score
            const aiScore = calculateSmartProfile(item); // "9.2/10"
            const scoreNum = aiScore.split('/')[0];
            document.getElementById('map-card-score').innerText = scoreNum;

            // Audience (Random or Mock)
            const audiences = ["20-29 Thn", "25-34 Thn", "30-45 Thn", "18-24 Thn"];
            document.getElementById('map-card-audience').innerText = audiences[item.id % audiences.length];

            // 2. Render Map-Specific Vehicle Chart
            // NOW USING SHARED LOGIC for 100% Consistency
            renderVehicleChart([item], 'mapVehicleChart', 'vehicle-legend-map');

            // 3. STRATEGIC LOCATIONS (REAL-TIME PLACES)
            // Use fetchRealPlaces which handles async rendering
            let poiContainer = document.getElementById('map-poi-container');
            
            if (!poiContainer) {
                 // Inject logic: Map Card Content Structure
                 const container = document.getElementById('map-analysis-card').querySelector('.space-y-4');
                 poiContainer = document.createElement('div');
                 poiContainer.id = 'map-poi-container';
                 poiContainer.className = 'bg-slate-50 p-3 rounded-xl border border-slate-100';
                 container.appendChild(poiContainer);
            }
            
            // Set Initial Skeleton
            poiContainer.innerHTML = `
                <div class="flex items-center gap-2 mb-2">
                     <i class="fa-solid fa-map-pin text-blue-500 text-xs"></i>
                     <h5 class="text-[10px] font-bold text-slate-500 uppercase">Lokasi Strategis (1.5 KM)</h5>
                </div>
                <div id="map-poi-list" class="space-y-2">
                    <div class="h-4 bg-slate-200 rounded w-full animate-pulse"></div>
                    <div class="h-4 bg-slate-100 rounded w-3/4 animate-pulse"></div>
                </div>
            `;
            
            // TRIGGER ASYNC FETCH
            fetchRealPlaces(item, 'map-poi-list', 'map');

            // 4. TRIGGER REAL-TIME VERIFICATION (Check if actually Toll Road)
            if (typeof google !== 'undefined' && google.maps && google.maps.Geocoder) {
                // Clear old badge first
                const badge = document.getElementById('road-verified-badge');
                if(badge) badge.remove();
                
                verifyRoadContext(item);
            }

            // 5. Show Card (Slide In)
            const card = document.getElementById('map-analysis-card');
            card.classList.remove('translate-x-[120%]');
            card.classList.add('translate-x-0');
            
            // 6. Bind Report Button
            const btnReport = document.getElementById('btn-generate-report');
            if(btnReport) {
               btnReport.onclick = () => {
                   // Get the EXACT displayed traffic value to ensure consistency
                   const displayedTraffic = document.getElementById('map-card-traffic').innerText.replace(/\D/g, '');
                   window.open('/location-intelligence/' + item.id + '?traffic=' + displayedTraffic, '_blank');
               };
            }
        }

        function closeMapAnalysis() {
            const card = document.getElementById('map-analysis-card');
            card.classList.remove('translate-x-0');
            card.classList.add('translate-x-[120%]');
        }
    </script>
    <script>
        // --- ROBUST GOOGLE MAPS LOADER ---
        // Prevents double loading and ensures libraries are ready
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
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
        })({
            key: "AIzaSyCKgDP4LOkniDYckfr3FuRW45G56yVhnnI",
            v: "weekly",
            loading: "async"
        });

        // --- MODERN INIT ---
        async function initMap() {
            // Wait for Libraries
            const { Map } = await google.maps.importLibrary("maps");
            const { TrafficLayer } = await google.maps.importLibrary("maps"); // TrafficLayer is in maps lib
            const { PlacesService } = await google.maps.importLibrary("places");
            const { Geocoder } = await google.maps.importLibrary("geocoding");
            // const { AdvancedMarkerElement } = await google.maps.importLibrary("marker"); // Future use

            // Default Center (Indonesia)
            const centerIndonesia = { lat: -2.5489, lng: 118.0149 };
            
            mapInstance = new Map(document.getElementById('map-container'), {
                zoom: 5,
                center: centerIndonesia,
                mapTypeId: google.maps.MapTypeId.ROADMAP, 
                streetViewControl: true,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_LEFT
                }
            });

            // ENABLE TRAFFIC LAYER
            const trafficLayer = new TrafficLayer();
            trafficLayer.setMap(mapInstance);

            infoWindow = new google.maps.InfoWindow();

            // Check if data is already loaded
            if (window.mapData && window.mapData.length > 0) {
                renderMarkers(window.mapData);
                 const loadingEl = document.getElementById('map-loading');
                 if (loadingEl) {
                    loadingEl.style.opacity = '0';
                    setTimeout(() => loadingEl.remove(), 500);
                 }
            } else {
                await fetchAndProcessData(true);
            }
        }
        
        // --- HELPER WRAPPERS TO ENSURE LIB IS LOADED ---
        // These functions might be called before map is ready, so we must guard them?
        // Actually initMap is called only when tab is switched.
        // But fetchRealPlaces might be called from Dashboard view (no map yet).
        
        async function ensurePlacesLib() {
             await google.maps.importLibrary("places");
        }

    </script>
</body>
</html>

