<!DOCTYPE html>
<html lang="en" ng-app="productApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Variants Repeater - Laravel + AngularJS</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    
    <style>
        .repeater-item {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .repeater-item:hover {
            background-color: #e9ecef;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        .btn-add {
            margin-bottom: 20px;
        }
        .product-list {
            margin-top: 40px;
        }
        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .variant-badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body ng-controller="ProductController as vm">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Product Variants Management</h1>
                <p class="lead">Add product with multiple variants using AngularJS repeater</p>
                
                <!-- Product Form -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Add New Product with Variants</h5>
                    </div>
                    <div class="card-body">
                        <form name="productForm" ng-submit="vm.submitForm()" novalidate>
                            <!-- Product Basic Info -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="productName">Product Name *</label>
                                        <input type="text" 
                                               id="productName" 
                                               class="form-control" 
                                               ng-model="vm.product.name" 
                                               required
                                               ng-class="{'is-invalid': productForm.productName.$touched && productForm.productName.$invalid}">
                                        <div class="error-message" ng-show="productForm.productName.$touched && productForm.productName.$invalid">
                                            Product name is required
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="productDescription">Description</label>
                                        <textarea id="productDescription" 
                                                  class="form-control" 
                                                  ng-model="vm.product.description"
                                                  rows="1"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Variants Repeater Section -->
                            <h5 class="mb-3">Product Variants</h5>
                            <div class="mb-3">
                                <button type="button" class="btn btn-success btn-add" ng-click="vm.addVariant()">
                                    <i class="fas fa-plus"></i> Add Variant
                                </button>
                            </div>

                            <!-- Repeater Items -->
                            <div class="repeater-items" ng-repeat="variant in vm.product.variants track by $index">
                                <div class="repeater-item">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Variant #@{{ $index + 1 }}</h6>
                                        <button type="button" 
                                                class="btn btn-danger btn-sm" 
                                                ng-click="vm.removeVariant($index)"
                                                ng-show="vm.product.variants.length > 1">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       ng-model="variant.size"
                                                       placeholder="e.g., M, L, XL">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Color</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       ng-model="variant.color"
                                                       placeholder="e.g., Red, Blue">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Price ($) *</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       ng-model="variant.price" 
                                                       step="0.01"
                                                       min="0"
                                                       required>
                                                <div class="error-message" ng-show="!variant.price && variant.price !== 0">
                                                    Price is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Stock Quantity *</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       ng-model="variant.stock_quantity"
                                                       min="0"
                                                       required>
                                                <div class="error-message" ng-show="!variant.stock_quantity && variant.stock_quantity !== 0">
                                                    Stock quantity is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="button" class="btn btn-secondary me-md-2" ng-click="vm.resetForm()">
                                    Reset
                                </button>
                                <button type="submit" 
                                        class="btn btn-primary"
                                        ng-disabled="productForm.$invalid || vm.product.variants.length === 0">
                                    <span ng-if="!vm.loading">Save Product</span>
                                    <span ng-if="vm.loading">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Saving...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Product List -->
                <div class="product-list">
                    <h3 class="mb-3">Existing Products</h3>
                    <div class="row">
                        <div class="col-md-4" ng-repeat="product in vm.products">
                            <div class="product-card">
                                <h5>@{{ product.name }}</h5>
                                <p class="text-muted" ng-if="product.description">@{{ product.description }}</p>
                                <div class="mt-2">
                                    <strong>Variants:</strong>
                                    <div class="mt-1">
                                        <span ng-repeat="variant in product.variants" 
                                              class="badge bg-info variant-badge">
                                            @{{ variant.size || 'N/A' }} / 
                                            @{{ variant.color || 'N/A' }} - 
                                            $@{{ variant.price }} 
                                            (@{{ variant.stock_quantity }} in stock)
                                        </span>
                                    </div>
                                </div>
                                <small class="text-muted">Added: @{{ product.created_at | date:'short' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
    <!-- AngularJS Application -->
    <script>
        angular.module('productApp', [])
        .controller('ProductController', ['$http', '$timeout', function($http, $timeout) {
            var vm = this;
            
            // Initialize product object
            vm.product = {
                name: '',
                description: '',
                variants: [{
                    size: '',
                    color: '',
                    price: null,
                    stock_quantity: null
                }]
            };
            
            vm.products = [];
            vm.loading = false;
            
            // Add variant
            vm.addVariant = function() {
                vm.product.variants.push({
                    size: '',
                    color: '',
                    price: null,
                    stock_quantity: null
                });
            };
            
            // Remove variant
            vm.removeVariant = function(index) {
                if (vm.product.variants.length > 1) {
                    vm.product.variants.splice(index, 1);
                }
            };
            
            // Submit form
            vm.submitForm = function() {
                vm.loading = true;
                
                // Validate variants
                var hasEmptyVariants = vm.product.variants.some(function(variant) {
                    return !variant.price || !variant.stock_quantity;
                });
                
                if (hasEmptyVariants) {
                    alert('Please fill all required fields in variants');
                    vm.loading = false;
                    return;
                }
                
                $http.post('/products', vm.product)
                    .then(function(response) {
                        alert(response.data.message);
                        vm.resetForm();
                        vm.loadProducts();
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                        alert('Error saving product: ' + (error.data.message || 'Unknown error'));
                    })
                    .finally(function() {
                        vm.loading = false;
                    });
            };
            
            // Reset form
            vm.resetForm = function() {
                vm.product = {
                    name: '',
                    description: '',
                    variants: [{
                        size: '',
                        color: '',
                        price: null,
                        stock_quantity: null
                    }]
                };
            };
            
            // Load products
            vm.loadProducts = function() {
                $http.get('/products')
                    .then(function(response) {
                        vm.products = response.data;
                    })
                    .catch(function(error) {
                        console.error('Error loading products:', error);
                    });
            };
            
            // Initialize CSRF token for Laravel
            $http.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Load existing products on page load
            vm.loadProducts();
        }])
        .filter('date', function() {
            return function(input) {
                return new Date(input).toLocaleString();
            };
        });
    </script>
</body>
</html>