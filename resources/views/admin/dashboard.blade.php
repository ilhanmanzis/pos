<x-layout>
    <x-slot:page>{{ $page }}</x-slot:page>
    <x-slot:selected>{{ $selected }}</x-slot:selected>
    <x-slot:title>{{ $title }}</x-slot:title>
    <script src="{{ url('/') }}/js/apexcharts.js"></script>
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">

            <!-- Metric Group One -->
            <div class="grid grid-cols-4 gap-4 sm:grid-cols-4 md:gap-6">
                <!-- Metric Item Start -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex justify-between">


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </div>

                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Pemasukan Hari Ini</span>
                            <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                Rp. {{ number_format($pemasukanHariIni, 0, ',', '.') }}
                            </h4>
                        </div>


                    </div>
                </div>

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex justify-between">


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </div>

                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Pemasukan Bulan Ini</span>
                            <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                Rp. {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                            </h4>
                        </div>


                    </div>
                </div>
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex justify-between">


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </div>

                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Pengeluatan Hari Ini</span>
                            <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                Rp. {{ number_format($pengeluaranHariIni, 0, ',', '.') }}
                            </h4>
                        </div>


                    </div>
                </div>
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex justify-between">


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </div>

                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Pengeluaran Bulan Ini</span>
                            <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                Rp. {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                            </h4>
                        </div>


                    </div>
                </div>




            </div>
            <!-- Metric Group One -->

            <!-- ====== Chart One Start -->

            <div
                class="my-5 overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
                <div class="flex items-center justify-between">

                </div>
                <div
                    class="my-5 overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 pb-8 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Grafik Pemasukan & Pengeluaran per Bulan
                        </h3>
                        <div class="my-4">
                            <label for="tahun" class="font-semibold text-gray-800 dark:text-white">Pilih
                                Tahun:</label>
                            <select id="tahun"
                                class="dark:bg-dark-900 shadow-theme-xs  focus:ring-brand-500/10  h-11 w-20 appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 focus:border-brand-300 dark:border-gray-700">
                                @foreach ($tahunList as $tahunOption)
                                    <option value="{{ $tahunOption }}" {{ $tahunOption == $tahun ? 'selected' : '' }}>
                                        {{ $tahunOption }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="max-w-full overflow-x-auto custom-scrollbar">
                        <div class="-ml-5 min-w-[650px] pl-2 xl:min-w-full">
                            <div id="chartOnee" class="h-96"></div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const dataChartt = @json($chartData);

                        const categories = dataChartt.map(item => item.bulan);
                        const pemasukan = dataChartt.map(item => item.pemasukan);
                        const pengeluaran = dataChartt.map(item => item.pengeluaran);

                        var options = {
                            chart: {
                                type: 'bar',
                                height: 400,
                                toolbar: {
                                    show: false
                                },
                                // beri margin atas bawah dengan padding di chart
                                // ApexCharts tidak punya properti margin, tapi pakai "padding"
                                // padding ini di bawah plot area
                                // untuk custom margin bisa styling di container juga
                            },
                            plotOptions: {
                                bar: {
                                    borderRadius: 8, // rounded corners batang
                                    columnWidth: '75%', // lebar batang
                                    borderRadiusApplication: 'end' // ujung atas batang yang rounded
                                }
                            },
                            series: [{
                                    name: 'Pemasukan',
                                    data: pemasukan
                                },
                                {
                                    name: 'Pengeluaran',
                                    data: pengeluaran
                                }
                            ],
                            xaxis: {
                                categories: categories,
                                labels: {
                                    style: {
                                        colors: '#6B7280', // warna abu untuk label x-axis
                                        fontSize: '12px',
                                    }
                                },
                                axisBorder: {
                                    show: true,
                                    color: '#E5E7EB' // abu terang border x axis
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: '#6B7280',
                                        fontSize: '12px',
                                    }
                                }
                            },
                            colors: ['#16a34a', '#dc2626'], // hijau dan merah

                            grid: {
                                borderColor: '#E5E7EB',
                                strokeDashArray: 4
                            },
                            tooltip: {
                                theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#chartOnee"), options);
                        chart.render();
                    });
                    // Update chart ketika tahun berubah
                    document.getElementById('tahun').addEventListener('change', function(event) {
                        const selectedYear = event.target.value;
                        window.location.href = `{{ url('/') }}/admin/dashboard?tahun=` + selectedYear;
                    });
                </script>


            </div>
            <!-- ====== Chart One End -->


        </div>
    </main>
</x-layout>
