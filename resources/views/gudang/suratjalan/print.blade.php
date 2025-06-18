<!DOCTYPE html>
<html>

<head>
    <title>Print Gabungan Surat Jalan</title>
    <style>
        @page {
            size: 9.5in 11in;

        }

        * {
            margin: 2px;
            padding: 0;
        }

        body {
            margin: 10px 0 0 0;
            font-family: Arial, sans-serif;
        }

        .print-page {
            /* width: 9.5in;
            height: 11in; */
            page-break-after: always;
            padding: 0.25in 0.5in;
            box-sizing: border-box;

        }

        table {
            width: 100%;
            border-collapse: collapse;

        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            font-size: 14px;
            text-align: left;
        }

        .header {
            display: flex;
            justify-content: start;
        }

        .logo {
            width: 1in;
        }

        .logo img {
            width: 1in;
            padding-left: 10px;
        }

        .nama-perusahaan {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 100%
        }

        .nama-perusahaan h2,
        .nama-perusahaan p {
            text-align: center;
        }

        .invoice {
            border: none;
            padding: 0 !important;
            margin: 0 !important;
        }

        .invoice table,
        .invoice tr,
        .invoice td {
            border: none !important;
            padding: 0 0 0 0 !important;
            margin: 0 !important;
        }

        .invoice td {
            padding: 0 0 5px 5px !important;
        }

        th.kode {
            width: 10%;
            text-align: center;
        }

        th.qty {
            width: 5%;
            text-align: center;
        }

        th.satuan {
            width: 5%;
            text-align: center;
        }

        th.nama_barang {
            width: 50%;
            text-align: center;
        }

        th.size {
            width: 10%;
            text-align: center;
        }

        th.keterangan {
            width: 20%;
            text-align: center;
        }

        .header-cell {
            vertical-align: top;
        }

        td.td-logo {
            width: 100%;
        }

        td.td-jalan {
            width: 30%;
        }

        .ttd {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .font {
            font-size: 10px;
        }

        .bottom {
            margin-bottom: 0.5in;
        }
    </style>
</head>

<body>

    <div class="print-page">
        <table>
            <thead>
                <tr>
                    <td colspan="4" class="header-cell td-logo">
                        <div class="header">
                            <div class="logo"><img src="{{ asset('storage/logo/' . $profile['logo']) }}" alt="">
                            </div>
                            <div class="nama-perusahaan">
                                <h2>{{ $profile['name'] }}</h2>
                                <p>{{ $profile['alamat'] }}</p>
                                <p>Telp. {{ $profile['no_hp'] }} | email: {{ $profile['email'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td colspan="2" class="td-jalan">
                        <table class="invoice">
                            <tr style="margin: 10px;">
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ $suratJalan->tanggal_pengiriman }}</td>
                            </tr>
                            <tr>
                                <td class="header-cell">Nomor</td>
                                <td class="header-cell">:</td>
                                <td class="header-cell">{{ $suratJalan->nomor }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <h1 style="text-align: center;">Surat Jalan</h1>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <th class="kode">Kode</th>
                    <th class="qty">QTY</th>
                    <th class="satuan">Satuan</th>
                    <th class="nama_barang">Nama Barang</th>
                    <th class="size">Size</th>
                    <th class="keterangan">Keterangan</th>
                </tr>

                @foreach ($produkData as $key => $data)
                    <tr>
                        <td style="text-align: center;">{{ $data['kode'] }}</td>
                        <td style="text-align: center;">{{ $data['qty'] }}</td>
                        <td style="text-align: center;">{{ $data['satuan'] }}</td>
                        <td>{{ $data['produk_name'] }}</td>
                        <td style="text-align: center;">{{ $data['size'] }}</td>
                        <td>Merek {{ $data['merk'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="6"><strong>Invoice</strong></td>
                    {{-- <td style="text-align: center"><strong>Diterima</strong></td> --}}
                </tr>
                @foreach ($invoiceCodes as $index => $kode_faktur)
                    <tr>
                        <td colspan="6">{{ $kode_faktur }}</td>
                        {{-- <td style="text-align: center"></td> --}}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6">
                        <div class="ttd">
                            <div class="font">
                                <br>
                                <br>
                                <div class="bottom"></div>
                                ......................................
                                <h3 style="text-align: center;"><strong>Gudang</strong></h3>
                            </div>
                            <div class="font" style="text-align: center;">
                                <br><br>
                                <div class="bottom"></div>
                                ......................................
                                <h3><strong>Pengirim</strong></h3>
                            </div>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
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
