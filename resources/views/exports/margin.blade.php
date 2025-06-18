<table border="1px" style="border: 1px solid black; border-collapse: collapse;">
    <thead>
        <tr>
            <td align="center" colspan="2" width="20"><img src="{{ $logo }}" alt="" width="130">
            </td>
            <td align="center" colspan="4">
                <strong>{{ $profile['name'] }}</strong>
                <p>{{ $profile['alamat'] }}</p>
                <p>Telp. {{ $profile['no_hp'] }} | Email: {{ $profile['email'] }}</p>
            </td>
        </tr>
        <tr height="20">
            <td colspan="6" width="100">Laporan Margin : {{ $bulanTahun }}</td>
        </tr>
        <tr>
            <th width="5" align="center">No</th>
            <th width="20" align="center">Nama</th>
            <th width="30" align="center">Harga Beli</th>
            <th width="15" align="center">Jumlah</th>
            <th width="15" align="center">Total Harga Beli</th>
            <th width="25" align="center">Margin</th>
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
