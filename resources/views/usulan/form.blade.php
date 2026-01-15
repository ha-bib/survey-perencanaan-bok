<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Survey Perencanaan BOK 2027</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            --light-gray: #eeeeee;
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

        .btn-primary {
            background: linear-gradient(135deg, #007E78 0%, #00B3AC 100%);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #005050 0%, #007E78 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #646400 0%, #939c00 100%);
        }

        .btn-secondary:hover {
            background: #646400;
        }

        .accent-border {
            border-color: #00B3AC;
        }

        .form-box {
            background: linear-gradient(135deg, #edfffe 0%, #fefff0 100%);
        }

        .header-gradient {
            background: linear-gradient(90deg, #005858 0%, #00B3AC 100%);
        }

        .select2-selection.select2-selection--single {
            padding: 5px;
            height: 40px;
            border-radius: 0.75rem;
            border-color: #eeeeee;
            border-width: 2px;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #007a77 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #2c2c2c !important;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-6 md:py-8 max-w-6xl">
        <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden mb-6">
            <!-- Header dengan gradient Kemenkes -->
            <div class="header-gradient p-4 md:p-6">
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-4">Survey Perencanaan BOK 2027</h1>
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('usulan.indikator') }}"
                        class="flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                        <span class="mr-2">📋</span>
                        <span>Daftar Indikator</span>
                    </a>
                    <a href="{{ route('usulan.rekap') }}"
                        class="flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white px-4 md:px-6 py-2 rounded-xl transition text-sm md:text-base border border-white border-opacity-30">
                        <span class="mr-2">📊</span>
                        <span>Rekap Survey</span>
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
                        <div class="bg-gradient-to-r from-[#edfffe] to-[#edfffe] border-2 border-[#00B3AC] rounded-xl p-4 mb-4">
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

                @if (session('success'))
                    <div class="border-2 border-[#00B3AC] text-sm px-4 py-3 rounded-xl mb-4" style="background-color: #005c57; color: #eefdfd">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="border-2 border-[#C00000] text-sm px-4 py-3 rounded-xl mb-4" style="background-color: #ffebee; color: #C00000">
                        ✕ {{ session('error') }}
                    </div>
                @endif

                @if (!$respondenId)
                    <!-- Form Data Responden -->
                    <div class="border-2 accent-border rounded-xl p-4 md:p-6 mb-0 bg-gradient-to-r from-[#edfffe] to-[#edfffe] ">
                        <h2 class="text-lg md:text-xl font-semibold mb-4" style="color: #005050">Isi Data Responden Berikut</h2>
                        <form action="{{ route('usulan.storeUser') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Nama *</label>
                                    <input type="text" name="nama" required placeholder="Nama lengkap anda"
                                        class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        style="border-color: #eeeeee; focus:border-color: #00B3AC">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Instansi *</label>
                                    <input type="text" name="instansi" required placeholder="Cth: Dinkes Kota Bogor"
                                        class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm" style="border-color: #eeeeee">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Jabatan *</label>
                                    <input type="text" name="jabatan" required placeholder="Cth: Kabid Yankes"
                                        class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm" style="border-color: #eeeeee">
                                </div>
                            </div>
                            <button type="submit" class="mt-4 w-full btn-primary text-white px-6 py-3 rounded-xl transition font-semibold">
                                SIMPAN
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Form Usulan -->
                    <div class="border-2 accent-border rounded-xl p-4 md:p-6 mb-0 bg-gradient-to-r from-[#edfffe] to-[#edfffe]">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg md:text-xl font-semibold" style="color: #005050">Tambah Usulan</h2>
                            <button type="button" id="buttonExample" class="btn-secondary text-white px-4 py-2 rounded-xl transition font-semibold text-sm">
                                Contoh
                            </button>
                        </div>

                        <form action="{{ route('usulan.store') }}" method="POST" id="usulanForm">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Indikator *</label>
                                    <select name="indikator" required
                                        class="indikator-select w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        style="border-color: #eeeeee">
                                        <option value="">-- Pilih indikator --</option>
                                        @foreach ($indikators as $ind)
                                            <option value="{{ $ind->id }}">{{ $ind->nomor }} - {{ $ind->nama }} ({{ $ind->tingkat }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Level Kegiatan *</label>
                                    <select name="tingkat_bok" required class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        style="border-color: #eeeeee">
                                        <option value="">-- Pilih level kegiatan --</option>
                                        <option value="Provinsi">Provinsi</option>
                                        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                        <option value="Puskesmas">Puskesmas</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Kategori Kegiatan *</label>
                                    <select name="kategori_usulan" required class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        style="border-color: #eeeeee">
                                        <option value="">-- Pilih kegiatan --</option>
                                        @foreach (\App\Models\Usulan::KATEGORI_USULAN as $kategori)
                                            <option value="{{ $kategori }}">{{ $kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Nama Kegiatan *</label>
                                    <textarea name="rincian_menu" required rows="2" class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        placeholder="Rincian menu yang anda usulkan..." maxlength="255" style="border-color: #eeeeee"></textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Detail Kegiatan *</label>
                                    <textarea name="detail_kegiatan" required rows="3" class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        placeholder="Jelaskan kegiatan yang anda usulkan..." style="border-color: #eeeeee"></textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2" style="color: #005050">Sasaran Kegiatan *</label>
                                    <textarea name="sasaran_rincian_menu" required rows="3" class="w-full px-3 py-2 border-2 rounded-xl focus:outline-none text-sm"
                                        placeholder="Rincikan sasaran untuk kegiatan ini..." style="border-color: #eeeeee"></textarea>
                                </div>
                            </div>

                            <button type="submit"
                                class="mt-4 w-full  bg-gradient-to-r from-[#005050] to-[#00B3AC] text-white px-6 py-3 rounded-xl transition font-semibold">
                                Tambah Usulan
                            </button>
                        </form>
                    </div>

                    <!-- Example Modal -->
                    <div id="exampleModal" class="fixed inset-0 z-50 hidden" aria-hidden="true">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div class="relative max-w-3xl mx-auto mt-10 bg-white rounded-2xl shadow-2xl overflow-hidden">
                            <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: #eeeeee">
                                <h3 class="text-lg font-semibold" style="color: #005050">Contoh Isian Usulan</h3>
                                <button type="button" id="closeExample" class="text-sm font-semibold px-3 py-1 rounded-lg" style="color: #C00000; background: #ffebee">Tutup</button>
                            </div>
                            <div class="p-5 bg-gradient-to-r from-[#edfffe] to-[#edfffe]">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1" style="color: #005050">Indikator</label>
                                        <select disabled class="w-full px-3 py-2 border-2 rounded-xl text-sm" style="border-color: #eeeeee">
                                            <option selected>1 - Penguatan Surveilans (Provinsi)</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1" style="color: #005050">Level Kegiatan</label>
                                        <select disabled class="w-full px-3 py-2 border-2 rounded-xl text-sm" style="border-color: #eeeeee">
                                            <option selected>Kabupaten/Kota</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1" style="color: #005050">Kategori Kegiatan</label>
                                        <select disabled class="w-full px-3 py-2 border-2 rounded-xl text-sm" style="border-color: #eeeeee">
                                            <option selected>Pertemuan / Rapat</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1" style="color: #005050">Nama Kegiatan</label>
                                        <textarea readonly rows="2" class="w-full px-3 py-2 border-2 rounded-xl text-sm" style="border-color: #eeeeee">Rapat koordinasi lintas sektor pemantauan penyakit prioritas</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1" style="color: #005050">Detail Kegiatan</label>
                                        <textarea readonly rows="3" class="w-full px-3 py-2 border-2 rounded-xl text-sm" style="border-color: #eeeeee">Pertemuan koordinasi triwulanan melibatkan dinas kesehatan, puskesmas, dan RS rujukan untuk membahas capaian surveilans, analisis gap, serta rencana tindak lanjut.</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1" style="color: #005050">Sasaran Kegiatan</label>
                                        <textarea readonly rows="3" class="w-full px-3 py-2 border-2 rounded-xl text-sm" style="border-color: #eeeeee">Minimal 30 peserta per pertemuan: pengelola surveilans kab/kota, penanggung jawab surveilans puskesmas, RS sentinel, serta lintas program terkait.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Usulan -->
                    @if ($usulanList->count() > 0)
                        <div class="border-2 rounded-xl p-4 md:p-6 bg-white mt-4" style="border-color: #eeeeee">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4">
                                <h2 class="text-lg md:text-xl font-semibold" style="color: #005050">Daftar Usulan Anda ({{ $usulanList->count() }})
                                </h2>
                                <form action="{{ route('usulan.cancel') }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin membatalkan semua usulan?')">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-xl transition text-sm font-medium text-white"
                                        style="background-color: #C00000; hover:background-color: #900000">
                                        ❌ Hapus Semua Usulan
                                    </button>
                                </form>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                                @foreach ($usulanList as $index => $usulan)
                                    <div class="bg-white rounded-lg border p-3" style="border-color: #BFBFBF">
                                        <!-- Header -->
                                        <div class="flex items-start justify-between gap-2 mb-2">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold truncate" style="color: #007E78">{{ $usulan->rincian_menu }}</p>
                                            </div>
                                            <span
                                                class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full flex-shrink-0 {{ $usulan->tingkat_bok == 'Provinsi' ? 'badge-provinsi' : ($usulan->tingkat_bok == 'Kabupaten/Kota' ? 'badge-kabkota' : 'badge-puskesmas') }}">
                                                {{ $usulan->tingkat_bok == 'Kabupaten/Kota' ? 'Kab/Kota' : $usulan->tingkat_bok }}
                                            </span>
                                        </div>

                                        <!-- Details -->
                                        <div class="space-y-1.5 mb-2 text-xs border-t pt-2" style="border-color: #BFBFBF">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium" style="color: #7F7F7F">Kategori Usulan</span>
                                                <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold"
                                                    style="background-color: #edfffe; color: #005050">{{ $usulan->kategori_usulan ?? '-' }}</span>
                                            </div>
                                            <div>
                                                <span class="font-medium" style="color: #7F7F7F">Detail Kegiatan</span><br>
                                                <span style="color: #005050">{{ $usulan->detail_kegiatan }}</span>
                                            </div>
                                            <div>
                                                <span class="font-medium" style="color: #7F7F7F">Sasaran Rincian Menu</span><br>
                                                <span style="color: #005050">{{ $usulan->sasaran_rincian_menu }}</span>
                                            </div>
                                        </div>

                                        <!-- Indikator Badge -->
                                        <div class="p-1 rounded mb-2" style="background-color: #f9fafa;">
                                            <span class="inline-block px-2 py-0.5 text-xs rounded-full">
                                                {{ $usulan->indikator->nomor }} - {{ $usulan->indikator->nama }}
                                            </span>
                                        </div>

                                        <!-- Delete Button -->
                                        <div class="flex justify-end pt-2 border-t" style="border-color: #BFBFBF">
                                            <form action="{{ route('usulan.destroy', $usulan->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus usulan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-1.5 rounded-xl text-xs transition text-white font-medium"
                                                    style="background-color: #C00000">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
                <!-- Footer Info -->
                <div class="text-center text-xs mt-4" style="color: #7F7F7F">
                    Setditjen Kesprimkom © 2025 Kementerian Kesehatan RI
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.indikator-select').select2({
            placeholder: '-- Pilih Indikator --',

            width: '100%',
            allowClear: true,
        });

        const modal = document.getElementById('exampleModal');
        const openBtn = document.getElementById('buttonExample');
        const closeBtn = document.getElementById('closeExample');

        function openModal() {
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        if (openBtn && modal) {
            openBtn.addEventListener('click', openModal);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        modal?.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>

</html>
