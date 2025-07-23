
@extends('layouts.mainapp')

@section('content')
<main class="flex-1 p-6">
    <div class="w-full flex flex-row justify-between">
        <div class="font-bold">Peserta</div>
        <div>
            <button id="openModalBtn" class="button-add text-white px-4 py-2 rounded text-xs">
                <i class="fas fa-plus"></i> Add Peserta
            </button>

        </div>
    </div>
    <div class="w-full mt-4">
        <table id="tabel" class="table text-xs table-striped striped-table border-0">
            <thead>
                <tr class="border-0">
                    <th>ID</th>
                    <th>Nama Pesert</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Level</th>
                    <th>Instansi</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</main>


@include('pages.admin.peserta.input')


<script>
    $(document).ready(function () {
        // Modal Open/Close Logic
        $('#openModalBtn').on('click', function () {
            $('#pesertaModal').removeClass('hidden');
        });

        $('#closeModalBtn, #closeModalBtn2').on('click', function () {
            $('#pesertaModal').addClass('hidden');
        });
    });
    $(document).ready(function () {
        $('#tabel').DataTable({

            responsive: false,
            serverSide: true,
            processing: true,
            language: {
                processing:
                    '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;margin-bottom:50px;"></i>',
            },
            scroller: {
                loadingIndicator: false,
            },

            ajax: {
                url: "{{url('peserta/get-data')}}",
                type: 'GET',
            },
            columns: [
                { data: 'id_peserta', name: 'id_peserta'},
                { data: 'nama_peserta', name: 'nama_peserta'},
                { data: 'umur', name: 'umur'},
                { data: 'alamat', name: 'alamat'},
                { data: 'email', name: 'email'},
                { data: 'tgl_daftar', name: 'tgl_daftar'},
                { data: 'level', name: 'level'},
                { data: 'nama_instansi', name: 'instansi.nama_instansi' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    createdCell: function(td) {
                        $(td).addClass('flex flex-row justify-center items-center gap-2');
                    }
                }

            ],
            order: [[0, 'asc']],
            pagingType: "full_numbers",
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: "lfrtip",
            buttons: [],
        });
    });
</script>

<script>
   $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.get("{{ url('peserta/get') }}/" + id, function(data) {
            // Isi data ke form modal
            $('#id_peserta').val(data.id_peserta);
            $('#nama_pelajar').val(data.nama_peserta); // Pastikan backend mengirim "nama_peserta"
            $('#umur').val(data.umur);
            $('#email').val(data.email);
            $('#alamat').val(data.alamat);
            $('#tgl_daftar').val(data.tgl_daftar);
            $('#level').val(data.level);
            $('#instansi').val(data.id_instansi);

            // Ubah judul modal
            $('#pesertaModal h2').text('Edit Peserta');

            // Tampilkan modal
            $('#pesertaModal').removeClass('hidden');
        });
    });

</script>

<script>
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let nama = $(this).data('nama');

        Swal.fire({
            title: `Hapus peserta "${nama}"?`,
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('peserta/delete') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Peserta "${nama}" berhasil dihapus.`
                        });
                        $('#tabel').DataTable().ajax.reload();
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.'
                        });
                    }
                });
            }
        });
    });
</script>



@endsection
