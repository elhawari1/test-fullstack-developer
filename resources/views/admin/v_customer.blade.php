@extends('layout_admin.v_index')
@section('title', 'Customer')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="align-items: flex-end">
                <div class="col">
                    <h1 class="m-0">Customer</h1>
                    <ol class="breadcrumb float-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
                <div class="col ml-auto">
                    <button type="button" class="btn btn-outline-success float-sm-right items-end" data-bs-toggle="modal"
                        data-bs-target="#insertModal" title="Tambah Akun Customer">
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
                    <h3 class="card-title">Data Customer</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Paket</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dataCustomer">
                        </tbody>

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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Akun Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertCustomer" method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" id="recipient-name"
                                placeholder="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Alamat</label>
                            <input type="text" id="alamat" class="form-control" id="recipient-name"
                                placeholder="Alamat">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">No Hp</label>
                            <input type="number" id="no_hp" class="form-control" id="recipient-name"
                                placeholder="No Hp">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Paket</label>
                            <select id="id_paket" class="form-control">
                                <!-- Placeholder untuk data yang akan dimasukkan dari API -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">KTP</label>
                            <input type="file" id="foto_ktp" class="form-control" id="recipient-name"
                                placeholder="Foto KTP">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Rumah</label>
                            <input type="file" id="foto_rumah" class="form-control" id="recipient-name"
                                placeholder="Foto KTP">
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

    {{-- Show Data --}}
    <!-- Show Data -->
    <div class="modal fade" id="showModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="customerDetails">
                    <!-- Data pelanggan akan ditampilkan di sini -->
                </div>
            </div>
        </div>
    </div>

    {{-- Update Data --}}
    <div class="modal fade" id="updateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Update Form -->
                    <form id="updateForm" method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="updateId" name="id" value="">
                        <div class="mb-3">
                            <label for="updateNama" class="col-form-label">Nama</label>
                            <input type="text" id="updateNama" class="form-control" placeholder="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="updateAlamat" class="col-form-label">Alamat</label>
                            <input type="text" id="updateAlamat" class="form-control" placeholder="Alamat">
                        </div>
                        <div class="mb-3">
                            <label for="updateNoHp" class="col-form-label">No Hp</label>
                            <input type="number" id="updateNoHp" class="form-control" placeholder="No Hp">
                        </div>
                        <div class="mb-3">
                            <label for="updateIdPaket" class="col-form-label">Paket</label>
                            <select id="updateIdPaket" class="form-control">
                                <!-- Placeholder untuk data yang akan dimasukkan dari API -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="updateFotoKtp" class="col-form-label">KTP</label>
                            <input type="file" id="updateFotoKtp" class="form-control" placeholder="Foto KTP">
                        </div>
                        <div class="mb-3">
                            <label for="updateFotoRumah" class="col-form-label">Rumah</label>
                            <input type="file" id="updateFotoRumah" class="form-control" placeholder="Foto Rumah">
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
        function numberFormat(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
        }

        function Error(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while processing your request. Please try again.');
        }
        // Get Paket
        $.ajax({
            type: 'GET',
            url: '/api/paket',
            dataType: 'json',
            success: function(response) {
                if (response.status && response.data.length > 0) {
                    $('#id_paket').empty();

                    $.each(response.data, function(index, paket) {
                        $('#id_paket').append(
                            `<option value="${paket.id_paket}">${paket.nama} - ( ${numberFormat(paket.harga)})</option>`
                        );
                    });
                }
            },
            error: Error
        });
        
        // Get Paket for Update Form
        $.ajax({
            type: 'GET',
            url: '/api/paket',
            dataType: 'json',
            success: function(response) {
                if (response.status && response.data.length > 0) {
                    $('#updateIdPaket').empty();

                    $.each(response.data, function(index, paket) {
                        $('#updateIdPaket').append(
                            `<option value="${paket.id_paket}">${paket.nama} - ( ${numberFormat(paket.harga)})</option>`
                        );
                    });

                    // Set selected option based on existing data
                    var idPaket = $('#updateIdPaket').data('id_paket');
                    $('#updateIdPaket').val(idPaket);
                }
            },
            error: Error
        });

        // Get Customer
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/api/customer?withCustomerModel=true',
                dataType: 'json',
                success: function(response) {
                    if (response.status && response.data.length > 0) {
                        $('#dataCustomer').empty();

                        $.each(response.data, function(index, customer) {
                            $('#dataCustomer').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${customer.nama}</td>
                                <td>${customer.alamat}</td>
                                <td>${customer.no_hp}</td>
                                <td>${customer.paket.nama}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#showModel" data-id_customer="${customer.id_customer}" title="Show Customer">
                                        <i class="fa-solid fa-info"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-warning btn-update" data-bs-toggle="modal"
                                        data-bs-target="#updateModel" data-id_customer="${customer.id_customer}" data-nama="${customer.nama}" data-alamat="${customer.alamat}" data-no_hp="${customer.no_hp}" data-id_paket="${customer.id_paket}" title="Update Customer">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#hapusData"
                                    data-id="${customer.id_customer}" data-nama="${customer.nama}">
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

            // Show By ID
            $(document).on('click', '.btn-outline-primary', function() {
                var customerId = $(this).data('id_customer');
                $.ajax({
                    type: 'GET',
                    url: '/api/customershow/' + customerId + '/?withCustomerModel=true',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status && response.data.length > 0) {
                            var customer = response.data[0];
                            $('#customerDetails').html(`
                        <div class="container text-start">
                            <div class="row">
                                <div class="col-lg-3">
                                    Nama:
                                </div>
                                <div class="col">
                                    ${customer.nama}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    Alamat:
                                </div>
                                <div class="col">
                                    ${customer.alamat}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    No Hp:
                                </div>
                                <div class="col">
                                    ${customer.no_hp}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    Paket:
                                </div>
                                <div class="col">
                                    ${customer.paket.nama}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    Foto:
                                </div>
                                <div class="col">
                                    <img src="/image_customer/ktp/${customer.foto_ktp}" alt="Foto KTP" style="width: 100%; height: 100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    Rumah:
                                </div>
                                <div class="col">
                                    <img src="/image_customer/rumah/${customer.foto_rumah}" alt="Foto Rumah" style="width: 100%; height: 100%;">
                                </div>
                            </div>
                        </div>
                    `);
                        } else {
                            alert('Failed to retrieve customer data.');
                        }
                    },
                    error: Error
                });
            });

            // Insert Data
            $('#insertCustomer').submit(function(event) {
                event.preventDefault();
                var formData = new FormData();
                // Tambahkan data ke FormData
                formData.append('nama', $('#nama').val());
                formData.append('alamat', $('#alamat').val());
                formData.append('no_hp', $('#no_hp').val());
                formData.append('id_paket', $('#id_paket').val());
                formData.append('foto_ktp', $('#foto_ktp')[0].files[0]); // Ambil file foto_ktp
                formData.append('foto_rumah', $('#foto_rumah')[0].files[0]); // Ambil file foto_rumah

                $.ajax({
                    type: 'POST',
                    url: 'api/storecustomer',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set false untuk FormData
                    processData: false, // Set false untuk FormData
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/customer';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
            });

            // Update Data
            $(document).on('click', '.btn-update', function() {
                var id_customer = $(this).data('id_customer');
                var nama = $(this).data('nama');
                var alamat = $(this).data('alamat');
                var no_hp = $(this).data('no_hp');
                var id_paket = $(this).data('id_paket');

                $('#updateId').val(id_customer);
                $('#updateNama').val(nama);
                $('#updateAlamat').val(alamat);
                $('#updateNoHp').val(no_hp);
                $('#updateIdPaket').val(id_paket);
            });

            $('#updateForm').submit(function(event) {
                event.preventDefault();
                var id_customer = $('#updateId').val();
                var formData = new FormData();
                // Tambahkan data ke FormData dengan menggunakan id yang sesuai
                formData.append('nama', $('#updateNama').val());
                formData.append('alamat', $('#updateAlamat').val());
                formData.append('no_hp', $('#updateNoHp').val());
                formData.append('id_paket', $('#updateIdPaket').val());
                formData.append('foto_ktp', $('#updateFotoKtp')[0].files[0]); // Ambil file foto_ktp
                formData.append('foto_rumah', $('#updateFotoRumah')[0].files[0]); // Ambil file foto_rumah

                $.ajax({
                    type: 'POST',
                    url: '/api/updatecustomer/' + id_customer,
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set false untuk FormData
                    processData: false, // Set false untuk FormData
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/customer';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
            });

            // Delete Data
            $(document).on('click', '.btn-hapus', function() {
                var nama = $(this).data('nama');
                $('#hapusData .body-delete').html('Apakah Yakin Menghapus Data <b>' + nama + '</b>??');
                var id_customer = $(this).data('id');
                $('#hapusData .modal-footer .btn-delete').attr('data-id', id_customer);
            });
            $('#hapusData .modal-footer .btn-delete').click(function() {
                var id_customer = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '/api/deletecustomer/' + id_customer,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/customer';
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
