<?php

namespace Database\Seeders;

use App\Models\Indikator;
use Illuminate\Database\Seeder;

class IndikatorSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nomor' => '1.1', 'tingkat' => 'IKP', 'nama' => 'Persentase Anemia pada Ibu Hamil', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '1.1.1', 'tingkat' => 'IKK', 'nama' => 'Persentase calon pengantin yang mendapat skrining kesehatan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Kes Dewasa Kespro', 'is_display' => true],
            ['nomor' => '1.2', 'tingkat' => 'IKP', 'nama' => 'Cakupan KF lengkap sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '1.2.1', 'tingkat' => 'IKK', 'nama' => 'Persentase Puskesmas mampu pelayanan KB Metode Kontrasepsi Jangka Panjang (MKJP)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Kes Dewasa Kespro', 'is_display' => true],
            ['nomor' => '1.3', 'tingkat' => 'IKP', 'nama' => 'Persentase persalinan di fasilitas pelayanan kesehatan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Matneo', 'is_display' => true],
            ['nomor' => '1.3.1', 'tingkat' => 'IKK', 'nama' => 'Persentase kabupaten/kota dengan Puskesmas PONED sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Matneo', 'is_display' => true],
            ['nomor' => '1.5', 'tingkat' => 'IKK', 'nama' => 'Prevalensi remaja putri anemia', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Usekrem', 'is_display' => true],
            ['nomor' => '1.5.1', 'tingkat' => 'IKK', 'nama' => 'Persentase remaja putri mengonsumsi tablet tambah darah', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Usekrem', 'is_display' => true],
            ['nomor' => '1.6', 'tingkat' => 'IKP', 'nama' => 'Persentase antenatal care (ANC) 6 kali (K6)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Matneo', 'is_display' => true],
            ['nomor' => '1.7.1', 'tingkat' => 'IKK', 'nama' => 'Cakupan ANC sesuai standar (12T)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Matneo', 'is_display' => true],
            ['nomor' => '2.1', 'tingkat' => 'IKP', 'nama' => 'Angka Kematian Neonatal', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '2.1.1', 'tingkat' => 'IKK', 'nama' => 'Cakupan kunjungan neonatal (KN) lengkap sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Matneo', 'is_display' => true],
            ['nomor' => '2.2', 'tingkat' => 'IKP', 'nama' => 'Angka Kematian Bayi', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '2.3', 'tingkat' => 'IKP', 'nama' => 'Persentase bayi lahir prematur (<37 minggu)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Matneo', 'is_display' => true],
            ['nomor' => '3.1', 'tingkat' => 'IKP', 'nama' => 'Prevalensi Wasting (Gizi Kurang dan Gizi Buruk) pada Balita', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '3.1.1', 'tingkat' => 'IKK', 'nama' => 'Persentase balita dipantau pertumbuhan dan perkembangan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Balita', 'is_display' => true],
            ['nomor' => '3.2', 'tingkat' => 'IKP', 'nama' => 'Insiden Stunting Balita (kasus baru)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '3.2.1', 'tingkat' => 'IKK', 'nama' => 'Persentase anak usia 6 - 23 bulan mendapatkan MPASI', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '3.3', 'tingkat' => 'IKP', 'nama' => 'Persentase bayi usia 6 bulan mendapatkan ASI eksklusif', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '3.3.1', 'tingkat' => 'IKK', 'nama' => 'Persentase bayi usia kurang dari 6 bulan mendapat ASI eksklusif', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Gizi', 'is_display' => true],
            ['nomor' => '3.4', 'tingkat' => 'IKP', 'nama' => 'Persentase Ibu hamil Kurang Energi Kronis (KEK)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga', 'is_display' => true],
            ['nomor' => '4.1', 'tingkat' => 'IKP', 'nama' => 'Persentase Lanjut Usia yang Mandiri', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesren', 'is_display' => true],
            ['nomor' => '4.1.1', 'tingkat' => 'IKK', 'nama' => 'Persentase lanjut usia yang mendapatkan skrining kesehatan sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesren/ Lansia', 'is_display' => true],
            ['nomor' => '4.1.2', 'tingkat' => 'IKK', 'nama' => 'Persentase Puskesmas santun lansia', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesren/ Lansia', 'is_display' => true],
            ['nomor' => '4.1.3', 'tingkat' => 'IKK', 'nama' => 'Persentase Lanjut usia dengan ketergantungan sedang, berat, dan total mendapatkan perawatan jangka panjang (PJP)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesren/ Lansia', 'is_display' => true],
            ['nomor' => '4.2', 'tingkat' => 'IKP', 'nama' => 'Persentase pekerja mendapatkan pelayanan kesehatan kerja', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes', 'is_display' => true],
            ['nomor' => '4.2.1', 'tingkat' => 'IKK', 'nama' => 'Persentase fasilitas pelayanan kesehatan melaksanakan pelayanan kesehatan penyakit akibat kerja', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes/ Kesja', 'is_display' => true],
            ['nomor' => '4.2.2', 'tingkat' => 'IKK', 'nama' => 'Persentase tempat kerja formal yang melaksanakan kesehatan kerja', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes/ Kesja', 'is_display' => true],
            ['nomor' => '4.2.3', 'tingkat' => 'IKK', 'nama' => 'Jumlah Pos Upaya Kesehatan Kerja (Pos UKK) yang terbentuk di tempat kerja informal', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes/ Kesja', 'is_display' => true],
            ['nomor' => '5.1', 'tingkat' => 'IKP', 'nama' => 'Persentase kabupaten/kota dengan cakupan Pemeriksaan Kesehatan Gratis >80%', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Takel PKP', 'is_display' => true],
            ['nomor' => '5.1.1', 'tingkat' => 'IKK', 'nama' => 'Persentase penduduk penerima pemeriksaan kesehatan gratis kelompok usia bayi baru lahir', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Skrining BBL', 'is_display' => true],
            ['nomor' => '5.1.2', 'tingkat' => 'IKK', 'nama' => 'Persentase penduduk penerima pemeriksaan kesehatan gratis kelompok usia balita dan anak usia pra sekolah', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/ Balita', 'is_display' => true],
            ['nomor' => '5.1.3', 'tingkat' => 'IKK', 'nama' => 'Persentase penduduk penerima pemeriksaan kesehatan gratis kelompok usia sekolah dan remaja', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesga/', 'is_display' => true],
            ['nomor' => '5.1.5', 'tingkat' => 'IKK', 'nama' => 'Persentase penduduk penerima pemeriksaan kesehatan gratis kelompok usia lanjut', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Kesren/ Lansia', 'is_display' => true],
            ['nomor' => '6.1', 'tingkat' => 'IKP', 'nama' => 'Persentase depresi yang mendapatkan layanan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan', 'is_display' => true],
            ['nomor' => '6.1.1', 'tingkat' => 'IKK', 'nama' => 'Cakupan skrining kesehatan jiwa', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan/ Deteksi dini', 'is_display' => true],
            ['nomor' => '6.2', 'tingkat' => 'IKP', 'nama' => 'Persentase ODGJ berat yang mendapatkan layanan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan', 'is_display' => true],
            ['nomor' => '6.3', 'tingkat' => 'IKP', 'nama' => 'Persentase Perempuan dan Anak Korban Kekerasan Mendapat Pelayanan Kesehatan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan', 'is_display' => true],
            ['nomor' => '6.3.1', 'tingkat' => 'IKK', 'nama' => 'Persentase Puskesmas yang mampu melaksanakan tata laksana Kekerasan terhadap Perempuan dan Anak', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan/ KTPA', 'is_display' => true],
            ['nomor' => '6.4', 'tingkat' => 'IKP', 'nama' => 'Jumlah kabupaten/kota bebas pasung', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan', 'is_display' => true],
            ['nomor' => '6.5', 'tingkat' => 'IKP', 'nama' => 'Persentase orang dengan gangguan penggunaan NAPZA yang mendapatkan layanan rehabilitasi medis di fasyankes IPWL', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Rentan', 'is_display' => true],
            ['nomor' => '6.6', 'tingkat' => 'IKP', 'nama' => 'Jumlah orang yang menjadi first aider Pertolongan Pertama pada Luka Psikologis (P3LP)', 'is_RENSTRA' => true, 'is_RIBK' => false, 'is_RPJMN' => true, 'unit_timker' => '', 'is_display' => true],
            ['nomor' => '10.1', 'tingkat' => 'IKP', 'nama' => 'Persentase Penduduk yang Menerapkan Perilaku Hidup Sehat', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes', 'is_display' => true],
            ['nomor' => '10.1.3', 'tingkat' => 'IKK', 'nama' => 'Persentase kabupaten/kota dengan minimal 75% Posyandu siklus hidup yang aktif', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes/ Posyandu', 'is_display' => true],
            ['nomor' => '11.1', 'tingkat' => 'IKP', 'nama' => 'Persentase kabupaten/kota yang menggerakkan masyarakat melakukan aktivitas fisik sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Promkes', 'is_display' => true],
            ['nomor' => '14.3', 'tingkat' => 'IKP', 'nama' => 'Persentase Puskesmas yang memenuhi standar akses', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut', 'is_display' => true],
            ['nomor' => '14.3.2', 'tingkat' => 'IKK', 'nama' => 'Persentase unit pelayanan kesehatan tingkat desa/kelurahan dengan ketersediaan tenaga kesehatan dan kader kesehatan sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Takel PKP/ UPKD/K', 'is_display' => true],
            ['nomor' => '14.3.3', 'tingkat' => 'IKK', 'nama' => 'Persentase kabupaten/kota yang memiliki unit pelayanan kesehatan tingkat desa/ kelurahan sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut/ Mutu Pusk UPKDK', 'is_display' => true],
            ['nomor' => '14.3.6', 'tingkat' => 'IKK', 'nama' => 'Jumlah kabupaten/kota dengan akses sulit yang menerapkan skema/ pendekatan khusus dalam pemenuhan pelayanan kesehatan berkualitas', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Takel PKP/ DTPK', 'is_display' => true],
            ['nomor' => '14.4', 'tingkat' => 'IKP', 'nama' => 'Persentase laboratorium kesehatan masyarakat tingkat 2-5 yang dikembangkan sesuai standar berdasarkan stratanya', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut', 'is_display' => true],
            ['nomor' => '14.5', 'tingkat' => 'IKP', 'nama' => 'Persentase kabupaten/kota yang memiliki minimal 90 % Puskesmas sesuai standar SPA', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut', 'is_display' => true],
            ['nomor' => '14.5.1', 'tingkat' => 'IKK', 'nama' => 'Persentase Puskesmas memiliki SPA sesuai standar', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut/ SPA PKM', 'is_display' => true],
            ['nomor' => '16.1', 'tingkat' => 'IKP', 'nama' => 'Persentase labkesmas yang terakreditasi', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut', 'is_display' => true],
            ['nomor' => '16.2', 'tingkat' => 'IKP', 'nama' => 'Persentase Puskesmas terakreditasi paripurna', 'is_RENSTRA' => true, 'is_RIBK' => false, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut', 'is_display' => true],
            ['nomor' => '16.2.1', 'tingkat' => 'IKK', 'nama' => 'Persentase Puskesmas yang mencapai target INM (Indikator Nasional Mutu)', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut/ Mutu Pusk & UPK D/K', 'is_display' => true],
            ['nomor' => '16.2.4', 'tingkat' => 'IKK', 'nama' => 'Persentase FKTP yang mengimplementasikan penggunaan antibiotik rasional', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut/ Mutu Pusk & UPK D/K', 'is_display' => true],
            ['nomor' => '16.2.5', 'tingkat' => 'IKK', 'nama' => 'Persentase Puskesmas yang ramah penyandang disabilitas', 'is_RENSTRA' => true, 'is_RIBK' => false, 'is_RPJMN' => true, 'unit_timker' => 'Rentan/ Disabilitas', 'is_display' => true],
            ['nomor' => '17.1', 'tingkat' => 'IKP', 'nama' => 'Tingkat kepuasan pasien di fasilitas pelayanan kesehatan primer', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Fasmut', 'is_display' => true],
            ['nomor' => '33.1', 'tingkat' => 'IKP', 'nama' => 'Indeks Kepuasan Pengguna Layanan Kemenkes', 'is_RENSTRA' => true, 'is_RIBK' => false, 'is_RPJMN' => true, 'unit_timker' => 'Setjen', 'is_display' => true],
            ['nomor' => '33.2', 'tingkat' => 'IKP', 'nama' => 'Nilai Kinerja Anggaran Kementerian Kesehatan', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Setjen', 'is_display' => true],
            ['nomor' => '33.3', 'tingkat' => 'IKP', 'nama' => 'Indeks Penerapan Sistem Merit Kemenkes', 'is_RENSTRA' => true, 'is_RIBK' => true, 'is_RPJMN' => true, 'unit_timker' => 'Setjen', 'is_display' => true],
            ['nomor' => '33.4', 'tingkat' => 'IKP', 'nama' => 'Nilai Maturitas SPIPT', 'is_RENSTRA' => true, 'is_RIBK' => false, 'is_RPJMN' => true, 'unit_timker' => 'Itjen', 'is_display' => true],
        ];

        foreach ($data as $item) {
            Indikator::create($item);
        }
    }
}