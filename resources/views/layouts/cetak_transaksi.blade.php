 <!-- Penerapan template untuk halaman Cetak Transaksi @ web app CuciYuk -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Transaksi #{{ $transaksi->id_transaksi }}</title>
    <style>
        body {
            color: #222;
            font-family: Arial, sans-serif;
            margin: 2rem auto;
            max-width: 640px;
            padding: 0 1.5rem;
        }

        h1,
        p {
            margin-bottom: 0.5rem;
        }

        .header,
        .actions {
            text-align: center;
        }

        .details {
            border-collapse: collapse;
            margin: 1.5rem 0;
            width: 100%;
        }

        .details th,
        .details td {
            border-bottom: 1px solid #ddd;
            padding: 0.75rem 0;
            text-align: left;
        }

        .details th {
            width: 40%;
        }

        .actions button {
            cursor: pointer;
            margin: 0.25rem;
            padding: 0.6rem 1rem;
        }

        @media print {
            body {
                margin: 0;
                max-width: none;
                padding: 0;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>CuciYuk</h1>
        <p>Bukti Transaksi</p>
    </header>

    <table class="details">
        <tbody>
            <tr>
                <th>ID Transaksi</th>
                <td>{{ $transaksi->id_transaksi }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $transaksi->tanggal }}</td>
            </tr>
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $transaksi->nama_pelanggan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Jasa</th>
                <td>{{ $transaksi->nama_jasa ?? 'Jasa tidak ditemukan' }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ $transaksi->jumlah_kg }} kg</td>
            </tr>
            <tr>
                <th>Harga per kg</th>
                <td>Rp. {{ number_format($transaksi->harga_satuan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>Rp. {{ number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>{{ $transaksi->status_pembayaran }}</td>
            </tr>
        </tbody>
    </table>

     <footer>&copy;2026 Dikembangkan oleh Scientia Hashina</footer>

    <div class="actions">
        <button type="button" onclick="window.print()">Cetak</button>
        <button type="button" onclick="window.close()">Tutup</button>
    </div>
</body>

</html>
