<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggan | PDF</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 10px;
        }

        table.header tr td {
            border: none;
        }

        .header td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .header-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .center {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border-bottom: 1px solid #000;
            padding: 5px 4px;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .no-border td {
            border: none;
            padding: 3px 4px;
        }

        .bold {
            font-weight: bold;
        }

        .totals td {
            border-top: 1px solid #000;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
        }

        @page {
            margin: 20px;
        }
    </style>
</head>

<body>
    <h2 class="center">LAPORAN PELANGGAN TERBAIK</h2>
    <br>
    <br>
    <table class="header">
        <tr>
            <td class="header-title">Periode :</td>
            <td>{{ \Carbon\Carbon::parse($dari)->isoFormat('dddd, DD MMMM YYYY') }}</td>
            <td class="header-title">Sampai :</td>
            <td>{{ \Carbon\Carbon::parse($sampai)->isoFormat('dddd, DD MMMM YYYY') }}</td>
        </tr>
    </table>
    <br>
    <!-- Tabel Data Pelanggan -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;" class="center">No.</th>
                <th class="center">Nama Pelanggan</th>
                <th class="center">Email</th>
                <th class="center">Frekuensi Sewa</th>
                <th class="center">Total Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($data as $row)
            <tr>
                <td class="center">{{ $i++ }}</td>
                <td class="center" style="text-transform: capitalize;">{{ $row->user->name }}</td>
                <td class="center">{{ $row->user->email }}</td>
                <td class="center text-center">{{ $row->total_rentals }}x</td>
                <td class="center text-right">Rp {{ number_format($row->total_spent, 0, ',', '.') }}</td>
            </tr>
            @endforeach

            <tr class="totals">
                <td class="center" colspan="4">Total Seluruh Transaksi Pelanggan :</td>
                <td class="center text-right">Rp {{ number_format($data->sum('total_spent'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="footer center">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('dddd, DD MMMM YYYY - HH:mm') }}</p>
    </div>
</body>

</html>
