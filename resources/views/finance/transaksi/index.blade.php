<x-layout>
    <x-slot:page>{{ $page }}</x-slot:page>
    <x-slot:selected>{{ $selected }}</x-slot:selected>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- start main --}}

    @php
        $openInvoiceUrl = session()->pull('open_invoice_url'); // ambil dan hapus session
    @endphp

    @if ($openInvoiceUrl)
        <script>
            window.open("{{ $openInvoiceUrl }}", "_blank");
        </script>
    @endif


    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: `Transaksi` }">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                    @if (session('success'))
                        <div
                            class="rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15 mb-5">
                            <div class="flex items-start gap-3">
                                <div class="-mt-0.5 text-success-500">
                                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                                            fill="" />
                                    </svg>
                                </div>

                                <div>
                                    <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                        {{ session('success') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
            <!-- Breadcrumb End -->

            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <div class="flex items-center justify-between gap-5">
                            <a href="{{ route('finance.transaksi.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 mb-5">
                                Tambah Transaksi
                            </a>
                            <form action="{{ route('finance.transaksi') }}" method="get">
                                <div class="flex justify-between mb-2">

                                    <div class="relative">
                                        <span class="absolute top-1/2 left-4 -translate-y-1/2">
                                            <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z"
                                                    fill="" />
                                            </svg>
                                        </span>
                                        <input type="text" placeholder="cari transaksi..." id="search-input"
                                            name="transaksi" value="{{ request('transaksi') }}"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[400px] dark:border-gray-800 dark:bg-gray-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30" />

                                        <button id="search-button"
                                            class="absolute top-1/2 right-2.5 inline-flex -translate-y-1/2 items-center gap-0.5 rounded-lg border border-gray-200 bg-gray-50 px-[7px] py-[4.5px] text-xs -tracking-[0.2px] text-gray-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
                                            <span> Search </span>

                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>

                        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                            <!-- ====== Table Six Start -->
                            <div
                                class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                <div class="max-w-full overflow-x-auto">
                                    <div x-data="{ openDropDown: false, selectedId: null }">

                                        <table class="min-w-full">
                                            <!-- table header start -->
                                            <thead>
                                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                No
                                                            </p>
                                                        </div>
                                                    </th>
                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                Faktur
                                                            </p>
                                                        </div>
                                                    </th>
                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                Pelanggan
                                                            </p>
                                                        </div>
                                                    </th>
                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                Tanggal
                                                            </p>
                                                        </div>
                                                    </th>
                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                Total
                                                            </p>
                                                        </div>
                                                    </th>

                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                Status
                                                            </p>
                                                        </div>
                                                    </th>
                                                    <th class="px-5 py-3 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p
                                                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                Aksi
                                                            </p>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <!-- table header end -->

                                            @php
                                                $i = 1;
                                            @endphp
                                            <!-- table body start -->
                                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                                @foreach ($transaksis as $transaksi)
                                                    <tr>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex items-center gap-3">
                                                                    <span
                                                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                                        {{ $i++ }}
                                                                    </span>


                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex -space-x-2">
                                                                    <p
                                                                        class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        {{ $transaksi->kode_faktur }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex -space-x-2">
                                                                    <p
                                                                        class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        {{ $transaksi->pelanggan->name }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex -space-x-2">
                                                                    <p
                                                                        class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        {{ $transaksi->tanggal }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex -space-x-2">
                                                                    <p
                                                                        class="text-gray-500 text-theme-sm dark:text-gray-400">

                                                                        {{ 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex -space-x-2">
                                                                    <p
                                                                        class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        {{ $transaksi->status }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">

                                                                <a href="{{ route('finance.transaksi.invoice', ['id' => $transaksi['id_transaksi']]) }}"
                                                                    target="blank"
                                                                    class="inline-flex items-center gap-2 rounded-lg bg-success-500 px-2 py-1.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-success-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="size-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                                                    </svg>



                                                                </a>
                                                                <a href="{{ route('finance.transaksi.detail', ['id' => $transaksi['id_transaksi']]) }}"
                                                                    class="inline-flex items-center gap-2 rounded-lg bg-warning-500 px-2 py-1.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-warning-600 mx-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
                                                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                                        <path fill-rule="evenodd"
                                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>


                                                                </a>
                                                                <div x-data="{ openDropDown: false }" class="relative h-fit">
                                                                    <button @click="openDropDown = !openDropDown"
                                                                        :class="openDropDown ? 'text-gray-700 dark:text-white' :
                                                                            'text-gray-400 hover:text-gray-700 dark:hover:text-white'">
                                                                        <svg class="fill-current" width="24"
                                                                            height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                                                                                fill="" />
                                                                        </svg>
                                                                    </button>

                                                                    <div x-show="openDropDown"
                                                                        @click.outside="openDropDown = false"
                                                                        class="absolute right-0 z-40 w-40 p-2 space-y-1 bg-white border border-gray-200 top-full rounded-2xl shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark">
                                                                        <form
                                                                            action="{{ route('finance.transaksi.delete', ['id' => $transaksi['id_transaksi']]) }}"
                                                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus data?')"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('delete')

                                                                            <button type="submit"
                                                                                class="flex w-full px-3 py-2 font-medium text-left text-error-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-error-700 dark:text-error-400 dark:hover:bg-white/5 dark:hover:text-error-300">
                                                                                Delete


                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                <!-- table body end -->

                                            </tbody>
                                        </table>
                                        <!-- Pagination links -->
                                        <div class="border-t border-gray-100 dark:border-gray-800 p-4">
                                            {{ $transaksis->links() }}
                                        </div>
                                    </div>
                                </div>

                                <!-- ====== Table Six End -->
                            </div>
                        </div>
                    </div>
                </div>
    </main>

    {{-- end main --}}
</x-layout>
