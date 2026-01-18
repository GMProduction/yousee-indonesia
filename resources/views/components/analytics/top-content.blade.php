@props(['title', 'apiUrl'])

@php
    $componentId = 'topContent_' . Str::random(8);
@endphp
<div class="menu-container">
    <div class="menu">
        <div class="card-header bg-white border-0 py-3 d-flex align-items-center gap-2">
            <div class="bg-light p-2 rounded text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1rem;">{{ $title }}</h5>
        </div>


        <div id="loading_{{ $componentId }}" class="p-4">
            @for ($i = 0; $i < 5; $i++)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-light rounded" style="width: 20px; height: 20px;"></div>
                    <div class="flex-grow-1">
                        <div class="bg-light rounded w-75 mb-1" style="height: 14px;"></div>
                        <div class="bg-light rounded w-50" style="height: 10px;"></div>
                    </div>
                    <div class="bg-light rounded" style="width: 40px; height: 20px;"></div>
                </div>
            @endfor
        </div>

        <div id="list_{{ $componentId }}" class="list-group list-group-flush d-none">
        </div>

        <div id="error_{{ $componentId }}" class="p-4 text-center text-danger d-none small">
            Gagal memuat data.
        </div>
        <div class="p-3 text-center border-top">
            <a href="#"
                onclick="openDetailModal('{{ $title }}', '{{ $apiUrl }}', 'Judul Halaman', 'Views')"
                class="text-decoration-none fw-bold small text-primary">
                Lihat Semua Data &rarr;
            </a>
        </div>
    </div>


</div>

@push('scripts')
    <script>
        (async function() {
            const listContainer = document.getElementById('list_{{ $componentId }}');
            const loadingContainer = document.getElementById('loading_{{ $componentId }}');
            const errorContainer = document.getElementById('error_{{ $componentId }}');

            try {
                // Panggil API
                const response = await fetch("{{ $apiUrl }}");
                const data = await response.json();

                if (data.length === 0) {
                    listContainer.innerHTML = '<div class="p-4 text-center text-muted small">Belum ada data.</div>';
                } else {
                    // Loop data dan bikin HTML string
                    let html = '';
                    data.forEach((item, index) => {
                        html += `
                        <div class="list-group-item border-0 d-flex align-items-start gap-3 py-3 px-4">
                            <div class="text-muted fw-bold" style="font-size: 1.2rem; min-width: 20px;">
                                ${index + 1}
                            </div>
                            <div class="flex-grow-1" style="min-width: 0;">
                                <h6 class="mb-1 fw-semibold text-dark text-truncate" title="${item.title}">
                                    ${item.title}
                                </h6>
                                <a href="${item.url}" target="_blank" class="text-decoration-none text-secondary small d-block text-truncate text-wrap">
                                    ${item.url}
                                </a>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                    ${new Intl.NumberFormat('id-ID').format(item.views)} Views
                                </span>
                            </div>
                        </div>
                    `;
                    });
                    listContainer.innerHTML = html;
                }

                // Switch Tampilan
                loadingContainer.classList.add('d-none'); // Sembunyikan Loading
                listContainer.classList.remove('d-none'); // Tampilkan Data

            } catch (error) {
                console.error(error);
                loadingContainer.classList.add('d-none');
                errorContainer.classList.remove('d-none');
            }
        })();
    </script>
@endpush
