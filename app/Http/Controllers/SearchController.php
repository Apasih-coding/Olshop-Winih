<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $search = request('search');
        $product = Product::where('name_product', 'like', "%$search%")->paginate(8);
        return view('winihApp.product.index', ['product' => $product]);
    }

    public function pupuk()
    {
        $search = request('pupuk');
        $product = Product::where('category_id', '=', $search)->paginate(8);
        return view('winihApp.product.index', ['product' => $product]);
    }

    public function benih()
    {
        $search = request('benih');
        $product = Product::where('category_id', '=', $search)->paginate(8);
        return view('winihApp.product.index', ['product' => $product]);
    }

    public function peralatan()
    {
        $search = request('peralatan');
        $product = Product::where('category_id', '=', $search)->paginate(8);
        return view('winihApp.product.index', ['product' => $product]);
    }

    public function sortir()
    {
        $search = request('category');
        $product = Product::where('category_id', '=', $search)->paginate(15);
        $category = Category::all();
        return view('admin.product.index')->with([
            'product' => $product,
            'category' => $category
        ]);
    }
}
