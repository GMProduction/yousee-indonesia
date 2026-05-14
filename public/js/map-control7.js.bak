var map_container;
var map_container_single;
var center_indonesia = { lat: -0.4029326, lng: 110.5938779 };

var s_provinsi = localStorage.getItem("s_provinsi") || "";
var s_kota = localStorage.getItem("s_kota") || "";
var s_tipe = localStorage.getItem("s_tipe") || "";
var s_posisi = localStorage.getItem("s_posisi") || "";

var IMG_BASE =
    location.protocol === "https:"
        ? "https://internal.yousee-indonesia.com"
        : "http://internal.yousee-indonesia.com";

function escapeHtml(str) {
    if (str == null) return "";
    return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#39;");
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

// --- REAL-TIME PLACES API ---
// --- REAL-TIME PLACES API ---
function fetchRealPlaces(item, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Loading State
    container.innerHTML = `
        <div style="display:flex; align-items:center; gap:6px; color:#64748b; font-size:10px; padding:4px 0;">
             <i class="fa-solid fa-circle-notch fa-spin" style="color:#3b82f6;"></i> Loading Data...
        </div>
    `;

    // --- FALLBACK LOGIC ---
    const renderFallback = (existingItems = []) => {
        const text = ((item.address || '') + ' ' + (item.location || '') + ' ' + (item.name || '')).toLowerCase();
        const city = item.city && item.city.name ? item.city.name : '';
        let fallbacks = [...existingItems];

        // 1. Keyword Extraction (Context from Address)
        const keywords = [
            { key: 'terminal', label: 'Dekat Terminal Bus' },
            { key: 'stasiun', label: 'Akses Stasiun Kereta' },
            { key: 'pasar', label: 'Dekat Pasar Tradisional' },
            { key: 'simpang', label: 'Persimpangan Utama' },
            { key: 'lampu merah', label: 'Area Lampu Merah' },
            { key: 'jalan raya', label: 'Jalan Raya Utama' },
            { key: 'tol', label: 'Akses Jalan Tol' },
            { key: 'alun', label: 'Pusat Keramaian' },
            { key: 'kampus', label: 'Kawasan Pendidikan' },
            { key: 'univ', label: 'Kawasan Pendidikan' },
            { key: 'sekolah', label: 'Area Sekolah' },
            { key: 'mall', label: 'Pusat Perbelanjaan' },
            { key: 'plaza', label: 'Pusat Perbelanjaan' },
            { key: 'rs', label: 'Fasilitas Kesehatan' },
            { key: 'sakit', label: 'Fasilitas Kesehatan' }
        ];

        const found = keywords.find(k => text.includes(k.key));
        if (found) {
            // Avoid duplicate if API already found something similar? 
            // Simple check: don't add if we already have 3
            if (fallbacks.length < 3) {
                fallbacks.push({ name: found.label, dist: 'Area', isFallback: true });
            }
        }

        // 2. City Context (Always available as Backfill)
        if (city) {
            fallbacks.push({ name: `Pusat Kota ${city}`, dist: '2-3 km', isFallback: true });
            fallbacks.push({ name: `Kawasan Bisnis ${city}`, dist: '2-3 km', isFallback: true });
            fallbacks.push({ name: `Akses Jalan Utama ${city}`, dist: '1-2 km', isFallback: true });
        }

        // Ensure unique & Force 3 items
        const unique = fallbacks.filter((v, i, a) => a.findIndex(t => (t.name === v.name)) === i).slice(0, 3);

        const html = unique.map(p => `
            <div style="display:flex; align-items:center; gap:6px; background:#f8fafc; padding:6px; border-radius:4px; border:1px solid #e2e8f0;">
                    <span style="color:#${p.isFallback ? '94a3b8' : '3b82f6'}; font-size:10px;">${p.isFallback ? '📍' : '🎯'}</span>
                    <span style="font-size:10px; font-weight:600; color:#475569; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; flex:1;">${escapeHtml(p.name)}</span>
                    <span style="font-size:9px; color:#94a3b8;">${p.dist || p._realDistance.toFixed(1) + ' km'}</span>
            </div>
        `).join('');
        container.innerHTML = html;
    };

    const dummyMap = document.createElement('div');
    const service = new google.maps.places.PlacesService(dummyMap);

    let searchContext = item.location || item.address || (item.city && item.city.name) || '';
    if (searchContext.toLowerCase().includes('tol') || searchContext.toLowerCase().includes('highway')) {
        searchContext = item.city && item.city.name ? item.city.name : 'Sekitar';
    }

    const query = `landmark, hospital, mall, school, university, office, bank, market near ${searchContext}`;
    const latlng = { lat: parseFloat(item.latitude), lng: parseFloat(item.longitude) };
    const request = {
        query: query,
        location: latlng,
        radius: 2500, // 2.5 KM
    };

    service.textSearch(request, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
            const maxRadius = 3.0; // Slightly looser than dashboard strict 2.5 to ensure results
            const validPlaces = results.map(p => {
                const placeLoc = p.geometry.location;
                const distKm = haversineDistance(
                    latlng.lat, latlng.lng,
                    placeLoc.lat(), placeLoc.lng()
                );
                p._realDistance = distKm;
                p.dist = distKm.toFixed(1) + ' km'; // For compatibility
                return p;
            }).filter(p => p._realDistance <= maxRadius)
                .sort((a, b) => b.user_ratings_total - a.user_ratings_total)
                .slice(0, 3); // Top 3 only

            // FORCE 3 ITEMS: Backfill if validPlaces < 3
            if (validPlaces.length < 3) {
                renderFallback(validPlaces);
            } else {
                // We have 3 valid real places, render directly
                const html = validPlaces.map(p => `
                    <div style="display:flex; align-items:center; gap:6px; background:#f8fafc; padding:6px; border-radius:4px; border:1px solid #e2e8f0;">
                         <span style="color:#3b82f6; font-size:10px;">🎯</span>
                         <span style="font-size:10px; font-weight:600; color:#475569; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; flex:1;">${escapeHtml(p.name)}</span>
                         <span style="font-size:9px; color:#94a3b8;">${p._realDistance.toFixed(1)} km</span>
                    </div>
                `).join('');
                container.innerHTML = html;
            }
        } else {
            renderFallback();
        }
    });
}

