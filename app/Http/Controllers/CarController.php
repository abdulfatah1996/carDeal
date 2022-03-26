<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        if (Auth::user()->role == 'Administrator') {
            $OraderCount = Order::where('status', '=', 'incomplete')->count();
        } else {
            $OraderCount = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', 'incomplete')->count();
        }
        $cars = Car::where('number_of_cars', '>', 0)->latest()->paginate(10);
        $myProfile = User::find(Auth::user()->id)->Profile;
        return view('cars.index', compact('myProfile', 'cars', 'OraderCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'Administrator') {
            $OraderCount = Order::where('status', '=', 'incomplete')->count();
        } else {
            $OraderCount = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', 'incomplete')->count();
        }
        $myProfile = User::find(Auth::user()->id)->Profile;
        return view('cars.create', compact('myProfile','OraderCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'color' => 'required',
            'description' => 'required',
            'number_of_cars' => 'required',
            'picture' => 'required',
        ]);
        if ($request->hasFile($request->input('picture'))) {
            $car = new Car();
            $file = $request->file('picture');
            $extension  = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('users/cars', $fileName);
            $request->picture = $fileName;
            $input = $request->all();
            $car->fill($input)->save();
            $car->picture = $fileName;
            $car->save();
            return redirect()->back()->with('success', 'New Car Created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == 'Administrator') {
            $OraderCount = Order::where('status', '=', 'incomplete')->count();
        } else {
            $OraderCount = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', 'incomplete')->count();
        }
        $car = Car::find($id);
        $myProfile = User::find(Auth::user()->id)->Profile;
        return view('cars.edit', compact('car', 'myProfile','OraderCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'color' => 'required',
            'description' => 'required',
            'number_of_cars' => 'required',
        ]);
        $car = Car::find($request->id);
        $input = $request->all();
        $car->fill($input)->save();
        if ($request->hasFile($request->input('picture'))) {
            $file = $request->file('picture');
            $extension  = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('users/cars', $fileName);
            $request->picture = $fileName;
            $car->picture = $fileName;
            $car->save();
        }
        return redirect()->route('cars-index')->with('success', 'New Car Created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json([
            'status' => true,
            'success' => 'Car deleted successfully',
        ]);
    }
}
