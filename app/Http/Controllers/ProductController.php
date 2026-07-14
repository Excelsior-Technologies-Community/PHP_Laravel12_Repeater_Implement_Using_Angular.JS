<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Show Blade
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Dashboard Statistics
     */
    public function statistics(): JsonResponse
    {
        $totalProducts = Product::count();

        $totalVariants = Product::withCount('variants')
            ->get()
            ->sum('variants_count');

        $totalStock = Product::with('variants')
            ->get()
            ->sum(function ($product) {
                return $product->variants->sum('stock_quantity');
            });

        $totalValue = Product::with('variants')
            ->get()
            ->sum(function ($product) {
                return $product->variants->sum(function ($variant) {
                    return $variant->price * $variant->stock_quantity;
                });
            });

        return response()->json([
            'total_products' => $totalProducts,
            'total_variants' => $totalVariants,
            'total_stock' => $totalStock,
            'total_inventory_value' => $totalValue,
        ]);
    }

    /**
     * Store Product
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

            'variants' => 'required|array|min:1',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock_quantity' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        foreach ($validated['variants'] as $variant) {
            $product->variants()->create($variant);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
        ]);
    }

    /**
     * Product List
     * Search + Pagination
     */
    public function getProducts(Request $request): JsonResponse
    {
        $query = Product::with('variants');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('variants', function ($variant) use ($search) {

                        $variant->where('size', 'like', "%{$search}%")
                            ->orWhere('color', 'like', "%{$search}%");

                    });

            });

        }

        $products = $query
            ->oldest()
            ->paginate($request->get('per_page', 3));

        return response()->json($products);
    }

    /**
     * Single Product
     */
    public function show($id): JsonResponse
    {
        $product = Product::with('variants')->findOrFail($id);

        return response()->json($product);
    }

    /**
     * Update Product
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

            'variants' => 'required|array|min:1',

            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock_quantity' => 'required|integer|min:0',

        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        // Delete old variants
        $product->variants()->delete();

        // Insert new variants
        foreach ($validated['variants'] as $variant) {

            $product->variants()->create($variant);

        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
        ]);
    }

    /**
     * Delete Product
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->variants()->delete();

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
        ]);
    }
}