function normalizeImageUrl(raw) {
    if (!raw) return { primary: "", alt: "" };
    raw = String(raw).trim();

    if (/^https?:\/\//i.test(raw)) {
        var isHttp = raw.startsWith("http://");
        return {
            primary:
                isHttp && location.protocol === "https:"
                    ? raw.replace("http://", "https://")
                    : raw,
            alt: isHttp ? raw : raw.replace("https://", "http://"),
        };
    }

    if (raw.startsWith("//")) {
        return {
            primary:
                (location.protocol === "https:" ? "https:" : "http:") + raw,
            alt: (location.protocol === "https:" ? "http:" : "https:") + raw,
        };
    }

    var joined = raw.startsWith("/") ? IMG_BASE + raw : IMG_BASE + "/" + raw;
    return {
        primary:
            joined.startsWith("http://") && location.protocol === "https:"
                ? joined.replace("http://", "https://")
                : joined,
        alt: joined.startsWith("https://")
            ? joined.replace("https://", "http://")
            : joined.replace("http://", "https://"),
    };
}

async function fetchImageFromScraper(slug) {
    try {
        if (!slug) return null;
        var res = await fetch("/scraper.php?slug=" + encodeURIComponent(slug), {
            cache: "no-store",
        });
        if (!res.ok) {
            // Avoid throwing to prevent 'Uncaught (in promise)' noise if not handled upstream
            console.warn("Scraper fetch failed HTTP " + res.status);
            return null;
        }
        var json = await res.json();
        if (json && json.imgUrl) {
            var pair = normalizeImageUrl(json.imgUrl);
            return pair.primary || pair.alt || null;
        }
    } catch (e) {
        console.warn("[scraper.php] gagal:", e);
    }
    return null;
}

function getFallbackImageFromPayload(d) {
    var raw = d.image3 || d.image2 || d.image1 || "";
    var pair = normalizeImageUrl(raw);
    return pair.primary || pair.alt || "";
}

function initMap() {
    var myLatLng = { lat: -2.5489, lng: 118.0149 }; // Indonesia Center
    map_container = new google.maps.Map(document.getElementById("main-map"), {
        zoom: 5,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        streetViewControl: false,
        mapTypeControl: true, // Enable Satellite/Map toggle
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_LEFT
        }
    });

    // Add Traffic Layer (Dashboard Style)
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map_container);

    // Initialize Global InfoWindow
    singleInfoWindow = new google.maps.InfoWindow();

    generateGoogleMapData();
}

