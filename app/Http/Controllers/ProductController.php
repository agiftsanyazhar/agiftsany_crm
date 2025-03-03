<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $data = [
            'title' => 'Products',
            'products' => $products,
        ];

        return view('dashboard.product.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|integer',
            ]);

            Product::create($data);

            $status = 'success';
            $message = 'Product successfully created.';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to create product: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|integer',
            ]);

            $product->update($data);

            $status = 'success';
            $message = 'Product successfully updated.';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to update product: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->delete();

            $status = 'success';
            $message = 'Successfully deleted.';
        } catch (Exception $e) {
            $status = 'danger';
            $message = 'Failed to delete: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }
}
