<!DOCTYPE html>
<html lang="en" ng-app="productApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Variants Studio - Laravel 12 + AngularJS</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AngularJS 1.8.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <style>
        body {
            background: #f4f7fb;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .stat-card {
            border-radius: 16px;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .repeater-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 14px;
            background-color: #ffffff;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .repeater-item:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }

        .matrix-chip {
            cursor: pointer;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            background: #fff;
            transition: all 0.2s;
            user-select: none;
        }

        .matrix-chip.selected {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        .bulk-toolbar {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 14px;
            border: 1px dashed #cbd5e1;
        }

        .badge-subtle-success { background: #dcfce7; color: #166534; }
        .badge-subtle-warning { background: #fef9c3; color: #854d0e; }
        .badge-subtle-danger { background: #fee2e2; color: #991b1b; }
    </style>
</head>

<body ng-controller="ProductController as vm">

    <div class="container py-4">

        <!-- ================= Header ================= -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h2 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <span class="badge bg-primary p-2 fs-5"><i class="fas fa-boxes-stacked"></i></span>
                    Product Variants Repeater Studio
                </h2>
                <small class="text-muted">
                    Laravel 12 + AngularJS | Matrix Generator & Real-time Valuation
                </small>
            </div>

            <button class="btn btn-primary fw-bold" ng-click="vm.resetForm()">
                <i class="fas fa-plus-circle me-1"></i> New Product
            </button>
        </div>

        <!-- ================= Dashboard Statistics ================= -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-2">
                <div class="card stat-card bg-primary text-white shadow-sm h-100">
                    <div class="card-body text-center p-3">
                        <small class="text-white-50 text-uppercase fw-bold">Products</small>
                        <h3 class="fw-bold mb-0 mt-1">@{{ vm.statistics.total_products || 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2">
                <div class="card stat-card bg-success text-white shadow-sm h-100">
                    <div class="card-body text-center p-3">
                        <small class="text-white-50 text-uppercase fw-bold">Variants</small>
                        <h3 class="fw-bold mb-0 mt-1">@{{ vm.statistics.total_variants || 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2">
                <div class="card stat-card bg-warning text-dark shadow-sm h-100">
                    <div class="card-body text-center p-3">
                        <small class="text-dark-50 text-uppercase fw-bold">Total Stock</small>
                        <h3 class="fw-bold mb-0 mt-1">@{{ vm.statistics.total_stock || 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card bg-dark text-white shadow-sm h-100">
                    <div class="card-body text-center p-3">
                        <small class="text-white-50 text-uppercase fw-bold">Inventory Value</small>
                        <h4 class="fw-bold text-warning mb-0 mt-1">₹@{{ vm.statistics.total_inventory_value || 0 | number:2 }}</h4>
                        <small class="text-white-50" style="font-size: 0.75rem;">Profit: ₹@{{ vm.statistics.total_projected_profit || 0 | number:2 }}</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card bg-danger text-white shadow-sm h-100">
                    <div class="card-body text-center p-3">
                        <small class="text-white-50 text-uppercase fw-bold">Low Stock Alert</small>
                        <h3 class="fw-bold mb-0 mt-1">@{{ vm.statistics.low_stock_variants || 0 }}</h3>
                        <small class="text-white-50" style="font-size: 0.75rem;">(Stock ≤ 5 items)</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= Main Product Form ================= -->
        <div class="card shadow-sm border-0 rounded-4 mb-5">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-primary">
                    <i class="fas fa-edit me-2"></i> @{{ vm.product.id ? 'Edit Product: ' + vm.product.name : 'Create Product with Dynamic Variants' }}
                </h5>
                <span class="badge bg-light text-secondary border">Form Studio</span>
            </div>

            <div class="card-body p-4">
                <form name="productForm" ng-submit="vm.submitForm()" novalidate>

                    <!-- Product Basics -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg fw-semibold" ng-model="vm.product.name"
                                ng-change="vm.updateAllSKUs()" placeholder="e.g. Classic Cotton T-Shirt" required>
                        </div>

                        <div class="col-md-7">
                            <label class="form-label fw-bold">Product Description</label>
                            <input type="text" class="form-control form-control-lg" ng-model="vm.product.description"
                                placeholder="Short description, category tags, or fabric info">
                        </div>
                    </div>

                    <!-- FEATURE 1: Matrix Variant Generator Accordion -->
                    <div class="card border border-primary-subtle bg-light mb-4 rounded-3">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="text-primary d-flex align-items-center gap-2">
                                    <i class="fas fa-wand-magic-sparkles"></i> 1-Click Matrix Variant Generator
                                </strong>
                                <small class="text-muted">Auto-generate combinations (Sizes × Colors)</small>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-md-5">
                                    <small class="fw-bold text-secondary d-block mb-1">Select Sizes:</small>
                                    <div class="d-flex flex-wrap gap-1">
                                        <span ng-repeat="s in vm.matrixOptions.sizes"
                                            class="matrix-chip"
                                            ng-class="{'selected': vm.matrixSelection.sizes.includes(s)}"
                                            ng-click="vm.toggleMatrixItem('sizes', s)">
                                            @{{ s }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <small class="fw-bold text-secondary d-block mb-1">Select Colors:</small>
                                    <div class="d-flex flex-wrap gap-1">
                                        <span ng-repeat="c in vm.matrixOptions.colors"
                                            class="matrix-chip"
                                            ng-class="{'selected': vm.matrixSelection.colors.includes(c)}"
                                            ng-click="vm.toggleMatrixItem('colors', c)">
                                            @{{ c }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-2 text-end">
                                    <button type="button" class="btn btn-primary w-100 fw-bold"
                                        ng-click="vm.generateMatrixVariants()"
                                        ng-disabled="!vm.matrixSelection.sizes.length || !vm.matrixSelection.colors.length">
                                        <i class="fas fa-bolt me-1"></i> Generate
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FEATURE 2: Bulk Action Toolbar -->
                    <div class="bulk-toolbar mb-4">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-3">
                                <strong class="text-secondary small d-flex align-items-center gap-1">
                                    <i class="fas fa-layer-group"></i> Bulk Batch Updater:
                                </strong>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Price ₹</span>
                                    <input type="number" class="form-control" ng-model="vm.bulk.price" placeholder="Set all">
                                    <button type="button" class="btn btn-outline-primary" ng-click="vm.applyBulkPrice()">Apply</button>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Stock</span>
                                    <input type="number" class="form-control" ng-model="vm.bulk.stock" placeholder="Set all">
                                    <button type="button" class="btn btn-outline-primary" ng-click="vm.applyBulkStock()">Apply</button>
                                </div>
                            </div>

                            <div class="col-md-3 text-end">
                                <button type="button" class="btn btn-success btn-sm fw-bold" ng-click="vm.addVariant()">
                                    <i class="fas fa-plus me-1"></i> Add Single Row
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ================= Repeater Items ================= -->
                    <h6 class="fw-bold text-dark mb-3">
                        Product Variants (@{{ vm.product.variants.length }})
                    </h6>

                    <div class="repeater-item" ng-repeat="variant in vm.product.variants track by $index">
                        <div class="row g-2 align-items-center">
                            
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted mb-1">Size</label>
                                <input type="text" class="form-control form-control-sm" ng-model="variant.size"
                                    ng-change="vm.generateSKU(variant)" placeholder="e.g. M, XL, 32">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted mb-1">Color</label>
                                <input type="text" class="form-control form-control-sm" ng-model="variant.color"
                                    ng-change="vm.generateSKU(variant)" placeholder="e.g. Blue, Red">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted mb-1">SKU (Auto)</label>
                                <input type="text" class="form-control form-control-sm bg-light font-monospace" ng-model="variant.sku" readonly>
                            </div>

                            <!-- FEATURE 3: Cost Price -->
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted mb-1">Cost Price (₹)</label>
                                <input type="number" class="form-control form-control-sm" ng-model="variant.cost_price" min="0" placeholder="Cost" step="any">
                            </div>

                            <!-- Selling Price -->
                            <div class="col-md-1">
                                <label class="form-label small fw-semibold text-muted mb-1">Price (₹)</label>
                                <input type="number" class="form-control form-control-sm fw-bold" ng-model="variant.price" min="0" required placeholder="Sell">
                            </div>

                            <!-- Stock Quantity -->
                            <div class="col-md-1">
                                <label class="form-label small fw-semibold text-muted mb-1">Stock</label>
                                <input type="number" class="form-control form-control-sm fw-bold" ng-model="variant.stock_quantity" min="0" required placeholder="Qty">
                            </div>

                            <!-- Actions: Clone & Delete -->
                            <div class="col-md-2 d-flex gap-1 align-items-end pt-3">
                                <!-- FEATURE 2: 1-Click Clone Row -->
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Clone Row" ng-click="vm.cloneVariant(variant)">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" title="Delete Row"
                                    ng-click="vm.removeVariant($index)" ng-disabled="vm.product.variants.length == 1">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <!-- Margin Badge -->
                                <span class="badge ms-auto" ng-class="vm.getVariantMargin(variant) >= 30 ? 'badge-subtle-success' : (vm.getVariantMargin(variant) > 0 ? 'badge-subtle-warning' : 'badge-subtle-danger')">
                                    @{{ vm.getVariantMargin(variant) }}%
                                </span>
                            </div>

                        </div>
                    </div>

                    <!-- FEATURE 3: Real-Time Margin & Inventory Valuation Studio Summary -->
                    <div class="card bg-light border-0 rounded-3 mt-4 mb-4">
                        <div class="card-body p-3">
                            <div class="row text-center g-2">
                                <div class="col-6 col-md-2">
                                    <small class="text-muted d-block">Variants</small>
                                    <strong class="fs-5">@{{ vm.getTotalVariants() }}</strong>
                                </div>
                                <div class="col-6 col-md-2">
                                    <small class="text-muted d-block">Total Units</small>
                                    <strong class="fs-5">@{{ vm.getTotalStock() }}</strong>
                                </div>
                                <div class="col-6 col-md-3">
                                    <small class="text-muted d-block">Estimated Stock Value</small>
                                    <strong class="fs-5 text-primary">₹@{{ vm.getInventoryValue() | number:2 }}</strong>
                                </div>
                                <div class="col-6 col-md-2">
                                    <small class="text-muted d-block">Est. Total Cost</small>
                                    <strong class="fs-5 text-secondary">₹@{{ vm.getInventoryCost() | number:2 }}</strong>
                                </div>
                                <div class="col-12 col-md-3">
                                    <small class="text-muted d-block">Projected Gross Profit</small>
                                    <strong class="fs-5 text-success">₹@{{ vm.getProjectedProfit() | number:2 }}</strong>
                                    <span class="badge bg-success ms-1">@{{ vm.getOverallMargin() }}% Margin</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Controls -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" ng-click="vm.resetForm()">
                            Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold" ng-disabled="vm.loading">
                            <span ng-if="!vm.loading">
                                <i class="fas fa-save me-1"></i> Save Product & Variants
                            </span>
                            <span ng-if="vm.loading">
                                <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- ================= Search & Products Catalog ================= -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                
                <div class="row g-3 mb-4 align-items-center">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-list me-2 text-primary"></i> Product Catalog
                        </h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Search name, description, SKU, size..."
                            ng-model="vm.searchText" ng-change="vm.loadProducts()">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" ng-model="vm.itemsPerPage" ng-change="vm.loadProducts()">
                            <option value="3">3 per page</option>
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                        </select>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Product Details</th>
                                <th>Variants Matrix & Stock Breakdown</th>
                                <th width="140" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="product in vm.products.data">
                                <td class="fw-bold text-muted">@{{ product.id }}</td>
                                <td>
                                    <div class="fw-bold fs-6">@{{ product.name }}</div>
                                    <small class="text-muted d-block">@{{ product.description || 'No description provided' }}</small>
                                    <small class="text-muted" style="font-size: 0.75rem;">Created: @{{ product.created_at | date:'medium' }}</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <div ng-repeat="v in product.variants" class="p-2 border rounded-2 bg-light small" style="min-width: 140px;">
                                            <div class="fw-bold text-primary font-monospace" style="font-size: 0.75rem;">@{{ v.sku || 'N/A' }}</div>
                                            <div>@{{ v.size || '-' }} / @{{ v.color || '-' }}</div>
                                            <div class="d-flex justify-content-between mt-1">
                                                <span>₹@{{ v.price }}</span>
                                                <span class="badge" ng-class="v.stock_quantity > 5 ? 'bg-success' : (v.stock_quantity > 0 ? 'bg-warning text-dark' : 'bg-danger')">
                                                    Qty: @{{ v.stock_quantity }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-warning btn-sm" ng-click="vm.editProduct(product)" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" ng-click="vm.deleteProduct(product)" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr ng-if="!vm.products.data || vm.products.data.length === 0">
                                <td colspan="4" class="text-center py-4 text-muted">
                                    No products found matching the criteria.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3" ng-if="vm.products.last_page > 1">
                    <small class="text-muted">Page @{{ vm.products.current_page }} of @{{ vm.products.last_page }}</small>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary" ng-disabled="vm.products.current_page == 1"
                            ng-click="vm.changePage(vm.products.prev_page_url)">
                            Previous
                        </button>
                        <button class="btn btn-outline-secondary" ng-disabled="vm.products.current_page == vm.products.last_page"
                            ng-click="vm.changePage(vm.products.next_page_url)">
                            Next
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- ================= AngularJS App Script ================= -->
    <script>
        angular.module('productApp', [])
            .controller('ProductController', ['$http', function($http) {
                var vm = this;

                $http.defaults.headers.common['X-CSRF-TOKEN'] =
                    document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Master options for Matrix Generator
                vm.matrixOptions = {
                    sizes: ['S', 'M', 'L', 'XL', 'XXL'],
                    colors: ['Black', 'White', 'Navy Blue', 'Red', 'Olive']
                };

                vm.matrixSelection = {
                    sizes: ['S', 'M', 'L'],
                    colors: ['Black', 'White']
                };

                // Bulk Batch state
                vm.bulk = {
                    price: 499,
                    stock: 50
                };

                vm.itemsPerPage = "5";
                vm.searchText = '';
                vm.loading = false;
                vm.statistics = {};
                vm.products = {};

                // Default Product Form State
                vm.resetForm = function() {
                    vm.product = {
                        id: null,
                        name: '',
                        description: '',
                        variants: [
                            { sku: '', size: 'M', color: 'Black', cost_price: 250, price: 499, stock_quantity: 25 }
                        ]
                    };
                    vm.updateAllSKUs();
                };

                // FEATURE 1: Toggle Matrix Tag Selection
                vm.toggleMatrixItem = function(type, item) {
                    var idx = vm.matrixSelection[type].indexOf(item);
                    if (idx > -1) {
                        vm.matrixSelection[type].splice(idx, 1);
                    } else {
                        vm.matrixSelection[type].push(item);
                    }
                };

                // FEATURE 1: Generate All Combinations Matrix
                vm.generateMatrixVariants = function() {
                    if (!vm.matrixSelection.sizes.length || !vm.matrixSelection.colors.length) {
                        Swal.fire('Matrix Builder', 'Please select at least one size and one color.', 'warning');
                        return;
                    }

                    var newVariants = [];
                    angular.forEach(vm.matrixSelection.sizes, function(s) {
                        angular.forEach(vm.matrixSelection.colors, function(c) {
                            var v = {
                                sku: '',
                                size: s,
                                color: c,
                                cost_price: vm.product.variants[0] ? vm.product.variants[0].cost_price : 200,
                                price: vm.bulk.price || 499,
                                stock_quantity: vm.bulk.stock || 20
                            };
                            vm.generateSKU(v);
                            newVariants.push(v);
                        });
                    });

                    vm.product.variants = newVariants;
                    Swal.fire({
                        icon: 'success',
                        title: 'Matrix Created!',
                        text: newVariants.length + ' variant combinations generated successfully.',
                        timer: 1600,
                        showConfirmButton: false
                    });
                };

                // FEATURE 2: 1-Click Clone Variant Row
                vm.cloneVariant = function(variant) {
                    var clone = angular.copy(variant);
                    clone.size = (clone.size || '') + '-Copy';
                    vm.generateSKU(clone);
                    vm.product.variants.push(clone);
                };

                // FEATURE 2: Bulk Apply Price
                vm.applyBulkPrice = function() {
                    if (vm.bulk.price !== null && vm.bulk.price >= 0) {
                        angular.forEach(vm.product.variants, function(v) {
                            v.price = Number(vm.bulk.price);
                        });
                    }
                };

                // FEATURE 2: Bulk Apply Stock
                vm.applyBulkStock = function() {
                    if (vm.bulk.stock !== null && vm.bulk.stock >= 0) {
                        angular.forEach(vm.product.variants, function(v) {
                            v.stock_quantity = parseInt(vm.bulk.stock, 10);
                        });
                    }
                };

                // Add Single Variant
                vm.addVariant = function() {
                    var v = {
                        sku: '',
                        size: '',
                        color: '',
                        cost_price: 0,
                        price: vm.bulk.price || 0,
                        stock_quantity: vm.bulk.stock || 0
                    };
                    vm.generateSKU(v);
                    vm.product.variants.push(v);
                };

                // Remove Single Variant
                vm.removeVariant = function(index) {
                    if (vm.product.variants.length > 1) {
                        vm.product.variants.splice(index, 1);
                    }
                };

                // SKU Generator
                vm.generateSKU = function(variant) {
                    var prod = (vm.product.name || 'PRD').substring(0, 3).toUpperCase();
                    var sz = (variant.size || 'NA').substring(0, 2).toUpperCase();
                    var cl = (variant.color || 'NA').substring(0, 2).toUpperCase();
                    variant.sku = 'SKU-' + prod + '-' + sz + '-' + cl;
                };

                vm.updateAllSKUs = function() {
                    angular.forEach(vm.product.variants, function(v) {
                        vm.generateSKU(v);
                    });
                };

                // FEATURE 3: Margin & Valuation Calculations
                vm.getVariantMargin = function(variant) {
                    var sell = Number(variant.price || 0);
                    var cost = Number(variant.cost_price || 0);
                    if (sell <= 0) return 0;
                    var margin = ((sell - cost) / sell) * 100;
                    return Math.round(margin);
                };

                vm.getTotalVariants = function() {
                    return vm.product.variants ? vm.product.variants.length : 0;
                };

                vm.getTotalStock = function() {
                    var total = 0;
                    angular.forEach(vm.product.variants, function(v) {
                        total += Number(v.stock_quantity || 0);
                    });
                    return total;
                };

                vm.getInventoryValue = function() {
                    var total = 0;
                    angular.forEach(vm.product.variants, function(v) {
                        total += Number(v.price || 0) * Number(v.stock_quantity || 0);
                    });
                    return total;
                };

                vm.getInventoryCost = function() {
                    var total = 0;
                    angular.forEach(vm.product.variants, function(v) {
                        total += Number(v.cost_price || 0) * Number(v.stock_quantity || 0);
                    });
                    return total;
                };

                vm.getProjectedProfit = function() {
                    return vm.getInventoryValue() - vm.getInventoryCost();
                };

                vm.getOverallMargin = function() {
                    var val = vm.getInventoryValue();
                    if (val <= 0) return 0;
                    return Math.round((vm.getProjectedProfit() / val) * 100);
                };

                // Submit Form (Create / Update)
                vm.submitForm = function() {
                    var seen = {};
                    for (var i = 0; i < vm.product.variants.length; i++) {
                        var v = vm.product.variants[i];
                        var key = (v.size || '').trim().toLowerCase() + '___' + (v.color || '').trim().toLowerCase();
                        if (seen[key]) {
                            Swal.fire('Duplicate Variant', 'Same Size & Color combination (' + v.size + ' / ' + v.color + ') exists twice.', 'warning');
                            return;
                        }
                        seen[key] = true;
                    }

                    vm.loading = true;
                    var url = vm.product.id ? ('/products/' + vm.product.id) : '/products';
                    var method = vm.product.id ? 'put' : 'post';

                    $http[method](url, vm.product)
                        .then(function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            vm.resetForm();
                            vm.loadProducts();
                            vm.loadStatistics();
                        })
                        .catch(function(err) {
                            var msg = err.data && err.data.message ? err.data.message : 'Validation failed';
                            Swal.fire('Error', msg, 'error');
                        })
                        .finally(function() {
                            vm.loading = false;
                        });
                };

                // Load Statistics
                vm.loadStatistics = function() {
                    $http.get('/statistics').then(function(res) {
                        vm.statistics = res.data;
                    });
                };

                // Load Products
                vm.loadProducts = function(url) {
                    url = url || '/products';
                    $http.get(url, {
                        params: {
                            search: vm.searchText,
                            per_page: vm.itemsPerPage
                        }
                    }).then(function(res) {
                        vm.products = res.data;
                    });
                };

                vm.changePage = function(url) {
                    if (url) vm.loadProducts(url);
                };

                // Edit Product
                vm.editProduct = function(product) {
                    vm.product = angular.copy(product);
                    window.scrollTo({ top: 150, behavior: 'smooth' });
                };

                // Delete Product
                vm.deleteProduct = function(product) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Delete "' + product.name + '" and all its variants?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $http.delete('/products/' + product.id).then(function(res) {
                                Swal.fire('Deleted!', res.data.message, 'success');
                                vm.loadProducts();
                                vm.loadStatistics();
                            });
                        }
                    });
                };

                // Initial Load
                vm.resetForm();
                vm.loadStatistics();
                vm.loadProducts();
            }]);
    </script>

</body>

</html>