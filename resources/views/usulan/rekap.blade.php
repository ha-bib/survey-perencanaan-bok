<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Usulan Daerah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Rekap Usulan Daerah</h1>
                <a href="{{ route('usulan.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    ← Kembali ke Survey
                </a>
            </div>

            <!-- Filter -->
            <div class="bg-gray-100 rounded-lg p-4 mb-6">
                <form method="GET" action="{{ route('usulan.rekap') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat</label>
                        <select name="tingkat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Tingkat</option>
                            <option value="Provinsi" {{ request('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                            <option value="Kabupaten/Kota" {{ request('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                            <option value="Puskesmas" {{ request('tingkat') == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Indikator</label>
                        <select name="id_indikator" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Indikator</option>
                            @foreach($indikators as $ind)
                                <option value="{{ $ind->id }}" {{ request('id_indikator') == $ind->id ? 'selected' : '' }}>
                                    {{ $ind->nomor }} - {{ Str::limit($ind->nama, 40) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Responden</label>
                        <input type="text" name="nama_responden" value="{{ request('nama_responden') }}" placeholder="Cari nama..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instansi</label>
                        <input type="text" name="instansi" value="{{ request('instansi') }}" placeholder="Cari instansi..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex-1">
                            🔍 Filter
                        </button>
                        <a href="{{ route('usulan.rekap') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-100 rounded-lg p-4">
                    <div class="text-sm text-blue-600 font-medium">Total Usulan</div>
                    <div class="text-3xl font-bold text-blue-800">{{ $usulanList->total() }}</div>
                </div>
                <div class="bg-green-100 rounded-lg p-4">
                    <div class="text-sm text-green-600 font-medium">Total Anggaran</div>
                    <div class="text-2xl font-bold text-green-800">Rp {{ number_format($usulanList->sum('anggaran'), 0, ',', '.') }}</div>
                </div>
                <div class="bg-purple-100 rounded-lg p-4">
                    <div class="text-sm text-purple-600 font-medium">Jumlah Responden</div>
                    <div class="text-3xl font-bold text-purple-800">{{ $usulanList->pluck('id_responden')->unique()->count() }}</div>
                </div>
            </div>

            <!-- Tabel Rekap -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Responden</th>
                            <th class="px-4 py-3 text-left">Instansi</th>
                            <th class="px-4 py-3 text-left">Indikator</th>
                            <th class="px-4 py-3 text-left">Tingkat</th>
                            <th class="px-4 py-3 text-left">Saran Kegiatan</th>
                            <th class="px-4 py-3 text-left">Detail Kegiatan</th>
                            <th class="px-4 py-3 text-left">Kriteria BOK</th>
                            <th class="px-4 py-3 text-left">Volume</th>
                            <th class="px-4 py-3 text-left">Frekuensi</th>
                            <th class="px-4 py-3 text-left">Anggaran</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usulanList as $index => $usulan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $usulanList->firstItem() + $index }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $usulan->responden->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $usulan->responden->jabatan }}</div>
                            </td>
                            <td class="px-4 py-3">{{ $usulan->responden->instansi }}</td>
                            <td class="px-4 py-3" title="{{ $usulan->indikator->nama }}">
                                <div class="text-xs text-gray-600">{{ $usulan->indikator->nomor }}</div>
                                <div>{{ Str::limit($usulan->indikator->nama, 30) }}</div>
                                <span class="inline-block px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">
                                    {{ $usulan->indikator->tingkat }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-1 text-xs rounded {{ $usulan->tingkat_bok == 'Provinsi' ? 'bg-red-100 text-red-800' : ($usulan->tingkat_bok == 'Kabupaten/Kota' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $usulan->tingkat_bok }}
                                </span>
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <div class="inline-block" title="{{ $usulan->saran_kegiatan }}">
                                    {{ Str::limit($usulan->saran_kegiatan, 50) }}
                                </div>
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <div class="inline-block" title="{{ $usulan->detail_kegiatan }}">
                                    {{ Str::limit($usulan->detail_kegiatan, 50) }}
                                </div>
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <div class="inline-block" title="{{ $usulan->keriteria_penerima_bok }}">
                                    {{ Str::limit($usulan->keriteria_penerima_bok, 50) }}
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $usulan->volume }} {{ $usulan->satuan }}</td>
                            <td class="px-4 py-3">{{ $usulan->frekuensi_tahun }} kali/th</td>
                            <td class="px-4 py-3 font-medium text-end truncate">{{ number_format($usulan->anggaran, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">
                                {{ $usulan->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data usulan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $usulanList->links() }}
            </div>
        </div>
    </div>
</body>
</html>