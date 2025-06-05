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
            <td colspan="6" width="100">Laporan Pengeluaran : {{ $bulanTahun }}</td>
        </tr>
        <tr>
            <th width="5" align="center">No</th>
            <th width="15" align="center">Kategori</th>
            <th width="30" align="center">Keterangan</th>
            <th width="15" align="center">Tanggal</th>
            <th width="25" align="center">Sub Total</th>
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
            <td colspan="4" align="right">
                <h4 style="text-align: right; margin: 0 10px 0 0;">Total</h4>
            </td>
            <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
