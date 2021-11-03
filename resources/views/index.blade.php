@extends('templates.main')

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="text-center lg:text-left">
                    <h2 class="mb-5 font-medium text-3xl">Bangun Karirmu Sebagai Developer Profesional</h2>
                    <div class="mb-16 font-light">Mulai belajar terarah dengan learning path</div>
                    <a href="#" class="px-4 py-3 rounded-lg bg-indigo-500 text-white ring-2 ring-transparent transition delay-100 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">
                        <span>Belajar Sekarang</span>
                    </a>
                </div>
                <div class="ml-auto hidden lg:block">
                    <img src="https://dicoding-web-img.sgp1.cdn.digitaloceanspaces.com/original/commons/homepage-hero.png" data-original="https://dicoding-web-img.sgp1.cdn.digitaloceanspaces.com/original/commons/homepage-hero.png" alt="Hero Illustration" class="lazy img-fluid" width="578" height="376" style="display: inline;">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
                @include('courses.templates.courselist')
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('courses') }}" class="px-4 py-3 rounded-lg bg-indigo-500 text-white ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">
                    <span>Lainnya</span>
                </a>
            </div>
        </div>
    </section>
@endsection
