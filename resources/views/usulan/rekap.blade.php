<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Usulan Daerah</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
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

        .btn-secondary {
            background: linear-gradient(135deg, #646400 0%, #939c00 100%);
        }

        .btn-secondary:hover {
            background: #646400;
        }

        .wrap-text {
            white-space: normal !important;
            overflow: visible !important;
            text-overflow: unset !important;
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
                    <div class="flex gap-3">
                        <a href="{{ route('usulan.exportusulan') }}"
                            class="flex items-center justify-center bg-white bg-opacity-50 hover:bg-opacity-30 backdrop-blur text-dark px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                            Download
                        </a>
                        <a href="{{ route('usulan.index') }}"
                            class="flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                            <span class="mr-2">←</span>
                            <span>Kembali ke Survey</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <!-- Filter & Sort -->
                <div class="bg-gradient-to-r from-[#edfffe] to-[#edfffe] rounded-xl p-3 mb-4 border-2" style="border-color: #00B3AC">
                    <div class="grid grid-cols-1 md:grid-cols-8 gap-2">
                        <div>
                            <select id="filterTingkat" class="w-full px-2 py-1.5 border rounded-lg text-xs" style="border-color: #BFBFBF">
                                <option value="">Semua Level</option>
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
                            <input type="text" id="filterKegiatan" placeholder="Cari rincian..."
                                class="w-full px-2 py-1.5 border rounded-lg text-xs" style="border-color: #BFBFBF">
                        </div>
                        <div>
                            <input type="text" id="filterInstansi" placeholder="Instansi..." class="w-full px-2 py-1.5 border rounded-lg text-xs"
                                style="border-color: #BFBFBF">
                        </div>
                        <div>
                            <select id="sortBy" class="w-full px-2 py-1.5 border rounded-lg text-xs" style="border-color: #BFBFBF">
                                <option value="terbaru">Terbaru</option>
                                <option value="terlama">Terlama</option>
                                <option value="like">Like terbanyak</option>
                                <option value="dislike">Dislike terbanyak</option>
                            </select>
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
                        <div class="text-xl font-bold" style="color: #005050" id="totalUsulan">{{ $totalUsulan }}</div>
                    </div>
                    <div class="rounded-lg p-2" style="background-color: #F4F7C2">
                        <div class="text-xs font-medium" style="color: #646400">Like</div>
                        <div class="text-lg font-bold" style="color: #646400" id="totalLikes">{{ $totalLikes }}</div>
                    </div>
                    <div class="rounded-lg p-2 border" style="border-color: #00B3AC; background-color: white">
                        <div class="text-xs font-medium" style="color: #007E78">Responden</div>
                        <div class="text-xl font-bold" style="color: #005050" id="totalResponden">0</div>
                    </div>
                </div>

                <!-- Cards Container -->
                <div id="cardsContainer" class="grid grid-cols-1 lg:grid-cols-2 gap-3"></div>

                <!-- No Results -->
                <div id="noResults" class="hidden py-8 text-center">
                    <div class="text-4xl mb-2">🔍</div>
                    <p class="font-semibold mb-1" style="color: #005050">Tidak ada usulan ditemukan</p>
                    <p class="text-xs" style="color: #7F7F7F">Coba ubah filter pencarian</p>
                </div>

                <!-- Footer Info -->
                <div class="text-center text-xs mt-3" style="color: #7F7F7F">
                    Menampilkan <span id="visibleCount">0</span> dari <span id="totalCount">0</span> usulan · <span class="italic">Klik kartu untuk
                        melihat detail</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Parse JSON data
        const usulanData = {!! $usulanJson !!};
        let filteredData = [...usulanData];
        const hasResponden = {{ session('responden_id') ? 'true' : 'false' }};

        // DOM elements
        const filterTingkat = document.getElementById('filterTingkat');
        const filterIndikator = document.getElementById('filterIndikator');
        const filterKegiatan = document.getElementById('filterKegiatan');
        const filterInstansi = document.getElementById('filterInstansi');
        const sortBy = document.getElementById('sortBy');
        const resetFilterBtn = document.getElementById('resetFilter');
        const expandAllBtn = document.getElementById('expandAll');
        const expandText = document.getElementById('expandText');
        const cardsContainer = document.getElementById('cardsContainer');
        const noResults = document.getElementById('noResults');

        let allExpanded = false;

        // Helper: Get badge class
        function getBadgeClass(tingkat) {
            if (tingkat === 'Provinsi') return 'badge-provinsi';
            if (tingkat === 'Kabupaten/Kota') return 'badge-kabkota';
            return 'badge-puskesmas';
        }

        function getTingkatLabel(tingkat) {
            return tingkat === 'Kabupaten/Kota' ? 'Kab/Kota' : tingkat;
        }

        // Create card HTML
        function createCard(usulan) {
            return `
                <div class="usulan-card bg-white rounded-lg border p-3" style="border-color: #BFBFBF"
                    data-tingkat="${usulan.level_kegiatan}" data-indikator="${usulan.indikator.id}"
                    data-id="${usulan.id}" onclick="toggleCard(this)">

                    <!-- Header -->
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-sm truncate" style="color: #005050">${usulan.responden.nama}</h3>
                            <p class="text-xs truncate" style="color: #007E78">${usulan.responden.instansi} · ${usulan.responden.jabatan}</p>
                        </div>
                        <div class="flex gap-1 flex-shrink-0 items-center">
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full ${getBadgeClass(usulan.level_kegiatan)}">
                                ${getTingkatLabel(usulan.level_kegiatan)}
                            </span>
                            <svg class="expand-icon w-4 h-4" style="color: #007E78" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Rincian Menu -->
                    <div class="mb-2 py-2 px-1 rounded" style="background-color: #f8f9fa">
                        <p class="text-xs font-medium truncate wrap-text-target" style="color: #007E78" title="${usulan.nama_kegiatan}">
                            ${usulan.nama_kegiatan}
                        </p>
                    </div>

                    <!-- Detail Content (Hidden by default) -->
                    <div class="detail-content">
                        <div class="space-y-1.5 mb-2 text-xs border-t pt-2" style="border-color: #BFBFBF">
                            <div>
                                <span class="font-medium" style="color: #7F7F7F">Detail Kegiatan</span><br>
                                <span style="color: #005050">${usulan.detail_kegiatan}</span>
                            </div>
                            <div>
                                <span class="font-medium" style="color: #7F7F7F">Sasaran Rincian Menu</span><br>
                                <span style="color: #005050">${usulan.sasaran_kegiatan}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Indikator -->
                    <div class="p-1 rounded mb-2" style="background-color: #f9fafa">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium truncate wrap-text-target" style="color: #007E78" title="${usulan.indikator.nama}">
                                    ${usulan.indikator.nomor} · ${usulan.indikator.nama}
                                </p>
                            </div>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full flex-shrink-0 ${usulan.indikator.tingkat === 'IKP' ? 'badge-ikp' : 'badge-ikk'}">
                                ${usulan.indikator.tingkat}
                            </span>
                        </div>
                    </div>

                    <!-- Footer: Like / Dislike -->
                    <div class="flex items-center justify-between pt-2 border-t text-xs" style="border-color: #BFBFBF">
                        <div class="flex gap-3 items-center">
                            <button class="px-2 py-1 rounded border like-btn" data-id="${usulan.id}" data-type="like" style="border-color:#C7EDEB; color:#005050" onclick="event.stopPropagation(); handleReaction(this)">👍 <span class="like-count">${usulan.likes_count}</span></button>
                            <button class="px-2 py-1 rounded border dislike-btn" data-id="${usulan.id}" data-type="dislike" style="border-color:#F4F7C2; color:#646400" onclick="event.stopPropagation(); handleReaction(this)">👎 <span class="dislike-count">${usulan.dislikes_count}</span></button>
                        </div>
                        <div class="text-right text-[10px]" style="color:#7F7F7F">${usulan.created_at}</div>
                    </div>
                </div>
            `;
        }

        // Toggle card expand/collapse
        function toggleCard(card) {
            const detailContent = card.querySelector('.detail-content');
            const isExpanded = card.classList.contains('expanded');
            // Find all elements to wrap/unwrap
            const wrapTargets = card.querySelectorAll('.wrap-text-target');

            if (isExpanded) {
                card.classList.remove('expanded');
                detailContent.classList.remove('show');
                // Remove wrap-text, add truncate
                wrapTargets.forEach(el => {
                    el.classList.remove('wrap-text');
                    el.classList.add('truncate');
                });
            } else {
                card.classList.add('expanded');
                detailContent.classList.add('show');
                // Remove truncate, add wrap-text
                wrapTargets.forEach(el => {
                    el.classList.remove('truncate');
                    el.classList.add('wrap-text');
                });
            }
        }

        // Expand all cards
        function expandAllCards() {
            allExpanded = !allExpanded;
            document.querySelectorAll('.usulan-card').forEach(card => {
                if (card.style.display !== 'none') {
                    const detailContent = card.querySelector('.detail-content');
                    const wrapTargets = card.querySelectorAll('.wrap-text-target');
                    if (allExpanded) {
                        card.classList.add('expanded');
                        detailContent.classList.add('show');
                        wrapTargets.forEach(el => {
                            el.classList.remove('truncate');
                            el.classList.add('wrap-text');
                        });
                    } else {
                        card.classList.remove('expanded');
                        detailContent.classList.remove('show');
                        wrapTargets.forEach(el => {
                            el.classList.remove('wrap-text');
                            el.classList.add('truncate');
                        });
                    }
                }
            });
            expandText.textContent = allExpanded ? 'Collapse Semua' : 'Expand Semua';
        }

        // Handle like/dislike
        function handleReaction(btn) {
            if (!hasResponden) {
                alert('Anda harus mengisi survey untuk meng-like/dislike.');
                return;
            }

            const usulanId = btn.getAttribute('data-id');
            const type = btn.getAttribute('data-type');

            fetch(`{{ url('/usulan') }}/${usulanId}/react`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        reaction: type
                    })
                })
                .then(r => {
                    if (!r.ok) {
                        return r.json().then(data => {
                            throw new Error(data.message || 'Error');
                        });
                    }
                    return r.json();
                })
                .then(data => {
                    const card = btn.closest('.usulan-card');
                    const likeCount = card.querySelector('.like-count');
                    const dislikeCount = card.querySelector('.dislike-count');
                    likeCount.textContent = data.likes;
                    dislikeCount.textContent = data.dislikes;

                    // Update usulan data
                    const idx = usulanData.findIndex(u => u.id == usulanId);
                    if (idx >= 0) {
                        usulanData[idx].likes_count = data.likes;
                        usulanData[idx].dislikes_count = data.dislikes;
                    }

                    // Update total likes
                    let totalLikes = usulanData.reduce((sum, u) => sum + u.likes_count, 0);
                    document.getElementById('totalLikes').textContent = totalLikes;
                })
                .catch(err => alert(err.message || 'Terjadi kesalahan, coba lagi.'));
        }

        // Filter & Sort
        function applyFilters() {
            const tingkat = filterTingkat.value;
            const indikator = filterIndikator.value;
            const kegiatan = filterKegiatan.value.toLowerCase().trim();
            const instansi = filterInstansi.value.toLowerCase().trim();
            const sortValue = sortBy.value;

            // Filter
            filteredData = usulanData.filter(u => {
                const matchTingkat = !tingkat || u.level_kegiatan === tingkat;
                const matchIndikator = !indikator || u.indikator.id == indikator;
                const matchKegiatan = !kegiatan ||
                    (u.nama_kegiatan.toLowerCase().includes(kegiatan) ||
                        u.detail_kegiatan.toLowerCase().includes(kegiatan));
                const matchInstansi = !instansi || u.responden.instansi.toLowerCase().includes(instansi);
                return matchTingkat && matchIndikator && matchKegiatan && matchInstansi;
            });

            // Sort
            if (sortValue === 'like') {
                filteredData.sort((a, b) => b.likes_count - a.likes_count);
            } else if (sortValue === 'dislike') {
                filteredData.sort((a, b) => b.dislikes_count - a.dislikes_count);
            } else if (sortValue === 'terlama') {
                filteredData.sort((a, b) => new Date(a.created_at_iso) - new Date(b.created_at_iso));
            } else { // terbaru (default)
                filteredData.sort((a, b) => new Date(b.created_at_iso) - new Date(a.created_at_iso));
            }

            renderCards();
        }

        // Render cards
        function renderCards() {
            cardsContainer.innerHTML = filteredData.map(u => createCard(u)).join('');

            // Update stats
            const uniqueResponden = [...new Set(filteredData.map(u => u.responden.id))].length;
            document.getElementById('totalUsulan').textContent = filteredData.length;
            document.getElementById('totalResponden').textContent = uniqueResponden;
            document.getElementById('visibleCount').textContent = filteredData.length;
            document.getElementById('totalCount').textContent = usulanData.length;

            // Show/hide no results
            if (filteredData.length === 0) {
                cardsContainer.style.display = 'none';
                noResults.classList.remove('hidden');
            } else {
                cardsContainer.style.display = 'grid';
                noResults.classList.add('hidden');
            }
        }

        // Reset filters
        function resetFilters() {
            filterTingkat.value = '';
            filterIndikator.value = '';
            filterKegiatan.value = '';
            filterInstansi.value = '';
            sortBy.value = 'terbaru';
            applyFilters();
        }

        // Event listeners
        filterTingkat.addEventListener('change', applyFilters);
        filterIndikator.addEventListener('change', applyFilters);
        filterKegiatan.addEventListener('input', applyFilters);
        filterInstansi.addEventListener('input', applyFilters);
        sortBy.addEventListener('change', applyFilters);
        resetFilterBtn.addEventListener('click', resetFilters);
        expandAllBtn.addEventListener('click', expandAllCards);

        // Initial render
        document.addEventListener('DOMContentLoaded', () => {
            renderCards();
        });
    </script>
</body>

</html>
