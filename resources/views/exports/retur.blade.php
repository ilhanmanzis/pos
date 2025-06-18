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
            <th width="20" align="center"><strong>Tanggal</strong></th>
            <th width="30" align="center"><strong>Nama</strong></th>
            <th width="15" align="center"><strong>Kondisi</strong></th>
            <th width="15" align="center"><strong>size</strong></th>
            <th width="25" align="center"><strong>Jumlah</strong></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($returs as $key => $retur)
            @foreach ($retur->details as $index => $detail)
                <tr>
                    @if ($index === 0)
                        <td style="text-align: center;" rowspan="{{ $retur->details->count() }}">
                            {{ $key + 1 }}
                        </td>
                        <td rowspan="{{ $retur->details->count() }}">{{ $retur->tanggal }}</td>
                        <td rowspan="{{ $retur->details->count() }}">
                            {{ $retur->details[0]->produk->name }}
                        </td>
                        <td rowspan="{{ $retur->details->count() }}">{{ $retur->jenis }}</td>
                    @endif
                    <td>{{ $detail->stok->size }}</td>
                    <td>{{ $detail->jumlah_satuan }} {{ $detail->satuan }}</td>
                </tr>
            @endforeach
        @endforeach

    </tbody>
</table>
