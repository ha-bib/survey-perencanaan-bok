<?php

namespace App\Exports;

use App\Models\Usulan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsulanExport implements WithColumnWidths, WithHeadings, WithColumnFormatting, WithProperties, FromQuery, WithChunkReading
{
    use Exportable;

    /**
     * Chunk size for memory-efficient export
     */
    public function chunkSize(): int
    {
        return 500;
    }

    public function query()
    {
        return Usulan::query()
            ->select([
                'usulans.level_kegiatan',
                'usulans.kategori_kegiatan',
                'usulans.nama_kegiatan',
                'usulans.detail_kegiatan',
                'usulans.sasaran_kegiatan',
                'respondens.nama as responden_nama',
                'respondens.instansi as responden_instansi',
                'respondens.jabatan as responden_jabatan',
                'indikators.nomor as indikator_nomor',
                'indikators.tingkat as indikator_tingkat',
                'indikators.nama as indikator_nama',
                'indikators.unit_timker as indikator_unit_timker',
                'indikators.is_RENSTRA',
                'indikators.is_RIBK',
                'indikators.is_RPJMN', 
            ])
            ->join('respondens', 'respondens.id', '=', 'usulans.responden_id')
            ->join('indikators', 'indikators.id', '=', 'usulans.indikator_id')
            ->orderBy('usulans.id');
    }

    public function columnFormats(): array
    {
        return [
            // 'A' => NumberFormat::FORMAT_NUMBER,
            // 'B' => NumberFormat::FORMAT_TEXT,
            // 'C' => NumberFormat::FORMAT_TEXT,
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 25,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 25,
            'G' => 25,
            'H' => 20,
            'I' => 12,
            'J' => 12,
            'K' => 35,
            'L' => 18,
            'M' => 12,
            'N' => 12,
            'O' => 12,
        ];
    }
    public function headings(): array
    { 
        return [
            'Tingkat BOK',
            'Kategori Usulan',
            'Saran Kegiatan',
            'Detail Kegiatan',
            'Keriteria Penerima BOK',
            'Nama Responden',
            'Instansi Responden',
            'Jabatan Responden',
            'Nomor Indikator',
            'Tingkat Indikator',
            'Nama Indikator',
            'Unit Tim Ker',
            'RENSTRA',
            'RIBK',
            'RPJMN',
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Habz Dev',
            'lastModifiedBy' => 'Habz Dev',
            'title'          => 'Usulan Export',
            'description'    => 'Usulan Export',
            'subject'        => 'Usulan',
            'keywords'       => 'Usulan,export,spreadsheet,kemenkes',
            'category'       => 'Usulan',
            'manager'        => 'Habz Dev',
            'company'        => 'Habz Dev',
        ];
    }
}
