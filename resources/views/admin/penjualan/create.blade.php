@extends('admin.template.master')
@section('title')
    APLIKASI KASIR | Data Penjualan
@endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header pt-6">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ route('penjualan.index') }}">
                            <button class="btn btn-warning btn-sm">Kembali</button>
                        </a>

                        {{-- Alert sukses --}}
                        @if (session()->has('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Alert error stok tidak cukup --}}
                        @if ($errors->has('msg'))
                            <div class="alert alert-danger mt-3">
                                {{ $errors->first('msg') }}
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('penjualan.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="penjualan">
                                    <tr>
                                        <td>
                                            <select name="ProdukId[]" class="form-control kode-produk" onchange="pilihProduk(this)">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}">
                                                        {{ $produk->NamaProduk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="harga[]" class="form-control harga" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahProduk[]" class="form-control jumlahProduk" oninput="hitungTotal(this)">
                                        </td>
                                        <td>
                                            <input type="text" name="TotalHarga[]" class="form-control totalHarga" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="hapusProduk(this)">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Total harga</td>
                                        <td colspan="2">
                                            <input type="text" id="total" readonly class="form-control" name="total">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="button" class="btn btn-primary" onclick="tambahProduk()">Tambah Produk</button>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
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
        function tambahProduk() {
            const newRow = `
                <tr>
                    <td>
                        <select name="ProdukId[]" class="form-control kode-produk" onchange="pilihProduk(this)">
                            <option value="">Pilih Produk</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}">{{ $produk->NamaProduk }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="harga[]" class="form-control harga" readonly>
                    </td>
                    <td>
                        <input type="number" name="JumlahProduk[]" class="form-control jumlahProduk" oninput="hitungTotal(this)">
                    </td>
                    <td>
                        <input type="text" name="TotalHarga[]" class="form-control totalHarga" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="hapusProduk(this)">Hapus</button>
                    </td>
                </tr>
            `;
            $('#penjualan').append(newRow);
        }

        function hapusProduk(buttonElement) {
            $(buttonElement).closest('tr').remove();
            hitungTotalAkhir();
        }

        function pilihProduk(selectElement) {
            const option = selectElement.options[selectElement.selectedIndex];
            const row = $(selectElement).closest('tr');
            const harga = $(option).data('harga');
            const selectedValue = selectElement.value;

            // Cek produk duplikat
            const duplicate = $('.kode-produk').not(selectElement).filter(function() {
                return this.value == selectedValue;
            }).length > 0;

            if (duplicate) {
                alert('Produk sudah dipilih!');
                selectElement.value = '';
                row.find('.harga').val('');
                return;
            }

            row.find('.harga').val(harga);
            row.find('.jumlahProduk').val('');
            row.find('.totalHarga').val('');
            hitungTotalAkhir();
        }

        function hitungTotal(inputElement) {
            const row = $(inputElement).closest('tr');
            const harga = parseFloat(row.find('.harga').val());
            const jumlah = parseFloat(inputElement.value);
            const total = (harga * jumlah) || 0;
            row.find('.totalHarga').val(total);
            hitungTotalAkhir();
        }

        function hitungTotalAkhir() {
            let total = 0;
            $('.totalHarga').each(function () {
                total += parseFloat($(this).val()) || 0;
            });
            $('#total').val(total);
        }
    </script>
@endsection