async function generateGoogleMapData() {
    try {
        $("#loading").show();
        var progressBar = $("#progress-bar");
        var progress = 0;
        var interval = setInterval(function () {
            if (progress < 90) {
                progress += 10;
                progressBar.css("width", progress + "%").text(progress + "%");
            }
        }, 300);

        var params = {
            province: localStorage.getItem("s_provinsi") || "",
            city: localStorage.getItem("s_kota") || "",
            type: localStorage.getItem("s_tipe") || "",
            position: localStorage.getItem("s_posisi") || "",
        };
        var queryString = $.param(params);
        var response = await $.get("/map/data?" + queryString);
        var payload = response["payload"] || [];

        clearInterval(interval);
        progressBar.css("width", "100%").text("100%");

        var filteredPayload = payload.filter(function (item) {
            var a = item.latitude,
                b = item.longitude;
            return a >= -11.0 && a <= 6.1 && b >= 95.0 && b <= 141.0;
        });

        removeMultiMarker();
        if (filteredPayload.length > 0) {
            currentPage = 1;
            await createGoogleMapMarker(filteredPayload);
            updateListTitik(filteredPayload);
        }
    } catch (e) {
        console.log(e);
    } finally {
        setTimeout(function () {
            $("#loading").hide();
        }, 500);
    }
}

let currentPage = 1;
const itemsPerPage = 12;

function updateListTitik(titik) {
    var listTitikContainer = $(".list-titik");
    listTitikContainer.empty();

    var totalItems = titik.length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    var start = (currentPage - 1) * itemsPerPage;
    var end = start + itemsPerPage;
    var paginatedItems = titik.slice(start, end);
    var currentLocale = window.location.pathname.split("/")[1] || "id";

    paginatedItems.forEach(function (d) {
        var img = normalizeImageUrl("" + (d.image2 || "")).primary || "";
        var typeName = (d.type && d.type.name) ? d.type.name : 'Billboard';

        var provinceName = (d.city && d.city.province && d.city.province.name) || "";
        var cityName = (d.city && d.city.name) || "";

        // Modern Minimalist Card
        listTitikContainer.append(`
            <a href="/${currentLocale}/listing/${d.slug}" class="d-flex flex-column h-100 text-decoration-none" 
               style="background: #fff; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02); border-radius: 16px; overflow: hidden; transition: all 0.2s ease; min-height: 280px;"
               onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.05)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02)';">
                
                <!-- Image Section -->
                <div style="aspect-ratio: 4/3; overflow: hidden; background: #f8fafc; position: relative; flex-shrink: 0;">
                    <img src="${escapeHtml(img)}" 
                         class="w-100 h-100" 
                         style="object-fit: cover; width:100%; height:100%;" 
                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                    
                    <!-- Fallback -->
                    <div style="display:${img ? 'none' : 'flex'}; flex-direction:column; align-items:center; justify-content:center; width:100%; height:100%; color:#94a3b8;">
                        <span class="material-symbols-outlined mb-2" style="font-size: 32px; color: #cbd5e1;">image_not_supported</span>
                        <span style="font-size: 10px; font-weight: 700; letter-spacing: 1px;">NO IMAGE</span>
                    </div>

                    <!-- Badge -->
                    <div style="position:absolute; bottom:8px; right:8px; background:#16a34a; color:#fff; font-size:10px; font-weight:700; padding:4px 10px; border-radius:6px; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
                        ${escapeHtml(typeName)}
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <div class="mb-3">
                         <!-- Province -->
                         <div class="text-primary mb-1" style="font-weight: 700; font-size: 14px; text-transform: uppercase; line-height: 1.2;">
                            ${escapeHtml(provinceName)}
                         </div>
                         <!-- City -->
                         <div class="text-warning" style="font-weight: 700; font-size: 13px; text-transform: uppercase; line-height: 1.2; color: #f97316 !important;">
                            ${escapeHtml(cityName)}
                         </div>
                    </div>
                    
                    <div class="mt-auto d-flex align-items-center gap-2 text-muted" style="border-top: 1px solid #f1f5f9; padding-top: 12px;">
                        <div style="display:flex; align-items:center; justify-content:center; width:24px; height:24px; background:#f1f5f9; color:#64748b; border-radius:50%; flex-shrink:0;">
                            <span class="material-symbols-outlined" style="font-size: 14px;">location_on</span>
                        </div>
                        <span class="text-dark" style="font-size: 12px; font-weight: 500; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            ${escapeHtml(d.address || 'Lokasi Tanpa Nama')}
                        </span>
                    </div>
                </div>
            </a>
        `);
    });

    var paginationContainer = $("#pagination");
    paginationContainer.empty();
    if (currentPage > 1)
        paginationContainer.append(
            '<a href="#" class="prev-next" id="prev-page">Prev</a>'
        );

    var isMobile = window.innerWidth <= 540;
    var pageStart = isMobile
        ? Math.max(1, currentPage - 2)
        : Math.max(1, currentPage - 4);
    var pageEnd = isMobile
        ? Math.min(totalPages, pageStart + 2)
        : Math.min(totalPages, pageStart + 4);

    for (let i = pageStart; i <= pageEnd; i++) {
        const pageItem = $(
            '<a href="#" class="page-link ' +
            (i === currentPage ? "active" : "") +
            '">' +
            i +
            "</a>"
        );
        pageItem.on("click", function (e) {
            e.preventDefault();
            currentPage = i;
            updateListTitik(titik);
        });
        paginationContainer.append(pageItem);
    }
    if (currentPage < totalPages)
        paginationContainer.append(
            '<a href="#" class="prev-next" id="next-page">Next</a>'
        );

    $("#prev-page").on("click", function (e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            updateListTitik(titik);
        }
    });
    $("#next-page").on("click", function (e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            updateListTitik(titik);
        }
    });
}

