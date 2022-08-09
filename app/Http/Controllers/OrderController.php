<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Courier;
use App\Order;
use App\Payment;
use App\Product;
use App\Status;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $order = DB::table('orders')->where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 1);
            })->get();
            $subTotal = Order::where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 1);
            })->selectRaw('total_price')->get();
            $collect = collect($subTotal);
            $total_belanja = $collect->sum('total_price');
        } else {
            $order = Order::all();
            $total_belanja = 0;
        }
        $statusName = Status::where('id', '=', 1)->get();
        $status = $statusName[0]['name'];
        // dd($total_belanja);
        return view('winihApp.order.index', compact('order', 'status', 'total_belanja'));
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
        $data = $request->all();
        $count = $data['total'] * $data['price'];
        $order = Order::create([
            'cart_id' => $data['cart_id'],
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'status_id' => 1,
            'total' => $data['total'],
            'price' => $data['price'],
            'receiver' => $data['receiver'],
            'phone' => $data['phone'],
            'alamat' => $data['alamat'],
            'city_id' => $data['city_id'],
            'berat' => $data['berat'],
            'courier' => $data['courier'],
            'ongkir' => $data['ongkir'],
            'total_price' => $count + $data['ongkir'],
            'paket' => $data['paket'],
        ]);
        if ($order) {
            $cart_id = $data['cart_id'];
            $cart = DB::table('carts')->where('id', '=', $cart_id);
            $cart->delete();
        }
        return redirect('/myorders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $getPayment = Payment::where('order_id', '=', $order->id)->get();
        $payment = $getPayment[0];
        $getProduct = Product::where('id', '=', $order->product_id)->get();
        $product = $getProduct[0];
        $getCity = City::where('id', '=', $order->city_id)->get();
        $city = $getCity[0];
        return view('winihApp.order.detail', compact('order', 'payment', 'product', 'city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $productID = $order->product_id;
        $products = DB::table('products')->where('id', '=', $productID)->get();
        $product = $products[0];
        // dd($product);
        $couriers = Courier::where('', '=', $order->courier);
        return view('winihApp.order.payment', compact('order', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $payment = $request->validate([
            'bank' => 'required',
            'no_rekening' => 'required|digits_between:15,16',
            'tujuan_rekening' => 'required|digits_between:15,16',
            'nama_rekening' => 'required',
            'tanggal_transfer' => 'required',
            'bukti_transfer' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);
        $payment = $request->all();
        $bukti_transfer = request()->file('bukti_transfer')->getClientOriginalName();
        $file = request()->file('bukti_transfer')->storeAs('bukti', $order->order_id . '' . $bukti_transfer, '');
        $payment['bukti_transfer'] = $file;
        $store = Payment::create($payment);
        if ($store) {
            $order_id = $request->order_id;
            $orders = DB::table('orders')->where('id', '=', $order_id);
            $order = $orders->update(['status_id' => 4]);
            // $orders->status()->sync($order);
        }
        return redirect('/myorders/paid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('success', 'Deleting data successfully');
        return redirect('/myorders');
    }

    public function paid()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $order = DB::table('orders')->where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 4);
            })->get();
            $subTotal = Order::where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 4);
            })->selectRaw('total_price')->get();
            $collect = collect($subTotal);
            $total_belanja = $collect->sum('total_price');
        } else {
            $order = Order::all();
            $total_belanja = 0;
        }
        $statusName = Status::where('id', '=', 4)->get();
        $status = $statusName[0]['name'];
        return view('winihApp.order.order', compact('order', 'status', 'total_belanja'));
    }

    public function orderPaking()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $order = DB::table('orders')->where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 2);
            })->get();
            $subTotal = Order::where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 2);
            })->selectRaw('total_price')->get();
            $collect = collect($subTotal);
            $total_belanja = $collect->sum('total_price');
        } else {
            $order = Order::all();
            $total_belanja = 0;
        }
        $statusName = Status::where('id', '=', 2)->get();
        $status = $statusName[0]['name'];
        return view('winihApp.order.packing', compact('order', 'status', 'total_belanja'));
    }

    public function orderDeliver()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $order = DB::table('orders')->where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 3);
            })->get();
            $subTotal = Order::where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 3);
            })->selectRaw('total_price')->get();
            $collect = collect($subTotal);
            $total_belanja = $collect->sum('total_price');
        } else {
            $order = Order::all();
            $total_belanja = 0;
        }
        $statusName = Status::where('id', '=', 3)->get();
        $status = $statusName[0]['name'];
        return view('winihApp.order.deliver', compact('order', 'status', 'total_belanja'));
    }

    public function receive(Order $order)
    {
        $order->update(['status_id' => 5]);
        return redirect('/myorders/success');
    }

    public function orderSuccess()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $order = DB::table('orders')->where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 5);
            })->get();
            $subTotal = Order::where('user_id', '=', $id)->where(function ($query) {
                $query->where('status_id', '=', 5);
            })->selectRaw('total_price')->get();
            $collect = collect($subTotal);
            $total_belanja = $collect->sum('total_price');
        } else {
            $order = Order::all();
            $total_belanja = 0;
        }
        $statusName = Status::where('id', '=', 5)->get();
        $status = $statusName[0]['name'];
        return view('winihApp.order.success', compact('order', 'status', 'total_belanja'));
    }

    // Admin Manage Order
    public function indexAdmin()
    {
        $order = Order::where('status_id', '=', 1)->get();
        $subTotal = Order::where('status_id', '=', 1)->selectRaw('total_price')->get();
        $collect = collect($subTotal);
        $total_belanja = $collect->sum('total_price');
        $statusName = Status::where('id', '=', 1)->get();
        $status = $statusName[0]['name'];
        // $product = Product::where('id', '=', $order->product_id)->pluck('name_product', 'id');
        return view('admin.order.index')->with([
            'order' => $order,
            'status' => $status,
            'total_belanja' => $total_belanja
        ]);
    }

    public function paidAdmin()
    {
        $payment = Payment::all();
        $order = Order::where('status_id', '=', 4)->get();
        $subTotal = Order::where('status_id', '=', 4)->selectRaw('total_price')->get();
        $collect = collect($subTotal);
        $total_belanja = $collect->sum('total_price');
        $statusName = Status::where('id', '=', 4)->get();
        $status = $statusName[0]['name'];
        return view('admin.order.progress')->with([
            // 'payment' => $payment,
            'order' => $order,
            'status' => $status,
            'total_belanja' => $total_belanja
        ]);
    }

    public function packing(Request $request, Order $order)
    {
        // $orderID = $order->order_id;
        // $orders = DB::table('orders')->where('id', '=', $orderID);
        $order->update(['status_id' => 2]);
        // if ($order) {
        //     $payment->delete();
        // }
        return redirect('/admin/order/packing');
    }

    public function package()
    {
        $order = Order::where('status_id', '=', 2)->get();
        $subTotal = Order::where('status_id', '=', 2)->selectRaw('total_price')->get();
        $collect = collect($subTotal);
        $total_belanja = $collect->sum('total_price');
        $statusName = Status::where('id', '=', 2)->get();
        $status = $statusName[0]['name'];
        return view('admin.order.packing')->with([
            'order' => $order,
            'status' => $status,
            'total_belanja' => $total_belanja
        ]);
    }

    public function deliver(Order $order)
    {
        $order->update(['status_id' => 3]);
        return redirect('/admin/order/deliver');
    }

    public function delivering()
    {
        $order = Order::where('status_id', '=', 3)->get();
        $subTotal = Order::where('status_id', '=', 3)->selectRaw('total_price')->get();
        $collect = collect($subTotal);
        $total_belanja = $collect->sum('total_price');
        $statusName = Status::where('id', '=', 3)->get();
        $status = $statusName[0]['name'];
        return view('admin.order.deliver')->with([
            'order' => $order,
            'status' => $status,
            'total_belanja' => $total_belanja
        ]);
    }

    public function success()
    {
        $order = Order::where('status_id', '=', 5)->get();
        $subTotal = Order::where('status_id', '=', 5)->selectRaw('total_price')->get();
        $collect = collect($subTotal);
        $total_belanja = $collect->sum('total_price');
        $statusName = Status::where('id', '=', 5)->get();
        $status = $statusName[0]['name'];
        return view('admin.order.success')->with([
            'order' => $order,
            'status' => $status,
            'total_belanja' => $total_belanja
        ]);
    }

    public function showAdmin(Order $order)
    {
        $getPayment = Payment::where('order_id', '=', $order->id)->get();
        $payment = $getPayment[0];
        $getProduct = Product::where('id', '=', $order->product_id)->get();
        $product = $getProduct[0];
        $getCity = City::where('id', '=', $order->city_id)->get();
        $city = $getCity[0];
        // dd($getPayment);
        return view('admin.order.detail', compact('order', 'payment', 'product', 'city'));
    }

    public function showOrder(Order $order)
    {
        $getUser = User::where('id', '=', $order->user_id)->get();
        $user = $getUser[0];
        $getProduct = Product::where('id', '=', $order->product_id)->get();
        $product = $getProduct[0];
        $getCity = City::where('id', '=', $order->city_id)->get();
        $city = $getCity[0];
        // dd($order);
        return view('admin.order.detail_order', compact('order', 'user', 'product', 'city'));
    }
}
