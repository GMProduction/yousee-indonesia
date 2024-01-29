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
                    <a class="btn-primary-sm" href="/admin/tambah-artikel">Tambah Artikel</a>
                </div>
                <table id="tableArtikel" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            {{-- slug otomatis ambil dari judul --}}
                            <th>Isi Artikel</th>
                            <th>tags</th>
                            <th>Action</th>
                            {{-- detail, ubah status pesanan --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="https://www.dreambox.id/wp-content/uploads/2022/06/15.jpg" style="height: 50px" />
                            </td>
                            <td><span class="maxlines">15 Billboard strategis di Semarang</span></td>
                            <td><span class="maxlines">Berikut ini billboard strategis di semarang, Lorem Ipsum is simply
                                    dummy text of the
                                    printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                    text
                                    ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make
                                    a type specimen book. It has survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                    with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                    with
                                    desktop publishing software like Aldus PageMaker including versions of Lorem
                                    Ipsum.</span></td>
                            <td><span class="maxlines">billboard semarang, baliho semarang, iklan semarang, semarang
                                    jos</span></td>
                            <td><span class="d-flex gap-1"><a class="btn-primary-sm" data-bs-toggle="modal"
                                        data-bs-target="#modaldetail">Detail</a>
                                    <a class="btn-warning-sm" data-bs-toggle="modal" data-bs-target="#modalubahpesanan">Ubah
                                    </a>
                                    <a class="btn-warning-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalubahpesanan">Lihat Artikel
                                    </a>
                                    <a class="btn-warning-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalubahpesanan">Hapus
                                    </a>
                                </span>
                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            {{-- slug otomatis ambil dari judul --}}
                            <th>Isi Artikel</th>
                            <th>tags</th>
                            <th>Action</th>
                            {{-- detail, ubah status pesanan --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
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
        let startDate = document.getElementById('startDate')
        let endDate = document.getElementById('endDate')
    </script>
@endsection
