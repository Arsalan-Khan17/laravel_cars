@extends('layouts.app')

@section('content')

    <div class="m-auto w-4/5 py-24">
            <div class="text-center">
                <h1 class="text-5xl uppercase bold">cars</h1>
            </div>

            <div class="pt-10">
                <a class="border-b-2 pb-2 border-dotted italic text-gray-500" href="cars/create">Add a New Car &rarr;</a>
            </div>
        

       @foreach ($cars as $car)

       <div class="w-5/6 py-10">
        <div class="m-auto">
            <div class="float-right">
                <a class="border-b-2 pb-2 border-dotted italic text-green-500" href="cars/{{ $car->id }}/edit">
                Edit &rarr;
                </a>
                <form action="/cars/{{ $car->id }}" method="POST" class="pt-3">
                    @csrf
                    @method('delete')
                    <button class="border-b-2 pb-2 border-dotted italic text-red-500" type="submit">
                        Delete &rarr;
                    </button>
                </form>
            </div>
            <span class="uppercase text-blue-500 font-bold text-xs italic">
                Founded: {{ $car->founded }}
            </span>
            <h2 class="text-gray-700 text-5xl hover:text-gray-500">
                <a href="/cars/{{ $car->id }}">
                    {{ $car->name }}
                </a>
            </h2>
        </div>

        <p class="text-lg text-gray-700 py-6">
            {{ $car->description }}</p>
        <hr class="mt-4 mb-8">
    </div>
           
       @endforeach
    </div>
    
@endsection