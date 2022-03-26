<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myProfile = User::find(Auth::user()->id)->Profile;
        $carsCount = Car::all()->sum('number_of_cars');
        $cars = Car::where('number_of_cars', '>', 0)->latest()->paginate(5);

        $carsAll = Car::all();
        $sumCarPrise = 0;
        foreach ($carsAll as $car) {
            $sumCarPrise = $sumCarPrise  + ($car->price * $car->number_of_cars);
        }
        if (Auth::user()->role == 'Administrator') {
            $OraderTotalSum  = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('cars', 'orders.car_id', '=', 'cars.id')
                ->select('orders.*', 'cars.type', 'cars.price', 'cars.color', 'users.name as userName', 'cars.name as carName')
                ->latest()->get();
            // return $OraderTotalSum;
            $OraderIncompleteSum =  DB::table('orders')
                ->where('status', '=', 'incomplete')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('cars', 'orders.car_id', '=', 'cars.id')
                ->select('orders.*', 'cars.type', 'cars.price', 'cars.color', 'users.name as userName', 'cars.name as carName')
                ->latest()->get();
            $OraderCount = Order::where('status', '=', 'incomplete')->count();
            return view('home', compact('myProfile', 'OraderCount', 'OraderTotalSum', 'OraderIncompleteSum', 'carsCount', 'sumCarPrise'));
        } else {
            $OraderCount = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', 'incomplete')->count();
            return view('homeCustomer', compact('myProfile', 'cars', 'OraderCount'));
        }
    }
}
