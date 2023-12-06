<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use Carbon\Carbon;

class InteractionController extends Controller
{
    public function index()
    {

         $product = Product::all();

    return response()->json(['products' => $product]);

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['product' => $product]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:products|max:255',
            'description' => 'required|string',
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['product' => $product], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:products|max:255',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
