<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Rules\UpperCase;
use App\http\Requests\CreateValidationRequest;
class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('cars.index',[
            'cars' => $cars,
        ]); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Methods we can use on $request object

        //guessExtension()  ->  get the extension of file e-g jpg.
        //getMimeType()  ->  get the file type and extension e-g image/jpg.
        //getClientOriginalName() -> get the actual name of the image
        //guessClientExtension() -> get extension of file e-g jpeg
        //getSize -> Size in KB

        $test = $request->file('image')->getMimeType();

        //$request->validated();
        
        $request->validate([
            'name' => 'required',
            'founded' => 'required|integer|min:0|max:2021',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048'
        ]);

        $newImageName = time().'-'.$request->name .'.'.$request->image->extension();

        $request->image->move(public_path('images'),$newImageName);

    

        $car = Car::create([

            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' =>$newImageName
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        return view('cars.show')->with('car',$car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        
        return view('cars.edit')->with('car',$car);
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {

       
        $request->validated();

        
        Car::where('id',$id)->update([

            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
           
        ]);
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/cars');
    }
}
