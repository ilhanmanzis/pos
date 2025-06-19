<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Tambah Stok` }">
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
            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800">


                <div>
                    <form action="{{ route('gudang.produk.update.stok', ['id' => $produk['id_produk']]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <table class="min-w-full">
                            <!-- table header start -->
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center justify-center ">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Size
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Satuan
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Jumlah
                                            </p>
                                        </div>
                                    </th>

                                </tr>
                            </thead>
                            <!-- table header end -->

                            <!-- table body start -->
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800" x-data="{
                                sizes: [{
                                    size: '',
                                    harga_beli: '',
                                    jumlah: '',
                                    
                                }],
                                addSize() {
                                    this.sizes.push({
                                        size: '',
                                        harga_beli: '',
                                        jumlah: '',
                                        
                                    });
                                },
                                removeSize(index) {
                                    this.sizes.splice(index, 1);
                                }
                            }"
                                x-init="sizes = {{ Js::from(
                                    $produk->stoks->map(function ($stok) {
                                        return [
                                            'id_stok' => $stok->id_stok,
                                            'size' => $stok->size,
                                            'jumlah' => 0,
                                        ];
                                    }),
                                ) }}">
                                <template x-for="(row, index) in sizes" :key="index">
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <input type="hidden" name="id_stok[]" x-model="row.id_stok">
                                            <input type="text" name="size[]" x-model="row.size" readonly disabled
                                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700"
                                                required>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <input type="text" value="{{ $produk['satuan'] }}" readonly disabled
                                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <input type="number" name="jumlah[]" x-model="row.jumlah"
                                                class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700"
                                                required>
                                        </td>
                                    </tr>
                                </template>

                                <!-- table body end -->

                            </tbody>


                        </table>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium mt-10 text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 mb-5">
                            Simpan
                        </button>
                    </form>
                </div>











            </div>
        </div>



    </div>

</x-layout>
