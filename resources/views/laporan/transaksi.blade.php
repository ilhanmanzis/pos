<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Transaksi</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 25px;
        }

        /* Header perusahaan */
        .header-logo {
            display: flex;
            justify-content: flex-start;
            /* Membuat elemen berada di samping */
            align-items: center;
            /* Menyelaraskan elemen secara vertikal */
            margin-bottom: 20px;
            /* Menambahkan jarak bawah agar lebih rapi */
        }

        .header-logo .logo img {
            width: 1.5in;
            /* Sesuaikan ukuran logo */
            padding-left: 20px;
            /* Memberikan jarak antara logo dan nama perusahaan */
        }

        .navbar {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        .header {
            text-align: center;
        }



        .tabel-total {
            border: none !important;
            width: 40%;
        }

        /* Tabel produk */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Judul total pembayaran */
        h4 {
            margin-bottom: 8px;
        }

        /* Total pembayaran */
        .total-pembayaran {
            display: flex;
            justify-content: space-between;
        }

        .total-pembayaran p {
            margin: 4px 0;
        }

        th.no {
            width: 3%;
        }


        th.kode {
            width: 13%;
        }

        th.nama {
            width: 28%;
        }

        th.invoice {
            width: 22%;
        }


        th.tanggal {
            width: 12%;
        }

        th.sub {
            width: 17%;
        }



        th {
            text-align: center;
        }



        .info {
            margin: 20px 0 10px 10px;
        }
    </style>
</head>

<body>
    <div>
        <div class="header-logo">

            <table style="border: none;">
                <tr style="border: none;">
                    <td style="width: 10%; border: none;">
                        <div class="logo">
                            <img src="{{ $logo }}" alt="">
                        </div>
                    </td>
                    <td style="border: none;">
                        <div class="navbar">
                            <div class="header">
                                <h2>{{ $profile['name'] }}</h2>
                                <p>{{ $profile['alamat'] }}</p>
                                <p>Telp. {{ $profile['no_hp'] }} | Email: {{ $profile['email'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="width: 10%; border: none;"></td>
                </tr>
            </table>


        </div>

        <hr />

        <div class="info">
            <h3>Laporan Transaksi : {{ $bulanTahun }}</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th class="invoice">No Invoice</th>
                    <th class="nama">Nama</th>
                    <th class="tanggal">Tanggal</th>
                    <th class="kode">status</th>
                    <th class="sub">Sub Total</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaksis as $key => $transaksi)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td>{{ $transaksi->kode_faktur }}</td>
                        <td>{{ $transaksi->pelanggan->kode_pelanggan }} -- {{ $transaksi->pelanggan->name }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>{{ 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $total += $transaksi->total_harga;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="5">
                        <h4 style="text-align: right; margin: 0 10px 0 0;">Total</h4>
                    </td>
                    <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>


    </div>
</body>

</html>
