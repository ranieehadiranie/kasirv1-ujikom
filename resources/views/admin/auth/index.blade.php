@extends('admin.template.master')
@section('title')
SAPRAS | Manajemen Sarana
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid bg-gray-200" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid " id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl ">
            <div class="card">

                <div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahStokLabel">Tambah Stok</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form untuk menambah stok -->
                                <form id="form-tambah-stok">
                                    <input type="hidden" id="id_produk" name="id_produk">
                                    <div class="mb-3">
                                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                        <input type="number" min="1" class="form-control" id="Stok" name="Stok"
                                            required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" form="form-tambah-stok">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title">Petugas</h3>
                    <div class="card-toolbar d-flex justify-content-end">

                        <a href="{{ route('petugas-requests.create') }}" class="btn btn-sm btn-primary">
                            <i class="ki-duotone ki-plus-square fs-2 text-white">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            Tambah Petugas
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table-user">
                        <thead>
                            <tr>

                                <th>No</th>
                                <th>Nama:</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>

                                    <!-- Tombol Edit -->
                                    <a class="btn btn-sm btn-warning btn-icon"
                                        href="{{ route('petugas-requests.edit', $user->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('petugas-requests.destroy', $user->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Sarana -->
    <!-- Modal Tambah Stok -->



</div>
</div>
</div>
</div>
@endsection
@section('script')
<script>
    $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('petugas-requests.datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    // Fungsi untuk "Select All" checkbox
    $('#select-all-checkbox').on('click', function () {
        if ($(this).is(':checked')) {
            $('.checkbox-produk').prop('checked', true); // Centang semua checkbox
        } else {
            $('.checkbox-produk').prop('checked', false); // Hapus centang semua checkbox
        }
    });

    $(document).on('click', '#btnCetakLabel', function () {
        let id_produk = [];
        $('input[name="id_produk[]"]:checked').each(function () {
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
            success: function (data) {
                window.open(data.url, '_blank');
            },
            error: function (data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonText: 'Ok'
                })
            }
        })
    });

    $(document).on('click', '#btnTambahStok', function () {
        let id_produk = $(this).data('id_produk');
        $('#id_produk').val(id_produk);
    });
    $('#form-tambah-stok').submit(function (e) {
        e.preventDefault();
        dataForm = $(this).serialize() + "&_token={{ csrf_token() }}";

        console.log(dataForm);
        $.ajax({
            type: "PUT",
            url: "{{ route('produk.tambahStok', ':id') }}".replace(':id', $('#id_produk').val()),
            data: dataForm,
            dataType: "json",
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('produk.index') }}";
                    }
                })
                $('#modalTambahStok').modal('hide');
                $('#formTambahStok')[0].reset();
                $('#table-produk').DataTable().ajax.reload();
            },
            error: function (data) {
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
