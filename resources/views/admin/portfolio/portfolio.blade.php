@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data portfolio</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada pertanyaan, silahkan hubungi admin</span>
                </div>
            </div>
        </div>

        <div class="menu-container">
            <div class="menu overflow-hidden">
                <div class="title-container">
                    <p class="title">Data portfolio</p>
                    <a class="btn-primary-sm" href="{{ route('admin.portfolio.data') }}">Tambah Data portfolio</a>
                </div>
                <div class="table-responsive">

                    <table id="tabel" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama portfolio (Indo)</th>
                                <th>Nama portfolio (English)</th>
                                {{-- slug otomatis ambil dari nama --}}
                                <th>Keterangan (Indo)</th>
                                <th>Keterangan (English)</th>
                                {{-- keterangan bisa kosong --}}
                                <th style="width: 100px;">Action</th>
                                {{-- detail, ubah status pesanan --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama portfolio (Indo)</th>
                                <th>Nama portfolio (English)</th>
                                {{-- slug otomatis ambil dari nama --}}
                                <th>Keterangan (Indo)</th>
                                <th>Keterangan (English)</th>
                                {{-- keterangan bisa kosong --}}
                                <th>Action</th>
                                {{-- detail, ubah status pesanan --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {

        });

        show_datatable();

        function show_datatable() {
            let colums = [{
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {
                    // data: 'public_health_center.name', name: 'public_health_center.name'
                    data: 'image',
                    name: 'image',
                    render: function(data, x, row) {
                        return '<img  src="' + row.image + '" height="50" alt="img"/>'
                    }
                },
                {
                    data: 'name_id',
                    name: 'name_id',
                },
                {
                    data: 'name_en',
                    name: 'name_en',
                },
                {
                    data: 'description_id',
                    name: 'description_id',
                    render: function(data) {
                        return '<span class="pv-archiveText">' + data + '</span>'
                    }
                },
                {
                    data: 'description_en',
                    name: 'description_en',
                    render: function(data) {
                        return '<span class="pv-archiveText">' + data + '</span>'
                    }
                },
                {
                    className: "text-center",
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, x, row) {
                        return '<div class="d-flex justify-content-between gap-1">' +
                            '       <a class="btn-warning-sm" href="/admin/portfolio/data?q=' + data +
                            '">Ubah</a>' +
                            '       <a class="btn-danger-sm deletebutton" id="deleteData" data-name="' + row.title +
                            '" data-id="' + data + '">Hapus</a>' +
                            '</div>'
                    }
                },
            ];
            datatable('tabel', '{{ route('admin.portfolio.datatable') }}', colums)
        }

        $(document).on('click', '#deleteData', function() {
            let form = {
                '_token': '{{ csrf_token() }}',
                'id': $(this).data('id')
            }
            deleteData('artikel ' + $(this).data('name'), form, '{{ route('admin.portfolio.delete') }}')
            return false
        })
    </script>
@endsection
