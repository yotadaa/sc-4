<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Store a new product
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price,
            'plan_id' => $id,
        ];
        if ($request->has('foto')) {
            $fotoPath = $request->file('foto')->store('products', 'public');
            $data['foto'] = $fotoPath;
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // Show a single product
    public function show($id)
    {
        // $product = Product::find($id);
        $plans = Plan::findOrFail($id);
        $products = Product::where('plan_id', $id)->get();
        return view('item', compact('products', 'plans'));
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If a new image is uploaded, replace the old one
        if ($request->hasFile('foto')) {
            Storage::delete('public/' . $product->foto);
            $fotoPath = $request->file('foto')->store('products', 'public');
            $product->foto = $fotoPath;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/' . $product->foto); // Delete the image file
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
    public function check(Request $request, $plan_id, $id) {
        $product = Product::where(['id' => $id, 'plan_id' => $plan_id])->first();
        $product->update([
            'checked' => !$product->checked,
        ]);
        return redirect()->back();
    }
}
