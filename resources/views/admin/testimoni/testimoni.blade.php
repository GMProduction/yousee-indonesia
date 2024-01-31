@extends('admin.base')

@section('morecss')
    {{-- DROPZONE --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
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
                        <table id="tableTestimoni" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Isi Testimoni</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                    {{-- detail, ubah status pesanan --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="https://www.dreambox.id/wp-content/uploads/2022/06/15.jpg"
                                            style="height: 50px" />
                                    </td>
                                    <td><span class="maxlines">Prabowo</span></td>
                                    <td><span class="maxlines">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum
                                            Lorem ipsum Lorem ipsum </span></td>
                                    <td><span class="material-symbols-outlined">
                                            star
                                        </span>
                                        <span class="material-symbols-outlined">
                                            star
                                        </span>
                                        <span class="material-symbols-outlined">
                                            star
                                        </span>
                                        <span class="material-symbols-outlined">
                                            star
                                        </span>

                                        <span class="material-symbols-outlined">
                                            star
                                        </span>
                                    </td>
                                    <td><span class="d-flex gap-1">
                                            <a class="btn-primary-sm">Lihat
                                            </a>
                                            <a class="btn-warning-sm">Ubah
                                            </a>

                                            <a class="btn-danger-sm deletebutton">Hapus
                                            </a>
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
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
                        <div class="title-container">
                            <p class="title">Data testimoni</p>
                        </div>
                        <input type="hidden" id="d-id" name="d-id">

                        <div class=" mb-3">
                            <label class="form-label">Foto</label>

                            <form action="/target" class="dropzone" id="p-icon"></form>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-nama" name="p-nama"
                                placeholder="Nama Testimoni">
                            <label for="p-nama" class="form-label">Nama</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" style="min-height: 100px" id="p-isi" name="p-isi"
                                placeholder="Isi Testimoni" rows="5"></textarea>
                            <label for="p-isi" class="form-label">Isi Testimoni</label>
                        </div>

                        <div class="mb-3">
                            <label for="p-isi" class="form-label">Rating</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">
                                <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="inlineRadioOptions"
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">5</label>
                            </div>
                        </div>


                        <button type="button" class="bt-primary m-2 ms-auto">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

@section('morejs')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        $(document).ready(function() {

            var tabletestimoni = $('#tabletestimoni').DataTable({
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

            $(".deletebutton").click(function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });

            // Note that the name "myDropzone" is the camelized
            // id of the form.
            Dropzone.options.myDropzone = {
                // Configuration options go here
            };
        });
    </script>
@endsection
