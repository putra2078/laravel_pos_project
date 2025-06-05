<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'code' => 'required|unique:products,code',
        'category' => 'required|string',
        'stock' => 'required|integer|min:1',
        'buy_price' => 'required|integer|min:1',
        'sell_price' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Default null
    $imagePath = null;

    // Kalau ada file image, upload ke public/images
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
    }

    // Simpan ke database
    Product::create([
        'name' => $request->input('name'),
        'code' => $request->input('code'),
        'category' => $request->input('category'),
        'stock' => $request->input('stock'),
        'buy_price' => $request->input('buy_price'),
        'sell_price' => $request->input('sell_price'),
        'image' => $imagePath,
    ]);

    // Kirim ke view
    return view('hasil', [
        'name' => $request->input('name'),
        'code' => $request->input('code'),
        'category' => $request->input('category'),
        'stock' => $request->input('stock'),
        'buy_price' => $request->input('buy_price'),
        'sell_price' => $request->input('sell_price'),
        'image' => $imagePath,
    ]);
}


    public function data(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->input('category') !== null && $request->input('category') !== '') {
            $query->where('category', $request->input('category'));
        }

        $product  = $query->paginate(20);

        return view('product_list', compact('product'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'code' => 'required|unique:products,code,',
            'category' => 'required|string',
            'stock' => 'required|integer|min:1',
            'buy_price' => 'required|integer|min:1',
            'sell_price' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Default null
        $imagePath = $product->image;

        // Kalau ada file image, upload ke public/images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        // Simpan ke database
        $product->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'category' => $request->input('category'),
            'stock' => $request->input('stock'),
            'buy_price' => $request->input('buy_price'),
            'sell_price' => $request->input('sell_price'),
            'image' => $imagePath,
        ]);

        return redirect()->route('product_list')->with('success', 'Product updated successfully.');
    }
}
