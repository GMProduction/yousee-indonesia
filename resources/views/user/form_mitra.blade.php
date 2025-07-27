@extends('user.base')

@section('content')
    <div class="pencarian-container contact" style="margin-top: 0">
        <div class="pencarian-content w-100">
            <div class="pencarian-wrapper">
                <h3 class="mb-4 text-center">Form Pengajuan Mitra</h3>

                <form id="form-pendaftaran" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $vendor->id }}" />

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                            placeholder="Nama CV / PT" value="{{ $vendor->nama_perusahaan }}" required>
                        <label for="nama_perusahaan">Nama CV / PT</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="brand_vendor" id="brand_vendor"
                            placeholder="Brand Vendor" value="{{ $vendor->brand_vendor }}" required>
                        <label for="brand_vendor">Brand Vendor</label>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ $vendor->alamat }}</textarea>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                            value="{{ $vendor->email }}" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nophone" id="nophone" placeholder="No. Telp"
                            value="{{ $vendor->nophone }}" required>
                        <label for="nophone">No. Telp Kantor</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pic" id="pic" placeholder="Nama PIC"
                            value="{{ $vendor->pic }}" required>
                        <label for="pic">Nama PIC</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nomor_pic" id="nomor_pic" placeholder="Nomor PIC"
                            value="{{ $vendor->nomor_pic }}" required>
                        <label for="nomor_pic">Nomor PIC</label>
                    </div>

                    <div class="mb-4">
                        <label for="titik_file" class="form-label">Upload Titik Lokasi (PDF / Excel)</label>
                        <input type="file" class="form-control" name="titik_file" id="titik_file"
                            accept=".pdf,.xls,.xlsx">
                        <small class="text-muted">File harus dalam format .pdf, .xls, atau .xlsx</small>
                    </div>

                    <button type="button" id="submit-btn" class="btn-pasangiklan">Kirim</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <!-- Bootstrap JS (opsional, hanya jika pakai interaksi JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('submit-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Kirim Formulir?',
                text: "Pastikan data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Kirim Sekarang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('form-pendaftaran');
                    const formData = new FormData(form);

                    fetch("/daftar_mitra/store", {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: formData
                        })
                        .then(async response => {
                            const contentType = response.headers.get('content-type');
                            if (contentType && contentType.includes('application/json')) {
                                const data = await response.json();
                                if (response.ok) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: data.message || 'Formulir berhasil dikirim.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href =
                                            "https://yousee-indonesia.com";
                                    });
                                } else {
                                    throw new Error(data.message || 'Gagal mengirim formulir.');
                                }
                            } else {
                                throw new Error('Respons bukan JSON, mungkin halaman error.');
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: error.message || 'Terjadi kesalahan. Silakan coba lagi.'
                            });
                        });
                }
            });
        });
    </script>
@endsection
