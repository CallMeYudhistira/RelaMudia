<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan | PDF</title>
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
    <h2 class="center">LAPORAN PENJUALAN</h2>
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
    <!-- Tabel Data Penjualan -->
    <table>
        <thead>
            <tr>
                <th style="width: 10%;" class="center">No.</th>
                <th class="center" style="width: 18%;">Tanggal</th>
                <th class="center">Pelanggan</th>
                <th class="center">Status</th>
                <th class="center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td class="center">#RENT-{{ $row->id }}</td>
                <td class="center">{{ $row->created_at->isoFormat('DD-MMM-YYYY') }}</td>
                <td class="center" style="text-transform: capitalize;">{{ $row->user->name }}</td>
                <td class="center" style="text-transform: capitalize;">{{ $row->status }}</td>
                <td class="text-right">Rp {{ number_format($row->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach

            <tr class="totals">
                <td class="center" colspan="4">Total Pendapatan :</td>
                <td class="text-right">Rp {{ number_format($data->sum('total_price'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="footer center">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->locale(config('app.locale', 'id'))->isoFormat('dddd, DD MMMM YYYY - HH:mm') }}</p>
    </div>
</body>

</html>
