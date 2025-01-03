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
            font-size: .8rem
        }

        table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        .summary {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            color: #555;
            background-color: #f5f5f5;
            padding: 12px
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
                        <p style="margin: 0; font-size: 14px;">Jatisari, Jatisrono, Wonogiri Regency, Central Java 57691
                        </p>
                        <p style="margin: 0; font-size: 14px;">0812-4193-9160
                        </p>

                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div>
        <p style="color: #555; margin: 0; font-weight: bold">LAPORAN KUNJUNGAN TOKO</p>
        <p style="margin: 0; font-size: 14px; color: #777;">Periode: {{ $startDate }} - {{ $endDate }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Toko</th>
                <th>Nama Sales</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->no }}</td>
                    <td>{{ $attendance->tanggal }}</td>
                    <td>{{ $attendance->nama_customer }}</td>
                    <td>
                        <div
                            style="
                            font-size: 0.8rem;
                            background-color:
                                {{ $attendance->status === 'Pending'
                                    ? '#FFD966'
                                    : ($attendance->status === 'Dilewatkan'
                                        ? '#FF9999'
                                        : ($attendance->status === 'Dikunjungi'
                                            ? '#C3E6CB'
                                            : 'transparent')) }};
                            padding: 4px 8px;
                            margin: 2px 0;
                            border-radius: 10px;
                            text-align: center;
                        ">
                            {{ $attendance->status }}
                        </div>
                    </td>
                    <td>{{ $attendance->nama_sales }}</td>
                </tr>

                <!-- Baris alasan hanya muncul jika alasan tidak kosong -->
                @if (!empty($attendance->alasan))
                    <tr>
                        <td></td>
                        <td colspan="5" style="font-size: 0.8rem; color: #666;">
                            <strong>Alasan:</strong> {{ $attendance->alasan }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        Total Keseluruhan: {{ number_format($totalKeseluruhan, 2) }}
    </div>

    <div class="signature">
        <p>Dicetak oleh Admin</p>
        <span>Nama Admin</span>
    </div>
</body>

</html>
