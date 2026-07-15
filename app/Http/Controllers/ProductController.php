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

        $lowStockVariants = Product::with('variants')
            ->get()
            ->sum(function ($product) {
                return $product->variants
                    ->where('stock_quantity', '<=', 5)
                    ->count();
            });

        return response()->json([
            'total_products' => $totalProducts,
            'total_variants' => $totalVariants,
            'total_stock' => $totalStock,
            'total_inventory_value' => $totalValue,
            'low_stock_variants' => $lowStockVariants,
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

            $duplicate = collect($validated['variants'])->filter(function ($item) use ($variant) {

                return strtolower($item['size'] ?? '') ==
                    strtolower($variant['size'] ?? '')
                    &&
                    strtolower($item['color'] ?? '') ==
                    strtolower($variant['color'] ?? '');
            });

            if ($duplicate->count() > 1) {

                return response()->json([
                    'success' => false,
                    'message' => 'Duplicate Size & Color variant found.'
                ], 422);
            }

            $variant['sku'] =
                'SKU-' .
                strtoupper(substr($validated['name'], 0, 3))
                . '-' .
                strtoupper(substr($variant['size'] ?: 'NA', 0, 2))
                . '-' .
                strtoupper(substr($variant['color'] ?: 'NA', 0, 2))
                . '-' .
                strtoupper(substr(uniqid(), -4));

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
                            ->orWhere('color', 'like', "%{$search}%")
                            ->orWhere('sku', 'like', "%{$search}%");
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

            $duplicate = collect($validated['variants'])->filter(function ($item) use ($variant) {

                return strtolower($item['size'] ?? '') ==
                    strtolower($variant['size'] ?? '')
                    &&
                    strtolower($item['color'] ?? '') ==
                    strtolower($variant['color'] ?? '');
            });

            if ($duplicate->count() > 1) {

                return response()->json([
                    'success' => false,
                    'message' => 'Duplicate Size & Color variant found.'
                ], 422);
            }

            $variant['sku'] =
                'SKU-' .
                strtoupper(substr($validated['name'], 0, 3))
                . '-' .
                strtoupper(substr($variant['size'] ?: 'NA', 0, 2))
                . '-' .
                strtoupper(substr($variant['color'] ?: 'NA', 0, 2))
                . '-' .
                strtoupper(substr(uniqid(), -4));

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
