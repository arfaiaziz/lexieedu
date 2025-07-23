
@extends('layouts.mainapp')

@section('content')
<main class="flex-1 p-6">
    <div class="w-full flex flex-row justify-between">
        <div class="font-bold">PENGGUNA</div>
        <div>
            <button id="openModalBtn" class="button-add text-white px-4 py-2 rounded text-xs">
                <i class="fas fa-plus"></i> Add Pengguna
            </button>

        </div>
    </div>
    <div class="w-full mt-4">
        <table id="table" class="table text-xs table-striped striped-table border-0">
            <thead>
                <tr class="border-0">
                    <th>No</th>
                    <th>Nama pengguna</th>
                    <th>Email</th>
                    <th>No Handpone</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</main>


@include('pages.admin.pengguna.input')


<script>
    $(document).ready(function () {
        // Modal Open/Close Logic
        $('#openModalBtn').on('click', function () {
            $('#penggunaModal').removeClass('hidden');
        });

        $('#closeModalBtn, #closeModalBtn2').on('click', function () {
            $('#penggunaModal').addClass('hidden');
        });
    });
    $(document).ready(function () {
        $('#table').DataTable({

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
                url: "{{url('pengguna/get-data')}}",
                type: 'GET',
            },
            columns: [
                { data: 'no', name: 'no', orderable: false, searchable: false },
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                { data: 'no_hp', name: 'no_hp'},
                { data: 'alamat', name: 'alamat'},
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

        $.get("{{ url('pengguna/get') }}/" + id, function(data) {
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#no_hp').val(data.no_hp);
            $('#email').val(data.email);
            $('#alamat').val(data.alamat);

            $('#penggunaModal h2').text('Edit pengguna');

            // Tampilkan modal
            $('#penggunaModal').removeClass('hidden');
        });
    });
</script>

<script>
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let namapengguna = $(this).data('nama');

        Swal.fire({
            title: `Hapus Pengguna "${namapengguna}"?`,
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
                    url: `{{ url('pengguna/delete') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Pengguna "${namapengguna}" berhasil dihapus.`
                        });
                        $('#table').DataTable().ajax.reload();
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
