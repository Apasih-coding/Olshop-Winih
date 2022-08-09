<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('winihApp.product.index', ['product' => Product::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.insert', ['categories' => Category::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'image2' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'image3' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'name_product' => 'required',
            'total' => 'required',
            'price_buy' => 'required',
            'price_sell' => 'required',
            'desc' => 'required'
        ]);
        $product = $request->all();
        $slug = Str::slug($request->name_product);
        $product['slug'] = $slug;
        $logo = 'image/logo.png';
        $file = request()->file('image') ? request()->file('image')->store('image') : $logo;
        $file2 = request()->file('image2') ? request()->file('image2')->store('image') : $logo;
        $file3 = request()->file('image3') ? request()->file('image3')->store('image') : $logo;
        $product['image'] = $file;
        $product['image2'] = $file2;
        $product['image3'] = $file3;
        $product['category_id'] = request('category');

        Product::create($product);
        session()->flash('success', 'Inserting data successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('winihApp.product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $attr = $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'image2' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'image3' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'name_product' => 'required',
            'total' => 'required',
            'price_buy' => 'required',
            'price_sell' => 'required',
            'desc' => 'required'
        ]);
        if (request()->file('image')) {
            Storage::delete($product->image);
            $file = request()->file('image');
            $fileUrl = $file->store("image");
        } else {
            $fileUrl = $product->image;
        }
        if (request()->file('image2')) {
            Storage::delete($product->image2);
            $file2 = request()->file('image2');
            $fileUrl2 = $file2->store("image");
        } else {
            $fileUrl2 = $product->image2;
        }
        if (request()->file('image3')) {
            Storage::delete($product->image3);
            $file3 = request()->file('image3');
            $fileUrl3 = $file3->store("image");
        } else {
            $fileUrl3 = $product->image3;
        }
        $attr['image'] = $fileUrl;
        $attr['image2'] = $fileUrl2;
        $attr['image3'] = $fileUrl3;

        $product->update($attr);
        session()->flash('success', 'Updated data successfully');
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        Storage::delete($product->image2);
        Storage::delete($product->image3);
        $product->delete();
        session()->flash('success', 'Deleting data successfully');
        return redirect('/admin/product');
    }
    // Admin
    public function productAdmin()
    {
        $product = Product::paginate(5);
        $category = Category::all();
        return view('admin.product.index')->with([
            'product' => $product,
            'category' => $category
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showProduct(Product $product)
    {
        return view('admin.product.detail', compact('product'));
    }
}
