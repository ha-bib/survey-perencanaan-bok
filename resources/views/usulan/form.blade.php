<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Survey Perencanaan BOK 2027</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Survey Perencanaan BOK 2027</h1>
                <div class="flex gap-2">
                    <a href="{{ route('usulan.indikator') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition">
                        📋 Daftar Indikator
                    </a>
                    <a href="{{ route('usulan.rekap') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        📊 Rekap Survey
                    </a>
                </div>
            </div>

            <!-- Responden Identity -->
            @if (session('responden_id'))
                @php
                    $responden = \App\Models\Responden::find(session('responden_id'));
                @endphp
                @if ($responden)
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs text-green-600 font-medium mb-1">Responden Aktif</div>
                                <div class="flex items-center gap-4 text-sm">
                                    <div>
                                        <span class="font-semibold text-gray-800">{{ $responden->nama }}</span>
                                        <span class="text-gray-500">·</span>
                                        <span class="text-gray-600">{{ $responden->jabatan }}</span>
                                        <span class="text-gray-500">·</span>
                                        <span class="text-gray-600">{{ $responden->instansi }}</span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                @endif
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if (!$respondenId)
                <!-- Form Data Responden -->
                <div class="border-2 border-blue-200 rounded-lg p-6 mb-6 bg-blue-50">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800">Isi Data Responden Berikut</h2>
                    <form action="{{ route('usulan.storeUser') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                                <input type="text" name="nama" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Instansi *</label>
                                <input type="text" name="instansi" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan *</label>
                                <input type="text" name="jabatan" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                            S I M P A N
                        </button>
                    </form>
                </div>
            @else
                <!-- Form Usulan -->
                <div class="border-2 border-green-200 rounded-lg p-6 mb-6 bg-green-50">
                    <h2 class="text-xl font-semibold text-green-800">Tambah Usulan</h2>

                    <form action="{{ route('usulan.store') }}" method="POST" id="usulanForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Indikator *</label>
                                <select name="indikator" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih Indikator --</option>
                                    @foreach ($indikators as $ind)
                                        <option value="{{ $ind->id }}">{{ $ind->nomor }} - {{ $ind->nama }} ({{ $ind->tingkat }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat *</label>
                                <select name="tingkat_bok" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="Provinsi">Provinsi</option>
                                    <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                    <option value="Puskesmas">Puskesmas</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Volume *</label>
                                <input type="number" name="volume" required min="1"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Satuan *</label>
                                <input type="text" name="satuan" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="Contoh: orang, kegiatan, paket">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Frekuensi/Tahun *</label>
                                <input type="number" name="frekuensi_tahun" required min="1"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran (Rp) *</label>
                                <input type="number" name="anggaran" required min="0" step="0.01"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Saran Kegiatan *</label>
                                <textarea name="saran_kegiatan" required rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Detail Kegiatan *</label>
                                <textarea name="detail_kegiatan" required rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kriteria Penerima BOK *</label>
                                <textarea name="keriteria_penerima_bok" required rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
                            ➕ Tambah Usulan
                        </button>
                    </form>
                </div>

                <!-- Daftar Usulan -->
                @if ($usulanList->count() > 0)
                    <div class="border-2 border-gray-200 rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Daftar Usulan Anda ({{ $usulanList->count() }})</h2>
                            <form action="{{ route('usulan.cancel') }}" method="POST"
                                onsubmit="return confirm('Yakin ingin membatalkan semua usulan?')">
                                @csrf
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition text-sm">
                                    ❌ Hapus Semua Usulan
                                </button>
                            </form>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left">No</th>
                                        <th class="px-4 py-2 text-left">Indikator</th>
                                        <th class="px-4 py-2 text-left">Tingkat</th>
                                        <th class="px-4 py-2 text-left">Saran Kegiatan</th>
                                        <th class="px-4 py-2 text-left">Volume</th>
                                        <th class="px-4 py-2 text-left">Anggaran</th>
                                        <th class="px-4 py-2 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usulanList as $index => $usulan)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3">{{ $usulan->indikator->nomor }} - {{ Str::limit($usulan->indikator->nama, 30) }}
                                            </td>
                                            <td class="px-4 py-3">{{ $usulan->tingkat_bok }}</td>
                                            <td class="px-4 py-3">{{ Str::limit($usulan->saran_kegiatan, 40) }}</td>
                                            <td class="px-4 py-3">{{ $usulan->volume }} {{ $usulan->satuan }}</td>
                                            <td class="px-4 py-3">Rp {{ number_format($usulan->anggaran, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <form action="{{ route('usulan.destroy', $usulan->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus usulan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</body>

</html>
