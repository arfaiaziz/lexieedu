
<div id="soalModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-full flex-row justify-center">
                <h2 class="text-lg font-bold">Tambah soal</h2>
            </div>

            <button id="closeModalBtn" class="text-gray-500 hover:text-black text-lg">&times;</button>
        </div>
        <form id="soalForm" method="POST" action="{{ url('soal/store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="id_soal" name="id_soal">
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <div class="mb-4">
                <label for="pertanyaan" class="block text-sm font-medium">Pertanyaan</label>
                <input type="text" name="pertanyaan" id="pertanyaan" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="audio" class="block text-sm font-medium">Upload Audio (MP3)</label>
                <input type="file" name="audio" id="audio" accept="audio/mp3" class="w-full border rounded p-2 text-sm">
            </div>
            <div class="audio-wrapper hidden">
                <label>Audio Saat Ini:</label>
                <audio id="current-audio" controls class="w-full mt-2"></audio>
            </div>


            <div class="mb-4">
                <label for="a" class="block text-sm font-medium">A</label>
                <input type="text" name="a" id="a" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="b" class="block text-sm font-medium">B</label>
                <input type="text" name="b" id="b" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="c" class="block text-sm font-medium">C</label>
                <input type="text" name="c" id="c" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="d" class="block text-sm font-medium">D</label>
                <input type="text" name="d" id="d" class="w-full border rounded p-2 text-sm" required>
            </div>
            <div class="mb-4">
                <label for="jawaban" class="block text-sm font-medium">Jawaban</label>
                <select name="jawaban" id="jawaban" class="w-full border rounded p-2 text-sm" required>
                    <option value="">Pilih Jawaban</option>
                    @foreach(['A','B','C','D'] as $items)
                        <option value="{{ $items }}">{{ $items }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="submitsoal" class="px-4 py-2 button-add text-white rounded w-full">Submit</button>
            </div>
        </form>
    </div>
</div>


<script>

    $('#submitsoal').on('click', function (e) {
        e.preventDefault();

        let form = $('#soalForm')[0];
        let formData = new FormData(form);

        let id          = $('#id_soal').val();
        let url         = id ? "{{ url('soal/update') }}/" + id : "{{ url('soal/store') }}";
        let method      = id ? "POST" : "POST";
        let labelsukses = id ? 'Soal berhasil diupdate!' : 'Soal berhasil ditambahkan!';

        if (id) {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: labelsukses
                }).then(() => {
                    $('#soalForm')[0].reset();
                    $('#id_soal').val('');
                    $('#soalModal h2').text('Tambah soal');
                    $('#soalModal').addClass('hidden');
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
        $('#soalForm')[0].reset();
        $('#id_soal').val('');
        $('#soalModal h2').text('Tambah soal');
        $('#submitsoal').text('Submit');
        $('#soalModal').addClass('hidden');
        $('#current-audio').addClass('hidden').attr('src', '');
    });




</script>
