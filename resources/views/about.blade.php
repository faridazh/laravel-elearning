@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('about') }}@endsection

@section('content')
    <section class="bg-gray-50">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <h1 class="sr-only">{{ $page_title }}</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 lg:gap-8 items-start lg:grid-cols-4">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:col-span-3">
                    <section aria-labelledby="web">
                        <h2 class="sr-only" id="web">Tentang Web</h2>
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6">
                                <div class="text-2xl font-semibold mb-2">
                                    <a href="#web">Tentang Web</a>
                                </div>
                                <div class="text-justify whitespace-normal">
                                    Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.
                                </div>
                            </div>
                        </div>
                    </section>
                    <section aria-labelledby="dev">
                        <h2 class="sr-only" id="dev">Tentang Developer</h2>
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6">
                                <div class="text-2xl font-semibold mb-2">
                                    <a href="#dev">Tentang Developer</a>
                                </div>
                                <div class="text-justify whitespace-normal">
                                    Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.
                                </div>
                            </div>
                        </div>
                    </section>
                    <section aria-labelledby="section-1-title">
                        <h2 class="sr-only" id="section-1-title">Section title</h2>
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6">
                                <div class="h-96 border-4 border-dashed border-gray-200 rounded-lg"></div>
                            </div>
                        </div>
                    </section>
                    <section aria-labelledby="section-1-title">
                        <h2 class="sr-only" id="section-1-title">Section title</h2>
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6">
                                <div class="h-96 border-4 border-dashed border-gray-200 rounded-lg"></div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4 lg:gap-8 sticky top-8">
                    <section aria-labelledby="section-2-title">
                        <h2 class="sr-only" id="section-2-title">Section title</h2>
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6 space-y-4">
                                <ul class="list-inside space-y-2">
                                    <li>
                                        <a href="#web" class="hover:text-indigo-600 focus:underline">Tentang Web</a>
                                    </li>
                                    <li>
                                        <a href="#dev" class="hover:text-indigo-600 focus:underline">Tentang Developer</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
