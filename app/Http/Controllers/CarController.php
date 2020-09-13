<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use \Faker\Provider\CarData as CarData;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all()->toArray();
        return array_reverse($cars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $car = new Car([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'body_type' => $request->input('body_type'),
            'fuel_type' => $request->input('fuel_type'),
            'transmission' => $request->input('transmission'),
            'description' => $request->input('description'),
        ]);
        $car->save();

        return response()->json('New car successfully added to your listing');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $car->update($request->all());
        return response()->json('The car successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function delete(Car $car)
    {
        $car->delete();

        return response()->json('The car successfully deleted');
    }

    /**
     * Fetch Car Make and Model options
     * 
     * @return Array
     */
    public function getCarOptions()
    {
        return response()->json([
            'make'          => ['Honda', 'Toyota', 'Nissan', 'Hyundai', 'Kia', 'Ford', 'Jeep', 'Chevrolet', 'Audi', 'Volvo', 'BMW'],
            'body_types'    => CarData::getVehicleTypes(),
            'fuel_types'    => CarData::getVehicleFuelTypes(),
            'transmissions' => array_merge(array_keys(CarData::getVehicleGearBoxType()), ['CVT'])
        ]);
    }
}
