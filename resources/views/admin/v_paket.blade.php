@extends('layout_admin.v_index')
@section('title', 'Paket')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="align-items: flex-end">
                <div class="col">
                    <h1 class="m-0">Paket</h1>
                    <ol class="breadcrumb float-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Paket</li>
                    </ol>
                </div>
                <div class="col ml-auto">
                    <button type="button" class="btn btn-outline-success float-sm-right items-end" data-bs-toggle="modal"
                        data-bs-target="#insertModal" title="Tambah Akun Paket">
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
                    <h3 class="card-title">Data Paket</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="paketBody">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertPaket" method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" id="recipient-name"
                                placeholder="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Harga</label>
                            <input type="text" id="harga" class="form-control" id="recipient-name"
                                placeholder="Harga">
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
                    <form id="updatePaket" method="POST" action="#">
                        @csrf
                        <input type="hidden" id="updateId" name="id_paket" value="">

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama</label>
                            <input type="text" id="updateNama" class="form-control" placeholder="Nama">

                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Harga</label>
                            <input type="text" id="updateHarga" class="form-control" placeholder="Harga">
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
                <div class="modal-body">
                    ..
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
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
            console.error(xhr.responseText); // Log error response for debugging
            alert('An error occurred while processing your request. Please try again.');
        }
        $(document).ready(function() {
            // Fungsi Ajax untuk Mendapatkan Data Paket
            $.ajax({
                type: 'GET',
                url: '/api/paket',
                dataType: 'json',
                success: function(response) {
                    // Mengecek apakah terdapat data paket yang diterima dari response
                    if (response.status && response.data.length > 0) {
                        // Mengosongkan tbody
                        $('#paketBody').empty();

                        // Iterasi data paket dan menambahkannya ke dalam tabel
                        $.each(response.data, function(index, paket) {
                            $('#paketBody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${paket.nama}</td>
                                <td>${numberFormat(paket.harga)}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-update" data-bs-toggle="modal"
                                        data-bs-target="#updateModel" data-id_paket="${paket.id_paket}" data-nama="${paket.nama}" data-harga="${paket.harga}" title="Tambah Akun Paket">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusData"
                                    data-id_paket="${paket.id_paket}" data-nama="${paket.nama}" data-harga="${paket.harga}">
                                        <i class="fa-solid fa-trash"></i>                                   
                                    </button>
                                </td>
                            </tr>
                        `);
                        });
                    } else {
                        // Menampilkan pesan jika tidak ada data paket
                        $('#paketBody').html('<tr><td colspan="4">Tidak ada data paket.</td></tr>');
                    }
                },
                error: Error
            });

            // Event Handler untuk Form "Insert Paket"
            $('#insertPaket').submit(function(event) {
                event.preventDefault();
                var formData = {
                    'nama': $('#nama').val(),
                    'harga': $('#harga').val()
                };
                $.ajax({
                    type: 'POST',
                    url: '/api/storepaket',
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/paket';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
            });

            // Event delegation untuk menangani klik pada tombol "Update"
            $(document).on('click', '.btn-update', function() {
                var id_paket = $(this).data('id_paket');
                var nama = $(this).data('nama');
                var harga = $(this).data('harga');

                // Isi nilai formulir modal "Update Data" dengan data yang sesuai
                $('#updateNama').val(nama);
                $('#updateHarga').val(harga);

                // Menyimpan data id pada sebuah elemen tersembunyi untuk referensi saat submit
                $('#updateId').val(id_paket);
            });
            // Event Handler untuk Form "Update Paket"
            $('#updatePaket').submit(function(event) {
                event.preventDefault();
                var id_paket = $('#updateId').val();
                var formData = {
                    'id_paket': id_paket,
                    'nama': $('#updateNama').val(),
                    'harga': $('#updateHarga').val()
                };

                // Lanjutkan dengan mengirim data ke server untuk pembaruan
                $.ajax({
                    type: 'POST',
                    url: '/api/updatepaket/' + id_paket,
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/paket';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });
            });

            // Event delegation untuk menangani klik pada tombol "Hapus"
            $(document).on('click', '.btn-outline-danger', function() {
                var nama = $(this).data('nama');

                $('#hapusData .modal-body').html('Apakah Anda Yakin Ingin Menghapus <b>' + nama +
                    ' </b>Data ini??');

                // Menambahkan atribut data-id pada tombol "Save changes" dengan id_paket yang sesuai
                var idPaket = $(this).data('id_paket');
                $('#hapusData .modal-footer .btn-danger').attr('data-id_paket', idPaket);
            });

            // Lanjutkan dengan kode Anda yang lain...
            $('#hapusData .modal-footer .btn-danger').click(function() {
                var idPaket = $(this).data(
                    'id_paket'); // Mengambil id_paket dari atribut data-id pada tombol

                // Lakukan sesuatu dengan id_paket, misalnya kirim request ke server untuk menghapus data
                $.ajax({
                    type: 'POST',
                    url: '/api/deletepaket/' + idPaket, // Sesuaikan dengan URL endpoint yang benar
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '/paket';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: Error
                });

                // Setelah berhasil menghapus, tutup modal hapus
                $('#hapusData').modal('hide');
            });
        });
    </script>
@endsection
