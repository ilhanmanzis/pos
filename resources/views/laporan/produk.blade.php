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

        /* Memaksa halaman baru setelah setiap kategori */
        .page-break {
            page-break-before: always;
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





        th {
            text-align: center;
        }



        .info {
            margin: 20px 0 10px 10px;
        }

        .category {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
        }

        thead {
            margin: 0;
        }

        tbody {
            margin: 0;
        }

        .no {
            width: 3%;
        }

        .size {
            width: 15%;
        }

        .merk {
            width: 10%;
        }

        .keterangan {
            width: 27%;
        }

        .satuan {
            width: 5%;
        }

        .harga {
            width: 20%;
        }

        .gambar {
            width: 20%;
        }

        tbody td {
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
                            <img src="{{ public_path('storage/logo/' . $profile['logo']) }}" alt="">
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

        @foreach ($kategoris as $index => $category)
            <!-- Menambahkan page-break jika ini bukan kategori pertama -->
            @if ($index > 0)
                <div class="page-break"></div>
            @endif

            <!-- Kategori Produk (Berbeda tiap halaman) -->
            <div class="category">
                <h2>Price List{{ $category->name }}</h2>
            </div>

            <!-- List Produk Berdasarkan Kategori -->
            <div class="product-list">
                <table>
                    @foreach ($category->produks as $product)
                        <thead>
                            <tr>
                                <th colspan="7">{{ $product->name }} -- {{ $product->kode }}</th>
                            </tr>
                            <tr>
                                <th class="no">No</th>
                                <th class="size">size</th>
                                <th class="merk">Merk</th>
                                <th class="satuan">Satuan</th>
                                <th class="harga">Harga</th>
                                <th class="keterangan">Keterangan</th>
                                <th class="gambar">Gambar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Menampilkan gambar per produk dengan rowspan sebanyak jumlah stok -->


                            <!-- Looping untuk stok -->
                            @foreach ($product->stoks as $index => $stok)
                                <tr>
                                    <td>{{ $index + 1 }}</td> <!-- Nomor urut berdasarkan stok -->
                                    <td>{{ $stok->size }}</td> <!-- Menampilkan size -->
                                    <td>{{ $product->merk }}</td> <!-- Menampilkan merk -->
                                    <!-- Menampilkan keterangan -->
                                    <td>{{ $product->satuan }}</td> <!-- Menampilkan keterangan -->
                                    <td></td>
                                    <!-- Menampilkan harga dengan format angka -->

                                    <!-- Kolom satuan dipindahkan ke kanan -->
                                    @if ($index === 0)
                                        <td rowspan="{{ $product->stoks->count() }}" style="text-align: justify;">
                                            {{ $product->keterangan }}</td>
                                        <!-- Pastikan satuan hanya tampil sekali pada baris pertama -->
                                        <td rowspan="{{ $product->stoks->count() }}" style="vertical-align: middle;">
                                            <img src="{{ public_path('storage/produk/' . $product['foto']) ?? '' }}"
                                                width="80px">
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    @endforeach
                </table>
            </div>
        @endforeach

        <div class="info">
            <h3>Laporan Transaksi</h3>
        </div>




    </div>
</body>

</html>
