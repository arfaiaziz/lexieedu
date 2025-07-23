
<div id="levelModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-full flex-row justify-center">
                <h2 class="text-lg font-bold">Tambah Level</h2>
            </div>

            <button id="closeModalBtn" class="text-gray-500 hover:text-black text-lg">&times;</button>
        </div>
        <form id="levelForm" method="POST" action="{{ url('level/store') }}">
            @csrf
            <input type="hidden" id="id_level" name="id_level">
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <div class="mb-4">
                <label for="nama_level" class="block text-sm font-medium">Nama level</label>
                <input type="text" name="nama_level" id="nama_level" class="w-full border rounded p-2 text-sm" required>
            </div>

            <div class="mb-4">
                <label for="keterangan_level" class="block text-sm font-medium">Keterangan Level</label>
                <input type="text" name="keterangan_level" id="keterangan_level" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="submitlevel" class="px-4 py-2 button-add text-white rounded w-full">Submit</button>
            </div>
        </form>
    </div>
</div>


<script>

    $('#submitlevel').on('click', function (e) {
        e.preventDefault();

        let nama_level          = $('#nama_level').val().trim();
        let keterangan_level    = $('#keterangan_level').val();

        // Validasi input kosong
        if (!nama_level || !keterangan_level) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Semua field harus diisi!'
            });
            return;
        }

        let data = {
            nama_level,
            keterangan_level,
            _token: $('input[name="_token"]').val()
        };

        let id          = $('#id_level').val();
        let url         = id ? "{{ url('level/update') }}/" + id : "{{ url('level/store') }}";
        let method      = id ? "PUT" : "POST";
        let labelsukses = id ? 'Level berhasil diupdate!' : 'Level berhasil ditambahkan!';

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: labelsukses
                }).then(() => {
                    $('#levelForm')[0].reset();
                    $('#id_level').val('');
                    $('#levelModal h2').text('Tambah Level');
                    $('#levelModal').addClass('hidden');
                    $('#admin_table').DataTable().ajax.reload();
                });
            },
            error: function (xhr) {
                let response = xhr.responseJSON;
                if (response && response.errors) {
                    let errors = Object.values(response.errors).flat().join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menyimpan',
                        html: errors
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal menyimpan data.'
                    });
                }
            }
        });
    });

    $('#closeModalBtn').on('click', function () {
        $('#levelForm')[0].reset();
        $('#id_level').val('');
        $('#levelModal h2').text('Tambah Level');
        $('#levelModal').addClass('hidden');
    });



</script>
