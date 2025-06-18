<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pengeluaran</title>
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
            width: 5%;
        }



        th.nama {
            width: 30%;
        }

        th.invoice {
            width: 25%;
        }


        th.tanggal {
            width: 17%;
        }

        th.sub {
            width: 28%;
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
            <h3>Laporan Pengeluaran : {{ $bulanTahun }}</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th class="invoice">Kategori</th>
                    <th class="nama">Keterangan</th>
                    <th class="tanggal">Tanggal</th>
                    <th class="sub">Sub Total</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($pengeluarans as $key => $pengeluaran)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td>{{ $pengeluaran->kategori->name }}</td>
                        <td>{{ $pengeluaran->keterangan }}</td>
                        <td>{{ $pengeluaran->tanggal }}</td>
                        <td>{{ 'Rp ' . number_format($pengeluaran->harga, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $total += $pengeluaran->harga;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4">
                        <h4 style="text-align: right; margin: 0 10px 0 0;">Total</h4>
                    </td>
                    <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>


    </div>
</body>

</html>
