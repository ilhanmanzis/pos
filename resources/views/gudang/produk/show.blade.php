<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Edit Produk` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
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
                <form action="{{ route('gudang.produk.update', ['id' => $produk['id_produk']]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <!-- Elements -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Kode
                                <input type="text" name="kode" value="{{ $produk['kode'] }}"
                                    class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('kode') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}" />
                                @error('kode')
                                    <p class="text-theme-xs text-error-500 my-1.5">
                                        {{ $message }}
                                    </p>
                                @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Nama<span class="text-error-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ $produk['name'] }}"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('name') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                required />
                            @error('name')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Merk<span class="text-error-500">*</span>
                            </label>
                            <input type="text" name="merk" value="{{ $produk['merk'] }}"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('merk') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                required />
                            @error('merk')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Kategori<span class="text-error-500">*</span>
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select name="kategori" required
                                    class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10  h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('kategori') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">
                                    @foreach ($kategoris as $kategori)
                                        <option
                                            {{ $produk['id_kategori'] === $kategori['id_kategori'] ? 'selected' : '' }}
                                            value="{{ $kategori['id_kategori'] }}"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            {{ $kategori['name'] }}
                                        </option>
                                    @endforeach

                                </select>
                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                @error('kategori')
                                    <p class="text-theme-xs text-error-500 my-1.5">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>





                        </div>


                        <div>
                            <label class="my-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Foto
                            </label>
                            <input type="file" id="fotoInput" name="foto"
                                class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border 
                                {{ $errors->has('foto') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}   bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400" />
                            @error('foto')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                            <div id="previewFoto" class="mt-4">
                                {{-- Tampilkan foto dari database jika ada --}}
                                @if (!empty($produk->foto))
                                    <img src="{{ asset('storage/produk/' . $produk->foto) }}" alt="Foto Saat Ini"
                                        class="max-w-[200px] mt-2 rounded shadow">
                                @endif
                            </div>
                        </div>
                        {{-- Tempat preview foto --}}
                        <script>
                            document.getElementById('fotoInput').addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                const previewDiv = document.getElementById('previewFoto');
                                previewDiv.innerHTML = ''; // Clear preview sebelumnya

                                if (file && file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function(event) {
                                        const img = document.createElement('img');
                                        img.src = event.target.result;
                                        img.alt = 'Preview Foto';
                                        img.classList = 'max-w-[200px] mt-2 rounded shadow';
                                        previewDiv.appendChild(img);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Keterangan
                            </label>
                            <textarea placeholder="........" type="text" rows="6" name="keterangan"
                                class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10  w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('keterangan') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}">{{ $produk['keterangan'] }}</textarea>
                            @error('keterangan')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                    </div>
                    {{-- @php
                        if ($produk['satuan'] === 'box') {
                            $satuan = 'box/pcs';
                        } elseif ($produk['satuan'] === 'roll') {
                            $satuan = 'roll';
                        } else {
                            $satuan = 'pack/pcs';
                        }
                    @endphp --}}
                    <div x-data="{ selectedSatuan: '{{ $produk['satuan'] }}' }">


                        <div>
                            <div class="py-4 sm:py-5">
                                <h3 class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    Satuan<span class="text-error-500">*</span>
                                </h3>
                            </div>


                            <!-- Radio Buttons -->
                            <div class="flex flex-wrap items-center gap-8">
                                <!-- Box -->
                                <label for="radioBox"
                                    class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                    <div class="relative">
                                        <input type="radio" id="radioBox" name="satuan" value="box"
                                            class="sr-only" x-model="selectedSatuan" required />
                                        <div :class="selectedSatuan === 'box' ? 'border-brand-500 bg-brand-500' :
                                            'bg-transparent border-gray-300 dark:border-gray-700'"
                                            class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-full border-[1.25px]">
                                            <span class="h-2 w-2 rounded-full"
                                                :class="selectedSatuan === 'box' ? 'bg-white' :
                                                    'bg-white dark:bg-[#171f2e]'"></span>
                                        </div>
                                    </div>
                                    Box
                                </label>

                                <!-- Roll -->
                                <label for="radioRoll"
                                    class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                    <div class="relative">
                                        <input type="radio" id="radioRoll" name="satuan" value="roll"
                                            class="sr-only" x-model="selectedSatuan" />
                                        <div :class="selectedSatuan === 'roll' ? 'border-brand-500 bg-brand-500' :
                                            'bg-transparent border-gray-300 dark:border-gray-700'"
                                            class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-full border-[1.25px]">
                                            <span class="h-2 w-2 rounded-full"
                                                :class="selectedSatuan === 'roll' ? 'bg-white' :
                                                    'bg-white dark:bg-[#171f2e]'"></span>
                                        </div>
                                    </div>
                                    Roll
                                </label>

                                <!-- Pack -->
                                <label for="radioPack"
                                    class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                    <div class="relative">
                                        <input type="radio" id="radioPack" name="satuan" value="pack"
                                            class="sr-only" x-model="selectedSatuan" />
                                        <div :class="selectedSatuan === 'pack' ? 'border-brand-500 bg-brand-500' :
                                            'bg-transparent border-gray-300 dark:border-gray-700'"
                                            class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-full border-[1.25px]">
                                            <span class="h-2 w-2 rounded-full"
                                                :class="selectedSatuan === 'pack' ? 'bg-white' :
                                                    'bg-white dark:bg-[#171f2e]'"></span>
                                        </div>
                                    </div>
                                    Pack
                                </label>
                                {{-- pcs --}}
                                <label for="radioPcs"
                                    class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                    <div class="relative">
                                        <input type="radio" id="radioPcs" name="satuan" value="pcs"
                                            class="sr-only" x-model="selectedSatuan" />
                                        <div :class="selectedSatuan === 'pcs' ? 'border-brand-500 bg-brand-500' :
                                            'bg-transparent border-gray-300 dark:border-gray-700'"
                                            class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-full border-[1.25px]">
                                            <span class="h-2 w-2 rounded-full"
                                                :class="selectedSatuan === 'pcs' ? 'bg-white' :
                                                    'bg-white dark:bg-[#171f2e]'"></span>
                                        </div>
                                    </div>
                                    Pcs
                                </label>
                            </div>
                            @error('satuan')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- Div ini akan berubah sesuai pilihan -->
                        <div id="isiSatuan" class="mt-4 w-full">
                            {{-- box --}}
                            <template x-if="selectedSatuan === 'box'">
                                @php
                                    $sizesJson =
                                        $produk->satuan === 'box'
                                            ? Js::from(
                                                $produk->stoks->map(function ($stok) {
                                                    return [
                                                        'id_stok' => $stok->id_stok,
                                                        'size' => $stok->size,
                                                        'harga_beli' => $stok->harga_beli ?? '',
                                                        'jumlah' => $stok->jumlah ?? '',
                                                    ];
                                                }),
                                            )
                                            : Js::from([1]); // kosongkan jika bukan 'box'
                                @endphp

                                <div x-data="{
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
                                }" x-init="sizes = {{ $sizesJson }}">

                                    <table class="w-full">
                                        <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Size
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Satuan
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Harga Beli
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Jumlah Box
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Jumlah Pcs / Box
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Aksi
                                                        </p>
                                                    </div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, index) in sizes" :key="index">
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="hidden" name="id_stok[]" x-model="row.id_stok">
                                                        <input type="text" name="size[]" x-model="row.size"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="text" value="Box" readonly disabled
                                                            class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="harga_beli[]"
                                                            x-model="row.harga_beli"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="jumlah[]"
                                                            x-model="row.jumlah"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>

                                                    <td class="px-5 py-4 sm:px-6 text-center">
                                                        <button type="button" @click="removeSize(index)"
                                                            class="bg-red-500 text-white rounded px-2 py-1 text-sm hover:bg-red-600"
                                                            x-show="sizes.length > 1"><svg
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg></button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <!-- Tombol Tambah -->
                                    <div class="mt-3 mx-6">
                                        <button type="button" @click="addSize()"
                                            class="bg-green-500 text-white rounded px-4 py-2 text-sm hover:bg-green-600">+
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Roll -->
                            <template x-if="selectedSatuan === 'roll'">
                                @php
                                    $sizesJson =
                                        $produk->satuan === 'roll'
                                            ? Js::from(
                                                $produk->stoks->map(function ($stok) {
                                                    return [
                                                        'id_stok' => $stok->id_stok,
                                                        'size' => $stok->size,
                                                        'harga_beli' => $stok->harga_beli ?? '',
                                                        'jumlah' => $stok->jumlah ?? '',
                                                        
                                                    ];
                                                }),
                                            )
                                            : Js::from([1]); // kosongkan jika bukan 'box'
                                @endphp
                                <div x-data="{
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
                                }" x-init="sizes = {{ $sizesJson }}">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Size
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Satuan
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Harga Beli
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Jumlah
                                                        </p>
                                                    </div>
                                                </th>

                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Aksi
                                                        </p>
                                                    </div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, index) in sizes" :key="index">
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="hidden" name="id_stok[]" x-model="row.id_stok">
                                                        <input type="text" name="size[]" x-model="row.size"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="text" value="Roll" readonly disabled
                                                            class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="harga_beli[]"
                                                            x-model="row.harga_beli"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="jumlah[]"
                                                            x-model="row.jumlah"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>

                                                    <td class="px-5 py-4 sm:px-6 text-center">
                                                        <button type="button" @click="removeSize(index)"
                                                            class="bg-red-500 text-white rounded px-2 py-1 text-sm hover:bg-red-600"
                                                            x-show="sizes.length > 1"><svg
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg></button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <!-- Tombol Tambah -->
                                    <div class="mt-3 mx-6">
                                        <button type="button" @click="addSize()"
                                            class="bg-green-500 text-white rounded px-4 py-2 text-sm hover:bg-green-600">+
                                        </button>
                                    </div>
                                </div>
                            </template>
                            <!-- Pack -->
                            <template x-if="selectedSatuan === 'pack'">
                                @php
                                    $sizesJson =
                                        $produk->satuan === 'pack'
                                            ? Js::from(
                                                $produk->stoks->map(function ($stok) {
                                                    return [
                                                        'id_stok' => $stok->id_stok,
                                                        'size' => $stok->size,
                                                        'harga_beli' => $stok->harga_beli ?? '',
                                                        'jumlah' => $stok->jumlah ?? '',
                                                    ];
                                                }),
                                            )
                                            : Js::from([1]); // kosongkan jika bukan 'box'
                                @endphp
                                <div x-data="{
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
                                }" x-init="sizes = {{ $sizesJson }}">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Size
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Satuan
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Harga Beli
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Jumlah Pack
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Aksi
                                                        </p>
                                                    </div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, index) in sizes" :key="index">
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="hidden" name="id_stok[]" x-model="row.id_stok">
                                                        <input type="text" name="size[]" x-model="row.size"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="text" value="Pack" readonly disabled
                                                            class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="harga_beli[]"
                                                            x-model="row.harga_beli"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="jumlah[]"
                                                            x-model="row.jumlah"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6 text-center">
                                                        <button type="button" @click="removeSize(index)"
                                                            class="bg-red-500 text-white rounded px-2 py-1 text-sm hover:bg-red-600"
                                                            x-show="sizes.length > 1"><svg
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg></button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <!-- Tombol Tambah -->
                                    <div class="mt-3 mx-6">
                                        <button type="button" @click="addSize()"
                                            class="bg-green-500 text-white rounded px-4 py-2 text-sm hover:bg-green-600">+
                                        </button>
                                    </div>
                                </div>
                            </template>

                            {{-- pcs --}}
                            <template x-if="selectedSatuan === 'pcs'">
                                @php
                                    $sizesJson =
                                        $produk->satuan === 'pcs'
                                            ? Js::from(
                                                $produk->stoks->map(function ($stok) {
                                                    return [
                                                        'id_stok' => $stok->id_stok,
                                                        'size' => $stok->size,
                                                        'harga_beli' => $stok->harga_beli ?? '',
                                                        'jumlah' => $stok->jumlah ?? '',
                                                    ];
                                                }),
                                            )
                                            : Js::from([1]); // kosongkan jika bukan 'box'
                                @endphp
                                <div x-data="{
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
                                }" x-init="sizes = {{ $sizesJson }}">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Size
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Satuan
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Harga Beli
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Jumlah Pcs
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center justify-center">
                                                        <p
                                                            class="font-medium text-gray-500  text-theme-xs dark:text-gray-400">
                                                            Aksi
                                                        </p>
                                                    </div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, index) in sizes" :key="index">
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="hidden" name="id_stok[]" x-model="row.id_stok">
                                                        <input type="text" name="size[]" x-model="row.size"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="text" value="Pcs" readonly disabled
                                                            class="form-input bg-[#e6e7e8] shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 dark:border-gray-700">
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="harga_beli[]"
                                                            x-model="row.harga_beli"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <input type="number" name="jumlah[]"
                                                            x-model="row.jumlah"
                                                            class="dark:bg-dark-900 shadow-theme-xs  w-full focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 "
                                                            required>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6 text-center">
                                                        <button type="button" @click="removeSize(index)"
                                                            class="bg-red-500 text-white rounded px-2 py-1 text-sm hover:bg-red-600"
                                                            x-show="sizes.length > 1"><svg
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg></button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <!-- Tombol Tambah -->
                                    <div class="mt-3 mx-6">
                                        <button type="button" @click="addSize()"
                                            class="bg-green-500 text-white rounded px-4 py-2 text-sm hover:bg-green-600">+
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                    </div>





                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium mt-10 text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 mb-5">
                        Simpan
                    </button>

                </form>

            </div>
        </div>



    </div>
</x-layout>
