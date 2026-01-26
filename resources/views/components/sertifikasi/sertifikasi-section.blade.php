<div>
    <section class="achievement-hero-section position-relative d-flex align-items-center"
        style="background-image: url('{{ asset('images/local/penghargaan.jpg') }}');">

        {{-- <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div> --}}

        <div class="container position-relative z-2 py-5">
            <div class="row justify-content-end py-lg-5">
                <div class="col-lg-6 col-xl-5 ms-auto" data-aos="fade-up" data-aos-duration="1200">

                    <div class="glass-card p-4 p-md-5 rounded-5 text-white">
                        <div
                            class="d-inline-flex align-items-center gap-2 mb-4 px-3 py-2 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-25">
                            <i class="bi bi-trophy-fill text-warning"></i>
                            <span class="text-uppercase ls-1 fw-bold small">Penghargaan & Sertifikasi</span>
                        </div>

                        <h2 class="display-5 fw-bolder mb-4" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                            Bukti Nyata Komitmen Kualitas & Inovasi.
                        </h2>

                        <p class="lead text-white-50 mb-5" style="font-weight: 300;">
                            Diakui secara resmi oleh pemimpin industri global. Berbagai penghargaan ini menegaskan
                            posisi
                            YouSee sebagai mitra teknologi display terpercaya di Indonesia.
                        </p>

                        <button type="button"
                            class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm hover-glow d-flex align-items-center gap-3"
                            data-bs-toggle="modal" data-bs-target="#achievementsGridModal">
                            <span class="text-black">Lihat Sertifikasi Perusahaan</span>
                            <i class="bi bi-arrow-right-circle-fill text-primary fs-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="achievementsGridModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-5 shadow-lg overflow-hidden">

                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <div>
                        <h4 class="fw-bold mb-1">Sertifikasi Perusahaan</h4>
                        <p class="text-muted small">Klik pada gambar untuk melihat detail dokumen.</p>
                    </div>
                    <button type="button" class="btn-close bg-light p-2 rounded-circle"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

                        <div class="col">
                            <div class="card h-100 border-1 shadow-sm achievement-thumb cursor-pointer"
                                onclick="viewDetail(this)" data-title="Quality Management System"
                                data-desc="Quality Management System."
                                data-file="{{ asset('images/local/iso-9001.jpg') }}">
                                <div class="thumb-wrapper overflow-hidden rounded-3 position-relative bg-light">
                                    <img src="{{ asset('images/local/iso-9001.jpg') }}"
                                        class="w-100 h-100 object-fit-cover thumb-img" alt="Thumbnail">

                                    <div class="thumb-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill text-white fs-3"></i>
                                    </div>
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase"
                                        style="font-size: 0.6rem;">PDF</span>
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold text-dark mb-0 small text-truncate">Quality Management System
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">ISO 9001.jpg</small>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100 border-1 shadow-sm achievement-thumb cursor-pointer"
                                onclick="viewDetail(this)" data-title="Anti bribery Management System"
                                data-desc="Anti bribery Management System."
                                data-file="{{ asset('images/local/iso-37001.jpg') }}">
                                <div class="thumb-wrapper overflow-hidden rounded-3 position-relative bg-light">
                                    <img src="{{ asset('images/local/iso-37001.jpg') }}"
                                        class="w-100 h-100 object-fit-cover thumb-img" alt="Thumbnail">

                                    <div class="thumb-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill text-white fs-3"></i>
                                    </div>
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase"
                                        style="font-size: 0.6rem;">PDF</span>
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold text-dark mb-0 small text-truncate">Anti bribery Management
                                        System
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">ISO 37001.jpg</small>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100 border-1 shadow-sm achievement-thumb cursor-pointer"
                                onclick="viewDetail(this)" data-title="Occupational Healt & Safety Management System"
                                data-desc="Occupational Healt & Safety Management System."
                                data-file="{{ asset('images/local/iso-45001.jpg') }}">
                                <div class="thumb-wrapper overflow-hidden rounded-3 position-relative bg-light">
                                    <img src="{{ asset('images/local/iso-45001.jpg') }}"
                                        class="w-100 h-100 object-fit-cover thumb-img" alt="Thumbnail">

                                    <div class="thumb-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill text-white fs-3"></i>
                                    </div>
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase"
                                        style="font-size: 0.6rem;">PDF</span>
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold text-dark mb-0 small text-truncate">Occupational Healt & Safety
                                        Management System</h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">ISO 45001</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
