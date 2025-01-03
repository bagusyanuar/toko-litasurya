<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Global Transaksi Sales</title>
    <style>
        @page {
            margin: 0;
            /* Hilangkan margin pada semua sisi */
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 16px;
            padding: 16px;
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
            background-color: #f5f5f5;
        }

        .transaction-header2 {
            font-size: .8rem;
            margin-top: 20px;
            font-weight: bold;
            color: #555;
        }

        .summary {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            color: #555;
            background-color: #f5f5f5;
        }

        .summary2 {
            margin-top: 20px;
            font-size: 0.8rem;
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
            margin-top: 50px;
            border-top: 1px solid #777;
            width: 200px;
            text-align: center;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="header">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <!-- Logo Kiri -->
                <td width="20%">
                    <img src="assets/images/logo.png" alt="Logo" style="max-height: 80px;">
                </td>
                <!-- Info Toko Kanan -->
                <td width="80%">
                    <div class="header-info">
                        <h1 style="margin: 0; font-size: 24px;">LitaSurya</h1>
                        <p style="margin: 0; font-size: 14px;">Jatisari, Jatisrono, Wonogiri Regency, Central Java
                            57691
                        </p>
                        <p style="margin: 0; font-size: 14px;">0812-4193-9160
                        </p>

                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div>
        <p style="color: #555; margin: 0; font-weight: bold">LAPORAN SALES</p>
        <p style="margin: 0; font-size: 14px; color: #777;">Periode: {{ $startDate }} - {{ $endDate }}</p>
    </div>

    @foreach ($transactionsByDate as $date => $transactions)
        <div class="transaction-header">
            <h4>Tanggal: {{ $date }}</h4>
        </div>


        @foreach ($transactions as $transaction)
            {{-- <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;"> --}}
            <div class="transaction-header2">
                Transaksi: {{ $transaction->no_trans }} | Customer: {{ $transaction->nama_customer }} |
                Status: <span
                    style="font-size:0.8rem;
                    background-color:
                        {{ $transaction->status === 'Pending'
                            ? '#FFD966'
                            : ($transaction->status === 'Batal'
                                ? '#FF9999'
                                : ($transaction->status === 'Selesai'
                                    ? '#C3E6CB'
                                    : 'transparent')) }};
                    padding: 4px 8px;
                    margin: 1px 0;
                    border-radius: 10px;
                    text-align: center;
                ">{{ $transaction->status }}</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Unit</th>
                        <th>Harga</th>
                        <th>Permintaan</th>
                        <th>Realisasi Jumlah</th>
                        <th>Status</th>
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
                            <td>{{ $item->request_qty }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>
                                <div
                                    style="font-size:0.8rem;
                            background-color:
                                {{ $item->status === 'Penyesuaian'
                                    ? '#FFD966'
                                    : ($item->status === 'Stock Kosong'
                                        ? '#FF9999'
                                        : ($item->status === 'OK'
                                            ? '#C3E6CB'
                                            : 'transparent')) }};
                            padding: 1px 4px;
                            margin: 1px 0;
                            border-radius: 10px;
                            text-align: center;
                        ">
                                    {{ $item->status }}
                                </div>
                            </td>
                            <td>{{ number_format($item->sub_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary2">
                Total Transaksi {{ $transaction->no_trans }}: {{ number_format($transaction->total, 2) }}
            </div>
            <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
        @endforeach

        <div class="summary">
            Total Tanggal {{ $date }}: {{ number_format($transactions->sum('total'), 2) }}
        </div>
    @endforeach

    <div class="signature">
        <p>Dicetak oleh Admin</p>
        <span>Nama Admin</span>
    </div>
</body>

</html>
