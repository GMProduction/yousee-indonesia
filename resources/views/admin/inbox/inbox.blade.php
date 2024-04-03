@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data Inbox</a></li>
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
                    <p class="title">Data Inbox</p>
                </div>
                <table id="tabel" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nomor Telp</th>
                        {{-- slug otomatis ambil dari judul --}}
                        <th>Isi Pesan</th>
                        <th style="width: 300px">Action</th>
                        {{-- detail, ubah status pesanan --}}
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nomor Telp</th>
                        {{-- slug otomatis ambil dari judul --}}
                        <th>Isi Pesan</th>
                        <th style="width: 300px">Action</th>
                        {{-- detail, ubah status pesanan --}}
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalinbox" tabindex="-1" aria-labelledby="modalinboxLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalinboxLabel">Pesan dari "<span class="iName"></span>"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <span class="fw-bold iName">Nama </span>
                            <span>(<span class="iPhone"></span>) </span>
                        </div>
                        <br>
                        <div><span class="fw-bold ">Isi Pesan</span></div>
                        <div><span class="iMessage"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" id="iWa" target="_blank">Hubungi lewat whatsapp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        let detail_inbox;
        show_datatable();

        function show_datatable() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {
                    data: 'name', name: 'name',
                },
                {
                    data: 'phone', name: 'phone',
                },
                {
                    data: 'message', name: 'message',
                    render: function (data) {
                        return '<span class="maxlines">' + data + '</span>'
                    }
                },
                {
                    className: "text-center",
                    data: 'id', name: 'id', orderable: false, searchable: false,
                    render: function (data, x, row) {
                        let picPhone = row.phone;
                        const first = picPhone.substring(0, 1);
                        if (first == 0) {
                            picPhone = '62' + picPhone.substring(1)
                        }

                        return '<span class="d-flex gap-1">' +
                            ' <a class="btn-primary-sm" id="detailData" data-id="' + data + '" data-message="' + row.message + '" data-phone="' + row.phone + '" data-name="' + row.name + '">Lihat Detail' +
                            '</a> ' +
                            '<a class="btn-warning-sm" ' +
                            '  target="_blank" href="https://wa.me/' + picPhone + '">Whatsapp</a>' +
                            ' <a class="btn-danger-sm" id="deleteInbox" data-name="' + row.name + '" data-id="' + data + '" >Hapus</a>' +
                            '</span>';
                    }
                },
            ];
            datatable('tabel', '{{route('admin.dashboard.inbox.datatable')}}', colums)
        }

        $(document).on('click', '#deleteInbox', function () {
            let form = {
                '_token': '{{csrf_token()}}',
                'id': $(this).data('id')
            }
            deleteData('message ' + $(this).data('name'), form, '{{route('admin.dashboard.inbox.delete')}}', afterDelete)
            return false
        })

        function afterDelete() {
            $('#tabel').DataTable().ajax.reload(null,false);
        }

        $(document).on('click', '#detailData', function () {
            let phone = $(this).data('phone')
            let name = $(this).data('name')
            let message = $(this).data('message')
            $('.iName').html(name)
            $('.iPhone').html(phone)
            $('#iWa').attr('href',"https://wa.me/"+phone)
            $('.iMessage').html(message)
            $('#modalinbox').modal('show')
        })
    </script>
@endsection
