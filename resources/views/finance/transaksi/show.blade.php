<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-8">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Edit Transaksi` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">{{ $title }}</h2>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Data Transaksi
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm({{ json_encode($transaksi) }}, {{ json_encode($transaksi->detail->toArray()) }})">

                <form @submit.prevent="submitForm"
                    action="{{ route('finance.transaksi.update', $transaksi->id_transaksi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="keranjang" x-model="JSON.stringify(keranjang)">

                    <!-- Pilih Pelanggan -->
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
                                    {{ $pelanggan->name }}</option>
                            @endforeach
                        </select>

                        @error('pelanggan')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data pelanggan tampil readonly -->
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4 my-5">
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama</label>
                            <input type="text" x-model="pelangganData.name" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                        <div><label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">No
                                HP</label>
                            <input type="text" x-model="pelangganData.no_hp" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                            <input type="text" x-model="pelangganData.email" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Alamat</label>
                            <textarea x-model="pelangganData.alamat" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700"></textarea>
                        </div>
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Desa</label>
                            <input type="text" x-model="pelangganData.desa" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kecamatan</label>
                            <input type="text" x-model="pelangganData.kecamatan" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kabupaten</label>
                            <input type="text" x-model="pelangganData.kabupaten" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                        <div><label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Provinsi</label>
                            <input type="text" x-model="pelangganData.provinsi" readonly disabled
                                class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                        </div>
                    </div>

                    <!-- Produk dan Keranjang, sama seperti create tapi isi awal dari data transaksi -->
                    <div class="my-6" x-data="produkForm()">
                        <label for="produk" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Pilih Produk <span class="text-error-500">*</span>
                        </label>

                        <select id="produk" name="id_produk" x-model="selectedProduk" @change="fetchProduk"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id_produk }}">{{ $produk->kode }} -- {{ $produk->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Info Produk dan input jumlah, harga sama seperti form create -->

                        <template x-if="produkDetail">
                            <div class="grid grid-cols-3 gap-6 sm:grid-cols-4 my-5">
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama</label>
                                    <input type="hidden" x-model="produkDetail.id">
                                    <input type="hidden" x-model="produkDetail.allSizes">
                                    <input type="hidden" x-model="produkDetail.satuan">
                                    <input type="text" x-model="produkDetail.nama" readonly disabled
                                        class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                                </div>
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Size<span
                                            class="text-error-500">*</span></label>
                                    <div class="relative bg-transparent">
                                        <select x-model="produkDetail.size"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700">
                                            <template x-for="s in produkDetail.allSizes" :key="s">
                                                <option x-text="s"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div x-effect="updateStokDisplay()">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Stok</label>
                                    <input type="text" x-show="produkDetail && produkDetail.stokDisplay"
                                        x-model="produkDetail.stokDisplay" readonly disabled
                                        class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                                </div>
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Satuan<span
                                            class="text-error-500">*</span></label>
                                    <template x-if="produkDetail.satuan.length > 1">
                                        <div class="relative bg-transparent">
                                            <select x-model="produkDetail.selectedSatuan"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700">
                                                <template x-for="s in produkDetail.satuan" :key="s">
                                                    <option x-text="s"
                                                        :selected="produkDetail.selectedSatuan === s"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </template>
                                    <template x-if="produkDetail.satuan.length === 1">
                                        <input type="text" x-model="produkDetail.satuan[0]" readonly disabled
                                            class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                                    </template>
                                </div>
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Jumlah<span
                                            class="text-error-500">*</span></label>
                                    <input type="number" x-model="produkDetail.jumlah" min="1"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                                </div>
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Harga
                                        Jual<span class="ml-1"
                                            x-text="'/ ' + produkDetail.selectedSatuan"></span><span
                                            class="text-error-500">*</span></label>
                                    <input type="number" x-model="produkDetail.harga_jual"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700"
                                        step="0.01" min="0" />
                                </div>
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Total</label>
                                    <input type="number" :value="produkDetail.jumlah * produkDetail.harga_jual"
                                        readonly
                                        class="form-input bg-[#e6e7e8] h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700" />
                                </div>
                                <button type="button"
                                    class="mt-2 pt-5 text-sm bg-green-600 flex justify-center text-white rounded"
                                    @click="tambahKeKeranjang">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                    <span class="ml-3">Tambah ke Keranjang</span>
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
                                </table>
                            </div>
                        </template>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Update
                    </button>
                </form>

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

                                fetch(`/finance/transaksi/produk/${this.selectedProduk}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        const satuan = data.satuan;

                                        let satuanOptions = [];
                                        if (satuan.includes('roll')) {
                                            satuanOptions = ['roll'];
                                        } else {
                                            satuanOptions = [satuan, 'pcs'];
                                        }

                                        this.produkDetail = {
                                            id: data.id_produk,
                                            nama: data.nama_produk,
                                            size: data.sizes[0],
                                            allSizes: data.sizes,
                                            satuan: satuanOptions,
                                            selectedSatuan: satuanOptions[0],
                                            jumlah: 1,
                                            harga_jual: 0,
                                            stokData: data.stok_per_size,
                                            stokDisplay: null,
                                        };

                                        this.updateStokDisplay();
                                    });
                            },

                            updateStokDisplay() {
                                if (!this.produkDetail || !this.produkDetail.stokData) return;

                                const stok = this.produkDetail.stokData.find(s => s.size === this.produkDetail.size);
                                this.produkDetail.stokDisplay = stok ? stok.display : 'Stok tidak ditemukan';
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

                    function returForm(oldTransaksi = {}, oldDetail = []) {
                        // Inisialisasi Alpine store keranjang dengan data lama 
                        console.log(oldDetail)
                        Alpine.store('keranjang', oldDetail.length ? oldDetail.map(item => ({
                            id: item.id_stok,
                            nama: item.stok?.produk?.name || item.produk?.name || item.nama_produk || '',
                            size: item.stok.size || '',
                            // allSizes: item.stok ? item.stok.map(s => s.size) : [item.size || ''],
                            satuan: [item.satuan, 'pcs'],
                            selectedSatuan: item.satuan,
                            jumlah: item.qty || 1,
                            harga_jual: item.harga_jual || 0,
                            stokData: item.stok ? [{
                                size: item.size,
                                display: item.stok.stok
                            }] : [],
                            stokDisplay: item.stok,
                        })) : []);

                        return {
                            selectedProduk: '',
                            selectedPelanggan: oldTransaksi.kode_pelanggan || '',
                            get keranjang() {
                                return Alpine.store('keranjang');
                            },
                            pelangganData: {
                                name: oldTransaksi.pelanggan?.name || '',
                                no_hp: oldTransaksi.pelanggan?.no_hp || '',
                                email: oldTransaksi.pelanggan?.email || '',
                                alamat: oldTransaksi.pelanggan?.alamat || '',
                                desa: oldTransaksi.pelanggan?.desa || '',
                                kecamatan: oldTransaksi.pelanggan?.kecamatan || '',
                                kabupaten: oldTransaksi.pelanggan?.kabupaten || '',
                                provinsi: oldTransaksi.pelanggan?.provinsi || ''
                            },
                            loadPelanggan() {
                                if (!this.selectedPelanggan) return;

                                fetch(`/finance/transaksi/pelanggan/${this.selectedPelanggan}`)
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
                                document.querySelector('form').submit();
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</x-layout>
