<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice</title>
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
        .navbar {
            display: flex;
            margin-left: 40px;
            justify-content: center;
            margin-bottom: 10px;
        }

        .header {
            text-align: center;
        }

        /* Info pelanggan dan invoice */
        .info table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        /* Hilangkan border seluruh tabel .info */
        .info table,
        .info th,
        .info td {
            border: none !important;
        }

        .info td.kepada {
            width: 60%;
            vertical-align: top;
            padding-right: 20px;
        }

        .info td.invoice {
            width: 40%;
            vertical-align: top;
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

        th.nama {
            width: 37%;
        }

        th.size {
            width: 10%;
        }

        th.satuan {
            width: 5%;
        }

        th.harga {
            width: 15%;
        }

        th.qty {
            width: 10%;
        }

        th.subtotal {
            width: 20%;
        }

        th {
            text-align: center;
        }

        .header-logo {
            width: 80%;
            margin: auto;
            display: flex;
            justify-content: start;
        }

        .logo img {
            padding-top: 5px;
            width: 1.5in;
        }

        .tabel-pelanggan {
            width: 100%;
            border: none;
            margin: 0;
            padding: 0;
        }

        .tabel-pelanggan tr,
        .tabel-pelanggan tr td {
            border: none;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div>
        <div class="header-logo">
            <div class="logo">
                <img src="{{ asset('storage/logo/' . $profile['logo']) }}" alt="" style="width: 1in;">
            </div>
            <div class="navbar">
                <div class="header">
                    <h2>{{ $profile['name'] }}</h2>
                    <p>{{ $profile['alamat'] }}</p>
                    <p>Telp. {{ $profile['no_hp'] }} | Email: {{ $profile['email'] }}</p>
                </div>
            </div>
        </div>

        <hr />

        <div class="info">
            <table>
                <tr>
                    <td class="kepada">
                        <h4>Pelanggan</h4>
                        <table class="tabel-pelanggan">
                            <tr>
                                <td style="width: 13%;">Nama</td>
                                <td style="width: 3%;">:</td>
                                <td>
                                    <p>{{ $transaksi->pelanggan->name }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>:</td>
                                <td>
                                    <p>{{ $transaksi->pelanggan->no_hp }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <p>{{ $transaksi->pelanggan->email }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">Alamat</td>
                                <td style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;">
                                    <p>
                                        {{ $transaksi->pelanggan->alamat }},
                                        {{ $transaksi->pelanggan->desa }},
                                        {{ $transaksi->pelanggan->kecamatan }},
                                        {{ $transaksi->pelanggan->kabupaten }},
                                        {{ $transaksi->pelanggan->provinsi }}
                                    </p>
                                </td>
                            </tr>
                        </table>




                    </td>
                    <td class="invoice">
                        <h4>Invoice</h4>
                        <p>{{ $transaksi->kode_faktur }}</p>
                        <h4 style="margin-top: 10px;">Tanggal</h4>
                        <p>{{ $transaksi->tanggal }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th class="nama">Nama</th>
                    <th class="size">Size</th>
                    <th class="satuan">Satuan</th>
                    <th class="harga">Harga</th>
                    <th class="qty">Qty</th>
                    <th class="subtotal">Sub Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transaksi->detail as $key => $item)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td>{{ $item->stok->produk->name }}</td>
                        <td style="text-align: center;">{{ $item->stok->size }}</td>
                        <td style="text-align: center;">{{ $item->satuan }}</td>
                        <td>{{ 'Rp ' . number_format($item->harga_jual, 0, ',', '.') }}
                        </td>
                        <td style="text-align: center;">{{ $item->qty }}</td>
                        <td>{{ 'Rp ' . number_format($item->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                @php
                    $total = 0;
                    foreach ($transaksi->detail as $item) {
                        $total += $item->sub_total;
                    }
                    $ppn = $profile->ppn ?? 0;
                    $pajak = ($total * $ppn) / 100;
                    $total_in_ppn = $total + $pajak;
                @endphp
                <tr>
                    <td colspan="6">
                        <h4 style="text-align: right; margin: 0 10px 0 0;">Total</h4>
                    </td>
                    <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-pembayaran">
            <div style="margin-left: 20px">
                <ol>
                    <li>
                        <p>Harga sudah termasuk ppn</p>
                    </li>
                    <li>
                        <p>Faktur asli sebagai bukti pembayaran yang sah</p>
                    </li>
                    <li>
                        <p>Transfer hanya ke rekening atas nama perusahaan</p>
                    </li>
                </ol>

            </div>
            <table class="tabel-total">
                <tr>
                    <td colspan="2">
                        <h4 style="margin-bottom: 0;">Total Pembayaran</h4>
                    </td>
                </tr>
                <tr>
                    <td>Pajak (PPN @ {{ $ppn }}%)</td>
                    <td>{{ 'Rp ' . number_format($pajak, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total In PPN</strong></td>
                    <td><strong>{{ 'Rp ' . number_format($total_in_ppn, 0, ',', '.') }}</strong></td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        // Fungsi untuk otomatis membuka print dialog saat halaman dimuat
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.close(); // Menutup jendela setelah print selesai
            };
        };
    </script>
</body>

</html>
