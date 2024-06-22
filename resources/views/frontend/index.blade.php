@extends('frontend.layouts.frontend_app')

@section('title')
    {{ app_name() }}
@endsection

@section('content')
    <section class="bg-gray-50 pb-20 dark:bg-gray-700">
        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">
            <div class="rounded-lg p-3 shadow-lg dark:bg-gray-800 sm:p-10">
                <div class="col-6">
                    <x-backend.buttons.create route='{{ route("frontend.produzione.create") }}' title="{{__('Insaccamento')}}">INSACCAMENTO</x-backend.buttons.create>
                </div>
            </div>
            <div class="rounded-lg p-3 shadow-lg dark:bg-gray-800 sm:p-10">
                <img src="https://github.com/nasirkhan/laravel-starter/assets/396987/93341711-60dd-4624-8cd7-82f1c611287d"
                    alt="Page preview">
            </div>
            <div class="rounded-lg p-3 shadow-lg dark:bg-gray-800 sm:p-10">
                <img src="https://github.com/nasirkhan/laravel-starter/assets/396987/0f6b8201-6f6a-429f-894b-4e491cc5eba4"
                    alt="Page preview">
            </div>
            <div class="rounded-lg p-3 shadow-lg dark:bg-gray-800 sm:p-10">
                <img src="https://github.com/nasirkhan/laravel-starter/assets/396987/f8131011-2ecc-4a11-961f-85e02cb8f7a1"
                    alt="Page preview">
            </div>
        </div>
    </section>
@endsection