var multi_marker = [];

function removeMultiMarker() {
    for (var i = 0; i < multi_marker.length; i++) {
        multi_marker[i].setMap(null);
    }
    multi_marker = [];
}

// Global InfoWindow (Dashboard Style) -> Initialized in initMap
var singleInfoWindow;

function createGoogleMapMarker(payload) {
    return new Promise(function (resolve) {
        var bounds = new google.maps.LatLngBounds();

        payload.forEach(function (v, k) {
            // Dashboard-style Icon Logic
            var iconUrl = v.type && v.type.icon ? v.type.icon : undefined;

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(v["latitude"], v["longitude"]),
                map: map_container,
                icon: iconUrl,
                title: v["name"],
                zIndex: 100 // Standard constant zIndex
            });

            multi_marker.push(marker);

            // Dashboard-style Click Listener (One InfoWindow)
            marker.addListener("click", function () {
                singleInfoWindow.close();
                var content = windowContent(v, k);
                singleInfoWindow.setContent(content);
                singleInfoWindow.open(map_container, marker);

                // Trigger Async Data Fetch
                setTimeout(function () {
                    fetchRealPlaces(v, 'places-list-' + v.id);
                }, 100);
            });

            bounds.extend(marker.getPosition());
        });

        // Only fit bounds if we have markers (and not resetting filters excessively)
        if (payload.length > 0) {
            map_container.fitBounds(bounds);
        }
        resolve();
    });
}

// --- SMART PROFILE LOGIC (Ported from Dashboard) ---
function calculateSmartProfileHelper(item, numericOnly = false) {
    let baseTraffic = 15000;

    let typeMult = 1.0;
    const typeName = item.type && item.type.name ? item.type.name.toLowerCase() : '';
    if (typeName.includes('videotron') || typeName.includes('megatron') || typeName.includes('led')) {
        typeMult = 2.5;
    } else if (typeName.includes('billboard')) {
        typeMult = 1.8;
    }

    let sizeMult = 1.0;
    const area = (parseFloat(item.width) || 0) * (parseFloat(item.height) || 0);
    if (area > 100) sizeMult = 1.5;
    else if (area > 50) sizeMult = 1.25;

    let locMult = 1.0;
    const address = (item.address || '').toLowerCase() + ' ' + (item.location || '').toLowerCase();
    if (address.includes('sudirman') || address.includes('thamrin') || address.includes('gatot')) locMult = 2.0;
    else if (address.includes('tol') || address.includes('arteri')) locMult = 1.5;
    else if (address.includes('alun')) locMult = 1.3;

    let aiScore = (typeMult * sizeMult * locMult * 1.5);
    if (aiScore > 10) aiScore = 9.8;
    if (aiScore < 4) aiScore = 4.2;

    const today = new Date();
    const day = today.getDay();
    let dayFactor = 1.0;
    if (day === 6) dayFactor = 1.15;
    if (day === 0) dayFactor = 0.85;

    // Consistent Randomness using ID
    const dateStr = today.toISOString().split('T')[0];
    const seed = dateStr.split('').reduce((a, b) => a + b.charCodeAt(0), 0) + (item.id || 0);
    const randomFactor = 0.9 + ((seed % 20) / 100);

    const finalTraffic = Math.floor(baseTraffic * typeMult * sizeMult * locMult * dayFactor * randomFactor);

    if (numericOnly) return finalTraffic;

    return aiScore.toFixed(1) + "/10";
}

