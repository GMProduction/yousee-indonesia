@extends('admin.base')

@section('morecss')
    {{-- DROPZONE --}}
@endsection
@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data testimoni</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada pertanyaan, silahkan hubungi admin</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="menu-container">
                    <div class="menu overflow-hidden">
                        <div class="title-container">
                            <p class="title">Tambah testimoni</p>
                        </div>
                        <table id="tabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Isi Testimoni</th>
                                <th>Rating</th>
                                <th style="width: 100px">Action</th>
                                {{-- detail, ubah status pesanan --}}
                            </tr>
                            </thead>
                            {{--                            <tbody>--}}
                            {{--                                <tr>--}}
                            {{--                                    <td><img src="https://www.dreambox.id/wp-content/uploads/2022/06/15.jpg"--}}
                            {{--                                            style="height: 50px" />--}}
                            {{--                                    </td>--}}
                            {{--                                    <td><span class="maxlines">Prabowo</span></td>--}}
                            {{--                                    <td><span class="maxlines">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum--}}
                            {{--                                            Lorem ipsum Lorem ipsum </span></td>--}}
                            {{--                                    <td><span class="material-symbols-outlined">--}}
                            {{--                                            star--}}
                            {{--                                        </span>--}}
{{--                                                                    <span class="material-symbols-outlined">--}}
{{--                                                                        star--}}
{{--                                                                    </span>--}}
                            {{--                                        <span class="material-symbols-outlined">--}}
                            {{--                                            star--}}
                            {{--                                        </span>--}}
                            {{--                                        <span class="material-symbols-outlined">--}}
                            {{--                                            star--}}
                            {{--                                        </span>--}}

                            {{--                                        <span class="material-symbols-outlined">--}}
                            {{--                                            star--}}
                            {{--                                        </span>--}}
                            {{--                                    </td>--}}
                            {{--                                    <td><span class="d-flex gap-1">--}}
                            {{--                                            <a class="btn-primary-sm">Lihat--}}
                            {{--                                            </a>--}}
                            {{--                                            <a class="btn-warning-sm">Ubah--}}
                            {{--                                            </a>--}}

                            {{--                                            <a class="btn-danger-sm deletebutton">Hapus--}}
                            {{--                                            </a>--}}
                            {{--                                        </span>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}

                            {{--                            </tbody>--}}
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Isi Testimoni</th>
                                <th>Rating</th>
                                <th>Action</th>
                                {{-- detail, ubah status pesanan --}}
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="menu-container">
                    <div class="menu overflow-hidden">
                        <form id="form" onsubmit="return saveForm()" enctype="multipart/form-data">
                            @csrf
                            <div class="title-container">
                                <p class="title">Data testimoni</p>
                            </div>
                            <input type="hidden" id="id" name="id">

                            <div class=" mb-3">
                                <label class="form-label">Foto</label>

                                <input type="file" id="image1" name="image" class="image"
                                       data-min-height="10" data-heigh="400" accept="image/jpeg, image/jpg, image/png"
                                       data-allowed-file-extensions="jpg jpeg png"/>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nama Testimoni">
                                <label for="name" class="form-label">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" style="min-height: 100px" id="content" name="content"
                                      placeholder="Isi Testimoni" rows="5"></textarea>
                                <label for="content" class="form-label">Isi Testimoni</label>
                            </div>

                            <div class="mb-3">
                                <label for="p-isi" class="form-label">Rating</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="star" id="inlineRadio1"
                                           value="1">
                                    <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="star" id="inlineRadio2"
                                           value="2">
                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="star" id="inlineRadio3"
                                           value="3">
                                    <label class="form-check-label" for="inlineRadio3">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="star" id="inlineRadio4"
                                           value="4">
                                    <label class="form-check-label" for="inlineRadio4">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" checked type="radio" name="star" id="inlineRadio5"
                                           value="5">
                                    <label class="form-check-label" for="inlineRadio5">5</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between gap-2">
                                <button type="button" class="btn-warning-sm w-100 text-center " onclick="clearData()">Clear</button>
                                <button type="submit" class="bt-primary  w-100 ">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function () {
            setImgDropify('image1');
        });

        show_datatable()

        function show_datatable() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {
                    // data: 'public_health_center.name', name: 'public_health_center.name'
                    data: 'image', name: 'image',
                    render: function (data, x, row) {
                        return '<img  src="' + row.image + '" height="50" alt="img"/>'
                    }
                },
                {
                    data: 'name', name: 'name',
                },
                {
                    data: 'content', name: 'content',
                },
                {
                    data: 'star', name: 'star',
                    render: function (data, x, row) {
                        let start = ''
                        for (let i = 1; i <= row.star; i++) {
                            start += '<span class="material-symbols-outlined">star</span>';
                        }
                        let dataDiv = '<div class="d-flex">'+start+'</div>'
                        console.log(start)
                        return dataDiv
                    }
                },
                {
                    className: "text-center",
                    data: 'id', name: 'id', orderable: false, searchable: false,
                    render: function (data, x, row) {
                        return '<div class="d-flex justify-content-between gap-1">' +
                            '       <a class="btn-primary-sm">Lihat</a>' +
                            '       <a class="btn-warning-sm" id="editData" data-star="' + row.star + '" data-image="' + row.image + '" data-name="' + row.name + '" data-content="'+row.content+'" data-id="' + data + '">Ubah</a>' +
                            '       <a class="btn-danger-sm deletebutton" id="deleteData" data-name="' + row.name + '" data-id="' + data + '">Hapus</a>' +
                            '</div>'
                    }
                },
            ];
            datatable('tabel', '{{route('admin.testimoni.datatable')}}', colums)
        }

        function saveForm() {
            saveData('Simpan Testimoni', 'form', '{{route('admin.testimoni.data')}}', null, 'image', aftersave)
            return false
        }

        function aftersave() {
            clearData();
            $('#tabel').DataTable().ajax.reload();
        }

        function clearData() {
            setImgDropify('image1');
            $('#name').val('')
            $('#id').val('')
            $('#content').val('')
            $('[name="star"]').attr('checked', false);
            $('#inlineRadio5').attr('checked', true);
        }

        $(document).on('click', '#editData', function () {
            $('#name').val($(this).data('name'))
            $('#content').val($(this).data('content'))
            $('#id').val($(this).data('id'))
            $('[name="star"]').attr('checked', false);
            $('#inlineRadio'+$(this).data('star')).attr('checked', true);
            setImgDropify('image1', null, $(this).data('image'));

        })

        $(document).on('click', '#deleteData', function () {
            let form = {
                '_token': '{{csrf_token()}}',
                'id': $(this).data('id')
            }
            deleteData('testimoni ' + $(this).data('name'), form, '{{route('admin.testimoni.delete')}}', aftersave)
            return false
        })

    </script>
@endsection
