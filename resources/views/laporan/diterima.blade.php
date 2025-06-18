<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Retur</title>
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

        .no {
            width: 3%;
        }


        .tanggal {
            width: 15%;
        }

        .nama {
            width: 32%;
        }

        @if ($kondisi === 'pending')

            .kondisi {
                width: 20%;
            }

            .kode {
                width: 15%;
            }
        @else
            .kondisi {
                width: 15%;
            }

            .kode {
                width: 20%;
            }
        @endif


        .jumlah {
            width: 15%;
        }



        th {
            text-align: center;
        }



        .info {
            margin: 20px 0 10px 10px;
        }

        tr td {
            text-align: center;
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
            <h3>Laporan Barang Diterima</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th class="tanggal">Invoice</th>
                    <th class="nama">Pelanggan</th>
                    <th class="kondisi">status</th>
                    <th class="kode">Tanggal</th>
                    <th class="jumlah">Surat Jalan</th>

                </tr>
            </thead>

            <tbody>
                @if ($suratJalans->count() === 0)
                    <tr>
                        <td colspan="6">
                            <h1>Data Kosong</h1>
                        </td>
                    </tr>
                @endif

                @foreach ($suratJalans as $key => $sj)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $sj->kode_faktur }}</td>
                        <td style="text-align: justify;">{{ $sj->transaksi->pelanggan->kode_pelanggan }} --
                            {{ $sj->transaksi->pelanggan->name }}
                        </td>
                        <td>{{ $sj->status === 'pending' ? 'Pending' : 'Diterima' }}</td>
                        <td>{{ $sj->status === 'pending' ? '-' : $sj->updated_at->format('Y-m-d') }} </td>
                        <td>{{ $sj->suratJalan->nomor }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>


    </div>
</body>

</html>
