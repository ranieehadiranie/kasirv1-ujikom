
@extends('admin.template.master')
@section('title')
    APLIKASI KASIR | Produk
@endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header pt-6">
                        <h3 class="card-title fw-bold text-primary">Data Produk</h3>
                        <div class="card-toolbar">

                        <a href="{{ route('produk.create') }}">
                            <button class="btn btn-primary btn-sm  ">Tambah</button>
                        </a>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                        

                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-1" id="btnCetakLabel">Cetak Label</button>
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="select-all">
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input checkbox-produk" name="id_produk[]" type="checkbox" value="{{ $produk->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->NamaProduk }}</td>
                                        <td>{{ rupiah($produk->Harga) }}</td>
                                        <td>{{ $produk->Stok }}</td>
                                        <td>
                                            <form id="form-delete-produk"
                                                action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        
                                            <!-- Pindahkan tombol di luar form -->
                                            <button type="button" 
        class="btn btn-warning btn-sm btnTambahStok" 
        data-bs-toggle="modal" 
        data-bs-target="#modalTambahStok" 
        data-id_produk="{{ $produk->id }}">
    Tambah Stok
</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
<!-- Modal Tambah Stok -->
<div class="modal fade" tabindex="-1" id="modalTambahStok" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTambahStokLabel">Tambah Stok</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form-tambah-stok" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <label for="nilaiTambahStok" class="form-label">Jumlah Stok</label>
                    <input type="number" name="Stok" id="nilaiTambahStok" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   
   
    <script>
        // Select All
        $('#select-all').on('change', function () {
            $('.checkbox-produk').prop('checked', $(this).is(':checked'));
        });
    
        // Kalau semua checkbox manual di-uncheck, select-all ikut off
        $(document).on('change', '.checkbox-produk', function () {
            if ($('.checkbox-produk:checked').length === $('.checkbox-produk').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        });
    </script>

<script>
        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            buttons: [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)' // kolom terakhir (aksi) tidak diexport
                    },
                    orientation: 'portrait',
                    pageSize: 'A4',
                    text: 'PDF',
                    title: 'Data Produk',
                    customize: function (doc) {
                        // Judul di tengah
                        doc.content[0].alignment = 'center';
                        doc.content[0].fontSize = 14;
                        doc.content[0].margin = [0, 0, 0, 20];
    
                        // Tambahkan margin ke sisi tabel
                        doc.content[1].margin = [20, 0, 20, 0];
    
                        // Set agar kolom table jadi lebar otomatis
                        var table = doc.content[1].table;
                        var colCount = table.body[0].length;
    
                        // Bikin semua kolom punya lebar '*'
                        table.widths = Array(colCount).fill('*');
    
                        // Gaya tabel
                        table.layout = {
                            hLineWidth: function(i) { return 0.5; },
                            vLineWidth: function(i) { return 0.5; },
                            hLineColor: function(i) { return '#aaa'; },
                            vLineColor: function(i) { return '#aaa'; },
                            paddingLeft: function(i) { return 6; },
                            paddingRight: function(i) { return 6; },
                            paddingTop: function(i) { return 4; },
                            paddingBottom: function(i) { return 4; }
                        };
    
                        // Center-align semua isi tabel dan header
                        doc.styles.tableBodyEven.alignment = 'center';
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                    }
                },
                "copy", "csv", "excel", "colvis"
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>

    
    <script>
        $("#form-delete-produk").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data tidak akan bisa kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data Ini !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).unbind().submit();
                }
            })
        });
    </script>
    <script>
        // Inisialisasi Bootstrap Modal (opsional jika Metronic sudah aktif otomatis)
        const modalTambahStok = new bootstrap.Modal(document.getElementById('modalTambahStok'));
    
        // Ketika tombol tambah stok diklik
        $(document).on('click', '.btnTambahStok', function () {
            const id_produk = $(this).data('id_produk');
            $('#id_produk').val(id_produk);
        });
    
        // Handle form submit
        $('#form-tambah-stok').submit(function (e) {
            e.preventDefault();
    
            const dataForm = $(this).serialize() + "&_token={{ csrf_token() }}";
            const id = $('#id_produk').val();
    
            $.ajax({
                type: "PUT",
                url: "{{ route('produk.tambahStok', ':id') }}".replace(':id', id),
                data: dataForm,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        modalTambahStok.hide(); // Tutup modal
                        $('#form-tambah-stok')[0].reset(); // Reset form
                        window.location.reload(); // Reload halaman
                    });
                },
                error: function (xhr) {
                    let msg = xhr.responseJSON?.message ?? 'Terjadi kesalahan!';
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: msg,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
    
    <script>
        $(document).on('click', '#btnCetakLabel', function() {
            let id_produk = [];
            $('input[name="id_produk[]"]:checked').each(function() {
                id_produk.push($(this).val());  
            });
            $.ajax({
                type: "POST",
                url: "{{ route('produk.cetakLabel') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id_produk: id_produk
                },
                dataType: "json",
                success: function(data) {
                    window.open(data.url, '_blank');
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    })
                }
            })
        })
    </script>
@endsection
