@extends('admin.base')

@section('morecss')
    {{-- DROPZONE --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection


@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="/admin/artikel">Data Artikel</a></li>
                        <li class="breadcrumb-item "><a href="#">Tambah Artikel</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada pertanyaan silahkan hubungi admin</span>
                </div>
            </div>


        </div>

        <div class="menu-container">
            <div class="menu">
                <div class="title-container">
                    <p class="title">Tambah Artikel</p>
                </div>



                <input type="hidden" id="d-id" name="d-id">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="p-judulartikel" name="p-judulartikel"
                        placeholder="Judul Artikel">
                    <label for="p-judulartikel" class="form-label">Judul Artikel</label>
                </div>


                <div class=" mb-3">
                    <label for="p-gambar" class="form-label">Gambar Utama</label>

                    <form action="/target" class="dropzone" id="my-dropzone"></form>
                </div>


                <div class="mb-3">
                    <label for="p-notelp" class="form-label">Tambahkan Tags</label>
                    <select class="form-select" id="multiple-select-field" data-placeholder="Choose anything" multiple>
                        <option>Christmas Island</option>
                        <option>South Sudan</option>
                        <option>Jamaica</option>
                        <option>Kenya</option>
                        <option>French Guiana</option>
                        <option>Mayotta</option>
                        <option>Liechtenstein</option>
                        <option>Denmark</option>
                        <option>Eritrea</option>
                        <option>Gibraltar</option>
                        <option>Saint Helena, Ascension and Tristan da Cunha</option>
                        <option>Haiti</option>
                        <option>Namibia</option>
                        <option>South Georgia and the South Sandwich Islands</option>
                        <option>Vietnam</option>
                        <option>Yemen</option>
                        <option>Philippines</option>
                        <option>Benin</option>
                        <option>Czech Republic</option>
                        <option>Russia</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="p-email" name="p-email" placeholder="lokasi">
                    <label for="p-email" class="form-label">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea rows="3" type="text" class="form-control" id="p-sejarahsingkat" name="p-sejarahsingkat"></textarea>
                    <label for="p-sejarahsingkat" class="form-label">Sejarah Singkat</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="p-telpkantor" name="p-telpkantor"
                        placeholder="Nomor Telp. Kantor">
                    <label for="p-telpkantor" class="form-label">No. Telp Kantor</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="p-petapusat" name="p-petapusat"
                        placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.508271932542!2d106.88216657576419!3d-6.196469660706733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5b4958505db%3A0x489cbcb4771909c!2sYousee%20Indonesia%20-%20Marketing%20Office%20%7C%7C%20Billboard%2C%20Baliho%2C%20Videotron%20Nasional%20Indonesia!5e0!3m2!1sen!2sid!4v1706332624474!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'>
                    <label for="p-petapusat" class="form-label">Alamat Kantor Pusat</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="p-petasolo" name="p-petasolo"
                        placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.508271932542!2d106.88216657576419!3d-6.196469660706733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5b4958505db%3A0x489cbcb4771909c!2sYousee%20Indonesia%20-%20Marketing%20Office%20%7C%7C%20Billboard%2C%20Baliho%2C%20Videotron%20Nasional%20Indonesia!5e0!3m2!1sen!2sid!4v1706332624474!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'>
                    <label for="p-petasolo" class="form-label">Alamat Kantor Solo</label>
                </div>
                Sosial Media (Link)
                <div class="row">


                    <div class="col-md-3 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-facebook" name="p-facebook"
                                placeholder="facebook">
                            <label for="p-facebook" class="form-label">Facebook</label>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-instagram" name="p-instagram"
                                placeholder="instagram">
                            <label for="p-instagram" class="form-label">Instagram</label>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-tiktok" name="p-tiktok"
                                placeholder="tiktok">
                            <label for="p-tiktok" class="form-label">Tiktok</label>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-whatsapp" name="p-whatsapp"
                                placeholder="whatsapp">
                            <label for="p-whatsapp" class="form-label">Whatsapp</label>
                        </div>
                    </div>


                    <button type="button" class="bt-primary m-2 ms-auto">Simpan Perubahan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Note that the name "myDropzone" is the camelized
        // id of the form.
        Dropzone.options.myDropzone = {
            // Configuration options go here
        };

        $('#multiple-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>
@endsection
