<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulir Mulai Tes - Lexie Edu</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .bg-button {
      background: #30CAEE;
    }
    .bg-button:hover {
      background: #3099fb;
    }
  </style>
</head>
<body class="bg-gray-100">

  <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-center text-blue-700 mb-6">Formulir Mulai Tes</h2>

    {{-- Tampilkan semua error --}}
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="text-sm list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div id="form-section">
      <form id="peserta-form" action="{{ url('mulai-tes') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label for="nama" class="block font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required class="mt-1 w-full p-2 border rounded">
          @error('nama')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="umur" class="block font-medium text-gray-700">Umur</label>
          <input type="number" id="umur" name="umur" min="1" value="{{ old('umur') }}" required class="mt-1 w-full p-2 border rounded">
          @error('umur')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="alamat" class="block font-medium text-gray-700">Alamat</label>
          <textarea id="alamat" name="alamat" rows="2" required class="mt-1 w-full p-2 border rounded">{{ old('alamat') }}</textarea>
          @error('alamat')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="email" class="block font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full p-2 border rounded">
          @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="instansi" class="block font-medium text-gray-700">Instansi</label>
          <select name="instansi" id="instansi" class="w-full border rounded p-2 text-sm" required>
            <option value="">Pilih Instansi</option>
            @foreach($respon['instansiData'] as $items)
              <option value="{{ $items->id_instansi }}" {{ old('instansi') == $items->id_instansi ? 'selected' : '' }}>
                {{ $items->nama_instansi }}
              </option>
            @endforeach
          </select>
          @error('instansi')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-button text-white py-2 rounded transition">Mulai Tes</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
