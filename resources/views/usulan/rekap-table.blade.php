<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Usulan Daerah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --dark-teal: #005050;
            --teal-green: #007E78;
            --medium-teal: #008E87;
            --bright-teal: #00B3AC;
            --light-mint: #C7EDEB;
            --olive-green: #646400;
            --lime-yellow: #D2DE00;
            --pale-yellow: #F4F7C2;
            --light-gray: #BFBFBF;
            --medium-gray: #7F7F7F;
            --bright-red: #C00000;
        }

        body {
            background: linear-gradient(80deg, #00151d 0%, #007E78 50%, #008E87 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .header-gradient {
            background: linear-gradient(90deg, #005858 0%, #00B3AC 100%);
        }

        .badge-provinsi {
            background-color: #ffcdd2;
            color: #C00000;
        }

        .badge-kabkota {
            background-color: #C7EDEB;
            color: #005050;
        }

        .badge-puskesmas {
            background-color: #F4F7C2;
            color: #646400;
        }

        .badge-ikp {
            background-color: #C7EDEB;
            color: #005050;
        }

        .badge-ikk {
            background-color: #F4F7C2;
            color: #646400;
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-6 md:py-8 max-w-7xl">
        <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden mb-6">
            <!-- Header -->
            <div class="header-gradient p-4 md:p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Rekap Usulan Daerah</h1>
                    <a href="{{ route('usulan.index') }}"
                        class="flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                        <span class="mr-2">←</span>
                        <span>Kembali ke Survey</span>
                    </a>
                </div>
            </div>

            <div class="p-4 md:p-6">
                <!-- Filter -->
                <div class="bg-gradient-to-r from-[#edfffe] to-[#edfffe] rounded-xl p-4 mb-6 border-1" style="border-color: #00B3AC">
                    <form method="GET" action="{{ route('usulan.rekap') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #005050">Tingkat</label>
                            <select name="tingkat" class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm" style="border-color: #BFBFBF">
                                <option value="">Semua Tingkat</option>
                                <option value="Provinsi" {{ request('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                <option value="Kabupaten/Kota" {{ request('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                <option value="Puskesmas" {{ request('tingkat') == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #005050">Indikator</label>
                            <select name="id_indikator" class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm" style="border-color: #BFBFBF">
                                <option value="">Semua Indikator</option>
                                @foreach($indikators as $ind)
                                    <option value="{{ $ind->id }}" {{ request('id_indikator') == $ind->id ? 'selected' : '' }}>
                                        {{ $ind->nomor }} - {{ Str::limit($ind->nama, 40) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #005050">Nama Responden</label>
                            <input type="text" name="nama_responden" value="{{ request('nama_responden') }}" placeholder="Cari nama..." class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm" style="border-color: #BFBFBF">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #005050">Instansi</label>
                            <input type="text" name="instansi" value="{{ request('instansi') }}" placeholder="Cari instansi..." class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm" style="border-color: #BFBFBF">
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit" class="bg-gradient-to-r from-[#007E78] to-[#00B3AC] hover:from-[#005050] hover:to-[#007E78] text-white px-6 py-2 rounded-xl transition flex-1 font-semibold">
                                🔍 Filter
                            </button>
                            <a href="{{ route('usulan.rekap') }}" class="px-4 py-2 rounded-xl transition text-white font-semibold" style="background-color: #7F7F7F">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="rounded-xl p-4" style="background-color: #C7EDEB">
                        <div class="text-sm font-medium" style="color: #007E78">Total Usulan</div>
                        <div class="text-3xl font-bold" style="color: #005050">{{ $usulanList->total() }}</div>
                    </div>
                    <div class="rounded-xl p-4" style="background-color: #F4F7C2">
                        <div class="text-sm font-medium" style="color: #646400">Total Anggaran</div>
                        <div class="text-2xl font-bold" style="color: #646400">Rp {{ number_format($usulanList->sum('anggaran'), 0, ',', '.') }}</div>
                    </div>
                    <div class="rounded-xl p-4 border-1" style="border-color: #00B3AC; background-color: white">
                        <div class="text-sm font-medium" style="color: #007E78">Jumlah Responden</div>
                        <div class="text-3xl font-bold" style="color: #005050">{{ $usulanList->pluck('id_responden')->unique()->count() }}</div>
                    </div>
                </div>

                <!-- Tabel Rekap -->
                <div class="overflow-x-auto rounded-xl border-1" style="border-color: #BFBFBF">
                    <table class="w-full text-sm">
                        <thead style="background-color: #C7EDEB">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">No</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Responden</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Instansi</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Indikator</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Tingkat</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Saran Kegiatan</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Detail Kegiatan</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Kriteria BOK</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Volume</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Frekuensi</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Anggaran</th>
                                <th class="px-4 py-3 text-left font-semibold" style="color: #005050">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($usulanList as $index => $usulan)
                            <tr class="border-b hover:bg-gray-50" style="border-color: #BFBFBF">
                                <td class="px-4 py-3" style="color: #7F7F7F">{{ $usulanList->firstItem() + $index }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium" style="color: #005050">{{ $usulan->responden->nama }}</div>
                                    <div class="text-xs" style="color: #7F7F7F">{{ $usulan->responden->jabatan }}</div>
                                </td>
                                <td class="px-4 py-3" style="color: #007E78">{{ $usulan->responden->instansi }}</td>
                                <td class="px-4 py-3" title="{{ $usulan->indikator->nama }}">
                                    <div class="text-xs" style="color: #7F7F7F">{{ $usulan->indikator->nomor }}</div>
                                    <div style="color: #007E78">{{ Str::limit($usulan->indikator->nama, 30) }}</div>
                                    <span class="inline-block px-2 py-1 text-xs rounded-full mt-1 {{ $usulan->indikator->tingkat == 'IKP' ? 'badge-ikp' : 'badge-ikk' }}">
                                        {{ $usulan->indikator->tingkat }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $usulan->tingkat_bok == 'Provinsi' ? 'badge-provinsi' : ($usulan->tingkat_bok == 'Kabupaten/Kota' ? 'badge-kabkota' : 'badge-puskesmas') }}">
                                        {{ $usulan->tingkat_bok }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 max-w-xs">
                                    <div class="inline-block" title="{{ $usulan->saran_kegiatan }}" style="color: #007E78">
                                        {{ Str::limit($usulan->saran_kegiatan, 50) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 max-w-xs">
                                    <div class="inline-block" title="{{ $usulan->detail_kegiatan }}" style="color: #007E78">
                                        {{ Str::limit($usulan->detail_kegiatan, 50) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 max-w-xs">
                                    <div class="inline-block" title="{{ $usulan->keriteria_penerima_bok }}" style="color: #007E78">
                                        {{ Str::limit($usulan->keriteria_penerima_bok, 50) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3" style="color: #007E78">{{ $usulan->volume }} {{ $usulan->satuan }}</td>
                                <td class="px-4 py-3" style="color: #007E78">{{ $usulan->frekuensi_tahun }} kali/th</td>
                                <td class="px-4 py-3 font-medium text-end truncate" style="color: #005050">{{ number_format($usulan->anggaran, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-xs" style="color: #7F7F7F">
                                    {{ $usulan->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="px-4 py-8 text-center" style="color: #7F7F7F">
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
    </div>
</body>

</html>