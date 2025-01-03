<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Global Transaksi Kasir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            line-height: 1.6;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .header img {
            max-height: 60px;
        }

        .header-info {
            text-align: left;
        }

        .header-info h1 {
            margin: 0;
            font-size: 20px;
            color: #555;
        }

        .header-info p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        table thead th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: #555;
        }

        table tbody td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        .transaction-header {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        .summary {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            color: #555;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        .signature span {
            display: inline-block;
            margin-top: 30px;
            border-top: 1px solid #777;
            width: 200px;
            text-align: center;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="logo-placeholder.png" alt="Logo Toko">
        <div class="header-info">
            <h1>Nama Toko</h1>
            <p>Alamat Toko, Kota</p>
            <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
        </div>
    </div>

    @foreach ($transactionsByDate as $date => $transactions)
        <div class="transaction-header">
            <h2>Tanggal: {{ $date }}</h2>
        </div>

        @foreach ($transactions as $transaction)
            <div class="transaction-header">
                Transaksi: {{ $transaction->no_trans }} | Customer: {{ $transaction->nama_customer }}
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Unit</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ number_format($item->harga, 2) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($item->sub_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary">
                Total Transaksi {{ $transaction->no_trans }}: {{ number_format($transaction->total, 2) }}
            </div>
        @endforeach

        <div class="summary">
            Total Tanggal {{ $date }}: {{ number_format($transactions->sum('total'), 2) }}
        </div>
    @endforeach

    <div class="signature">
        <p>Dicetak oleh Admin</p>
        <span>Tanda Tangan</span>
    </div>
</body>

</html>
