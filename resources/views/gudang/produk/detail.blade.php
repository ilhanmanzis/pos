<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Tambah Produk` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">{{ $title }}</h2>
            </div>

        </div>
        <!-- Breadcrumb End -->
        <div class=" mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">


            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Produk
                </h3>
            </div>
            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">


                <!-- Elements -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kode</label>
                        <input type="text" value="{{ $produk->kode }}"
                            class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                            readonly disabled />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Name</label>
                        <input type="text" value="{{ $produk->name }}"
                            class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                            readonly disabled />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kategori</label>
                        <input type="text" value="{{ $produk->kategori->name }}"
                            class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                            readonly disabled />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Merk</label>
                        <input type="text" value="{{ $produk->merk }}"
                            class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                            readonly disabled />
                    </div>
                    <div>
                        <label
                            class="my-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400  border-b border-gray-100 dark:border-gray-800">
                            Foto
                        </label>

                        <div id="previewFoto" class="mt-4">
                            {{-- Tampilkan foto dari database jika ada --}}
                            @if (!empty($produk->foto))
                                <img src="{{ asset('storage/produk/' . $produk->foto) }}" alt="Foto Saat Ini"
                                    class="max-w-[200px] mt-2 rounded shadow">
                            @else
                                <img src="{{ asset('storage/produk/' . $produk->foto) }}" alt="Foto Saat Ini"
                                    class="max-w-[200px] mt-2 rounded shadow">
                            @endif

                        </div>
                    </div>


                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Keterangan
                        </label>
                        <textarea placeholder="........" type="text" rows="6"
                            class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10  w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                            readonly disabled>{{ $produk->keterangan }}</textarea>
                    </div>
                </div>

                <div class="mt-5">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-b border-t border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Size
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Satuan
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Harga Beli
                                        </p>
                                    </div>
                                </th>



                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Stok
                                        </p>
                                    </div>
                                </th>

                            </tr>
                        </thead>
                        <!-- table header end -->

                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($produk->stoks as $stok)
                                <tr>

                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex -space-x-2">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $stok->size }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex -space-x-2">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $produk['satuan'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex -space-x-2">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $stok->harga_beli }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex -space-x-2">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $stok->jumlah_satuan }} {{ $produk->satuan }}
                                                    {{ $stok->pcs != 0 ? $stok->pcs . ' pcs' : '' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                            <!-- table body end -->

                        </tbody>
                    </table>
                </div>











            </div>
        </div>



    </div>

</x-layout>
