<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Tambah Retur` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">{{ $title }}</h2>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Retur
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form @submit.prevent="submitForm" action="{{ route('gudang.retur.store') }}" method="POST">
                    @csrf
                    <!-- Pilih Produk -->
                    <div class="my-6">
                        <label for="produk" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Pilih Produk <span class="text-error-500">*</span>
                        </label>


                        <select id="produk" name="id_produk"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                            x-model="selectedProduk" @change="loadStoks" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id_produk }}">{{ $produk->kode }} -- {{ $produk->name }}
                                </option>
                            @endforeach
                        </select>



                        @error('produk')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="my-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Kondisi<span class="text-error-500">*</span>
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative bg-transparent">
                                <select name="kondisi"
                                    class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10  h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('kondisi') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">
                                    <option {{ old('kondisi') === 'bagus' ? 'selected' : '' }} value="bagus"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Bagus
                                    </option>
                                    <option {{ old('kondisi') === 'rusak' ? 'selected' : '' }} value="rusak"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Rusak
                                    </option>

                                </select>
                                <span
                                    class="pointer-events-none absolute top-1/2 right-4  -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                @error('kondisi')
                                    <p class="text-theme-xs text-error-500 my-1.5">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Catatan
                            </label>
                            <textarea placeholder="........" type="text" rows="6" name="catatan"
                                class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10  w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('catatan') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}">{{ old('merk') }}</textarea>
                            @error('catatan')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>




                    <!-- Tabel Stok -->
                    <template x-if="sizes.length > 0">
                        <table class="w-full my-5">
                            <thead>
                                <tr class="border-y border-gray-100 dark:border-gray-800">
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
                            <tbody>
                                <template x-for="(row, index) in sizes" :key="row.id_stok">
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <input type="hidden" :name="'id_stok[]'" :value="row.id_stok">
                                            <input type="text" :value="row.size" readonly disabled
                                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700" />
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <input type="text" :value="row.satuan" readonly disabled
                                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700" />
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <input type="number" :name="'jumlah_satuan[]'"
                                                x-model.number="row.jumlah_satuan" min="0" required
                                                class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700" />
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </template>

                    <template x-if="sizes.length === 0 && selectedProduk">
                        <p class="text-red-500">Data stok tidak ditemukan untuk produk ini.</p>
                    </template>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded" :disabled="!selectedProduk">
                        Simpan
                    </button>
                </form>


                <!-- Di tempat paling bawah file Blade -->
                <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
                <script src="{{ asset('js/tom-select.min.js') }}"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new TomSelect('#produk', {
                            create: false,
                            placeholder: 'Cari produk...',
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                    });

                    function returForm() {
                        return {
                            selectedProduk: '',
                            sizes: [],
                            satuanProduk: '',
                            loadStoks() {
                                if (!this.selectedProduk) {
                                    this.sizes = [];
                                    return;
                                }

                                // Ganti URL ini dengan endpoint API backend kamu yang mengembalikan data stok produk
                                fetch(`{{ url('/') }}/gudang/produk/${this.selectedProduk}/stoks`)
                                    .then(res => res.json())
                                    .then(data => {

                                        // data format: [{id_stok, size, satuan, jumlah_satuan_default}]
                                        if (data.length > 0) {
                                            this.sizes = data.map(item => ({
                                                id_stok: item.id_stok,
                                                size: item.size,
                                                satuan: item.satuan,
                                                jumlah_satuan: 0,
                                            }));
                                        } else {
                                            this.sizes = [];
                                        }
                                    })
                                    .catch(() => {
                                        this.sizes = [];
                                    });
                            },
                            submitForm() {
                                // submit form via AJAX atau submit normal
                                // contoh submit normal:
                                $el = document.querySelector('form');
                                $el.submit();
                            }
                        }
                    }
                </script>


            </div>
        </div>
    </div>



</x-layout>
