<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        return view('cars.index');
    }

    public function fetchAll()
    {
        $cars = Car::where('user_id', Auth::id())->get();
        return response()->json($cars);
    }



    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'launchDate' => 'required|date',
            'price' => 'required|numeric|min:0',
            'color' => 'required|string|max:255',
        ]);

        $car = new Car([
            'brand' => $request->get('brand'),
            'model' => $request->get('model'),
            'launchDate' => $request->get('launchDate'),
            'price' => $request->get('price'),
            'color' => $request->get('color'),
            'user_id' => Auth::id(),
        ]);

        $car->save();

        return redirect('/cars');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'launchDate' => 'required|date',
            'price' => 'required|numeric|min:0',
            'color' => 'required|string|max:255',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return response()->json($car);
    }



    public function show($id)
    {
        return response()->json(Car::findOrFail($id));
    }

    public function destroy($id)
    {
        Car::findOrFail($id)->delete();
        return response()->json(['success' => 'Car deleted']);
    }
}
