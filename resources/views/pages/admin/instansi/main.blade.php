
@extends('layouts.mainapp')

@section('content')
<main class="flex-1 p-6">
    <div class="w-full flex flex-row justify-between">
        <div class="font-bold">INSTANSI</div>
        <div>
            <button id="openModalBtn" class="button-add text-white px-4 py-2 rounded text-xs">
                <i class="fas fa-plus"></i> Add Instansi
            </button>

        </div>
    </div>
    <div class="w-full mt-4">
        <table id="admin_table" class="table text-xs table-striped striped-table border-0">
            <thead>
                <tr class="border-0">
                    <th>ID Instansi</th>
                    <th>Nama Instansi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Jumlah Sesi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</main>


@include('pages.admin.instansi.input')


<script>
    $(document).ready(function () {
        // Modal Open/Close Logic
        $('#openModalBtn').on('click', function () {
            $('#instansiModal').removeClass('hidden');
        });

        $('#closeModalBtn, #closeModalBtn2').on('click', function () {
            $('#instansiModal').addClass('hidden');
        });
    });
    $(document).ready(function () {
        $('#admin_table').DataTable({

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
                url: "{{url('instansi/get-data')}}",
                type: 'GET',
            },
            columns: [
                { data: 'id_instansi', name: 'id_instansi'},
                { data: 'nama_instansi', name: 'nama_instansi'},
                { data: 'tgl_mulai', name: 'tgl_mulai'},
                { data: 'tgl_berakhir', name: 'tgl_berakhir'},
                { data: 'jumlah_sesi', name: 'jumlah_sesi'},
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

        $.get("{{ url('instansi/get') }}/" + id, function(data) {
            $('#id_instansi').val(data.id_instansi);
            $('#nama_instansi').val(data.nama_instansi);
            $('#tgl_mulai').val(data.tgl_mulai);
            $('#tgl_berakhir').val(data.tgl_berakhir);
            $('#jumlah_sesi').val(data.jumlah_sesi);

            $('#instansiModal h2').text('Edit Instansi');

            // Tampilkan modal
            $('#instansiModal').removeClass('hidden');
        });
    });
</script>

<script>
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let namaInstansi = $(this).data('nama');

        Swal.fire({
            title: `Hapus instansi "${namaInstansi}"?`,
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
                    url: `{{ url('instansi/delete') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Instansi "${namaInstansi}" berhasil dihapus.`
                        });
                        $('#admin_table').DataTable().ajax.reload();
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
