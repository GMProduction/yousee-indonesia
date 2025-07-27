@extends('user.base')


@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/becomeapartner.png') }}" />
        </div>
        <div class="g-services" style="justify-content: start">
            <div class="g-menu" style="justify-content: start" role="tablist">
                <a class="menu active" data-bs-toggle="pill" href="#affiliate">Affiliate</a>
                <a class="menu" data-bs-toggle="pill" href="#mitra">Mitra</a>
            </div>

            <div class="tab-content">
                {{-- TAB AFFILIATE --}}
                <div id="affiliate" class="tab-pane active">
                    <div class="pencarian-container contact" style="margin-top: 0">
                        <div class="pencarian-content w-100">
                            <div class="pencarian-wrapper">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 p-sm-20 sm-mb-30">
                                        <p class="title mb-0 text-start">Formulir Affiliate</p>
                                        <p class="title mb-3 text-start">Silakan isi data untuk bergabung sebagai
                                            affiliate
                                            kami.</p>

                                        @if (session('message_affiliate'))
                                            <div class="alert alert-success text-center" role="alert">
                                                {{ session('message_affiliate') }}
                                            </div>
                                        @endif

                                        <form id="useraffiliate-form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nama"
                                                    placeholder="Nama Lengkap">
                                                <label>Nama Lengkap</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Email">
                                                <label>Email</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nophone"
                                                    placeholder="No WA">
                                                <label>No WA</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="domisilikota"
                                                    placeholder="Domisili Kota/Kab Mana?">
                                                <label>Domisili Kota atau Kabupaten</label>
                                            </div>

                                            <div class="mb-3" style="text-align: left">
                                                <label for="cvUpload" class="form-label text-left">Upload CV (PDF) *max
                                                    10MB</label>
                                                <input type="file" class="form-control" name="file_upload"
                                                    id="file_upload">
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn-pasangiklan">Kirim</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="contact">
                                            <p class="header">Gabung Jadi Affiliate</p>
                                            <p class="text">
                                                Ingin dapat penghasilan tambahan tanpa repot? Yuk, jadi bagian dari tim
                                                affiliate kami!
                                                Cukup promosikan layanan sewa media iklan kami seperti billboard,
                                                baliho, dan videotron kepada relasi atau klien potensial.
                                            </p>
                                            <p class="text">
                                                Setiap transaksi yang berhasil dari referensimu akan mendapatkan komisi
                                                menarik. Cocok untuk freelancer, marketing agency, atau siapa pun yang
                                                punya jaringan luas.
                                            </p>
                                            <p class="text mt-3 d-flex flex-column">
                                                <strong>Ingin tahu lebih lanjut?</strong><br>
                                                Hubungi kami melalui WhatsApp:<br>
                                                <a href="https://wa.me/6281225550676" target="_blank"
                                                    style="color: #16a085; font-weight: bold; text-decoration: none;">
                                                    081225550676
                                                </a>
                                                <a style="display: block; text-align: left"
                                                    href="mailto:media.support@yousee-indonesia.com?subject=Permintaan%20Informasi">
                                                    official@yousee-indonesia.com
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB MITRA --}}
                <div id="mitra" class="tab-pane">
                    <div class="pencarian-container contact" style="margin-top: 0">
                        <div class="pencarian-content w-100">
                            <div class="pencarian-wrapper">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 p-sm-20 sm-mb-30">
                                        <p class="title mb-0 text-start">Formulir Mitra / Vendor</p>
                                        <p class="title mb-3 text-start">Silakan isi data untuk mendaftar sebagai mitra
                                            kami.</p>

                                        @if (session('message_mitra'))
                                            <div class="alert alert-success text-center" role="alert">
                                                {{ session('message_mitra') }}
                                            </div>
                                        @endif

                                        <form id="formCalonVendor">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nama_perusahaan"
                                                    placeholder="Nama Perusahaan">
                                                <label>Nama Perusahaan</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nophone"
                                                    placeholder="Kontak / No WA">
                                                <label>Kontak / No WA</label>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn-pasangiklan">Kirim</button>
                                            </div>
                                        </form>

                                    </div>

                                    {{-- Informasi Mitra --}}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="contact">
                                            <p class="header">Bermitra dengan Kami</p>
                                            <p class="text">
                                                Punya media iklan seperti baliho, billboard, videotron atau lahan potensial
                                                untuk beriklan? Jadikan asetmu lebih produktif dengan bergabung sebagai
                                                mitra kami secara digital.
                                            </p>
                                            <p class="text">
                                                Kami bantu kelola, pasarkan dan sewakan media iklan Anda ke klien kami
                                                secara professional. Kemitraan yang saling menguntungkan dan transparan.
                                            </p>
                                            <p class="text">
                                                Kami percaya bahwa kolaborasi yang baik dimulai dari kepercayaan dan sistem
                                                yang solid, mari bertumbuh bersama membentuk masa depan media luar ruang
                                                yang lebih cerdas dan efisien.
                                            </p>
                                            <p class="text mt-3 d-flex flex-column mb-0">
                                                <strong>Siap berkolaborasi?</strong><br>
                                                Silakan hubungi kami di:<br>
                                            <p class="text">
                                                Tim Kemitraan Media Support
                                            </p>
                                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', '882007317221') }}"
                                                target="_blank"
                                                style="color: #16a085; font-weight: bold; text-decoration: none; display: block; text-align: left">
                                                0882007317221
                                            </a>
                                            <a style="display: block; text-align: left"
                                                href="mailto:media.support@yousee-indonesia.com?subject=Permintaan%20Informasi">
                                                media.support@yousee-indonesia.com
                                            </a>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end tab-content --}}
        </div>
    </div>




    {{-- CLIENTS --}}
    <div class="g-container-clients">
        <div class="content">
            <p class="title">Our Happy Clients</p>
            <p class="text">{{ trans('messages.happy_client_description') }}


            </p>
            <div class="mb-5"></div>

        </div>

        <div class="client-list">
            @foreach ($clients as $client)
                <img class="client" loading="lazy" src="{{ asset($client->image) }}" />
            @endforeach

        </div>
    </div>
    <div class="morethan10000">
        <img src="{{ asset('images/local/city.jpg') }}" />
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <p>{{ trans('messages.10.000_titik_billboard_strategi') }} </p>
            <div class="d-flex justify-content-center ">
                <a class="btn-pasangiklan" href="https://wa.me/6281393700771?text=Halo,%20Yousee-indonesia.com"
                    target="_blank">
                    {{ trans('messages.pasang_sekarang') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.contact-map', slideUp);
            ScrollReveal().reveal('.g-container-clients', slideUp);
            ScrollReveal().reveal('.morethan10000', slideUp);

            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>

    <script>
        $('#useraffiliate-form').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menyimpan?',
                text: "Pastikan data sudah benar!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('#useraffiliate-form')[0];
                    let formData = new FormData(form);

                    $.ajax({
                        url: "{{ route('useraffiliate.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Data telah disimpan. Anda akan segera dihubungi oleh team Yousee Indonesia',
                                'success'
                            ).then(() => {
                                window.location.href =
                                    "{{ route('useraffiliate.index') }}";
                            });
                        },
                        error: function(xhr) {
                            let msg = 'Terjadi kesalahan.';
                            if (xhr.responseJSON?.message) {
                                msg = xhr.responseJSON.message;
                            }
                            Swal.fire('Gagal!', msg, 'error');
                        }
                    });
                }
            });
        });

        $('#formCalonVendor').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            // Tampilkan dialog konfirmasi dulu
            Swal.fire({
                title: 'Kirim Data?',
                text: "Pastikan data sudah benar sebelum dikirim.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim data via AJAX setelah user konfirmasi
                    $.ajax({
                        url: "{{ route('calon-vendor.store') }}",
                        method: "POST",
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data calon vendor berhasil dikirim.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                form[0].reset();
                            });
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON?.errors;
                            let message =
                                "Terjadi kesalahan. Pastikan data telah diisi dengan benar.";

                            if (errors) {
                                message = Object.values(errors).join('\n');
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: message
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
