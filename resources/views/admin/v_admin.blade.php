@extends('layout_admin.v_index')
@section('title', 'Sales')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="align-items: flex-end">
                <div class="col">
                    <h1 class="m-0">Sales</h1>
                    <ol class="breadcrumb float-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sales</li>
                    </ol>
                </div>
                <div class="col ml-auto">
                    <button type="button" class="btn btn-outline-success float-sm-right items-end" data-bs-toggle="modal"
                        data-bs-target="#insertModal" title="Tambah Akun Sales">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Sales</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dataSales">
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Insert Data --}}
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Akun Sales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertSales" method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">NIP</label>
                            <input type="text" id="nip" class="form-control" id="recipient-name" placeholder="NIP">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" id="recipient-name"
                                placeholder="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Password</label>
                            <input type="password" id="password" class="form-control" id="recipient-name"
                                placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Data --}}
    <div class="modal fade" id="updateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="POST" action="#">
                        @csrf
                        <input type="hidden" id="updateId" name="id" value="">

                        <div class="mb-3">
                            <label for="nip" class="col-form-label">NIP</label>
                            <input type="text" id="updateNip" class="form-control" placeholder="NIP" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="col-form-label">Nama</label>
                            <input type="text" id="updateNama" class="form-control" placeholder="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" id="updatePassword" class="form-control" placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Delete Data --}}
    <div class="modal fade" id="hapusData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="padding-left: 40%">Hapus Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body body-delete">
                    ..
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-delete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function Error(xhr, status, error) {
            console.error(xhr.responseText); // Log error response for debugging
            alert('An error occurred while processing your request. Please try again.');
        }
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/api/sales',
                dataType: 'json',
                success: function(response) {
                    if (response.status && response.data.length > 0) {
                        $('#dataSales').empty();

                        $.each(response.data, function(index, sales) {
                            $('#dataSales').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${sales.nip}</td>
                                <td>${sales.nama}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-update" data-bs-toggle="modal"
                                        data-bs-target="#updateModel" data-id="${sales.id}" data-nip="${sales.nip}" data-nama="${sales.nama}" data-password="${sales.password}" title="Update Sales">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#hapusData"
                                    data-id="${sales.id}" data-nip="${sales.nip}" data-nama="${sales.nama}">
                                        <i class="fa-solid fa-trash"></i>                                   
                                    </button>
                                </td>
                            </tr>
                            `);
                        });
                    }
                },
                error: Error
            });

            // Insert Data
            $('#insertSales').submit(function(event) {
                event.preventDefault();
                var formData = {
                    'nip': $('#nip').val(),
                    'nama': $('#nama').val(),
                    'password': $('#password').val()
                };
                $.ajax({
                    type: 'POST',
                    url: 'api/storesales',
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
            });


            // Update Data
            $(document).on('click', '.btn-update', function() {
                var id = $(this).data('id');
                var nip = $(this).data('nip');
                var nama = $(this).data('nama');
                var password = $(this).data('password');

                $('#updateId').val(id);
                $('#updateNip').val(nip);
                $('#updateNama').val(nama);
                $('#updatePassword').val(password);
            });

            $('#updateForm').submit(function(event) {
                event.preventDefault();
                var id = $('#updateId').val();
                var formData = {
                    'id': id,
                    'nip': $('#updateNip').val(),
                    'nama': $('#updateNama').val(),
                    'password': $('#updatePassword').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '/api/updatesales/' + id,
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
            });
            // Delete Data
            $(document).on('click', '.btn-hapus', function() {
                var nip = $(this).data('nip');
                $('#hapusData .body-delete').html('Apakah Anda Yakin Ingin Menghapus <b>' + nip +
                    ' </b>Data ini??');
                var id = $(this).data('id');
                $('#hapusData .modal-footer .btn-delete').attr('data-id', id);
            });

            $('#hapusData .modal-footer .btn-delete').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '/api/deletesale/' + id,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
                $('#hapusData').modal('hide');
            });
        });
    </script>
@endsection
