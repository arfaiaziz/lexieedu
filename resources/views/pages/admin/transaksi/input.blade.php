
<div id="transaksiModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-full flex-row justify-center">
                <h2 class="text-lg font-bold">Tambah Transaksi</h2>
            </div>

            <button id="closeModalBtn" class="text-gray-500 hover:text-black text-lg">&times;</button>
        </div>
        <form id="transaksiForm" method="POST" action="{{ url('transaksi/store') }}">
            @csrf
            <input type="hidden" id="id_transaksi" name="id_transaksi">
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium">Nama transaksi</label>
                <input type="text" name="nama" id="nama" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-2 w-full flex flex-row justify-between gap-2">
                <div class="w-full">
                    <label for="tgl_transaksi" class="block text-sm font-medium">Tanggal Transaksi</label>
                    <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div class="w-full">
                    <label for="via_pembayaran" class="block text-sm font-medium">Via Pembayaran</label>
                    <input type="text" name="via_pembayaran" id="via_pembayaran" class="w-full border rounded p-2 text-sm" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="nominal" class="block text-sm font-medium">Nominal</label>
                <input type="number" name="nominal" id="nominal" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-medium">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="submittransaksi" class="px-4 py-2 button-add text-white rounded w-full">Submit</button>
            </div>
        </form>
    </div>
</div>


<script>

    $('#submittransaksi').on('click', function (e) {
        e.preventDefault();

        let nama            = $('#nama').val().trim();
        let tgl_transaksi   = $('#tgl_transaksi').val();
        let via_pembayaran  = $('#via_pembayaran').val();
        let nominal         = $('#nominal').val();
        let keterangan      = $('#keterangan').val();

        // Validasi input kosong
        if (!nama || !tgl_transaksi || !via_pembayaran || !nominal || !keterangan) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Semua field harus diisi!'
            });
            return;
        }


        let data = {
            nama,
            tgl_transaksi,
            via_pembayaran,
            nominal,
            keterangan,
            _token: $('input[name="_token"]').val()
        };

        let id          = $('#id_transaksi').val();
        let url         = id ? "{{ url('transaksi/update') }}/" + id : "{{ url('transaksi/store') }}";
        let method      = id ? "PUT" : "POST";
        let labelsukses = id ? 'Transaksi berhasil diupdate!' : 'Transaksi berhasil ditambahkan!';

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
                    $('#transaksiForm')[0].reset();
                    $('#id_transaksi').val('');
                    $('#transaksiModal h2').text('Tambah Transaksi');
                    $('#transaksiModal').addClass('hidden');
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
        $('#transaksiForm')[0].reset();
        $('#id_transaksi').val('');
        $('#transaksiModal h2').text('Tambah Transaksi');
        $('#transaksiModal').addClass('hidden');
    });



</script>
