
<div id="penggunaModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-full flex-row justify-center">
                <h2 class="text-lg font-bold">Tambah Pengguna</h2>
            </div>

            <button id="closeModalBtn" class="text-gray-500 hover:text-black text-lg">&times;</button>
        </div>
        <form id="penggunaForm" method="POST" action="{{ url('pengguna/store') }}">
            @csrf
            <input type="hidden" id="id" name="id">
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Nama Pengguna</label>
                <input type="text" name="name" id="name" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="no_hp" class="block text-sm font-medium">No Handpone</label>
                <input type="number" name="no_hp" id="no_hp" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="submitpengguna" class="px-4 py-2 button-add text-white rounded w-full">Submit</button>
            </div>
        </form>
    </div>
</div>


<script>

    $('#submitpengguna').on('click', function (e) {
        e.preventDefault();

        let name = $('#name').val().trim();
        let email = $('#email').val();
        let no_hp = $('#no_hp').val();
        let alamat = $('#alamat').val();
        let password = $('#password').val();

        // Validasi input kosong
        if (!name || !email || !no_hp || !alamat || !password) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Semua field harus diisi!'
            });
            return;
        }

        let data = {
            name,
            email,
            no_hp,
            alamat,
            password,
            _token: $('input[name="_token"]').val()
        };

        let id          = $('#id').val();
        let url         = id ? "{{ url('pengguna/update') }}/" + id : "{{ url('pengguna/store') }}";
        let method      = id ? "PUT" : "POST";
        let labelsukses = id ? 'Pengguna berhasil diupdate!' : 'Pengguna berhasil ditambahkan!';

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
                    $('#penggunaForm')[0].reset();
                    $('#id').val('');
                    $('#penggunaModal h2').text('Tambah Pengguna');
                    $('#penggunaModal').addClass('hidden');
                    $('#table').DataTable().ajax.reload();
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
        $('#penggunaForm')[0].reset();
        $('#id').val('');
        $('#penggunaModal h2').text('Tambah Pengguna');
        $('#penggunaModal').addClass('hidden');
    });

</script>
