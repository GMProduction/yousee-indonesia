@props(['title' => 'Statistik Pengunjung'])

@php
    $chartId = 'chart_' . Str::random(8);
@endphp

<div class="card w-100">
    <div class="card-body">

        <div class="d-flex flex-column  justify-content-between align-items-center mb-4 gap-3">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <div>
                    <h3 class="card-title fw-bold h5 text-dark d-flex align-items-center gap-2 mb-1">
                        {{ $title }}
                    </h3>
                    <p class="text-muted small mb-0">Klik batang grafik untuk melihat detail harian</p>

                </div>
                <div class="w-sm-auto">
                    <x-analytics.year-select :chartId="$chartId" />
                </div>
            </div>
            <div class="position-relative w-100" style="height: 300px;">
                <canvas id="canvasMonthly_{{ $chartId }}"></canvas>

                <div id="loadingMonthly_{{ $chartId }}"
                    class="position-absolute top-0 start-0 w-100 h-100 bg-white d-none align-items-end justify-content-center pb-4 gap-2"
                    style="z-index: 10;">

                    @for ($i = 0; $i < 12; $i++)
                        <div class="placeholder-glow w-100 h-100 d-flex align-items-end justify-content-center">
                            <span class="placeholder col-8 bg-secondary rounded-top opacity-25"
                                style="height: {{ rand(30, 80) }}%; width: 60%;"></span>
                        </div>
                    @endfor
                </div>
            </div>


        </div>



        <div id="containerDaily_{{ $chartId }}" class="mt-4 border-top pt-4 d-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex gap-2">
                    <h4 id="titleDaily_{{ $chartId }}"
                        class="h6 fw-semibold text-secondary d-flex align-items-center gap-2 mb-0">
                        <span class="d-inline-block rounded-circle bg-success"
                            style="width: 10px; height: 10px;"></span>
                        Detail Harian
                    </h4>

                    <button id="btnCityMonth_{{ $chartId }}"
                        class="btn btn-sm btn-outline-primary px-3 rounded-pill" style="font-size: 0.75rem;">
                        <i class="bi bi-geo-alt-fill me-1"></i> Detail Pengunjung Bulan Ini
                    </button>
                </div>
                <button onclick="closeDaily_{{ $chartId }}()"
                    class="btn btn-sm btn-link text-danger text-decoration-none fw-bold px-0">
                    &times; Tutup
                </button>
            </div>

            <div class="position-relative w-100 bg-light rounded p-3 border"
                style="height: 250px; border-style: dashed !important;">
                <canvas id="canvasDaily_{{ $chartId }}"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function() {
            let chartMonthly = null;
            let chartDaily = null;
            const chartId = "{{ $chartId }}";

            // Fungsi Load Bulanan
            window['loadMonthly_' + chartId] = async function() {
                const year = document.getElementById('yearSelect_' + chartId).value;
                const canvas = document.getElementById('canvasMonthly_' + chartId);

                // Ambil elemen Loading
                const loadingOverlay = document.getElementById('loadingMonthly_' + chartId);

                // 1. MULAI LOADING:
                // Tampilkan overlay shimmer, sembunyikan canvas asli (atau biarkan di bawahnya)
                loadingOverlay.classList.remove('d-none');
                loadingOverlay.classList.add('d-flex'); // Agar flex layout batang grafik jalan

                // Hancurkan chart lama dulu biar bersih saat shimmer muncul
                if (chartMonthly) {
                    chartMonthly.destroy();
                    chartMonthly = null;
                }

                try {
                    const response = await fetch(`{{ route('analytics.monthly') }}?year=${year}`);
                    const data = await response.json();

                    const ctx = canvas.getContext('2d');

                    chartMonthly = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: `Total Users ${year}`,
                                data: data.values,
                                backgroundColor: '#0d6efd',
                                borderRadius: 4,
                                barThickness: 'flex',
                                maxBarThickness: 40,
                                hoverBackgroundColor: '#0b5ed7'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            onClick: (e) => handleClick(e),
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        borderDash: [2, 4],
                                        color: '#e9ecef'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            animation: {
                                // Opsional: Matikan animasi chart js biar langsung muncul setelah shimmer selesai
                                duration: 500
                            }
                        }
                    });

                } catch (error) {
                    console.error("Gagal memuat data", error);
                    // Bisa tambahkan pesan error di UI disini kalau mau
                } finally {
                    // 2. SELESAI LOADING:
                    // Sembunyikan overlay shimmer
                    loadingOverlay.classList.remove('d-flex');
                    loadingOverlay.classList.add('d-none');
                }
            };

            function handleClick(e) {
                const points = chartMonthly.getElementsAtEventForMode(e, 'nearest', {
                    intersect: true
                }, true);
                if (points.length) {
                    const index = points[0].index;
                    const year = document.getElementById('yearSelect_' + chartId).value;
                    const month = index + 1;
                    const monthName = chartMonthly.data.labels[index];
                    loadDaily(year, month, monthName);
                }
            }

            async function loadDaily(year, month, name) {
                const container = document.getElementById('containerDaily_' + chartId);
                const btnCity = document.getElementById('btnCityMonth_' + chartId);
                var apiUrl = `{{ route('analytics.daily') }}?year=${year}&month=${month}`;

                btnCity.onclick = function() {
                    const modalTitle = `Top Kota Pengunjung: ${name} ${year}`;

                    // Panggil API baru kita
                    apiUrl = `{{ route('analytics.city-month') }}?year=${year}&month=${month}`;

                    openDetailModal(
                        modalTitle,
                        apiUrl, 'Nama Kota (Negara)',
                        'Total Pengunjung');
                }

                container.classList.remove('d-none');

                container.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                document.getElementById('titleDaily_' + chartId).innerText = `Detail: ${name} ${year}`;

                const response = await fetch(apiUrl);
                const data = await response.json();

                const ctx = document.getElementById('canvasDaily_' + chartId).getContext('2d');
                if (chartDaily) chartDaily.destroy();

                chartDaily = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels, // Label tanggal: "1", "2", "3"
                        datasets: [{
                            label: 'Pengunjung',
                            data: data.values,
                            borderColor: '#198754', // Hijau
                            backgroundColor: (context) => {
                                const ctx = context.chart.ctx;
                                const gradient = ctx.createLinearGradient(0, 0, 0, 200);
                                gradient.addColorStop(0, 'rgba(25, 135, 84, 0.2)');
                                gradient.addColorStop(1, 'rgba(25, 135, 84, 0)');
                                return gradient;
                            },
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4, // Sedikit diperbesar biar enak diklik
                            pointHoverRadius: 7,
                            pointHitRadius: 10 // Area klik lebih luas
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    footer: (items) => 'Klik untuk detail kota' // Petunjuk untuk user
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [2, 4],
                                    color: '#e9ecef'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },

                        // --- EVENT KLIK DISINI ---
                        onClick: (e) => {
                            const points = chartDaily.getElementsAtEventForMode(e, 'nearest', {
                                intersect: true
                            }, true);

                            if (points.length) {
                                const index = points[0].index;
                                const dayLabel = chartDaily.data.labels[
                                    index]; // Dapat angka tanggal "1", "15", dll

                                // FORMAT TANGGAL YYYY-MM-DD
                                // Kita butuh padStart biar jadi "01", "05"
                                const formattedDay = String(dayLabel).padStart(2, '0');
                                const formattedMonth = String(month).padStart(2, '0');
                                const fullDate = `${year}-${formattedMonth}-${formattedDay}`;

                                // Judul Modal
                                const modalTitle =
                                    `Pengunjung per Kota: ${formattedDay} ${name} ${year}`;

                                // URL API dengan parameter date
                                // Pastikan route 'analytics.city-date' sudah ada
                                const apiUrl = `{{ route('analytics.city-date') }}?date=${fullDate}`;

                                // Panggil Modal Global (AnalyticsModal)
                                // Pastikan script modal sudah ada di dashboard utama
                                openDetailModal(modalTitle, apiUrl, 'Kota', 'Pengunjung');

                            }
                        },
                        // Cursor pointer saat hover titik
                        onHover: (event, chartElement) => {
                            event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                        }
                    }
                });

            }

            // Fungsi Tutup (Gunakan d-none)
            window['closeDaily_' + chartId] = function() {
                document.getElementById('containerDaily_' + chartId).classList.add('d-none');
            }

            window['loadMonthly_' + chartId]();
        })();
    </script>
@endpush
