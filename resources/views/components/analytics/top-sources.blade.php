<div class="card analytics-card h-100">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="bi bi-bar-chart-fill me-2 text-primary"></i>Traffic Sources</h6>
        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 rounded-pill">Top 15</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4 border-0">Source</th>
                        <th class="text-end border-0">Users</th>
                        <th class="text-end pe-4 border-0">Ratio</th>
                    </tr>
                </thead>
                <tbody id="traffic-table-body">
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadTrafficSources();
        });

        function loadTrafficSources() {
            // URL Route yang kita buat tadi
            const url = "{{ route('analytics.sources') }}";
            const tableBody = document.getElementById('traffic-table-body');

            fetch(url)
                .then(response => response.json())
                .then(res => {
                    if (res.status === 'success') {
                        // 1. Hapus Loading Spinner
                        tableBody.innerHTML = '';

                        // 2. Loop Data
                        if (res.data.length === 0) {
                            tableBody.innerHTML =
                                '<tr><td colspan="3" class="text-center py-3">Tidak ada data.</td></tr>';
                            return;
                        }

                        res.data.forEach(item => {
                            // Logic Badge Iklan
                            let badgeHtml = '';
                            let subText = '';

                            if (item.is_ad) {
                                // Kalo Iklan
                                badgeHtml =
                                    `<span class="badge bg-warning text-dark ms-2" style="font-size: 0.6rem;">ADS</span>`;
                                subText = 'Paid Traffic (Iklan)';
                            } else if (item.medium === 'organic') {
                                // Kalo Murni SEO (Google Search, Bing, Yahoo)
                                subText = 'Organic Search (SEO)';
                            } else if (item.medium === 'referral') {
                                // Kalo dari Website Lain (Backlink)
                                subText = 'Referral / Link Website';
                            } else if (item.name.toLowerCase().includes('direct') || item.medium === '(none)') {
                                // Kalo ketik sendiri
                                subText = 'Langsung (Direct)';
                            } else {
                                // Lain-lain
                                subText = 'Other Traffic';
                            }

                            // Template Row HTML
                            const row = `
                        <tr>
                            <td class="ps-4 border-bottom-0 py-3">
                                <div class="d-flex align-items-center">
                                   <div class="icon-wrapper me-3">
                                        <i class="bi ${item.icon} ${item.color}"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark d-flex align-items-center">
                                            ${item.name} ${badgeHtml}
                                        </div>
                                        <small class="text-muted" style="font-size: 0.75rem;">${subText}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end fw-bold text-dark border-bottom-0">
                                ${new Intl.NumberFormat('id-ID').format(item.users)}
                            </td>
                            <td class="text-end pe-4 border-bottom-0">
                                <div class="d-flex align-items-center justify-content-end">
                                    <span class="small text-muted me-2">${item.percent}%</span>
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: ${item.percent}%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;

                            // Masukkan ke Tabel
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        console.error('GA Error:', res.message);
                        tableBody.innerHTML =
                            '<tr><td colspan="3" class="text-center text-danger py-3">Gagal memuat data.</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    tableBody.innerHTML =
                        '<tr><td colspan="3" class="text-center text-danger py-3">Koneksi Error.</td></tr>';
                });
        }
    </script>
@endpush
