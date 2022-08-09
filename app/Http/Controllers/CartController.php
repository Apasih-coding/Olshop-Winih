<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Courier;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user()->id;
            $cart = DB::table('carts')->where('user_id', '=', $user)->get();
            $subTotal = DB::table('carts')->where('user_id', '=', $user)
                ->selectRaw('price *  total')
                ->get();
            $collect = collect($subTotal);
            $totalPrice = $collect->sum('price *  total');
        } else {
            $cart = Cart::all();
            $subTotal = 0;
            $totalPrice = 0;
        }
        return view('winihApp.cart.index')->with([
            'cart' => $cart,
            'sub_total' => $subTotal,
            'total_price' => $totalPrice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = $request->all();
        $user = auth()->user()->id;
        $cart['user_id'] = $user;
        Cart::create($cart);
        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        $origin = 501;
        $destination = 114;
        $weight = 1700;
        $courier = "tiki";
        $response = Http::asForm()->withHeaders([
            'key' => 'f6e9ef80b187dbe293652e78744c2b25'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);
        // $kurir = $response['rajaongkir']['results'][0]['costs'];
        $province = Province::all();
        $couriers = Courier::all();
        return view('winihApp.cart.proccess', compact('cart', 'province', 'couriers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart, Request $request)
    {
        if ($request->destination && $request->weight && $request->courier) {
            $origin = 41;
            $destination = $request->destination;
            $weight = $request->weight;
            $courier = $request->courier;
        } else {
            $origin = 41;
            $destination = '';
            $weight = '';
            $courier = '';
        }
        $response = Http::asForm()->withHeaders([
            'key' => 'f6e9ef80b187dbe293652e78744c2b25'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);
        $data = $request->all();
        // $nama = $request->nama;
        // dd($data);
        $cities = City::select('city_name')->where('id', '=', $destination)->get();
        $city = $cities[0]['city_name'];
        $kurir = $response['rajaongkir']['results'][0]['costs'];
        $province = Province::all();
        $couriers = Courier::all();
        // return view('winihApp.cart.ongkir', compact('cart', 'province', 'data', 'kurir'));
        return view('winihApp.cart.ongkir', compact('cart', 'city', 'data', 'kurir', 'couriers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart');
    }

    public function tambah(Request $request, Cart $cart)
    {
        $total = $cart->total;
        $id = $cart->id;
        $tambah = $total + 1;
        $cart['total'] = $tambah;
        DB::table('carts')->where('id', '=', $id)->update(['total' => $tambah]);
        return redirect('/cart');
    }

    public function minus(Request $request, Cart $cart)
    {
        $total = $cart->total;
        $id = $cart->id;
        $minus = $total - 1;
        $cart['total'] = $minus;
        DB::table('carts')->where('id', '=', $id)->update(['total' => $minus]);
        return redirect('/cart');
    }

    public function ajax($id)
    {
        $cities = City::where('province_id', '=', $id)->pluck('city_name', 'id');
        return json_encode($cities);
    }
}
