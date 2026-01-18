<div class="modal fade" id="analyticsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="analyticsModalTitle">Detail Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">

                <div id="modalLoading" class="text-center p-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="text-muted mt-2 small">Sedang mengambil data dari Google...</p>
                </div>

                <div id="modalTableContainer" class="d-none">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="bg-white sticky-top text-secondary small text-uppercase">
                            <tr>
                                <th class="px-4 py-3" width="50">#</th>

                                <th class="py-3" id="modalHeaderTitle">Judul Halaman</th>
                                <th class="py-3 text-end px-4" width="150" id="modalHeaderViews">Views</th>
                            </tr>
                        </thead>
                        <tbody id="modalTableBody" class="small">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer justify-content-between bg-light">
                <span class="text-muted small" id="pageInfo">Showing 1-10 of 100</span>

                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item">
                            <button class="page-link" onclick="changePage('prev')">Previous</button>
                        </li>
                        <li class="page-item">
                            <button class="page-link" onclick="changePage('next')">Next</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Variabel Global untuk menyimpan state
        var allData = []; // Menyimpan 100 data dari API
        var currentPage = 1; // Halaman aktif
        var rowsPerPage = 10; // Jumlah baris per halaman

        // 1. FUNGSI BUKA MODAL & TARIK DATA
        async function openDetailModal(title, apiUrl, headerTitle, headerViews) {
            // Reset State
            allData = [];
            currentPage = 1;

            // Update UI Modal
            document.getElementById('analyticsModalTitle').innerText = title ?? "";


            document.getElementById('modalHeaderTitle').innerText = headerTitle;
            document.getElementById('modalHeaderViews').innerText = headerViews;

            document.getElementById('modalLoading').classList.remove('d-none');
            document.getElementById('modalTableContainer').classList.add('d-none');

            // Tampilkan Modal Bootstrap
            const myModal = new bootstrap.Modal(document.getElementById('analyticsModal'));
            myModal.show();

            try {
                // Request ke API dengan limit besar (misal 100)
                // Kita tambahkan parameter &limit=100 ke URL yang sudah ada
                const separator = apiUrl.includes('?') ? '&' : '?';
                const fullUrl = `${apiUrl}${separator}limit=100`;

                console.log(fullUrl)
                const response = await fetch(fullUrl);
                allData = await response.json();

                // Sembunyikan Loading, Tampilkan Tabel
                document.getElementById('modalLoading').classList.add('d-none');
                document.getElementById('modalTableContainer').classList.remove('d-none');

                // Render Halaman Pertama
                renderTable();

            } catch (error) {
                alert('Gagal mengambil data detail.');
                console.error(error);
            }
        }

        // 2. FUNGSI RENDER TABEL (PAGINATION)
        function renderTable() {
            const tbody = document.getElementById('modalTableBody');
            tbody.innerHTML = '';

            // Hitung index start & end
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            // Ambil potongan data (slice)
            const paginatedItems = allData.slice(start, end);

            if (paginatedItems.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4">Tidak ada data.</td></tr>';
                return;
            }

            // Loop data
            paginatedItems.forEach((item, index) => {

                let titleClass = 'fw-bold text-dark';
                if (item.is_foreign) {
                    titleClass = 'fw-bold text-danger';
                }

                // Logic URL (Kalau listing/artikel ada link, kalau kota kosong)
                let titleHtml = `<div class="${titleClass}">${item.title}</div>`;
                if (item.url) {
                    titleHtml +=
                        `<a href="${item.url}" target="_blank" class="text-decoration-none text-muted d-block text-truncate text-wrap" style="max-width: 350px;">${item.url}</a>`;
                }

                const row = `
                <tr>
                    <td class="px-4 text-muted">${start + index + 1}</td>
                    <td>${titleHtml}</td>
                    <td class="text-end px-4">
                        <span class="badge bg-light text-dark border">
                            ${new Intl.NumberFormat('id-ID').format(item.views)}
                        </span>
                    </td>
                </tr>
            `;
                tbody.innerHTML += row;
            });

            // Update Info Pagination
            document.getElementById('pageInfo').innerText =
                `Menampilkan ${start + 1}-${Math.min(end, allData.length)} dari ${allData.length} data`;
        }

        // 3. FUNGSI GANTI HALAMAN
        function changePage(direction) {
            const totalPages = Math.ceil(allData.length / rowsPerPage);

            if (direction === 'prev' && currentPage > 1) {
                currentPage--;
            } else if (direction === 'next' && currentPage < totalPages) {
                currentPage++;
            }

            renderTable();
        }
    </script>
@endpush
