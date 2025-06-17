<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Margin All</title>
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
            <h3>Laporan Margin</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th class="nama">Nama</th>
                    <th class="beli">Harga Beli</th>
                    <th class="jumlah">Jumlah</th>
                    <th class="jual">Total Harga Jual</th>
                    <th class="margin">Margin</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $total = 0;
                    $key = 1;
                @endphp
                @foreach ($data as $produk)
                    <tr>
                        <td style="text-align: center;">{{ $key++ }}</td>
                        <td>{{ $produk['nama'] }}</td>
                        <td>Rp{{ number_format($produk['harga_beli_terakhir'], 0, ',', '.') }}</td>
                        <td>
                            @foreach ($produk['jumlah'] as $satuan => $jumlah)
                                {{ $jumlah }} {{ $satuan }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>Rp{{ number_format($produk['total_harga_jual'], 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($produk['total_margin'], 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $total += $produk['total_margin'];
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
