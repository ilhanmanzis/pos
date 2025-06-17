<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Data Transaksi` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90"></h2>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <div
            class="mx-5
                    rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Transaksi
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800">

                <div class="grid grid-cols-2 gap-6 sm:grid-cols-4 my-5">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama</label>
                        <input type="text" value="{{ $transaksi->pelanggan->name }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">No
                            HP</label>
                        <input type="text" value="{{ $transaksi->pelanggan->no_hp }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                        <input type="text" value="{{ $transaksi->pelanggan->email }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Alamat</label>
                        <textarea readonly disabled rows="4"
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">{{ $transaksi->pelanggan->alamat }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Desa</label>
                        <input type="text" value="{{ $transaksi->pelanggan->desa }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                    <div>
                        <label
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kecamatan</label>
                        <input type="text" value="{{ $transaksi->pelanggan->kecamatan }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                    <div>
                        <label
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kabupaten</label>
                        <input type="text" value="{{ $transaksi->pelanggan->kabupaten }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                    <div>
                        <label
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Provinsi</label>
                        <input type="text" value="{{ $transaksi->pelanggan->provinsi }}" readonly disabled
                            class="form-input bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm  placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                    </div>
                </div>

                <div class="my-5 space-y-6 border-t border-gray-100 dark:border-gray-800"></div>
                <!-- Pilih Produk -->
                <div class="my-6">


                    <!-- Keranjang -->

                    <div class="my-6">
                        <h4 class="text-lg font-semibold mb-2">Keranjang Produk</h4>
                        <table class="w-full text-sm text-left border border-collapse">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-2 py-1">Nama</th>
                                    <th class="border px-2 py-1">Size</th>
                                    <th class="border px-2 py-1">Satuan</th>
                                    <th class="border px-2 py-1">Jumlah</th>
                                    <th class="border px-2 py-1">Harga</th>
                                    <th class="border px-2 py-1">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->detail as $item)
                                    <tr>
                                        <td class="border px-2 py-1">{{ $item->stok->produk->name }}</td>
                                        <td class="border px-2 py-1">{{ $item->stok->size }}</td>
                                        <td class="border px-2 py-1">{{ $item->satuan }}</td>
                                        <td class="border px-2 py-1">{{ $item->qty }}</td>
                                        <td class="border px-2 py-1">{{ $item->harga_jual }}</td>
                                        <td class="border px-2 py-1">{{ $item->sub_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-layout>
