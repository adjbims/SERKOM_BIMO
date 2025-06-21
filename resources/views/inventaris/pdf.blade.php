<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Inventaris Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .right-align {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Data Inventaris Barang</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->deskrispi ?? '-' }}</td>
                    <td class="right-align">{{ $item->jumlah }}</td>
                    <td class="right-align">
                        @if($item->harga)
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><em>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</em></p>
</body>
</html>