function windowContent(data, key) {
    var pathSegments = window.location.pathname.split("/");
    var lang = pathSegments[1] || "id";
    var title = data["location"] || data["name"] || "-";
    if (title === '-' || title === 'null') title = data.address || 'Lokasi Tanpa Nama';

    var address = data["address"] || "";
    var detailUrl = "/" + lang + "/listing/" + data["slug"];

    // Smart Data
    var aiScore = calculateSmartProfileHelper(data);
    var views = calculateSmartProfileHelper(data, true).toLocaleString();

    // Collect all valid images
    var images = [];
    if (data["image1"]) images.push(normalizeImageUrl(data["image1"]).primary);
    if (data["image2"]) images.push(normalizeImageUrl(data["image2"]).primary);
    if (data["image3"]) images.push(normalizeImageUrl(data["image3"]).primary);

    // Fallback if no images
    if (images.length === 0) {
        images.push("https://placehold.co/400x300?text=No+Image");
    }

    // Generate Image Carousel HTML
    // Single Image Logic (Image 2 Priority - as requested for Portrait)
    // images[0] is image1, images[1] is image2 (if exists)
    // We want image2 if available, else image1.

    var imgUrl;
    // Single Image Logic (Image 2 Only - Strict)
    if (data["image2"]) {
        imgUrl = normalizeImageUrl(data["image2"]).primary;
    } else {
        // Jika Image 2 tidak ada, langsung ke No Image (Sesuai Request User)
        imgUrl = "https://placehold.co/400x300?text=No+Image";
    }
    return `
    <div style="font-family:'Plus Jakarta Sans',sans-serif; width:280px; text-align:left;">
        <!-- Image Header Wrapper (Relative) -->
        <div style="position:relative; width:100%; height:160px; background:#f1f5f9; border-radius:8px 8px 0 0; overflow:hidden;">

            <!-- Overlay Labels (Fixed relative to Header) -->
            <div style="position:absolute; top:8px; left:8px; background:#2563eb; color:#fff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px; text-transform:uppercase; z-index:20; pointer-events:none;">
                ${escapeHtml((data.type && data.type.name) || 'Billboard')}
            </div>

            <!-- Overlay Labels (Fixed relative to Header) -->
            <div style="position:absolute; bottom:0; left:0; width:100%; background:rgba(234, 179, 8, 0.95); color:#fff; font-size:10px; font-weight:700; padding:4px 8px; text-transform:uppercase; z-index:20; pointer-events:none;">
                <i class="fa-solid fa-eye" style="margin-right:4px"></i> ${escapeHtml(title)}
            </div>

            <!-- Scroll Hint -->
            <div style="position:absolute; bottom:30px; right:8px; background:rgba(0,0,0,0.5); color:#fff; padding:2px 6px; border-radius:10px; font-size:9px; z-index:20; pointer-events:none;">
                Scroll ⬇
            </div>

            <!-- Scrollable Image Container (Clickable) -->
            <div style="width:100%; height:100%; overflow-y:auto; scrollbar-width:thin;">
                 <img src="${escapeHtml(imgUrl)}" 
                      style="width:100%; height:auto; display:block; cursor:pointer; transition:filter 0.2s;" 
                      onclick="window.openImagePreview(this.src)"
                      onmouseover="this.style.filter='brightness(0.9)'"
                      onmouseout="this.style.filter='brightness(1)'">
            </div>
        </div>

        <!--Content -->
        <div style="padding:12px; background:#fff; border:1px solid #e2e8f0; border-top:none; border-radius:0 0 8px 8px;">
            <h3 style="font-weight:700; color:#1e293b; font-size:14px; margin:0 0 4px; line-height:1.2; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">
                ${escapeHtml(title)}
            </h3>
            <p style="font-size:11px; color:#64748b; display:flex; align-items:flex-start; margin:0 0 12px; gap:4px;">
                <span style="color:#ef4444; margin-top:2px;">📍</span>
                <span style="overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">${escapeHtml(address)}</span>
            </p>

            <!-- LOKASI STRATEGIS (REPLACEMENT) -->
            <!-- LOKASI STRATEGIS (REAL-TIME) -->
            <div style="margin-bottom:12px;">
                <p style="font-size:10px; font-weight:700; color:#94a3b8; margin:0 0 4px; text-transform:uppercase; display:flex; align-items:center; gap:4px;">
                    <i class="fa-solid fa-map-location-dot" style="color:#6366f1;"></i> Lokasi Strategis Dekat
                </p>
                <!-- Container for Async Places -->
                <div id="places-list-${data.id}" style="display:flex; flex-direction:column; gap:4px; min-height:60px;"></div>
            </div>

            <!-- Meta -->
            <div style="display:flex; justify-content:space-between; font-size:10px; color:#64748b; margin-bottom:12px;">
                <span style="background:#f8fafc; padding:2px 6px; border-radius:4px; border:1px solid #f1f5f9;">
                    📐 ${escapeHtml(data.width || 0)}m x ${escapeHtml(data.height || 0)}m
                </span>
                <span style="font-weight:700; text-transform:uppercase; color:#475569;">
                    ${escapeHtml(data.position || 'Horizontal')}
                </span>
                <span style="background:#f8fafc; padding:2px 6px; border-radius:4px; border:1px solid #f1f5f9;">
                    📺 ${escapeHtml(data.side || 1)} Sisi
                </span>
            </div>

            <!-- Action -->
            <!-- Action Buttons (Flex) -->
            <div style="display:flex; gap:8px; width:100%;">
                <a href="${detailUrl}" target="_blank" style="flex:1; display:flex; align-items:center; justify-content:center; background:#2563eb; color:#fff; font-size:13px; font-weight:700; padding:10px; border-radius:6px; text-decoration:none; transition:background 0.2s;">
                    Lihat Detail
                </a>
                <button onclick="addToCart('${data.id}', '${(data.address || "").replace(/'/g, "\\'")}', '${data.slug}')" style="flex:1; display:flex; align-items:center; justify-content:center; background:#eab308; color:#fff; font-size:13px; font-weight:700; padding:10px; border-radius:6px; border:none; cursor:pointer; transition:background 0.2s;">
                    <i class="fa-solid fa-cart-shopping" style="margin-right:4px;"></i> + Keranjang
                </button>
            </div>
        </div>
    </div > `;
}



