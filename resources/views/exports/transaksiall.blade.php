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
            <td colspan="6" width="100">Laporan Transaksi</td>
        </tr>
        <tr>
            <th width="5" align="center">No</th>
            <th width="20" align="center">No Invoice</th>
            <th width="30" align="center">Nama</th>
            <th width="15" align="center">Tanggal</th>
            <th width="15" align="center">status</th>
            <th width="25" align="center">Sub Total</th>
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
