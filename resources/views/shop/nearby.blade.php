@extends('partials.main')
@section('title','Nearby Shops')

@section('content')
    @include('partials.nav')

    <div class="">
        <div class="flex mb-4">
            <div class="max-w-sm rounded overflow-hidden shadow-lg mr-4">
                <h2 class="mb-2 mt-2 text-center">Title</h2>

                <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">

                <div class="px-6 py-4">
                    <button class="inline-block bg-red-light px-3 py-1 font-semibold text-white mr-2 shadow-md">Dislike</button>
                    <button class="inline-block bg-green-light px-3 py-1 font-semibold text-white shadow-md">Like</button>
                </div>
            </div>
        </div>

    </div>

@endsection