async function openDetail(element) {
    event.preventDefault();
    var id = element.dataset.id;
    await generateSingleGoogleMapData(id);
    $("#simple-modal-detail").modal("show");
}

async function generateSingleGoogleMapData(id) {
    try {
        var payload = id;
        if (typeof id === "string") {
            var response = await $.get("/map/data/" + id);
            payload = response.payload;
        } else {
            if (typeof getUrl === "function") {
                var url = await getUrl(id.id);
                payload.url = url;
            }
        }

        var location = { lat: payload["latitude"], lng: payload["longitude"] };
        map_container_single = new google.maps.Map(
            document.getElementById("single-map-container"),
            {
                zoom: 16,
                center: location,
            }
        );
        new google.maps.Marker({
            position: new google.maps.LatLng(
                payload["latitude"],
                payload["longitude"]
            ),
            map: map_container_single,
            icon:
                payload["type"] && payload["type"]["icon"]
                    ? payload["type"]["icon"]
                    : undefined,
            title: payload["name"],
        });
        generateDetail(payload);
    } catch (e) {
        console.log(e);
    }
}

function generateDetail(data) {
    $("#detail-title-tipe").html(data["type"]["name"]);
    $("#detail-title-nama").html("( " + data["name"] + " )");
    $("#detail-vendor").val(
        data["vendor_all"]["name"] + " (" + data["vendor_all"]["brand"] + ")"
    );
    $("#detail-vendor-address").val(data["vendor_all"]["address"]);
    $("#detail-vendor-email").val(data["vendor_all"]["email"]);
    $("#detail-vendor-phone").val(data["vendor_all"]["picPhone"]);
    $("#detail-vendor-phone-pic").val(data["vendor_all"]["picPhone"]);
    $("#detail-vendor-pic").val(data["vendor_all"]["picName"]);
    $("#detail-provinsi").val(data["city"]["province"]["name"]);
    $("#detail-kota").val(data["city"]["name"]);
    $("#detail-alamat").val(data["address"]);
    $("#detail-lokasi").val(data["location"]);
    $("#detail-coordinate").val(data["latitude"] + ", " + data["longitude"]);
    $("#detail-tipe").val(data["type"]["name"]);
    $("#detail-posisi").val(data["position"]);
    $("#detail-panjang").val(data["height"]);
    $("#detail-lebar").val(data["width"]);
    $("#detail-qty").val(data["qty"]);
    $("#detail-side").val(data["side"]);
    $("#detail-trafic").val(data["trafic"]);
    $("#single-map-container-street-view").html(data["url"]);

    var f1 = normalizeImageUrl(data["image1"] || "").primary;
    var f2 = normalizeImageUrl(data["image2"] || "").primary;
    var f3 = normalizeImageUrl(data["image3"] || "").primary;

    $("#detail-gambar-1").attr("src", f1 || f2 || f3 || "");
    $("#detail-gambar-2").attr("src", f2 || f1 || f3 || "");
    $("#detail-gambar-3").attr("src", f3 || f2 || f1 || "");

    $("#link-gbr1").attr("href", f1 || "#");
    $("#dwnld-gbr1").attr({ href: f1 || "#", download: f1 || "" });
    $("#link-gbr2").attr("href", f2 || "#");
    $("#dwnld-gbr2").attr({ href: f2 || "#", download: f2 || "" });
    $("#link-gbr3").attr("href", f3 || "#");
    $("#dwnld-gbr3").attr({ href: f3 || "#", download: f3 || "" });

    var picPhone = (data["vendor_all"]["picPhone"] || "")
        .split("/")[0]
        .split(" ")
        .join("");
    if (picPhone && picPhone[0] === "0")
        picPhone = "62" + picPhone.substring(1);
    var text =
        "Apakah " +
        data["type"]["name"] +
        " yang berlokasi di " +
        (data["city"]["name"] || "") +
        " " +
        (data["address"] || "") +
        " " +
        (data["location"] || "") +
        " tersedia ?";
    $(".sendWa")
        .attr("href", "https://wa.me/" + picPhone + "?text=" + encodeURI(text))
        .attr("target", "_blank");
}

