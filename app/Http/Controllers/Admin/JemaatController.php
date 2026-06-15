<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Wilayah;
use Faker\Core\Coordinates;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class JemaatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Jemaat::with('wilayah');

        if (!empty($search)) {
            $query->where('nama_jemaat', 'LIKE', '%' . $search . '%');
        }

        $jemaat = $query->orderBy('nama_jemaat', 'asc')->paginate(10);

        return view('admin.jemaat.index', compact('jemaat'));
    }

    public function show(Jemaat $jemaat)
    {
        $jemaat->load('wilayah');
        return view('admin.jemaat.show', compact('jemaat'));
    }

    public function create()
    {
        $wilayah = Wilayah::orderBy('nama_wilayah')->get();
        return view('admin.jemaat.create', compact('wilayah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jemaat'      => 'required|string|max:100',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'id_wilayah'       => 'required|exists:wilayah,id_wilayah',
            'no_hp'            => 'nullable|string|max:15',
            'status_jemaat'    => 'required|in:aktif,tidak_aktif,pindah,meninggal',
            'status_pernikahan' => 'required|in:belum_menikah,menikah,duda,janda',
        ]);
        Jemaat::create($request->all());
        return redirect()->route('admin.jemaat.index')->with('success', 'Data jemaat ditambahkan.');
    }

    public function edit(Jemaat $jemaat)
    {
        $wilayah = Wilayah::orderBy('nama_wilayah')->get();
        return view('admin.jemaat.edit', compact('jemaat', 'wilayah'));
    }

    public function update(Request $request, Jemaat $jemaat)
    {
        $request->validate([
            'nama_jemaat'      => 'required|string|max:100',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'id_wilayah'       => 'required|exists:wilayah,id_wilayah',
            'no_hp'            => 'nullable|string|max:15',
            'status_jemaat'    => 'required|in:aktif,tidak_aktif,pindah,meninggal',
            'status_pernikahan' => 'required|in:belum_menikah,menikah,duda,janda',
        ]);
        $jemaat->update($request->all());
        return redirect()->route('admin.jemaat.index')->with('success', 'Data jemaat diperbarui.');
    }

    public function destroy(Jemaat $jemaat)
    {
        $jemaat->delete();
        return redirect()->route('admin.jemaat.index')->with('success', 'Data jemaat dihapus.');
    }

    /**
     * Export data jemaat ke Excel sesuai format "Data Statistik Jemaat".
     * Setiap Lingkungan/Wilayah akan dibuat dalam sheet terpisah.
     */
    public function exportExcel(Request $request)
    {
        $wilayahId = $request->input('wilayah_id');

        $query = Jemaat::with('wilayah')->orderBy('id_wilayah')->orderBy('nama_jemaat');

        if (!empty($wilayahId)) {
            $query->where('id_wilayah', $wilayahId);
        }

        $grouped = $query->get()->groupBy(function ($item) {
            return $item->wilayah->nama_wilayah ?? 'Tanpa Wilayah';
        });

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        $sheetIndex = 0;
        foreach ($grouped as $wilayahName => $jemaats) {
            $sheet = $spreadsheet->createSheet($sheetIndex);

            $safeName = preg_replace('/[\\\\\/\?\*\[\]:]/', '', $wilayahName);
            $sheet->setTitle(mb_substr($safeName !== '' ? $safeName : 'Wilayah', 0, 31));

            $this->buildSheetHeader($sheet, $wilayahName);
            $this->fillSheetData($sheet, $jemaats);

            $sheetIndex++;
        }

        if ($sheetIndex === 0) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Data Jemaat');
            $this->buildSheetHeader($sheet, 'Semua Wilayah');
        }

        $spreadsheet->setActiveSheetIndex(0);

        $filename = 'data-statistik-jemaat-' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Membangun header sheet (judul + tabel header) sesuai template.
     */
    private function buildSheetHeader($sheet, string $wilayahName): void
    {
        // Judul
        $sheet->mergeCells('A1:AI1');
        $sheet->setCellValue('A1', 'DATA STATISTIK JEMAAT');

        $sheet->mergeCells('A2:AI2');
        $sheet->setCellValue('A2', 'GEREJA KRISTEN SUMBA JEMAAT KANATANG');

        $sheet->mergeCells('A3:AI3');
        $sheet->setCellValue('A3', 'LINGKUNGAN ' . mb_strtoupper($wilayahName));

        foreach (['A1', 'A2', 'A3'] as $cell) {
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Header tabel baris 6-8
        $sheet->mergeCells('A6:A8'); $sheet->setCellValue('A6', 'NO. Urut KK');
        $sheet->mergeCells('B6:B8'); $sheet->setCellValue('B6', 'NO. Urut');
        $sheet->mergeCells('C6:C8'); $sheet->setCellValue('C6', 'Nama');
        $sheet->mergeCells('D6:E8'); $sheet->setCellValue('D6', 'Tempat Tgl. Lahir');

        $sheet->mergeCells('F6:K6'); $sheet->setCellValue('F6', 'Tempat/Tgl. Baptis, Sidi dan Nikah');
        $sheet->mergeCells('F7:G8'); $sheet->setCellValue('F7', 'Baptis');
        $sheet->mergeCells('H7:I8'); $sheet->setCellValue('H7', 'Sidi');
        $sheet->mergeCells('J7:K8'); $sheet->setCellValue('J7', 'Nikah');

        $sheet->mergeCells('L6:T6'); $sheet->setCellValue('L6', 'Pekerjaan');
        $pekerjaanCols = [
            'L' => 'Petani', 'M' => 'Nelayan', 'N' => 'Tukang', 'O' => 'Buruh',
            'P' => 'PNS', 'Q' => 'PTT', 'R' => 'Swasta', 'S' => 'TNI/POLRI', 'T' => 'PENSION',
        ];
        foreach ($pekerjaanCols as $col => $label) {
            $sheet->mergeCells("{$col}7:{$col}8");
            $sheet->setCellValue("{$col}7", $label);
        }

        $sheet->mergeCells('U6:AB6'); $sheet->setCellValue('U6', 'Status Dalam Jemaat');
        $sheet->mergeCells('U7:V7'); $sheet->setCellValue('U7', 'Sidi');
        $sheet->mergeCells('W7:X7'); $sheet->setCellValue('W7', 'Baptis');
        $sheet->mergeCells('Y7:Z7'); $sheet->setCellValue('Y7', 'Belum Baptis');
        $sheet->mergeCells('AA7:AB7'); $sheet->setCellValue('AA7', 'Simpatisan');

        $sheet->setCellValue('U8', 'L'); $sheet->setCellValue('V8', 'P');
        $sheet->setCellValue('W8', 'L'); $sheet->setCellValue('X8', 'P');
        $sheet->setCellValue('Y8', 'L'); $sheet->setCellValue('Z8', 'P');
        $sheet->setCellValue('AA8', 'L'); $sheet->setCellValue('AB8', 'P');

        $sheet->mergeCells('AC6:AC8'); $sheet->setCellValue('AC6', 'Hub. Kel');

        $sheet->mergeCells('AD6:AH6'); $sheet->setCellValue('AD6', 'Pendidikan Terakhir');
        $pendidikanCols = ['AD' => 'SD', 'AE' => 'SMP', 'AF' => 'SMA', 'AG' => 'AMD', 'AH' => 'S1/S2'];
        foreach ($pendidikanCols as $col => $label) {
            $sheet->mergeCells("{$col}7:{$col}8");
            $sheet->setCellValue("{$col}7", $label);
        }

        $sheet->mergeCells('AI6:AI8'); $sheet->setCellValue('AI6', 'Keterangan');

        // Styling header
        $headerRange = 'A6:AI8';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->setSize(9);
        $sheet->getStyle($headerRange)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);
        $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('D9E1D3');

        // Lebar kolom
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(8);
        $sheet->getColumnDimension('C')->setWidth(28);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(12);

        for ($i = Coordinate::columnIndexFromString('F'); $i <= Coordinate::columnIndexFromString('AB'); $i++) {
            $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($i))->setWidth(7);
        }

        $sheet->getColumnDimension('AC')->setWidth(10);

        for ($i = Coordinate::columnIndexFromString('AD'); $i <= Coordinate::columnIndexFromString('AH'); $i++) {
            $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($i))->setWidth(6);
        }

        $sheet->getColumnDimension('AI')->setWidth(22);
    }

    /**
     * Mengisi baris data jemaat ke sheet sesuai struktur kolom template.
     */
    private function fillSheetData($sheet, $jemaats): void
    {
        $row = 9;
        $noUrut = 0;
        $noKK = 0;

        // Mapping pekerjaan -> kolom
        $pekerjaanMap = [
            'petani'    => 'L',
            'nelayan'   => 'M',
            'tukang'    => 'N',
            'buruh'     => 'O',
            'pns'       => 'P',
            'pt'        => 'Q', // PTT
            'swasta'    => 'R',
            'tni_polri' => 'S',
            'pensiun'   => 'T',
        ];

        // Mapping status_dalam_jemaat + jenis_kelamin -> kolom
        $statusMap = [
            'sidi'         => ['L' => 'U', 'P' => 'V'],
            'baptis'       => ['L' => 'W', 'P' => 'X'],
            'belum_baptis' => ['L' => 'Y', 'P' => 'Z'],
            'simpatisan'   => ['L' => 'AA', 'P' => 'AB'],
        ];

        // Mapping pendidikan_terakhir -> kolom
        $pendidikanMap = [
            'SD'  => 'AD',
            'SMP' => 'AE',
            'SMA' => 'AF',
            'D3'  => 'AG',
            'S1'  => 'AH',
            'S2'  => 'AH',
        ];

        foreach ($jemaats as $j) {
            $noUrut++;

            // Tandai NO. Urut KK hanya pada baris kepala keluarga
            $hub = mb_strtoupper(trim((string) $j->hubungan_keluarga));
            if ($hub === 'KK') {
                $noKK++;
                $sheet->setCellValue("A{$row}", $noKK);
            }

            $sheet->setCellValue("B{$row}", $noUrut);
            $sheet->setCellValue("C{$row}", $j->nama_jemaat);

            // Tempat / Tgl Lahir
            $sheet->setCellValue("D{$row}", $j->tempat_lahir);
            if ($j->tanggal_lahir) {
                $sheet->setCellValue("E{$row}", $j->tanggal_lahir->format('d-m-Y'));
            }

            // Baptis
            $sheet->setCellValue("F{$row}", $j->tempat_baptis);
            if ($j->tanggal_baptis) {
                $sheet->setCellValue("G{$row}", $j->tanggal_baptis->format('d-m-Y'));
            }

            // Sidi
            $sheet->setCellValue("H{$row}", $j->tempat_sidi);
            if ($j->tanggal_sidi) {
                $sheet->setCellValue("I{$row}", $j->tanggal_sidi->format('d-m-Y'));
            }

            // Nikah
            $sheet->setCellValue("J{$row}", $j->tempat_nikah);
            if ($j->tanggal_nikah) {
                $sheet->setCellValue("K{$row}", $j->tanggal_nikah->format('d-m-Y'));
            }

            // Pekerjaan (tandai 1)
            if (!empty($j->pekerjaan) && isset($pekerjaanMap[$j->pekerjaan])) {
                $col = $pekerjaanMap[$j->pekerjaan];
                $sheet->setCellValue("{$col}{$row}", 1);
            }

            // Status Dalam Jemaat (tandai 1 sesuai jenis kelamin L/P)
            $jk = ($j->jenis_kelamin === 'P') ? 'P' : 'L';
            if (!empty($j->status_dalam_jemaat) && isset($statusMap[$j->status_dalam_jemaat])) {
                $col = $statusMap[$j->status_dalam_jemaat][$jk];
                $sheet->setCellValue("{$col}{$row}", 1);
            }

            // Hub. Keluarga
            $sheet->setCellValue("AC{$row}", $j->hubungan_keluarga);

            // Pendidikan Terakhir (tandai 1)
            if (!empty($j->pendidikan_terakhir) && isset($pendidikanMap[$j->pendidikan_terakhir])) {
                $col = $pendidikanMap[$j->pendidikan_terakhir];
                $sheet->setCellValue("{$col}{$row}", 1);
            }

            // Keterangan (tambahkan info pekerjaan "lainnya" jika ada)
            $keterangan = (string) $j->keterangan;
            if ($j->pekerjaan === 'lainnya') {
                $keterangan = trim('Pekerjaan: Lainnya. ' . $keterangan);
            }
            $sheet->setCellValue("AI{$row}", $keterangan);

            $row++;
        }

        $lastRow = $row - 1;
        if ($lastRow >= 9) {
            $dataRange = "A9:AI{$lastRow}";
            $sheet->getStyle($dataRange)->getFont()->setSize(9);
            $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle($dataRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("A9:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("L9:AB{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("AD9:AH{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
    }
}
