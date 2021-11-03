@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus') }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
            @dosen
                <div class="mb-5 text-right">
                    <a href="{{ route('course_create') }}" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-plus mr-2"></i>{{ __('course.index.baru') }}</a>
                </div>
            @enddosen
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
                @include('courses.templates.courselist')
            </div>
            <div class="mt-5">
                {{ $courses->links() }}
            </div>
        </div>
    </section>
@endsection
