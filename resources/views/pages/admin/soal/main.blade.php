
@extends('layouts.mainapp')

@section('content')
<main class="flex-1 p-6">
    <div class="w-full flex flex-row justify-between">
        <div class="font-bold">SOAL </div>
        <div>


            <button id="openModalBtn" class="button-add text-white px-4 py-2 rounded text-xs">
                <i class="fas fa-plus"></i> Add Soal
            </button>
        </div>
    </div>
    <div class="w-full mt-4">
        <table id="table" class="table text-xs table-striped striped-table border-0">
            <thead>
                <tr class="border-0">
                    <th>ID Soal</th>
                    <th>Pertanyaan</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>Jawaban</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</main>


@include('pages.admin.soal.input')


<script>
    $(document).ready(function () {
        // Modal Open/Close Logic
        $('#openModalBtn').on('click', function () {
            $('#soalModal').removeClass('hidden');
        });

        $('#closeModalBtn, #closeModalBtn2').on('click', function () {
            $('#soalModal').addClass('hidden');
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
                url: "{{url('soal/get-data')}}",
                type: 'GET',
            },
            columns: [
                { data: 'id_soal', name: 'id_soal'},
                { data: 'pertanyaan', name: 'pertanyaan'},
                { data: 'a', name: 'a'},
                { data: 'b', name: 'b'},
                { data: 'c', name: 'c'},
                { data: 'd', name: 'd'},
                { data: 'jawaban', name: 'jawaban'},
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
        const id = $(this).data('id');

        $.get(`{{ url('soal/get') }}/${id}`, function(data) {
            if (data) {
                // Set nilai form
                $('#id_soal').val(data.id_soal);
                $('#pertanyaan').val(data.pertanyaan);
                $('#a').val(data.a);
                $('#b').val(data.b);
                $('#c').val(data.c);
                $('#d').val(data.d);
                $('#jawaban').val(data.jawaban);

                // Tampilkan audio jika ada
                if (data.audio) {
                    const audioUrl = `/audio-soal/${data.audio.split('/').pop()}`;
                    $('#current-audio')
                        .removeClass('hidden')
                        .attr('src', audioUrl)
                        .closest('.audio-wrapper') // pastikan pembungkus audio ditampilkan juga
                        .removeClass('hidden');
                } else {
                    $('#current-audio')
                        .addClass('hidden')
                        .attr('src', '')
                        .closest('.audio-wrapper')
                        .addClass('hidden');
                }

                // Ubah judul dan tombol submit
                $('#soalModal h2').text('Edit Soal');
                $('#submitsoal').text('Update');

                // Tampilkan modal
                $('#soalModal').removeClass('hidden');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memuat data',
                    text: 'Soal tidak ditemukan!'
                });
            }
        }).fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal mengambil data soal.'
            });
        });
    });


</script>

<script>
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let namasoal = $(this).data('nama');

        Swal.fire({
            title: `Hapus soal "${namasoal}"?`,
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
                    url: `{{ url('soal/delete') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Soal "${namasoal}" berhasil dihapus.`
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
