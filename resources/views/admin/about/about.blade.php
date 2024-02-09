@extends('admin.base')

@section('morecss')
    {{-- DROPZONE --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection


@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="/admin/artikel">About</a></li>
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
                      <p class="title">About</p>
                  </div>

                  <div class=" mb-3">
                      <label class="form-label">Upload Company Profile</label>

                      <input type="file" id="image1" name="company_profile" class="image"
                             data-min-height="10" data-heigh="400" accept="application/pdf"
                             data-allowed-file-extensions="pdf"/>
                      @if($data)
                          <a target="_blank" rel="noopener" href="{{$data->company_profile}}">Lihat File</a>
                      @endif
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

    <script>
        // Note that the name "myDropzone" is the camelized
        // id of the form.
        $(document).ready(function () {
            @if($data && $data->company_profile)
            setImgDropify('image1', null, '{{$data->company_profile}}');
            @else
            setImgDropify('image1');
            @endif
        });

        function saveForm() {
            saveData('Simpan Company Profile', 'form', '{{route('admin.about')}}', null,'image' )
            return false
        }
    </script>
@endsection
