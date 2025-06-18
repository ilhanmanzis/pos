<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Edit Pengeluaran` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
            </div>

        </div>
        <!-- Breadcrumb End -->
        <div class=" mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">


            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Pengeluaran
                </h3>
            </div>
            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <form action="{{ route('finance.pengeluaran.update', ['id' => $pengeluaran['id_pengeluaran']]) }}"
                    method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
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
                                        {{ $pengeluaran->kategori->id_kategori_pengeluaran === $kategori['id_kategori_pengeluaran'] ? 'selected' : '' }}
                                        value="{{ $kategori['id_kategori_pengeluaran'] }}"
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
                    <!-- Elements -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 my-5">



                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Harga<span class="text-error-500">*</span>
                            </label>
                            <input type="text" name="harga" value="{{ $pengeluaran['harga'] }}"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('harga') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}"
                                required />
                            @error('harga')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Keterangan
                            </label>
                            <textarea placeholder="........" type="text" rows="6" name="keterangan"
                                class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10  w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('keterangan') ? 'border-error-300 focus:border-error-300 dark:border-error-700 dark:focus:border-error-800' : 'border-gray-300 focus:border-brand-300 dark:border-gray-700' }}">{{ $pengeluaran['keterangan'] }}</textarea>
                            @error('keterangan')
                                <p class="text-theme-xs text-error-500 my-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>


                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium mt-5 text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 mb-5">
                        Simpan
                    </button>

                </form>

            </div>
        </div>



    </div>
</x-layout>