// Lightbox Logic
window.openImagePreview = function (url, title) {
    // Remove existing lightbox if any
    var existing = document.getElementById('lightbox-overlay');
    if (existing) existing.remove();

    // Create Overlay
    var overlay = document.createElement('div');
    overlay.id = 'lightbox-overlay';
    overlay.style.cssText = 'position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,0.9); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity 0.3s; padding:20px;';

    // Image Container
    var container = document.createElement('div');
    container.style.cssText = 'position:relative; max-width:100%; max-height:100%; text-align:center;';

    // Image
    var img = document.createElement('img');
    img.src = url;
    img.style.cssText = 'max-width:100%; max-height:90vh; border-radius:8px; box-shadow:0 0 20px rgba(0,0,0,0.5); object-fit:contain; border:2px solid #fff;';

    // Close Button
    var closeBtn = document.createElement('button');
    closeBtn.innerHTML = '&times;';
    closeBtn.style.cssText = 'position:absolute; top:-40px; right:0; background:none; border:none; color:#fff; font-size:40px; cursor:pointer; padding:0; line-height:1; text-shadow:0 1px 3px rgba(0,0,0,0.5); font-family:sans-serif; transition:transform 0.2s;';
    closeBtn.onmouseover = function () { this.style.transform = 'scale(1.2)'; };
    closeBtn.onmouseout = function () { this.style.transform = 'scale(1)'; };
    closeBtn.onclick = function (e) {
        e.stopPropagation();
        overlay.style.opacity = '0';
        setTimeout(function () { overlay.remove(); }, 300);
    };

    // Close on Backdrop Click
    overlay.onclick = function (e) {
        if (e.target === overlay || e.target === container) {
            overlay.style.opacity = '0';
            setTimeout(function () { overlay.remove(); }, 300);
        }
    };

    // Append Elements
    container.appendChild(closeBtn);
    container.appendChild(img);
    overlay.appendChild(container);
    document.body.appendChild(overlay);

    // Fade In
    requestAnimationFrame(function () {
        overlay.style.opacity = '1';
    });
};
