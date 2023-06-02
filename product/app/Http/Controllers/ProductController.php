<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreated;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return response(Product::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only('name', 'qtd'));
        ProductCreated::dispatch($product->toArray())->onQueue('default');
        return response($product, Response::HTTP_CREATED);
    }
}
