    @extends('layouts.app')

    @section('content')

        <div class="m-auto w-4/5 py-24">
                <div class="text-center">

                    @if ($car->image_path)
                    <img class="w-8/12 mb-8 shadow-xl" src="{{ asset('images/'.$car->image_path) }}" alt="">  
                    @endif()
                     
                   
                    
                    <h1 class="text-5xl uppercase bold">{{ $car->name }}</h1>
                </div>
            

            <div class="py-10 text-center">

                
            
                <span class="uppercase text-blue-500 font-bold text-xs italic">
                    Founded: {{ $car->founded }}
                </span>
            </div>

            

            <p class="text-lg text-gray-700 py-6">
                {{ $car->description }}
            </p>

            <table class="table-auto">
                <tr class="bg-blue-100">
                    <th class="w-1/4 border-4 border-gray-500">
                        Model
                    </th>
                    <th class="w-1/4 border-4 border-gray-500">
                        Engines
                    </th>
                    <th class="w-1/4 border-4 border-gray-500">
                        Production Date
                    </th>
                    
                </tr>

                @forelse ($car->carModel as $model)
                    <tr>

                        <td class="border-4 border-gray-500">
                            {{ $model->model_name }}
                        </td>
                        <td class="border-4 border-gray-500">
                            @foreach ($car->engines as $engine)
                            
                            @if ($model->id == $engine->model_id)

                            {{ $engine->engine_name }}
                                
                            @endif

                            @endforeach
                        </td>
                        <td class="border-4 border-gray-500">
                            {{ date('d-m-Y',strtotime($car->productionDate->created_at)) }}
                        </td>

                    

                        @empty

                        <p>
                            No Car Models Found
                        </p>
                    </tr>
                    
                @endforelse

            </table>
            <p class="text-left">

                Product Types:
                @forelse ($car->products as $product)
                {{ $product->name }}
                    
                @empty
                    <p>
                        No Car Product Description
                    </p>
                @endforelse 
            </p>
            <hr class="mt-4 mb-8">
        </div>
            
        
        </div>
        
    @endsection