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
            <td colspan="6" width="100" align="center"><strong>Laporan Retur</strong></td>
        </tr>
        <tr>
            <th width="5" align="center"><strong>No</strong></th>
            <th width="20" align="center"><strong>Invoice</strong></th>
            <th width="30" align="center"><strong>Pelanggan</strong></th>
            <th width="15" align="center"><strong>status</strong></th>
            <th width="15" align="center"><strong>Tanggal</strong></th>
            <th width="25" align="center"><strong>Surat Jalan</strong></th>
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
