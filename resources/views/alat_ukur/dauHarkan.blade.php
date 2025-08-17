<!DOCTYPE html>
<html>
<head>
    <title>Data Alat Ukur Harkan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold mb-4">Data Alat Ukur Harkan</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kodefikasi</th>
                    <th class="px-4 py-2 border">Nama Alat</th>
                    <th class="px-4 py-2 border">Merk / Type</th>
                    <th class="px-4 py-2 border">No. Seri</th>
                    <th class="px-4 py-2 border">Range</th>
                    <th class="px-4 py-2 border">Tgl Kalibrasi</th>
                    <th class="px-4 py-2 border">Kalibrasi Berikutnya</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $row->id }}</td>
                    <td class="px-4 py-2 border">{{ $row->kodefikasi }}</td>
                    <td class="px-4 py-2 border">{{ $row->nama_alat }}</td>
                    <td class="px-4 py-2 border">{{ $row->merk_type }}</td>
                    <td class="px-4 py-2 border">{{ $row->no_seri }}</td>
                    <td class="px-4 py-2 border">{{ $row->range_alat }}</td>
                    <td class="px-4 py-2 border">{{ $row->tgl_kalibrasi }}</td>
                    <td class="px-4 py-2 border">{{ $row->kalibrasi_selanjutnya }}</td>
                    <td class="px-4 py-2 border">{{ $row->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $data->links() }}
    </div>

</body>
</html>
