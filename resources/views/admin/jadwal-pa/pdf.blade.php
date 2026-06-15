<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jadwal PA - {{ $wilayahName }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 4px 0 0; color: #666; }
        .info { margin-bottom: 15px; padding: 10px; background: #f5f5f5; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 11px; }
        th { background: #143222; color: white; }
        .empty { text-align: center; padding: 30px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Jadwal Pelayanan PA</h1>
        <p>Lingkungan/Wilayah: {{ $wilayahName }}</p>
    </div>

    <div class="info">
        Total data: {{ $jadwal->count() }}
    </div>

    @if($jadwal->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Penerima PA</th>
                    <th>Pelayan</th>
                    <th>Pendamping</th>
                    <th>Wilayah</th>
                    <th>Ayat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $j)
                    <tr>
                        <td>{{ $j->waktu->format('d M Y H:i') }}</td>
                        <td>{{ $j->nama_penerima_pa }}</td>
                        <td>{{ $j->pelayan->nama_pelayan }}</td>
                        <td>{{ $j->pendamping->nama_pelayan }}</td>
                        <td>{{ $j->wilayah->nama_wilayah }}</td>
                        <td>{{ $j->ayat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty">Tidak ada data jadwal untuk wilayah ini.</div>
    @endif
</body>
</html>
