<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Indikator Kesprimkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Indikator Kesprimkom</h1>
                <a href="{{ route('usulan.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    ← Kembali ke Survey
                </a>
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

            <!-- Search & Filter Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-3 mb-4 border border-blue-200">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-end">
                    <div class="md:col-span-5 mb-1">
                        <label class="block text-xs font-medium text-gray-700 mb-1">🔍 Cari (Nomor, Nama, Tingkat, Unit)</label>
                        <input id="searchInput" type="text" placeholder="Ketik untuk mencari..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-3 mb-1">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Filter Tingkat</label>
                        <select id="tingkatFilter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Tingkat</option>
                            <option value="IKK">IKK</option>
                            <option value="IKP">IKP</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 mb-1">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Filter Unit/Tim Kerja</label>
                        <select id="unitFilter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Unit</option>
                            @foreach ($indikators->pluck('unit_timker')->unique()->filter()->sort() as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2 p-1"> 
                        <button id="resetBtn"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-lg transition w-full h-12">Reset</button>
                    </div> 
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                <div class="bg-blue-100 rounded-lg p-3">
                    <div class="text-xs text-blue-600 font-medium">Total Indikator</div>
                    <div class="text-2xl font-bold text-blue-800" id="totalCount">{{ $indikators->count() }}</div>
                </div>
                <div class="bg-green-100 rounded-lg p-3">
                    <div class="text-xs text-green-600 font-medium">IKP</div>
                    <div class="text-2xl font-bold text-green-800" id="ikpCount">{{ $indikators->where('tingkat', 'IKP')->count() }}</div>
                </div>
                <div class="bg-orange-100 rounded-lg p-3">
                    <div class="text-xs text-orange-600 font-medium">IKK</div>
                    <div class="text-2xl font-bold text-orange-800" id="ikkCount">{{ $indikators->where('tingkat', 'IKK')->count() }}</div>
                </div>
                <div class="bg-purple-100 rounded-lg p-3">
                    <div class="text-xs text-purple-600 font-medium">Ditampilkan</div>
                    <div class="text-2xl font-bold text-purple-800" id="visibleCount">{{ $indikators->count() }}</div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="indikatorTable">
                    <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                        <tr>
                            <th class="px-3 py-3 text-left">No</th>
                            <th class="px-3 py-3 text-left">Nomor</th>
                            <th class="px-3 py-3 text-left">Tingkat</th>
                            <th class="px-3 py-3 text-left">Nama Indikator</th>
                            <th class="px-3 py-3 text-left">Unit/Tim Kerja</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($indikators as $index => $indikator)
                            <tr class="border-b hover:bg-blue-50 transition indikator-row" data-nomor="{{ strtolower($indikator->nomor) }}"
                                data-nama="{{ strtolower($indikator->nama) }}" data-tingkat="{{ $indikator->tingkat }}"
                                data-unit="{{ strtolower($indikator->unit_timker ?? '') }}">
                                <td class="px-3 py-2 text-gray-600 row-number">{{ $index + 1 }}</td>
                                <td class="px-3 py-2">
                                    <span class="font-mono font-semibold text-blue-600">{{ $indikator->nomor }}</span>
                                </td>
                                <td class="px-3 py-2">
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $indikator->tingkat == 'IKP' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $indikator->tingkat }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">
                                    <div class="font-medium text-gray-800">{{ $indikator->nama }}</div>
                                </td>
                                <td class="px-3 py-2">
                                    <span class="text-gray-700">{{ $indikator->unit_timker ?: '-' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Active Filters & No Results -->
            <div id="activeFilters" class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mt-3 hidden">
                <div class="text-xs text-yellow-700"><span class="font-medium">Filter aktif:</span> <span id="filterTags"></span></div>
            </div>
            <div id="noResults" class="hidden py-6 text-center text-gray-500 text-sm">Tidak ada indikator ditemukan</div>

            <!-- Legend -->
            <div class="mt-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-semibold text-gray-700 mb-2">Keterangan:</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1 text-sm text-gray-600">
                    <div>• <span class="font-medium">IKP</span> = Indikator Kinerja Program</div>
                    <div>• <span class="font-medium">IKK</span> = Indikator Kinerja Kegiatan</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const tingkatFilter = document.getElementById('tingkatFilter');
        const unitFilter = document.getElementById('unitFilter');
        const resetBtn = document.getElementById('resetBtn');
        const activeFiltersDiv = document.getElementById('activeFilters');
        const filterTags = document.getElementById('filterTags');
        const noResults = document.getElementById('noResults');
        const tableBody = document.getElementById('tableBody');
        const allRows = document.querySelectorAll('.indikator-row');

        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const tingkat = tingkatFilter.value;
            const unit = unitFilter.value.toLowerCase();

            let visibleCount = 0,
                ikpVisible = 0,
                ikkVisible = 0;
            let tags = [];

            allRows.forEach(row => {
                const nomor = row.dataset.nomor;
                const nama = row.dataset.nama;
                const rowTingkat = row.dataset.tingkat;
                const rowUnit = row.dataset.unit;
                const matchSearch = !searchTerm || nomor.includes(searchTerm) || nama.includes(searchTerm) || rowTingkat.toLowerCase().includes(
                    searchTerm) || rowUnit.includes(searchTerm);
                const matchTingkat = !tingkat || rowTingkat === tingkat;
                const matchUnit = !unit || rowUnit === unit;

                if (matchSearch && matchTingkat && matchUnit) {
                    row.style.display = '';
                    visibleCount++;
                    row.querySelector('.row-number').textContent = visibleCount;
                    if (rowTingkat === 'IKP') ikpVisible++;
                    if (rowTingkat === 'IKK') ikkVisible++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('visibleCount').textContent = visibleCount;
            document.getElementById('ikpCount').textContent = ikpVisible;
            document.getElementById('ikkCount').textContent = ikkVisible;

            tableBody.style.display = visibleCount ? '' : 'none';
            noResults.style.display = visibleCount ? 'none' : 'block';

            if (searchTerm) tags.push(`<span class="inline-block bg-yellow-200 px-2 py-1 rounded mr-1">Pencarian: "${searchTerm}"</span>`);
            if (tingkat) tags.push(`<span class="inline-block bg-yellow-200 px-2 py-1 rounded mr-1">Tingkat: ${tingkat}</span>`);
            if (unit) tags.push(
                `<span class="inline-block bg-yellow-200 px-2 py-1 rounded mr-1">Unit: ${unitFilter.options[unitFilter.selectedIndex].text}</span>`);

            if (tags.length) {
                activeFiltersDiv.classList.remove('hidden');
                filterTags.innerHTML = tags.join('');
            } else {
                activeFiltersDiv.classList.add('hidden');
                filterTags.innerHTML = '';
            }
        }

        function resetFilters() {
            searchInput.value = '';
            tingkatFilter.value = '';
            unitFilter.value = '';
            applyFilters();
        }

        searchInput.addEventListener('input', applyFilters);
        tingkatFilter.addEventListener('change', applyFilters);
        unitFilter.addEventListener('change', applyFilters);
        resetBtn.addEventListener('click', resetFilters);
        document.getElementById('totalCount').textContent = allRows.length;
    </script>
</body>

</html>
