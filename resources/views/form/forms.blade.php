<x-layouts.header />
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pilih Jenis Material Retur</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Card Item: KWH Meter -->
                        <a href="{{ route('form-retur-kwh-meter.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_kwh_meter.png') }}" alt="KWH Meter Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                KWH Meter
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Fasa Tunggal dan Fasa Tiga
                            </p>
                        </a>

                        <!-- Card Item: MCB -->
                        <a href="{{ route('form-retur-mcb.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_mcb.png') }}" alt="KWH Meter Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Mini Circuit Breaker (MCB)
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Pengaman Arus Listrik
                            </p>
                        </a>

                        <!-- Card Item: Kotak APP -->
                        <a href="{{ route('form-retur-kotak-app.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_kotak_app.png') }}" alt="Kotak APP Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Kotak APP
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Alat Pengukur dan Pembatas
                            </p>
                        </a>

                        <!-- Card Item: Cable Power -->
                        <a href="{{ route('form-retur-cable-power.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_cable_power.png') }}" alt="Cable Power Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Cable Power
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Kabel Daya Listrik
                            </p>
                        </a>

                        <!-- Card Item: Conductor -->
                        <a href="{{ route('form-retur-conductor.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_conductor.png') }}" alt="Conductor Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Conductor
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Penghantar Listrik
                            </p>
                        </a>

                        <!-- Card Item: Trafo Distribusi -->
                        <a href="{{ route('form-retur-trafo.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_trafo_distribusi.png') }}" alt="Trafo Distribusi Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Trafo Distribusi
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Transformator Distribusi
                            </p>
                        </a>

                        <!-- Card Item: Lightning Arrester (LA) -->
                        <a href="{{ route('form-retur-lightning_arrester.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_lightning_arrester.png') }}"
                                        alt="Lightning Arrester Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Lightning Arrester (LA)
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Pengaman Petir
                            </p>
                        </a>

                        <!-- Card Item: Fuse Cut Out (FCO) -->
                        <a href="{{ route('form-retur-fco.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_electrical_fuse.png') }}" alt="Fuse Cut Out Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Fuse Cut Out (FCO)
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Pengaman Arus Lebih
                            </p>
                        </a>

                        <!-- Card Item: Isolator -->
                        <a href="{{ route('form-retur-isolator.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_insulator.png') }}" alt="Isolator Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Isolator
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Pemisah Tegangan Listrik
                            </p>
                        </a>

                        <!-- Card Item: Cubicle -->
                        <a href="{{ route('form-retur-cubicle.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_cubicle.png') }}" alt="Cubicle Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Cubicle
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Panel Distribusi Listrik
                            </p>
                        </a>

                        <!-- Card Item: PHBTR -->
                        <a href="{{ route('form-retur-phbtr.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_phbtr.png') }}" alt="PHBTR Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                PHBTR
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Perangkat Hubung Bagi Tegangan Rendah
                            </p>
                        </a>

                        <!-- Card Item: Current Transformer (CT) -->
                        <a href="{{ route('form-retur-ct.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_ct.png') }}" alt="Current Transformer Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Current Transformer (CT)
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Trafo Arus
                            </p>
                        </a>

                        <!-- Card Item: Potential Transformer (PT) -->
                        <a href="{{ route('form-retur-pt.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_current_transformer.png') }}"
                                        alt="Potential Transformer Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Potential Transformer (PT)
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Trafo Tegangan
                            </p>
                        </a>

                        <!-- Card Item: Load Break Switch (LBS) -->
                        <a href="{{ route('form-retur-lbs.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_lbs.png') }}" alt="Load Break Switch Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Load Break Switch (LBS)
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Saklar Pemutus Beban
                            </p>
                        </a>

                        <!-- Card Item: Tiang Listrik -->   
                        <a href="{{ route('form-retur-tiang-listrik.create') }}"
                            class="group block bg-gradient-to-br from-cyan-50 to-white border border-cyan-100 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 text-center hover:bg-cyan-100/40">
                            <div class="flex justify-center items-center mb-4">
                                <div
                                    class="bg-cyan-100 rounded-full p-4 group-hover:bg-cyan-200 transition-colors duration-300">
                                    <img src="{{ asset('icons/ic_tiang.png') }}" alt="Tiang Listrik Icon"
                                        class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-cyan-800 group-hover:text-cyan-900">
                                Tiang Listrik
                            </h3>
                            <p class="mt-1 text-sm text-cyan-700">
                                Penyangga Jaringan Listrik
                            </p>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>

<x-layouts.footer />
