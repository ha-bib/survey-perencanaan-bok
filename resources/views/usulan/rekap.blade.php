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

        .usulan-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .usulan-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 80, 80, 0.1);
        }

        .usulan-card.expanded {
            box-shadow: 0 6px 20px rgba(0, 80, 80, 0.15);
        }

        .detail-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .detail-content.show {
            max-height: 500px;
        }

        .expand-icon {
            transition: transform 0.3s ease;
        }

        .expanded .expand-icon {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-6 md:py-8 max-w-7xl">
        <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden mb-6">
            <!-- Header -->
            <div class="header-gradient p-4 md:py-4 px-4 ps-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-0">
                    <h2 class="text-xl md:text-2xl font-bold text-white">Rekap Usulan Daerah</h2>
                    <a href="{{ route('usulan.index') }}"
                        class="flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                        <span class="mr-2">←</span>
                        <span>Kembali ke Survey</span>
                    </a>
                </div>
            </div>


            <div class="p-4">
                <!-- Filter -->
                <div class="bg-gradient-to-r from-[#edfffe] to-[#edfffe] rounded-xl p-3 mb-4 border-2" style="border-color: #00B3AC">
                    <div class="grid grid-cols-1 md:grid-cols-7 gap-2">
                        <div>
                            <select id="filterTingkat" class="w-full px-2 py-1.5 border rounded-lg text-xs" style="border-color: #BFBFBF">
                                <option value="">Semua Tingkat</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                <option value="Puskesmas">Puskesmas</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <select id="filterIndikator" class="w-full px-2 py-1.5 border rounded-lg text-xs" style="border-color: #BFBFBF">
                                <option value="">Semua Indikator</option>
                                @foreach ($indikators as $ind)
                                    <option value="{{ $ind->id }}">{{ $ind->nomor }} - {{ $ind->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="text" id="filterKegiatan" placeholder="Cari kegiatan..."
                                class="w-full px-2 py-1.5 border rounded-lg text-xs" style="border-color: #BFBFBF">
                        </div>
                        <div>
                            <input type="text" id="filterInstansi" placeholder="Instansi..." class="w-full px-2 py-1.5 border rounded-lg text-xs"
                                style="border-color: #BFBFBF">
                        </div>
                        <div>
                            <button id="resetFilter" class="w-full px-2 py-1.5 rounded-lg text-white text-xs font-medium"
                                style="background-color: #7F7F7F">
                                Reset
                            </button>
                        </div>
                        <div>
                            <button id="expandAll"
                                class="w-full px-2 py-1.5 rounded-lg text-white text-xs font-medium bg-gradient-to-r from-[#007E78] to-[#00B3AC] hover:from-[#005050] hover:to-[#007E78]">
                                <span id="expandText">Expand Semua</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="grid grid-cols-3 gap-2 mb-4">
                    <div class="rounded-lg p-2" style="background-color: #C7EDEB">
                        <div class="text-xs font-medium" style="color: #007E78">Usulan</div>
                        <div class="text-xl font-bold" style="color: #005050" id="totalUsulan">{{ $usulanList->count() }}</div>
                    </div>
                    <div class="rounded-lg p-2" style="background-color: #F4F7C2">
                        <div class="text-xs font-medium" style="color: #646400">Anggaran</div>
                        <div class="text-lg font-bold" style="color: #646400" id="totalAnggaran">
                            {{ number_format($usulanList->sum('anggaran') / 1000000, 1) }}M</div>
                    </div>
                    <div class="rounded-lg p-2 border" style="border-color: #00B3AC; background-color: white">
                        <div class="text-xs font-medium" style="color: #007E78">Responden</div>
                        <div class="text-xl font-bold" style="color: #005050" id="totalResponden">
                            {{ $usulanList->pluck('id_responden')->unique()->count() }}</div>
                    </div>
                </div>

                <!-- Cards Container -->
                <div id="cardsContainer" class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    @foreach ($usulanList as $usulan)
                        <div class="usulan-card bg-white rounded-lg border p-3" style="border-color: #BFBFBF"
                            data-tingkat="{{ $usulan->tingkat_bok }}" data-indikator="{{ $usulan->id_indikator }}"
                            data-kegiatan="{{ strtolower($usulan->saran_kegiatan . ' ' . $usulan->detail_kegiatan) }}"
                            data-instansi="{{ strtolower($usulan->responden->instansi) }}" data-anggaran="{{ $usulan->anggaran }}"
                            data-responden-id="{{ $usulan->id_responden }}" onclick="toggleCard(this)">

                            <!-- Header -->
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-sm truncate" style="color: #005050">{{ $usulan->responden->nama }}</h3>
                                    <p class="text-xs truncate" style="color: #007E78">{{ $usulan->responden->instansi }} ·
                                        {{ $usulan->responden->jabatan }}</p>
                                </div>
                                <div class="flex gap-1 flex-shrink-0 items-center">
                                    <span
                                        class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full {{ $usulan->tingkat_bok == 'Provinsi' ? 'badge-provinsi' : ($usulan->tingkat_bok == 'Kabupaten/Kota' ? 'badge-kabkota' : 'badge-puskesmas') }}">
                                        {{ $usulan->tingkat_bok == 'Kabupaten/Kota' ? 'Kab/Kota' : $usulan->tingkat_bok }}
                                    </span>
                                    <svg class="expand-icon w-4 h-4" style="color: #007E78" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Saran Kegiatan -->
                            <div class="mb-2 py-2 px-1 rounded" style="background-color: #f8f9fa">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium" style="color: #007E78">
                                            {{ Str::limit($usulan->saran_kegiatan, 80) }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Content (Hidden by default) -->
                            <div class="detail-content">
                                <div class="space-y-1.5 mb-2 text-xs border-t pt-2" style="border-color: #BFBFBF">
                                    <div>
                                        <span class="font-medium" style="color: #7F7F7F">Detail Kegiatan</span><br>
                                        <span style="color: #005050">{{ $usulan->detail_kegiatan }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium" style="color: #7F7F7F">Kriteria Penerima BOK</span><br>
                                        <span style="color: #005050">{{ $usulan->keriteria_penerima_bok }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Indikator -->
                            <div class="p-1 rounded mb-2" style="background-color: #f9fafa">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium truncate" style="color: #007E78" title="{{ $usulan->indikator->nama }}">
                                            {{ $usulan->indikator->nomor }} · {{ Str::limit($usulan->indikator->nama, 40) }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full flex-shrink-0 {{ $usulan->indikator->tingkat == 'IKP' ? 'badge-ikp' : 'badge-ikk' }}">
                                        {{ $usulan->indikator->tingkat }}
                                    </span>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-2 border-t text-xs" style="border-color: #BFBFBF">
                                <div class="flex gap-3">
                                    <div>
                                        <span style="color: #7F7F7F">Vol:</span>
                                        <span class="font-semibold ml-1" style="color: #007E78">{{ $usulan->volume }} {{ $usulan->satuan }}</span>
                                    </div>
                                    <div>
                                        <span style="color: #7F7F7F">Frek:</span>
                                        <span class="font-semibold ml-1" style="color: #007E78">{{ $usulan->frekuensi_tahun }}x</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold" style="color: #005050">Rp {{ number_format($usulan->anggaran / 1000000, 1) }}jt</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- No Results -->
                <div id="noResults" class="hidden py-8 text-center">
                    <div class="text-4xl mb-2">🔍</div>
                    <p class="font-semibold mb-1" style="color: #005050">Tidak ada usulan ditemukan</p>
                    <p class="text-xs" style="color: #7F7F7F">Coba ubah filter pencarian</p>
                </div>

                <!-- Footer Info -->
                <div class="text-center text-xs mt-3" style="color: #7F7F7F">
                    Menampilkan <span id="visibleCount">{{ $usulanList->count() }}</span> dari <span
                        id="totalCount">{{ $usulanList->count() }}</span> usulan · <span class="italic">Klik kartu untuk melihat detail</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const filterTingkat = document.getElementById('filterTingkat');
        const filterIndikator = document.getElementById('filterIndikator');
        const filterKegiatan = document.getElementById('filterKegiatan');
        const filterInstansi = document.getElementById('filterInstansi');
        const resetFilterBtn = document.getElementById('resetFilter');
        const expandAllBtn = document.getElementById('expandAll');
        const expandText = document.getElementById('expandText');
        const cardsContainer = document.getElementById('cardsContainer');
        const noResults = document.getElementById('noResults');
        const cards = document.querySelectorAll('.usulan-card');
        let allExpanded = false;

        function toggleCard(card) {
            const detailContent = card.querySelector('.detail-content');
            const isExpanded = card.classList.contains('expanded');

            if (isExpanded) {
                card.classList.remove('expanded');
                detailContent.classList.remove('show');
            } else {
                card.classList.add('expanded');
                detailContent.classList.add('show');
            }
        }

        function expandAllCards() {
            allExpanded = !allExpanded;

            cards.forEach(card => {
                if (card.style.display !== 'none') {
                    const detailContent = card.querySelector('.detail-content');

                    if (allExpanded) {
                        card.classList.add('expanded');
                        detailContent.classList.add('show');
                    } else {
                        card.classList.remove('expanded');
                        detailContent.classList.remove('show');
                    }
                }
            });

            expandText.textContent = allExpanded ? 'Collapse Semua' : 'Expand Semua';
        }

        function applyFilters() {
            const tingkat = filterTingkat.value;
            const indikator = filterIndikator.value;
            const kegiatan = filterKegiatan.value.toLowerCase().trim();
            const instansi = filterInstansi.value.toLowerCase().trim();

            let visibleCount = 0;
            let totalAnggaran = 0;
            let uniqueResponden = new Set();

            cards.forEach(card => {
                const cardTingkat = card.dataset.tingkat;
                const cardIndikator = card.dataset.indikator;
                const cardKegiatan = card.dataset.kegiatan;
                const cardInstansi = card.dataset.instansi;
                const cardAnggaran = parseInt(card.dataset.anggaran);
                const cardRespondenId = card.dataset.respondenId;

                const matchTingkat = !tingkat || cardTingkat === tingkat;
                const matchIndikator = !indikator || cardIndikator === indikator;
                const matchKegiatan = !kegiatan || cardKegiatan.includes(kegiatan);
                const matchInstansi = !instansi || cardInstansi.includes(instansi);

                if (matchTingkat && matchIndikator && matchKegiatan && matchInstansi) {
                    card.style.display = '';
                    visibleCount++;
                    totalAnggaran += cardAnggaran;
                    uniqueResponden.add(cardRespondenId);
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('totalUsulan').textContent = visibleCount;
            document.getElementById('totalAnggaran').textContent = (totalAnggaran / 1000000).toFixed(1) + 'M';
            document.getElementById('totalResponden').textContent = uniqueResponden.size;
            document.getElementById('visibleCount').textContent = visibleCount;

            if (visibleCount === 0) {
                cardsContainer.style.display = 'none';
                noResults.classList.remove('hidden');
            } else {
                cardsContainer.style.display = 'grid';
                noResults.classList.add('hidden');
            }
        }

        function resetFilters() {
            filterTingkat.value = '';
            filterIndikator.value = '';
            filterKegiatan.value = '';
            filterInstansi.value = '';
            applyFilters();
        }

        resetFilterBtn.addEventListener('click', resetFilters);
        expandAllBtn.addEventListener('click', expandAllCards);
        filterTingkat.addEventListener('change', applyFilters);
        filterIndikator.addEventListener('change', applyFilters);
        filterKegiatan.addEventListener('input', applyFilters);
        filterInstansi.addEventListener('input', applyFilters);

        document.getElementById('totalCount').textContent = cards.length;
    </script>
</body>

</html>
