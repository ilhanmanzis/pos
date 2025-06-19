<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Tambah Transaksi` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">{{ $title }}</h2>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Transaksi
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form @submit.prevent="submitForm" action="{{ route('finance.transaksi.store') }}" method="POST">
                    @csrf
                    <!-- Input hidden untuk menyimpan data keranjang -->
                    <input type="hidden" name="keranjang" x-model="JSON.stringify(keranjang)">
                    <!-- Pilih Produk -->
                    <div class="my-6">
                        <label for="pelanggan"
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Pilih Pelanggan <span class="text-error-500">*</span>
                        </label>


                        <select id="pelanggan" name="pelanggan"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                            x-model="selectedPelanggan" @change="loadPelanggan" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->kode_pelanggan }}">{{ $pelanggan->kode_pelanggan }} --
                                    {{ $pelanggan->name }}
                                </option>
                            @endforeach
                        </select>



                        @error('pelanggan')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4 my-5">
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama</label>
                            <input type="text" x-model="pelangganData.name" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">No
                                HP</label>
                            <input type="text" x-model="pelangganData.no_hp" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                            <input type="text" x-model="pelangganData.email" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Alamat</label>
                            <textarea x-model="pelangganData.alamat" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700"></textarea>
                        </div>
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Desa</label>
                            <input type="text" x-model="pelangganData.desa" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kecamatan</label>
                            <input type="text" x-model="pelangganData.kecamatan" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kabupaten</label>
                            <input type="text" x-model="pelangganData.kabupaten" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Provinsi</label>
                            <input type="text" x-model="pelangganData.provinsi" readonly disabled
                                class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                        </div>
                    </div>

                    <div class="my-5 space-y-6 border-t border-gray-100 dark:border-gray-800"></div>
                    <!-- Pilih Produk -->
                    <div class="my-6" x-data="produkForm()">
                        <label for="produk" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Pilih Produk <span class="text-error-500">*</span>
                        </label>

                        <select id="produk" name="id_produk" x-model="selectedProduk" @change="fetchProduk"
                            value=""
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id_produk }}">{{ $produk->kode }} --
                                    {{ $produk->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('keranjang')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror

                        <!-- Info Produk -->
                        <template x-if="produkDetail">

                            <div class="grid grid-cols-3 gap-6 sm:grid-cols-4 my-5">
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama</label>
                                    <input type="hidden" x-model="produkDetail.id">
                                    <input type="hidden" x-model="produkDetail.allSizes">
                                    <input type="hidden" x-model="produkDetail.satuan">
                                    {{-- <input type="hidden" x-model="produkDetail.stokData"> --}}
                                    <input type="text" x-model="produkDetail.nama" readonly disabled
                                        class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                </div>

                                <!-- Size -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Size<span class="text-error-500">*</span>
                                    </label>
                                    <div class="relative bg-transparent">
                                        <select x-model="produkDetail.size"
                                            class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10  h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 focus:border-brand-300 dark:border-gray-700">
                                            <template x-for="s in produkDetail.allSizes" :key="s">
                                                <option x-text="s" :selected="produkDetail.size === s">
                                                </option>
                                            </template>
                                        </select>
                                        <span
                                            class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                            <svg class="stroke-current" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div x-effect="updateStokDisplay()">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Stok</label>
                                    <input type="text" x-show="produkDetail && produkDetail.stokDisplay"
                                        x-model="produkDetail.stokDisplay" readonly disabled
                                        class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                </div>

                                <!-- Satuan -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Satuan<span class="text-error-500">*</span>
                                    </label>
                                    <template x-if="produkDetail.satuan.length > 1">
                                        <div class="relative  bg-transparent">
                                            <select x-model="produkDetail.selectedSatuan"
                                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10  h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 focus:border-brand-300 dark:border-gray-700">
                                                <template x-for="s in produkDetail.satuan" :key="s">
                                                    <option x-text="s"
                                                        :selected="produkDetail.selectedSatuan === s"></option>
                                                </template>
                                            </select>
                                            <span
                                                class="pointer-events-none absolute top-1/2 right-4  -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                <svg class="stroke-current" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                                        stroke="" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </template>
                                    <template x-if="produkDetail.satuan.length === 1">


                                        <input type="text" x-model="produkDetail.satuan[0]" readonly disabled
                                            class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                    </template>
                                </div>

                                <!-- Jumlah -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Jumlah<span class="text-error-500">*</span>
                                    </label>

                                    <input type="number" x-model="produkDetail.jumlah" min="1"
                                        class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 'border-gray-300 focus:border-brand-300 dark:border-gray-700" />
                                </div>

                                <!-- Harga -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Harga Jual<span class="ml-1"
                                            x-text="'/ ' + produkDetail.selectedSatuan"></span><span
                                            class="text-error-500">*</span>
                                    </label>
                                    <input type="number" x-model="produkDetail.harga_jual"
                                        class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 'border-gray-300 focus:border-brand-300 dark:border-gray-700"
                                        step="0.01" min="0" />

                                </div>
                                <!-- Total -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Total
                                    </label>
                                    <input type="number" :value="produkDetail.jumlah * produkDetail.harga_jual"
                                        readonly
                                        class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                </div>
                                <button type="button"
                                    class="mt-2 pt-5 text-sm bg-green-600 flex justify-center text-white rounded"
                                    @click="tambahKeKeranjang">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                    <span class="ml-3">Simpan ke Keranjang</span>
                                </button>
                            </div>

                        </template>

                        <!-- Keranjang -->
                        <template x-if="keranjang.length > 0">
                            <div class="mt-6">
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
                                            <th class="border px-2 py-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, i) in keranjang" :key="i">
                                            <tr>
                                                <td class="border px-2 py-1" x-text="item.nama"></td>
                                                <td class="border px-2 py-1" x-text="item.size"></td>
                                                <td class="border px-2 py-1" x-text="item.selectedSatuan"></td>
                                                <td class="border px-2 py-1" x-text="item.jumlah"></td>
                                                <td class="border px-2 py-1" x-text="item.harga_jual"></td>
                                                <td class="border px-2 py-1" x-text="item.jumlah * item.harga_jual">
                                                </td>
                                                <td class="border px-2 py-1">
                                                    <button type="button" class="text-blue-500 mr-2"
                                                        @click="editProduk(i)">Edit</button>
                                                    <button type="button" class="text-red-500"
                                                        @click="keranjang.splice(i, 1)">Hapus</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <!-- Total Keranjang -->
                                    <tbody>
                                        <tr>
                                            <td class="border px-2 py-1" colspan="5">Total Keranjang</td>
                                            <td class="border px-2 py-1" colspan="2"
                                                x-text="'Rp. '+keranjang.reduce((sum, item) => sum + (item.jumlah * item.harga_jual), 0)">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>
                    </div>





                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </form>


                <!-- Di tempat paling bawah file Blade -->
                <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
                <script src="{{ asset('js/tom-select.min.js') }}"></script>
                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.store('keranjang', []);
                    });

                    let produkTomSelect = null;
                    document.addEventListener('DOMContentLoaded', function() {
                        new TomSelect('#pelanggan', {
                            create: false,
                            placeholder: 'Cari pelanggan...',
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                        produkTomSelect = new TomSelect('#produk', {
                            create: false,
                            placeholder: 'Cari produk...',
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                    });

                    function produkForm() {
                        return {
                            selectedProduk: '',
                            produkDetail: null,
                            keranjang: [],
                            get keranjang() {
                                return Alpine.store('keranjang');
                            },

                            fetchProduk() {
                                if (!this.selectedProduk) {
                                    this.produkDetail = null;
                                    return;
                                }

                                fetch(`{{ url('/') }}/finance/transaksi/produk/${this.selectedProduk}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        this.produkDetail = {
                                            id: data.id_produk,
                                            nama: data.nama_produk,
                                            size: data.sizes[0],
                                            allSizes: data.sizes,
                                            satuan: [data.satuan],
                                            selectedSatuan: [data.satuan][0],
                                            jumlah: 1,
                                            harga_jual: 0,
                                            stokData: data.stok_per_size,
                                            stokDisplay: null,
                                            //sample: 'tidak',
                                        };

                                        this.updateStokDisplay();
                                    });
                            },

                            updateStokDisplay() {
                                if (!this.produkDetail || !this.produkDetail.stokData) return;

                                const stok = this.produkDetail.stokData.find(s => s.size === this.produkDetail.size);
                                this.produkDetail.stokDisplay = stok ? stok.display : 'Stok tidak ditemukan';

                                // Simpan id_stok ke produkDetail agar nanti dikirim ke keranjang
                                this.produkDetail.id_stok = stok ? stok.id_stok : null;
                            },


                            tambahKeKeranjang() {
                                if (!this.produkDetail) return;

                                this.keranjang.push({
                                    ...this.produkDetail
                                });

                                this.resetProduk();
                            },

                            editProduk(index) {
                                const item = this.keranjang[index];
                                this.produkDetail = {
                                    id: item.id,
                                    nama: item.nama,
                                    size: item.size,
                                    allSizes: item.allSizes,
                                    satuan: item.satuan.length ? item.satuan : [item.selectedSatuan],
                                    selectedSatuan: item.selectedSatuan,
                                    jumlah: item.jumlah,
                                    harga_jual: item.harga_jual,
                                    stokData: item.stokData,
                                    stokDisplay: item.stokDisplay,
                                };

                                this.keranjang.splice(index, 1);
                                this.updateStokDisplay();
                            },

                            resetProduk() {
                                this.produkDetail = null;
                                this.selectedProduk = null;

                                produkTomSelect.clear(true);
                                produkTomSelect.setValue(null);
                                produkTomSelect.setTextboxValue('');
                                produkTomSelect.blur();
                            }
                        };
                    }




                    function returForm() {
                        return {
                            selectedProduk: '',
                            selectedPelanggan: '',
                            keranjang: [],
                            get keranjang() {
                                return Alpine.store('keranjang');
                            },
                            sizes: [],
                            pelangganData: {
                                name: '',
                                no_hp: '',
                                email: '',
                                alamat: '',
                                desa: '',
                                kecamatan: '',
                                kabupaten: '',
                                provinsi: ''
                            },
                            loadPelanggan() {
                                if (!this.selectedPelanggan) return;

                                fetch(`{{ url('/') }}/finance/transaksi/pelanggan/${this.selectedPelanggan}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        this.pelangganData = {
                                            name: data.name,
                                            no_hp: data.no_hp,
                                            email: data.email,
                                            alamat: data.alamat,
                                            desa: data.desa,
                                            kecamatan: data.kecamatan,
                                            kabupaten: data.kabupaten,
                                            provinsi: data.provinsi,
                                        };
                                    })
                                    .catch(() => {
                                        this.pelangganData = {};
                                    });
                            },
                            submitForm() {
                                // Validasi pelanggan dipilih
                                if (!this.selectedPelanggan) {
                                    alert('Pelanggan belum dipilih atau data pelanggan kosong.');
                                    return;
                                }

                                // Validasi data pelanggan lengkap (cek nama, no_hp sebagai contoh)
                                if (!this.pelangganData.name || !this.pelangganData.no_hp) {
                                    alert('Data pelanggan belum lengkap.');
                                    return;
                                }

                                // Validasi keranjang tidak kosong
                                if (this.keranjang.length === 0) {
                                    alert('Keranjang produk masih kosong.');
                                    return;
                                }

                                // Konfirmasi apakah data sudah sesuai
                                if (confirm('Apakah data sudah sesuai?')) {
                                    document.querySelector('form').submit();
                                }
                            }

                        }
                    }
                </script>


            </div>
        </div>
    </div>



</x-layout>
