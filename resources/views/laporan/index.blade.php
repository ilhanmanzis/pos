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

        {{-- piutang --}}
        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-10">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white/90">
                    Piutang
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form action="{{ route('laporan.penagihan') }}" method="post" target="blank">
                    @csrf

                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4" style="grid-template-columns: 60% 40%;">
                        <div class="mt-6">
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
                        <div class="my-10 flex justify-start ">
                            <button type="submit" name="action" value="pdf" target="blank"
                                class="px-4 py-2 bg-blue-600 text-white rounded flex mt-3 justify-between ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate PDF
                            </button>
                            <button type="submit" name="action" value="excel" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate Excel
                            </button>
                        </div>
                    </div>
                    <div class="border-t mb-5">

                    </div>
                    <div class="w-2/3 flex justify-start mb-3">
                        <a href="{{ route('laporan.penagihan.pdf') }}" target="blank"
                            class="px-4 py-2 bg-blue-600 text-white rounded flex justify-between ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Generate All PDF
                        </a>
                        <a href="{{ route('laporan.penagihan.excel') }}" target="blank"
                            class="px-4 py-2 bg-success-600 text-white rounded flex justify-between ml-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Generate All Excel
                        </a>
                    </div>
                </form>





            </div>
        </div>


        {{-- transaksi --}}
        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-10">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white/90">
                    Transaksi
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form action="{{ route('laporan.transaksi') }}" method="post" target="blank">
                    @csrf

                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4" style="grid-template-columns: 20% 80%;">
                        <div class="mt-6">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Pilih Bulan Tahun<span class="text-error-500">*</span>
                            </label>
                            <input type="month" name="transaksi" value="{{ old('transaksi') }}"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('transaksi') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                required />
                            @error('transaksi')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="my-10 flex justify-start ">
                            <button type="submit" name="action" value="pdf" target="blank"
                                class="px-2 py-2 bg-blue-600 text-white rounded flex mt-3 justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate PDF
                            </button>
                            <button type="submit" name="action" value="excel" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate Excel
                            </button>

                            <a href="{{ route('laporan.transaksi.pdf') }}" target="blank"
                                class="px-4 py-2 bg-brand-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate All PDF
                            </a>

                            <a href="{{ route('laporan.transaksi.excel') }}" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate All Excel
                            </a>
                        </div>
                    </div>
                </form>





            </div>
        </div>


        {{-- pengeluaran --}}
        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-10">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white/90">
                    Pengeluaran
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form action="{{ route('laporan.pengeluaran') }}" method="post" target="blank">
                    @csrf

                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4" style="grid-template-columns: 20% 80%;">
                        <div class="mt-6">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Pilih Bulan Tahun<span class="text-error-500">*</span>
                            </label>
                            <input type="month" name="pengeluaran" value="{{ old('pengeluaran') }}"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('pengeluaran') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                required />
                            @error('pengeluaran')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="my-10 flex justify-start ">
                            <button type="submit" name="action" value="pdf" target="blank"
                                class="px-2 py-2 bg-blue-600 text-white rounded flex mt-3 justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate PDF
                            </button>
                            <button type="submit" name="action" value="excel" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate Excel
                            </button>

                            <a href="{{ route('laporan.pengeluaran.pdf') }}" target="blank"
                                class="px-4 py-2 bg-brand-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate All PDF
                            </a>

                            <a href="{{ route('laporan.pengeluaran.excel') }}" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate All Excel
                            </a>
                        </div>
                    </div>
                </form>





            </div>
        </div>

        {{-- produk --}}
        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-10">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white/90">
                    Produk
                </h3>
            </div>

            <div class=" mb-5 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800 flex justify-start">

                {{-- <a href="{{ route('laporan.produk.pdf') }}" target="blank"
                    class="px-4 py-2 bg-brand-600 text-white rounded flex mt-3 justify-between ml-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Generate All PDF
                </a> --}}
                <a href="{{ route('laporan.produk.excel') }}" target="blank"
                    class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Generate Excell
                </a>


            </div>
        </div>

        {{-- retur --}}
        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-10">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white/90">
                    Retur
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form action="{{ route('laporan.retur') }}" method="post" target="blank">
                    @csrf

                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4" style="grid-template-columns: 20% 80%;">
                        <div class="mt-5">
                            <label class="my-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Kondisi<span class="text-error-500">*</span>
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative bg-transparent">
                                <select name="kondisi"
                                    class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10  h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('kondisi') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">
                                    <option {{ old('kondisi') === 'all' ? 'selected' : '' }} value="all"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Bagus & Rusak
                                    </option>
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
                        <div class="my-10 flex justify-start ">
                            <button type="submit" name="action" value="pdf" target="blank"
                                class="px-2 py-2 bg-blue-600 text-white rounded flex mt-3 justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate PDF
                            </button>
                            <button type="submit" name="action" value="excel" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate Excel
                            </button>


                        </div>
                    </div>
                </form>





            </div>
        </div>

        {{-- transaksi --}}
        <div class="mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-10">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white/90">
                    Margin
                </h3>
            </div>

            <div class="space-y-6 border-t border-gray-100 px-5 sm:px-6 dark:border-gray-800" x-data="returForm()">

                <form action="{{ route('laporan.margin') }}" method="post" target="blank">
                    @csrf

                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4" style="grid-template-columns: 20% 80%;">
                        <div class="mt-6">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Pilih Bulan Tahun<span class="text-error-500">*</span>
                            </label>
                            <input type="month" name="margin" value="{{ old('margin') }}"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('margin') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                required />
                            @error('margin')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="my-10 flex justify-start ">
                            <button type="submit" name="action" value="pdf" target="blank"
                                class="px-2 py-2 bg-blue-600 text-white rounded flex mt-3 justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate PDF
                            </button>
                            <button type="submit" name="action" value="excel" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate Excel
                            </button>

                            <a href="{{ route('laporan.margin.pdf') }}" target="blank"
                                class="px-4 py-2 bg-brand-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate All PDF
                            </a>

                            <a href="{{ route('laporan.margin.excel') }}" target="blank"
                                class="px-4 py-2 bg-success-600 text-white rounded flex mt-3 justify-between ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Generate All Excel
                            </a>
                        </div>
                    </div>
                </form>





            </div>
        </div>
    </div>

    <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tom-select.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#pelanggan', {
                create: false,
                placeholder: 'Cari pelanggan...',
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

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


            }
        }
    </script>
</x-layout>
