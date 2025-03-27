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
    <link rel="stylesheet" href="{{ asset('css/ckeditor.css') }}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css" />
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
                <form id="form" onsubmit="return saveForm()" enctype="multipart/form-data">
                    @csrf
                    <div class="title-container">
                        <p class="title">Tambah Artikel</p>
                    </div>


                    <input type="hidden" id="d-id" name="id" value="{{ $data ? $data->id : '' }}">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="p-judulartikel_id" name="title_id"
                            value="{{ $data ? $data->title_id : '' }}" placeholder="Judul Artikel">
                        <label for="p-judulartikel_id" class="form-label">Judul Artikel (Indo)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="p-judulartikel_en" name="title_en"
                            value="{{ $data ? $data->title_en : '' }}" placeholder="Judul Artikel">
                        <label for="p-judulartikel_en" class="form-label">Judul Artikel (English)</label>
                    </div>

                    <div class=" mb-3">
                        <label class="form-label">Gambar Utama</label>

                        <input type="file" id="image1" name="image" class="image" data-min-height="10"
                            data-heigh="400" accept="image/jpeg, image/jpg, image/png"
                            data-allowed-file-extensions="jpg jpeg png" />
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-8 ">
                            <label for="p-tags" class="form-label">Tambahkan Tags</label>
                            <select class="form-select" name="tags[]" id="p-tags" data-placeholder="Choose anything"
                                multiple>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <div class="w-100   ">
                                <div class=" mb-3">
                                    <label for="p-newtags" class="form-label" style="font-size: 0.6rem">Tambahkan Tags *jika
                                        belum ada</label>

                                    <input type="text" class="form-control" style="height: 2.5rem;" id="p-newtags"
                                        name="p-newtags" placeholder="tags baru">
                                </div>

                            </div>
                            <div>
                                <label class="form-label">.</label>
                                <button type="button" onclick="saveTags()"
                                    class="btn-warning-sm text-nowrap d-flex align-items-center  justify-content-center "
                                    style="height: 2.5rem;  padding-top: 0; padding-bottom: 0"><span
                                        class="material-symbols-outlined">
                                        save
                                    </span></button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="control-label" for="p-sort_desc_id">Deskripsi Pendek (Indo)</label>
                        <textarea id="p-sort_desc_id" class="form-control" maxlength="200" name="sort_desc_id">{{ $data ? $data->sort_desc_id : '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="control-label" for="p-sort_desc_en">Deskripsi Pendek (English)</label>
                        <textarea id="p-sort_desc_en" class="form-control" maxlength="200" name="sort_desc_en">{{ $data ? $data->sort_desc_en : '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="main-container">
                            <div class="editor-container editor-container_classic-editor" id="editor-container">
                                <label class="control-label" for="p-isiartikel">Isi Artikel (Indo)</label>
                                <textarea id="p-isiartikel" class="editor-container__editor" name="content_id">
                                    {{ $data ? $data->content_id : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="main-container">
                            <div class="editor-container editor-container_classic-editor" id="editor-container2">
                                <label class="control-label" for="p-isiartikel2">Isi Artikel (English)</label>
                                <textarea id="p-isiartikel2" class="editor-container__editor" name="content_en">
                                    {{ $data ? $data->content_en : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bt-primary m-2 ms-auto">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="importmap">
		{
			"imports": {
				"ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
				"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
			}
		}
		</script>
    <script type="module" src="{{ asset('js/cdeditor.js') }}"></script>


    <script>
        // Note that the name "myDropzone" is the camelized
        // id of the form.

        let sel2 = $('#p-tags').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            multiple: true
        });

        $(document).ready(function() {
            getDataTags()

            @if ($data && $data->image)
                setImgDropify('image1', null, '{{ $data->image }}');
            @else
                setImgDropify('image1');
            @endif
        });

        async function getDataTags() {
            await $.get('{{ route('admin.tags') }}', function(res) {
                console.log('res', res)
                let tag = $('#p-tags')
                tag.empty();
                $.each(res, function(k, v) {
                    tag.append('<option value="' + v.id + '">' + v.name + '</option>')
                })
            })
            @if ($data)
                var selectedValues = [];
                @foreach ($data->tags as $k => $t)
                    selectedValues[{{ $k }}] = '{{ $t }}'
                @endforeach
                console.log('asdasd', selectedValues)
                // $('#p-tags').select2('val', [1,2]);
                sel2.val(selectedValues).trigger('change');
            @endif

        }

        function saveForm() {
            saveData('Simpan Artikel', 'form', '{{ route('admin.article.data') }}', null, 'image')
            return false
        }

        function saveTags() {
            let form = {
                '_token': '{{ csrf_token() }}',
                'name': $('#p-newtags').val()
            }
            saveDataObjectFormData('Simpan Tags', form, '{{ route('admin.tags.add') }}', afterSave)
            return false
        }

        function afterSave() {
            $('#p-newtags').val('')
            getDataTags()
        }
    </script>
@endsection
