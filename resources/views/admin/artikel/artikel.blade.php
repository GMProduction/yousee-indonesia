@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data Artikel</a></li>
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
                    <p class="title">Data Artikel</p>
                    <a class="btn-primary-sm" href="{{ route('admin.article.data') }}">Tambah Artikel</a>
                </div>
                <div class="table-responsive">

                    <table id="tabel" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Judul (Indo)</th>
                                <th>Judul (English)</th>
                                {{-- slug otomatis ambil dari judul --}}
                                <th>Isi Artikel (Indo)</th>
                                <th>Isi Artikel (English)</th>
                                <th>tags</th>
                                <th style="width: 100px;">
                                    Action
                                </th>
                                {{-- detail, ubah status pesanan --}}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Judul (Indo)</th>
                                <th>Judul (English)</th>
                                {{-- slug otomatis ambil dari judul --}}
                                <th>Isi Artikel (Indo)</th>
                                <th>Isi Artikel (English)</th>
                                <th>tags</th>
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

            var tableArtikel = $('#tableArtikel').DataTable({
                responsive: {
                    details: {
                        display: DataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details for ' + data[0] + ' ' + data[1];
                            }
                        }),
                        renderer: DataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            });

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
                    data: 'title_id',
                    name: 'title_id',
                },
                {
                    data: 'title_en',
                    name: 'title_en',
                },
                {
                    data: 'sort_desc_id',
                    name: 'sort_desc_id',
                    render: function(data) {
                        return '<span class="pv-archiveText">' + data + '</span>'
                    }
                },
                {
                    data: 'sort_desc_en',
                    name: 'sort_desc_en',
                    render: function(data) {
                        return '<span class="pv-archiveText">' + data + '</span>'
                    }
                },
                {
                    data: 'tag',
                    name: 'tag'
                },
                {
                    className: "text-center",
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, x, row) {
                        return '<div class="d-flex justify-content-between gap-1">' +
                            '       <a class="btn-primary-sm">Lihat</a>' +
                            '       <a class="btn-warning-sm" href="/admin/artikel/data?q=' + data + '">Ubah</a>' +
                            '       <a class="btn-danger-sm deletebutton" id="deleteData" data-name="' + row.title +
                            '" data-id="' + data + '">Hapus</a>' +
                            '</div>'
                    }
                },
            ];
            datatable('tabel', '{{ route('admin.article.datatable') }}', colums)
        }

        $(document).on('click', '#deleteData', function() {
            let form = {
                '_token': '{{ csrf_token() }}',
                'id': $(this).data('id')
            }
            deleteData('artikel ' + $(this).data('name'), form, '{{ route('admin.article.delete') }}')
            return false
        })
    </script>
@endsection
