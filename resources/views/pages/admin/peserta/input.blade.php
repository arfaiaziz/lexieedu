
<div id="pesertaModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-full flex-row justify-center">
                <h2 class="text-lg font-bold">Tambah Peserta</h2>
            </div>

            <button id="closeModalBtn" class="text-gray-500 hover:text-black text-lg">&times;</button>
        </div>
        <form id="pesertaForm" method="POST" action="{{ url('peserta/store') }}">
            @csrf
            <input type="hidden" id="id_peserta" name="id_peserta">
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <div class="mb-4">
                <label for="nama_pelajar" class="block text-sm font-medium">Nama Pelajar</label>
                <input type="text" name="nama_pelajar" id="nama_pelajar" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-2 w-full flex flex-row justify-between gap-2">
                <div class="w-full">
                    <label for="umur" class="block text-sm font-medium">Umur</label>
                    <input type="number" name="umur" id="umur" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div class="w-full">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded p-2 text-sm" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-2 w-full flex flex-row justify-between gap-2">
                <div class="w-full">
                    <label for="tgl_daftar" class="block text-sm font-medium">Tanggal Daftar</label>
                    <input type="date" name="tgl_daftar" id="tgl_daftar" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div class="w-full">
                    <label for="level" class="block text-sm font-medium">Level</label>
                    <select name="level" id="level" class="w-full border rounded p-2 text-sm" required>
                        <option value="">Pilih Level</option>
                        @foreach($respon['levelData'] as $items)
                            <option value="{{ $items }}">{{ $items }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="instansi" class="block text-sm font-medium">Instansi</label>
                <select name="instansi" id="instansi" class="w-full border rounded p-2 text-sm" required>
                    <option value="">Pilih Instansi</option>
                    @foreach($respon['instansiData'] as $items)
                        <option value="{{ $items->id_instansi }}">{{ $items->nama_instansi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="submitPeserta" class="px-4 py-2 button-add text-white rounded w-full">Submit</button>
            </div>
        </form>
    </div>
</div>


<script>

    $('#submitPeserta').on('click', function (e) {
        e.preventDefault();

        let nama_pelajar    = $('#nama_pelajar').val().trim();
        let umur            = $('#umur').val();
        let email           = $('#email').val();
        let alamat          = $('#alamat').val();
        let tgl_daftar      = $('#tgl_daftar').val();
        let id_level        = $('#level').val();
        let id_instansi     = $('#instansi').val();

        // Validasi input kosong
        if (!nama_pelajar || !umur || !email || !alamat || !tgl_daftar || !id_level || !id_instansi) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Semua field harus diisi!'
            });
            return;
        }


        let data = {
            nama_pelajar,
            umur,
            email,
            alamat,
            tgl_daftar,
            id_level,
            id_instansi,
            _token: $('input[name="_token"]').val()
        };

        let id          = $('#id_peserta').val();
        let url         = id ? "{{ url('peserta/update') }}/" + id : "{{ url('peserta/store') }}";
        let method      = id ? "PUT" : "POST";
        let labelsukses = id ? 'Peserta berhasil diupdate!' : 'Peserta berhasil ditambahkan!';

        console.log(id);

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
                    $('#pesertaForm')[0].reset();
                    $('#id_peserta').val('');
                    $('#pesertaModal h2').text('Tambah Peserta');
                    $('#pesertaModal').addClass('hidden');
                    $('#tabel').DataTable().ajax.reload();
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
        $('#pesertaForm')[0].reset();
        $('#id_peserta').val('');
        $('#pesertaModal h2').text('Tambah Peserta');
        $('#pesertaModal').addClass('hidden');
    });



</script>
