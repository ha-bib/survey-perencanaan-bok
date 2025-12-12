<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Indikator Kesprimkom</title>
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
            <div class="header-gradient p-4 md:py-4 px-4 ps-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-0">
                    <h2 class="text-xl md:text-2xl font-bold text-white">Daftar Indikator Kesprimkom</h2>
                    <a href="{{ route('usulan.index') }}"
                        class="flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                        <span class="mr-2">←</span>
                        <span>Kembali ke Survey</span>
                    </a>
                </div>
            </div>

            <div class="p-4 md:p-6">
                <!-- Responden Identity -->
                @if (session('responden_id'))
                    @php
                        $responden = \App\Models\Responden::find(session('responden_id'));
                    @endphp
                    @if ($responden)
                        <div class="bg-gradient-to-r from-[#edfffe] to-[#edfffe] border-1 border-[#00B3AC] rounded-xl p-4 mb-4">
                            <div class="text-xs font-medium mb-2" style="color: #007E78">✓ Responden Aktif</div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 text-sm">
                                <div class="font-semibold" style="color: #005050">{{ $responden->nama }}</div>
                                <div class="hidden sm:block" style="color: #7F7F7F">·</div>
                                <div style="color: #007E78">{{ $responden->jabatan }}</div>
                                <div class="hidden sm:block" style="color: #7F7F7F">·</div>
                                <div style="color: #007E78">{{ $responden->instansi }}</div>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Search & Filter Section -->
                <div class="bg-gradient-to-r from-[#edfffe] to-[#edfffe] rounded-xl p-3 mb-4 border-1 border-[#00B3AC]">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-end">
                        <div class="md:col-span-5 mb-1">
                            <label class="block text-xs font-medium mb-1" style="color: #005050">🔍 Cari (Nomor, Nama, Tingkat, Unit)</label>
                            <input id="searchInput" type="text" placeholder="Ketik untuk mencari..."
                                class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm" style="border-color: #BFBFBF">
                        </div>
                        <div class="md:col-span-3 mb-1">
                            <label class="block text-xs font-medium mb-1" style="color: #005050">Filter Tingkat</label>
                            <select id="tingkatFilter" class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm"
                                style="border-color: #BFBFBF">
                                <option value="">Semua Tingkat</option>
                                <option value="IKK">IKK</option>
                                <option value="IKP">IKP</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 mb-1">
                            <label class="block text-xs font-medium mb-1" style="color: #005050">Filter Unit/Tim Kerja</label>
                            <select id="unitFilter" class="w-full px-3 py-2 border-1 rounded-xl focus:outline-none text-sm"
                                style="border-color: #BFBFBF">
                                <option value="">Semua Unit</option>
                                @foreach ($indikators->pluck('unit_timker')->unique()->filter()->sort() as $unit)
                                    <option value="{{ $unit }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2 p-1">
                            <button id="resetBtn"
                                class="bg-gradient-to-r from-[#007E78] to-[#00B3AC] hover:from-[#005050] hover:to-[#007E78] text-white px-2 py-1 rounded-xl transition w-full h-12 font-semibold">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                    <div class="rounded-xl p-3" style="background-color: #C7EDEB">
                        <div class="text-xs font-medium" style="color: #007E78">Total Indikator</div>
                        <div class="text-2xl font-bold" style="color: #005050" id="totalCount">{{ $indikators->count() }}</div>
                    </div>
                    <div class="rounded-xl p-3" style="background-color: #C7EDEB">
                        <div class="text-xs font-medium" style="color: #007E78">IKP</div>
                        <div class="text-2xl font-bold" style="color: #005050" id="ikpCount">{{ $indikators->where('tingkat', 'IKP')->count() }}
                        </div>
                    </div>
                    <div class="rounded-xl p-3" style="background-color: #F4F7C2">
                        <div class="text-xs font-medium" style="color: #646400">IKK</div>
                        <div class="text-2xl font-bold" style="color: #646400" id="ikkCount">{{ $indikators->where('tingkat', 'IKK')->count() }}
                        </div>
                    </div>
                    <div class="rounded-xl p-3 border-1" style="border-color: #00B3AC; background-color: white">
                        <div class="text-xs font-medium" style="color: #007E78">Ditampilkan</div>
                        <div class="text-2xl font-bold" style="color: #005050" id="visibleCount">{{ $indikators->count() }}</div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-xl border-1" style="border-color: #BFBFBF">
                    <table class="w-full text-sm" id="indikatorTable">
                        <thead style="background-color: #C7EDEB">
                            <tr>
                                <th class="px-3 py-3 text-left font-semibold" style="color: #005050">No</th>
                                <th class="px-3 py-3 text-left font-semibold" style="color: #005050">Nomor</th>
                                <th class="px-3 py-3 text-left font-semibold" style="color: #005050">Tingkat</th>
                                <th class="px-3 py-3 text-left font-semibold" style="color: #005050">Nama Indikator</th>
                                <th class="px-3 py-3 text-left font-semibold" style="color: #005050">Unit/Tim Kerja</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="bg-white">
                            @foreach ($indikators as $index => $indikator)
                                <tr class="border-b hover:bg-gray-50 transition indikator-row" data-nomor="{{ strtolower($indikator->nomor) }}"
                                    data-nama="{{ strtolower($indikator->nama) }}" data-tingkat="{{ $indikator->tingkat }}"
                                    data-unit="{{ strtolower($indikator->unit_timker ?? '') }}" style="border-color: #BFBFBF">
                                    <td class="px-3 py-2 row-number" style="color: #7F7F7F">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2">
                                        <span class="font-mono font-semibold" style="color: #007E78">{{ $indikator->nomor }}</span>
                                    </td>
                                    <td class="px-3 py-2">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $indikator->tingkat == 'IKP' ? 'badge-ikp' : 'badge-ikk' }}">
                                            {{ $indikator->tingkat }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="font-medium" style="color: #005050">{{ $indikator->nama }}</div>
                                    </td>
                                    <td class="px-3 py-2">
                                        <span style="color: #007E78">{{ $indikator->unit_timker ?: '-' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Active Filters & No Results -->
                <div id="activeFilters" class="border-l-4 p-3 mt-3 rounded-lg hidden" style="background-color: #F4F7C2; border-color: #D2DE00">
                    <div class="text-xs" style="color: #646400">
                        <span class="font-medium">Filter aktif:</span> <span id="filterTags"></span>
                    </div>
                </div>
                <div id="noResults" class="hidden py-6 text-center text-sm" style="color: #7F7F7F">
                    Tidak ada indikator ditemukan
                </div>

                <!-- Legend -->
                <div class="mt-4 p-3 rounded-xl border-1" style="background-color: #edfffe; border-color: #00B3AC">
                    <h3 class="font-semibold mb-2" style="color: #005050">Keterangan:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 text-sm" style="color: #007E78">
                        <div>• <span class="font-medium">IKP</span> = Indikator Kinerja Program</div>
                        <div>• <span class="font-medium">IKK</span> = Indikator Kinerja Kegiatan</div>
                    </div>
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

            if (searchTerm) tags.push(
                `<span class="inline-block px-2 py-1 rounded mr-1" style="background-color: #F4F7C2; color: #646400">Pencarian: "${searchTerm}"</span>`
                );
            if (tingkat) tags.push(
                `<span class="inline-block px-2 py-1 rounded mr-1" style="background-color: #F4F7C2; color: #646400">Tingkat: ${tingkat}</span>`);
            if (unit) tags.push(
                `<span class="inline-block px-2 py-1 rounded mr-1" style="background-color: #F4F7C2; color: #646400">Unit: ${unitFilter.options[unitFilter.selectedIndex].text}</span>`
                );

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
