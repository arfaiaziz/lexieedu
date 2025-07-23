
<div id="instansiModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-full flex-row justify-center">
                <h2 class="text-lg font-bold">Tambah Instansi</h2>
            </div>

            <button id="closeModalBtn" class="text-gray-500 hover:text-black text-lg">&times;</button>
        </div>
        <form id="instansiForm" method="POST" action="{{ url('instansi/store') }}">
            @csrf
            <input type="hidden" id="id_instansi" name="id_instansi">
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <div class="mb-4">
                <label for="nama_instansi" class="block text-sm font-medium">Nama Instansi</label>
                <input type="text" name="nama_instansi" id="nama_instansi" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-2 w-full flex flex-row justify-between gap-2">
                <div class="w-full">
                    <label for="tgl_mulai" class="block text-sm font-medium">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div class="w-full">
                    <label for="tgl_berakhir" class="block text-sm font-medium">Tanggal Berakhir</label>
                    <input type="date" name="tgl_berakhir" id="tgl_berakhir" class="w-full border rounded p-2 text-sm" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="jumlah_sesi" class="block text-sm font-medium">Jumlah Sesi</label>
                <input type="number" name="jumlah_sesi" id="jumlah_sesi" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="submitInstansi" class="px-4 py-2 button-add text-white rounded w-full">Submit</button>
            </div>
        </form>
    </div>
</div>


<script>

    $('#submitInstansi').on('click', function (e) {
        e.preventDefault();

        let nama_instansi = $('#nama_instansi').val().trim();
        let tgl_mulai = $('#tgl_mulai').val();
        let tgl_berakhir = $('#tgl_berakhir').val();
        let jumlah_sesi = $('#jumlah_sesi').val();

        // Validasi input kosong
        if (!nama_instansi || !tgl_mulai || !tgl_berakhir || !jumlah_sesi) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Semua field harus diisi!'
            });
            return;
        }

        // Validasi tanggal
        if (tgl_mulai > tgl_berakhir) {
            Swal.fire({
                icon: 'error',
                title: 'Tanggal tidak valid',
                text: 'Tanggal mulai tidak boleh lebih besar dari tanggal berakhir.'
            });
            return;
        }

        let data = {
            nama_instansi,
            tgl_mulai,
            tgl_berakhir,
            jumlah_sesi,
            _token: $('input[name="_token"]').val()
        };

        let id          = $('#id_instansi').val();
        let url         = id ? "{{ url('instansi/update') }}/" + id : "{{ url('instansi/store') }}";
        let method      = id ? "PUT" : "POST";
        let labelsukses = id ? 'Instansi berhasil diupdate!' : 'Instansi berhasil ditambahkan!';

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
                    $('#instansiForm')[0].reset();
                    $('#id_instansi').val('');
                    $('#instansiModal h2').text('Tambah Instansi');
                    $('#instansiModal').addClass('hidden');
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
        $('#instansiForm')[0].reset();
        $('#id_instansi').val('');
        $('#instansiModal h2').text('Tambah Instansi');
        $('#instansiModal').addClass('hidden');
    });



</script>
