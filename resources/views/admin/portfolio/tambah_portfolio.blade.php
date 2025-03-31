@extends('admin.base')

@section('morecss')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="/admin/Portfolio">Data Portfolio</a></li>
                        <li class="breadcrumb-item "><a href="#">Tambah Portfolio</a></li>
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
                <form id="form" onsubmit="return saveForm()" enctype="multipart/form-data">
                    @csrf
                    <div class="title-container">
                        <p class="title">Tambah Portfolio</p>
                    </div>

                    <input type="hidden" id="d-id" name="id" value="{{ $data ? $data->id : '' }}">

                    <div class=" mb-3">
                        <label class="form-label">Gambar Portfolio</label>

                        <input type="file" id="image1" name="image" class="image" data-min-height="10"
                            data-heigh="400" accept="image/jpeg, image/jpg, image/png"
                            data-allowed-file-extensions="jpg jpeg png" />
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="p-judulportfolio_id" name="name_id"
                            value="{{ $data ? $data->name_id : '' }}" placeholder="Nama Portfolio">
                        <label for="p-judulportfolio_id" class="form-label">Nama Portfolio (Indo)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="p-judulportfolio_en" name="name_en"
                            value="{{ $data ? $data->name_en : '' }}" placeholder="Nama Portfolio">
                        <label for="p-judulportfolio_en" class="form-label">Nama Portfolio (English)</label>
                    </div>

                    <div class="mb-3">
                        <label class="control-label" for="p-keteranganportfolio_id">Keterangan Portfolio (Indo)</label>
                        <textarea id="p-keteranganportfolio_id" class="form-control" style="min-height: 200px" name="description_id">{{ $data ? $data->description_id : '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="control-label" for="p-keteranganportfolio_en">Keterangan Portfolio (English)</label>
                        <textarea id="p-keteranganportfolio_en" class="form-control" style="min-height: 200px" name="description_en">{{ $data ? $data->description_en : '' }}</textarea>
                    </div>

                    <button type="submit" class="bt-primary m-2 ms-auto">Simpan Perubahan</button>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        // Note that the name "myDropzone" is the camelized
        // id of the form.

        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Masukan Keterangan Portfolio',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            @if ($data && $data->image)
                setImgDropify('image1', null, '{{ $data->image }}');
            @else
                setImgDropify('image1');
            @endif
        });

        function saveForm() {
            saveData('Simpan Portfolio', 'form', '{{ route('admin.portfolio.data') }}', null, 'image')
            return false
        }
    </script>
@endsection
