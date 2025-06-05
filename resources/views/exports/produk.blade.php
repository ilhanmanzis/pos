 <table>
     <thead>
         <tr>

             <td align="right" colspan="3" width="20">
                 <img src="{{ public_path('storage/logo/' . $profile['logo']) }}" alt="" width="130">
             </td>
             <td align="center" colspan="4">
                 <strong>{{ $profile['name'] }}</strong>
                 <p>{{ $profile['alamat'] }}</p>
                 <p>Telp. {{ $profile['no_hp'] }} | Email: {{ $profile['email'] }}</p>
             </td>
         </tr>

         <tr height="30">
             <td colspan="7" align="center">
                 <strong>Price List {{ $category->name }}</strong>
             </td>
         </tr>
     </thead>
     @foreach ($products as $product)
         <thead>
             <tr>
                 <td colspan="7" align="center"><strong>{{ $product->name }} -- {{ $product->kode }}</strong></td>
             </tr>
             <tr>
                 <th align="center" width="5"><strong>No</strong></th>
                 <th align="center" width="10"><strong>Size</strong></th>
                 <th align="center" width="10"><strong>Merek</strong></th>
                 <th align="center" width="10"><strong>Satuan</strong></th>
                 <th align="center" width="15"><strong>Harga</strong></th>
                 <th align="center" width="30"><strong>Keterangan</strong></th>
                 <th align="center" width="20"><strong>Gambar</strong></th>
             </tr>
         </thead>
         <tbody>
             @foreach ($product->stoks as $index => $stok)
                 <tr>
                     <td align="center">{{ $index + 1 }}</td>
                     <td align="center">{{ $stok->size }}</td>
                     <td align="center">{{ $product->merk }}</td>
                     <td align="center">{{ $product->satuan }}</td>

                     <td align="center"></td>
                     @if ($index === 0)
                         <td rowspan="{{ $product->stoks->count() }}" style="text-align: justify;">
                             {{ $product->keterangan }}</td>
                         <!-- Pastikan satuan hanya tampil sekali pada baris pertama -->
                         <td align="center" rowspan="{{ $product->stoks->count() }}" style="vertical-align: middle;">
                             <img src="{{ public_path('storage/produk/' . $product['foto']) ?? '' }}" width="80px">
                         </td>
                     @endif

                 </tr>
             @endforeach
         </tbody>
     @endforeach
 </table>
