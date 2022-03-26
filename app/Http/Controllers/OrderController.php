<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myProfile = User::find(Auth::user()->id)->Profile;
        if (Auth::user()->role == 'Administrator') {
            $OraderCount = Order::where('status', '=', 'incomplete')->count();

            $orders = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('cars', 'orders.car_id', '=', 'cars.id')
                ->select('orders.*', 'cars.type', 'cars.price', 'cars.color', 'users.name as userName', 'cars.name as carName')
                ->latest()->paginate(10);

            $orderIncomplete = DB::table('orders')
                ->where('status', '=', 'incomplete')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('cars', 'orders.car_id', '=', 'cars.id')
                ->select('orders.*', 'cars.type', 'cars.price', 'cars.color', 'users.name as userName', 'cars.name as carName')
                ->latest();
            return view('orders.adminIndex', compact('orders', 'myProfile', 'OraderCount', 'orderIncomplete'));
        } else {
            $OraderCount = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', 'incomplete')->count();
            $orders = DB::table('orders')
                ->where('user_id', '=', Auth::user()->id)
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('cars', 'orders.car_id', '=', 'cars.id')
                ->select('orders.*', 'cars.type', 'cars.price', 'cars.color', 'users.name as userName', 'cars.name as carName')
                ->latest()->paginate(10);
            $orderIncomplete = DB::table('orders')
                ->where('user_id', '=', Auth::user()->id)
                ->where('status', '=', 'incomplete')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('cars', 'orders.car_id', '=', 'cars.id')
                ->select('orders.*', 'cars.type', 'cars.price', 'cars.color', 'users.name as userName', 'cars.name as carName')
                ->latest();
            return view('orders.index', compact('orders', 'myProfile', 'OraderCount', 'orderIncomplete'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find(Auth::user()->id);
        if ($user->name == null or $user->email == null or $user->Profile->lname == null or $user->Profile->phone == null or $user->Profile->address == null or $user->Profile->national_id == null) {
            return redirect()->route('profile_index')->with('error', 'Your profile is incomplete');
        } else {
            $car = Car::find($id);
            if (Auth::user()->role == 'Administrator') {
                $OraderCount = Order::where('status', '=', 'incomplete')->count();
            } else {
                $OraderCount = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', 'incomplete')->count();
            }
            $myProfile = User::find(Auth::user()->id)->Profile;
            return view('cars.singleCar', compact('car', 'myProfile', 'OraderCount'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->car_id = $id;
        $order->save();
        return response()->json([
            'status' => true,
            'success' => 'Order send successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $order = Order::find($id);
        $order->status = 'complete';
        $order->save();
        return redirect()->route('order-index')->with('success', 'Order Completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
