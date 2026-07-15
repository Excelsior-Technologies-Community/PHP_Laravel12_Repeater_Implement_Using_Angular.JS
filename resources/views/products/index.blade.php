<!DOCTYPE html>
<html lang="en" ng-app="productApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<<<<<<< HEAD
    <title>Product CRUD with Variants - Laravel + AngularJS</title>
    
=======
    <title>Product Variants Repeater - Laravel + AngularJS</title>

>>>>>>> development
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
<<<<<<< HEAD
=======
            background: #f4f7fb;
            font-family: Inter, sans-serif;
        }

        .card {
            border-radius: 15px;
        }

        .card h2,
        .card h3 {
            font-weight: 700;
            margin-bottom: 0;
        }

        .card h6 {
            font-size: 14px;
            opacity: .9;
        }

        .repeater-item {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
>>>>>>> development
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }
        
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            border-radius: 0 0 20px 20px;
            margin-bottom: 30px;
        }
        
        .repeater-item {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: white;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
<<<<<<< HEAD
        
=======

>>>>>>> development
        .repeater-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
<<<<<<< HEAD
        
        .repeater-item.deleted {
            opacity: 0.5;
            background-color: #fff5f5;
            border-color: #fecaca;
        }
        
=======

>>>>>>> development
        .form-group {
            margin-bottom: 1.5rem;
        }
<<<<<<< HEAD
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
=======

>>>>>>> development
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.5rem;
        }
<<<<<<< HEAD
        
=======

>>>>>>> development
        .btn-add {
            margin-bottom: 20px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }
<<<<<<< HEAD
        
        .product-list {
            margin-top: 40px;
        }
        
=======

        .product-list {
            margin-top: 40px;
        }

>>>>>>> development
        .product-card {
            border: none;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
<<<<<<< HEAD
        
        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            transform: translateY(-4px);
        }
        
        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #667eea, #764ba2);
        }
        
=======

>>>>>>> development
        .variant-badge {
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 0.85em;
            padding: 6px 12px;
            border-radius: 20px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
        }
        
        .action-buttons {
            position: absolute;
            top: 15px;
            right: 15px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .product-card:hover .action-buttons {
            opacity: 1;
        }
        
        .btn-action {
            padding: 6px 12px;
            font-size: 0.8em;
            margin-left: 5px;
            border-radius: 6px;
            border: none;
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .btn-restore {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
            padding: 4px 8px;
            font-size: 0.7em;
            border-radius: 4px;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .tab-content {
            padding: 30px 0;
        }
        
        .nav-tabs {
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 30px;
        }
        
        .nav-tabs .nav-link {
            border: none;
            padding: 12px 24px;
            font-weight: 500;
            color: #6c757d;
            border-radius: 8px 8px 0 0;
            margin-right: 5px;
            transition: all 0.3s;
        }
        
        .nav-tabs .nav-link:hover {
            color: #495057;
            background-color: #f8f9fa;
        }
        
        .nav-tabs .nav-link.active {
            color: #667eea;
            background-color: white;
            border-bottom: 3px solid #667eea;
        }
        
        .search-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .input-group {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .input-group .form-control {
            border-radius: 8px 0 0 8px;
        }
        
        .input-group-text {
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 0 8px 8px 0;
        }
        
        .pagination {
            margin-top: 30px;
        }
        
        .page-link {
            border: none;
            color: #667eea;
            margin: 0 5px;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .page-link:hover {
            background-color: #f0f4ff;
            color: #764ba2;
        }
        
        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .card-header {
            border: none;
            padding: 20px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .badge-count {
            background: #667eea;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            margin-left: 5px;
        }
        
        .product-description {
            color: #6c757d;
            line-height: 1.6;
            margin: 10px 0;
            font-size: 0.95em;
        }
        
        .product-meta {
            font-size: 0.85em;
            color: #8a8a8a;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #4cd964 0%, #5ac8fa 100%);
            border: none;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #8e9eab 0%, #eef2f3 100%);
            border: none;
        }
        
        .alert-info {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            border: none;
            color: #2c5282;
            border-radius: 8px;
            padding: 15px;
        }
        
        .form-label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
        }
        
        .variant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f4ff;
        }
        
        .variant-title {
            font-weight: 600;
            color: #4a5568;
            font-size: 1.1em;
        }
        
        .required-field::after {
            content: " *";
            color: #f56565;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner .75s linear infinite;
        }
        
        @keyframes spinner {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body ng-controller="ProductController as vm">
<<<<<<< HEAD
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-3">Product CRUD with Variants</h1>
                    <p class="lead mb-0">Complete CRUD operations with repeater fields using Laravel + AngularJS</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Tabs for Create/Edit and List -->
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                ng-class="{active: vm.activeTab === 'list'}"
                                ng-click="vm.setActiveTab('list')">
                            <i class="fas fa-list"></i> Product List
                            <span class="badge-count">@{{ vm.filteredProducts.length }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                ng-class="{active: vm.activeTab === 'form'}"
                                ng-click="vm.setActiveTab('form')">
                            <i class="fas" ng-class="vm.editingProduct ? 'fa-edit' : 'fa-plus'"></i>
                            @{{ vm.editingProduct ? 'Edit Product' : 'Add New Product' }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Product List Tab -->
                    <div class="tab-pane" ng-class="{active: vm.activeTab === 'list'}">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="mb-0">All Products</h4>
                                    <button class="btn btn-primary" ng-click="vm.openCreateForm()">
                                        <i class="fas fa-plus"></i> Add New Product
                                    </button>
                                </div>

                                <!-- Search and Filter Section -->
                                <div class="search-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" 
                                                       class="form-control" 
                                                       placeholder="Search products..."
                                                       ng-model="vm.searchText"
                                                       ng-change="vm.filterProducts()">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select" ng-model="vm.sortBy" ng-change="vm.filterProducts()">
                                                <option value="newest">Newest First</option>
                                                <option value="oldest">Oldest First</option>
                                                <option value="name_asc">Name A-Z</option>
                                                <option value="name_desc">Name Z-A</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select" ng-model="vm.itemsPerPage" ng-change="vm.filterProducts()">
                                                <option value="5">5 per page</option>
                                                <option value="10">10 per page</option>
                                                <option value="20">20 per page</option>
                                                <option value="50">50 per page</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products Grid -->
                                <div class="row" ng-if="vm.filteredProducts.length > 0">
                                    <div class="col-md-4" ng-repeat="product in vm.filteredProducts | limitTo: vm.itemsPerPage: (vm.currentPage - 1) * vm.itemsPerPage">
                                        <div class="product-card">
                                            <div class="action-buttons">
                                                <button class="btn btn-warning btn-action" 
                                                        ng-click="vm.editProduct(product)"
                                                        title="Edit Product">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-action" 
                                                        ng-click="vm.deleteProduct(product)"
                                                        title="Delete Product">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <h5 class="mb-2">@{{ product.name }}</h5>
                                            <p class="product-description" ng-if="product.description">
                                                @{{ product.description }}
                                            </p>
                                            <div class="mt-3">
                                                <strong>Variants (@{{ product.variants.length }}):</strong>
                                                <div class="mt-2">
                                                    <span ng-repeat="variant in product.variants" 
                                                          class="badge variant-badge">
                                                        @{{ variant.size || 'N/A' }} / 
                                                        @{{ variant.color || 'N/A' }} - 
                                                        $@{{ variant.price | number:2 }} 
                                                        (@{{ variant.stock_quantity }})
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="product-meta">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar"></i> Created: @{{ product.created_at | date:'mediumDate' }}
                                                </small>
                                                <small class="text-muted d-block mt-1" ng-if="product.updated_at !== product.created_at">
                                                    <i class="fas fa-history"></i> Updated: @{{ product.updated_at | date:'mediumDate' }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Empty State -->
                                <div class="empty-state" ng-if="vm.filteredProducts.length === 0">
                                    <i class="fas fa-box-open fa-3x mb-3" style="color: #667eea;"></i>
                                    <h4>No products found</h4>
                                    <p ng-if="vm.searchText">Try a different search term</p>
                                    <p ng-if="!vm.searchText">Start by adding your first product!</p>
                                    <button class="btn btn-primary mt-3" ng-click="vm.openCreateForm()">
                                        <i class="fas fa-plus"></i> Add First Product
                                    </button>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4" 
                                     ng-if="vm.filteredProducts.length > vm.itemsPerPage">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" ng-class="{disabled: vm.currentPage === 1}">
                                                <a class="page-link" ng-click="vm.prevPage()">
                                                    <i class="fas fa-chevron-left"></i> Previous
                                                </a>
                                            </li>
                                            <li class="page-item" ng-repeat="page in vm.getPageNumbers() track by $index"
                                                ng-class="{active: page === vm.currentPage}">
                                                <a class="page-link" ng-click="vm.goToPage(page)">
                                                    @{{ page }}
                                                </a>
                                            </li>
                                            <li class="page-item" ng-class="{disabled: vm.currentPage === vm.totalPages}">
                                                <a class="page-link" ng-click="vm.nextPage()">
                                                    Next <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Form Tab -->
                    <div class="tab-pane" ng-class="{active: vm.activeTab === 'form'}">
                        <div class="card mt-3">
                            <div class="card-header" ng-class="vm.editingProduct ? 'bg-warning text-dark' : 'bg-primary text-white'">
                                <h5 class="mb-0">
                                    <i class="fas" ng-class="vm.editingProduct ? 'fa-edit' : 'fa-plus'"></i>
                                    @{{ vm.editingProduct ? 'Edit Product' : 'Add New Product' }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <form name="productForm" ng-submit="vm.submitForm()" novalidate>
                                    <!-- Product Basic Info -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="productName" class="form-label required-field">Product Name</label>
                                                <input type="text" 
                                                       id="productName" 
                                                       class="form-control" 
                                                       ng-model="vm.product.name" 
                                                       required
                                                       placeholder="Enter product name"
                                                       ng-class="{'is-invalid': productForm.productName.$touched && productForm.productName.$invalid}">
                                                <div class="error-message" 
                                                     ng-show="productForm.productName.$touched && productForm.productName.$invalid">
                                                    Product name is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="productDescription" class="form-label">Description</label>
                                                <textarea id="productDescription" 
                                                          class="form-control" 
                                                          ng-model="vm.product.description"
                                                          rows="2"
                                                          placeholder="Optional product description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Variants Repeater Section -->
                                    <div class="variant-header">
                                        <h5 class="variant-title mb-0">Product Variants</h5>
                                        <div>
                                            <button type="button" class="btn btn-success btn-sm" ng-click="vm.addVariant()">
                                                <i class="fas fa-plus"></i> Add Variant
                                            </button>
                                            <button type="button" class="btn btn-outline-primary btn-sm ms-2" 
                                                    ng-click="vm.addSampleVariant()"
                                                    ng-if="!vm.editingProduct">
                                                <i class="fas fa-magic"></i> Add Sample
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info" ng-if="vm.product.variants.length === 0">
                                        <i class="fas fa-info-circle"></i> Add at least one variant for this product
                                    </div>

                                    <!-- Repeater Items -->
                                    <div class="repeater-items" ng-repeat="variant in vm.product.variants track by $index">
                                        <div class="repeater-item" ng-class="{deleted: variant.deleted}">
                                            <button type="button" 
                                                    class="btn btn-outline-success btn-restore" 
                                                    ng-click="vm.restoreVariant($index)"
                                                    ng-if="variant.deleted"
                                                    title="Restore variant">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                            
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0 variant-title">
                                                    <i class="fas fa-cube me-2"></i>
                                                    <span ng-if="variant.id">Variant #@{{ $index + 1 }} (ID: @{{ variant.id }})</span>
                                                    <span ng-if="!variant.id">New Variant #@{{ $index + 1 }}</span>
                                                </h6>
                                                <div>
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm" 
                                                            ng-click="vm.markVariantForDeletion($index)"
                                                            ng-if="!variant.deleted && (vm.product.variants.length > 1 || !vm.editingProduct)"
                                                            title="Mark for deletion">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm" 
                                                            ng-click="vm.removeVariant($index)"
                                                            ng-if="!variant.deleted && vm.product.variants.length > 1 && !vm.editingProduct"
                                                            title="Remove variant">
                                                        <i class="fas fa-times"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Size</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               ng-model="variant.size"
                                                               placeholder="e.g., M, L, XL"
                                                               ng-disabled="variant.deleted">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Color</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               ng-model="variant.color"
                                                               placeholder="e.g., Red, Blue"
                                                               ng-disabled="variant.deleted">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label required-field">Price ($)</label>
                                                        <input type="number" 
                                                               class="form-control" 
                                                               ng-model="variant.price" 
                                                               step="0.01"
                                                               min="0"
                                                               required
                                                               placeholder="0.00"
                                                               ng-class="{'is-invalid': (variant.price === null || variant.price < 0) && !variant.deleted}"
                                                               ng-disabled="variant.deleted">
                                                        <div class="error-message" 
                                                             ng-show="(variant.price === null || variant.price < 0) && !variant.deleted">
                                                            Valid price is required
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label required-field">Stock Quantity</label>
                                                        <input type="number" 
                                                               class="form-control" 
                                                               ng-model="variant.stock_quantity"
                                                               min="0"
                                                               required
                                                               placeholder="0"
                                                               ng-class="{'is-invalid': (variant.stock_quantity === null || variant.stock_quantity < 0) && !variant.deleted}"
                                                               ng-disabled="variant.deleted">
                                                        <div class="error-message" 
                                                             ng-show="(variant.stock_quantity === null || variant.stock_quantity < 0) && !variant.deleted">
                                                            Valid stock quantity is required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 pt-3 border-top">
                                        <button type="button" class="btn btn-secondary me-md-2" ng-click="vm.cancelEdit()">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                        <button type="submit" 
                                                class="btn" 
                                                ng-class="vm.editingProduct ? 'btn-warning' : 'btn-primary'"
                                                ng-disabled="productForm.$invalid || vm.product.variants.length === 0 || vm.hasInvalidVariants()">
                                            <span ng-if="!vm.loading">
                                                <i class="fas" ng-class="vm.editingProduct ? 'fa-save' : 'fa-check'"></i>
                                                @{{ vm.editingProduct ? 'Update Product' : 'Save Product' }}
                                            </span>
                                            <span ng-if="vm.loading">
                                                <span class="loading-spinner"></span>
                                                @{{ vm.editingProduct ? 'Updating...' : 'Saving...' }}
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
=======

    <div class="container mt-4">

        <!-- ================= Dashboard Statistics ================= -->
        <div class="row g-3 mb-4">

            <div class="col">
                <div class="card bg-primary text-white shadow h-100">
                    <div class="card-body text-center">
                        <h6>Total Products</h6>
                        <h2>@{{ vm.statistics.total_products }}</h2>
>>>>>>> development
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card bg-success text-white shadow h-100">
                    <div class="card-body text-center">
                        <h6>Total Variants</h6>
                        <h2>@{{ vm.statistics.total_variants }}</h2>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card bg-warning shadow h-100">
                    <div class="card-body text-center">
                        <h6>Total Stock</h6>
                        <h2>@{{ vm.statistics.total_stock }}</h2>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card bg-danger text-white shadow h-100">
                    <div class="card-body text-center">
                        <h6>Inventory Value</h6>
                        <h3>₹@{{ vm.statistics.total_inventory_value }}</h3>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card bg-dark text-white shadow h-100">
                    <div class="card-body text-center">
                        <h6>Low Stock</h6>
                        <h2>@{{ vm.statistics.low_stock_variants }}</h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= Page Header ================= -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">
                    Product Variants Management
                </h2>

                <small class="text-muted">
                    Laravel 12 + AngularJS Repeater CRUD
                </small>
            </div>

            <button class="btn btn-success" ng-click="vm.resetForm()">

                <i class="fas fa-plus"></i>

                Add Product

            </button>

        </div>



        <!-- ================= Product Form ================= -->

        <div class="row">

            <div class="col-md-12">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">

                            Add New Product

                        </h5>

                    </div>

                    <div class="card-body">

                        <form name="productForm" ng-submit="vm.submitForm()" novalidate>

                            <!-- ================= Product Information ================= -->

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Product Name <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        ng-model="vm.product.name"
                                        ng-change="vm.product.variants.forEach(vm.generateSKU)"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea class="form-control" rows="2" ng-model="vm.product.description">
        </textarea>

                                </div>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h5 class="mb-0">
                                    Product Variants
                                </h5>

                                <button type="button" class="btn btn-success" ng-click="vm.addVariant()">

                                    <i class="fas fa-plus"></i>

                                    Add Variant

                                </button>

                            </div>

                            <!-- ================= Repeater ================= -->

                            <div class="repeater-item" ng-repeat="variant in vm.product.variants track by $index">

                                <div class="row">

                                    <div class="col-md-2">

                                        <label class="form-label">
                                            Size
                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            ng-model="variant.size"
                                            ng-change="vm.generateSKU(variant)"
                                            placeholder="Size">

                                    </div>

                                    <div class="col-md-2">

                                        <label class="form-label">
                                            Color
                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            ng-model="variant.color"
                                            ng-change="vm.generateSKU(variant)"
                                            placeholder="Color">

                                    </div>

                                    <div class="col-md-2">

                                        <label class="form-label">

                                            SKU

                                        </label>

                                        <input

                                            type="text"

                                            class="form-control bg-light"

                                            ng-model="variant.sku"

                                            readonly>

                                    </div>

                                    <div class="col-md-2">

                                        <label class="form-label">
                                            Price
                                        </label>

                                        <input type="number" class="form-control" ng-model="variant.price" min="0"
                                            required>

                                    </div>

                                    <div class="col-md-2">

                                        <label class="form-label">
                                            Stock
                                        </label>

                                        <input type="number" class="form-control" ng-model="variant.stock_quantity"
                                            min="0" required>

                                    </div>

                                    <div class="col-md-2 d-flex align-items-end">

                                        <button type="button" class="btn btn-danger w-100"
                                            ng-click="vm.removeVariant($index)"
                                            ng-disabled="vm.product.variants.length==1">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <!-- Inventory Summary -->

                            <div class="card border-primary mb-3">

                                <div class="card-header bg-primary text-white">

                                    <strong>Inventory Summary</strong>

                                </div>

                                <div class="card-body">

                                    <div class="row text-center">

                                        <div class="col-md-3">

                                            <h5>@{{ vm.getTotalVariants() }}</h5>

                                            <small>Total Variants</small>

                                        </div>

                                        <div class="col-md-3">

                                            <h5>@{{ vm.getTotalStock() }}</h5>

                                            <small>Total Stock</small>

                                        </div>

                                        <div class="col-md-3">

                                            <h5>₹ @{{ vm.getInventoryValue() }}</h5>

                                            <small>Inventory Value</small>

                                        </div>

                                        <div class="col-md-3">

                                            <h5>@{{ vm.getAveragePrice() }}</h5>

                                            <small>Average Price</small>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="text-end">

                                <button type="button" class="btn btn-secondary" ng-click="vm.resetForm()">

                                    Reset

                                </button>

                                <button type="submit" class="btn btn-primary" ng-disabled="vm.loading">

                                    <span ng-if="!vm.loading">

                                        <i class="fas fa-save"></i>

                                        Save Product

                                    </span>

                                    <span ng-if="vm.loading">

                                        <span class="spinner-border spinner-border-sm"></span>

                                        Saving...

                                    </span>

                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>




        <hr class="my-5">
        <!-- ================= Search + Pagination ================= -->

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-8">

                        <input type="text" class="form-control" placeholder="Search Product Name..."
                            ng-model="vm.searchText" ng-change="vm.loadProducts()">

                    </div>

                    <div class="col-md-4">

                        <select class="form-select" ng-model="vm.itemsPerPage" ng-change="vm.loadProducts()">

                            <option value="3">3 Per Page</option>
                            <option value="5">5 Per Page</option>
                            <option value="10">10 Per Page</option>
                            <option value="15">15 Per Page</option>
                            <option value="20">20 Per Page</option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <!-- ================= Product List ================= -->

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        Product List
                    </h5>

                    <span class="badge bg-warning text-dark">
                        Total : @{{ vm.products.total || 0 }}
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover mb-0">

                        <thead class="table-light">

                            <tr>

                                <th width="60">#</th>

                                <th>Product</th>

                                <th>Description</th>

                                <th>Variants</th>

                                <th width="120">Created</th>

                                <th width="170" class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr ng-repeat="product in vm.products.data">

                                <td>
                                    @{{ product.id }}
                                </td>

                                <td>

                                    <strong>
                                        @{{ product.name }}
                                    </strong>

                                </td>

                                <td>

                                    @{{ product.description }}

                                </td>

                                <td>

                                    <span ng-repeat="variant in product.variants"
                                        class="badge bg-primary me-1 mb-1">

                                        <strong>SKU:</strong>

                                        @{{ variant.sku || 'N/A' }}

                                        <br>

                                        @{{ variant.size || '-' }}

                                        /

                                        @{{ variant.color || '-' }}

                                        |

                                        ₹@{{ variant.price }}

                                        |

                                        Qty : @{{ variant.stock_quantity }}

                                        <span
                                            class="badge bg-success"
                                            ng-if="variant.stock_quantity>5">

                                            In Stock

                                        </span>

                                        <span
                                            class="badge bg-warning text-dark"
                                            ng-if="variant.stock_quantity>0 && variant.stock_quantity<=5">

                                            Low Stock

                                        </span>

                                        <span
                                            class="badge bg-danger"
                                            ng-if="variant.stock_quantity==0">

                                            Out of Stock

                                        </span>

                                    </span>

                                </td>

                                <td>

                                    @{{ product.created_at | date:'medium' }}

                                </td>

                                <td class="text-center">

                                    <button class="btn btn-warning btn-sm" ng-click="vm.editProduct(product)">

                                        <i class="fas fa-edit"></i>

                                    </button>

                                    <button class="btn btn-danger btn-sm" ng-click="vm.deleteProduct(product)">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

                            <tr ng-if="vm.products.data.length==0">

                                <td colspan="6" class="text-center">

                                    No Products Found.

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- ================= Pagination ================= -->

        <div class="mt-4 d-flex justify-content-between align-items-center">

            <div>

                Showing

                @{{ vm.products.from || 0 }}

                -

                @{{ vm.products.to || 0 }}

                of

                @{{ vm.products.total || 0 }}

                Products

            </div>

            <div>

                <button class="btn btn-outline-primary btn-sm" ng-disabled="!vm.products.prev_page_url"
                    ng-click="vm.changePage(vm.products.prev_page_url)">

                    Previous

                </button>

                <button class="btn btn-outline-primary btn-sm" ng-disabled="!vm.products.next_page_url"
                    ng-click="vm.changePage(vm.products.next_page_url)">

                    Next

                </button>

            </div>

        </div>

    </div>

<<<<<<< HEAD
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                    <div class="alert alert-warning" ng-if="vm.productToDelete">
                        <strong>Product:</strong> @{{ vm.productToDelete.name }}<br>
                        <strong>Variants:</strong> @{{ vm.productToDelete.variants.length }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-danger" ng-click="vm.confirmDelete()">
                        <i class="fas fa-trash"></i> Delete Product
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
    <!-- AngularJS Application -->
<!-- AngularJS Application -->
<script>
    angular.module('productApp', [])
    .controller('ProductController', ['$http', '$timeout', function($http, $timeout) {
        var vm = this;
        
        // Initialize properties
        vm.activeTab = 'list';
        vm.editingProduct = false;
        vm.loading = false;
        vm.searchText = '';
        vm.sortBy = 'newest';
        vm.itemsPerPage = 10;
        vm.currentPage = 1;
        vm.totalPages = 1;
        vm.products = [];
        vm.filteredProducts = [];
        vm.productToDelete = null;
        
        // Helper function - defined as regular function first
        function createEmptyVariant() {
            return {
                size: '',
                color: '',
                price: null,
                stock_quantity: null,
                deleted: false
            };
        }
        
        // Make it available on vm
        vm.createEmptyVariant = createEmptyVariant;
        
        // Initialize product object
        vm.initProduct = function() {
            vm.product = {
                name: '',
                description: '',
                variants: [createEmptyVariant()]
            };
        };
        
        // Initialize the product
        vm.initProduct();
        
        // Variant helper methods
        vm.addVariant = function() {
            vm.product.variants.push(createEmptyVariant());
        };
        
        vm.addSampleVariant = function() {
            var samples = [
                {size: 'S', color: 'Red', price: 19.99, stock_quantity: 50},
                {size: 'M', color: 'Blue', price: 21.99, stock_quantity: 75},
                {size: 'L', color: 'Green', price: 23.99, stock_quantity: 40},
                {size: 'XL', color: 'Black', price: 25.99, stock_quantity: 30}
            ];
            
            var sample = angular.copy(samples[Math.floor(Math.random() * samples.length)]);
            sample.deleted = false;
            vm.product.variants.push(sample);
        };
        
        vm.markVariantForDeletion = function(index) {
            vm.product.variants[index].deleted = true;
        };
        
        vm.restoreVariant = function(index) {
            vm.product.variants[index].deleted = false;
        };
        
        vm.removeVariant = function(index) {
            if (vm.product.variants.length > 1) {
                vm.product.variants.splice(index, 1);
            }
        };
        
        // Form validation
        vm.hasInvalidVariants = function() {
            if (!vm.product.variants || vm.product.variants.length === 0) {
                return true;
            }
            
            var activeVariants = vm.product.variants.filter(function(v) {
                return !v.deleted;
            });
            
            if (activeVariants.length === 0) {
                return true;
            }
            
            return activeVariants.some(function(variant) {
                return variant.price === null || variant.price < 0 ||
                       variant.stock_quantity === null || variant.stock_quantity < 0;
            });
        };
        
        // CRUD Operations
        vm.submitForm = function() {
            if (vm.hasInvalidVariants()) {
                alert('Please fix variant errors before saving');
                return;
            }
            
            vm.loading = true;
            
            // Prepare variants data - ensure proper number conversion
            var variantsToSubmit = vm.product.variants.map(function(variant) {
                return {
                    id: variant.id || null,
                    size: variant.size,
                    color: variant.color,
                    price: parseFloat(variant.price),
                    stock_quantity: parseInt(variant.stock_quantity),
                    deleted: variant.deleted || false
                };
            }).filter(function(variant) {
                // Only submit variants that are not marked for deletion
                return !variant.deleted;
            });
            
            // Ensure at least one variant
            if (variantsToSubmit.length === 0) {
                alert('At least one variant is required');
                vm.loading = false;
                return;
            }
            
            var productData = {
                name: vm.product.name,
                description: vm.product.description || '',
                variants: variantsToSubmit
            };
            
            var url = vm.editingProduct ? '/products/' + vm.product.id : '/products';
            var method = vm.editingProduct ? 'put' : 'post';
            
            $http[method](url, productData)
                .then(function(response) {
                    alert(response.data.message);
                    vm.cancelEdit();
                    vm.loadProducts();
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    var errorMsg = error.data && error.data.message 
                        ? error.data.message 
                        : (error.data && error.data.errors 
                            ? JSON.stringify(error.data.errors) 
                            : 'Something went wrong');
                    alert('Error: ' + errorMsg);
                })
                .finally(function() {
                    vm.loading = false;
                });
        };
        
        // Edit product - FIXED VERSION
        vm.editProduct = function(product) {
            vm.editingProduct = true;
            
            // Deep copy the product to avoid reference issues
            vm.product = angular.copy(product);
            vm.product.id = product.id;
            
            // Ensure each variant has proper data types
            if (vm.product.variants && vm.product.variants.length > 0) {
                vm.product.variants = vm.product.variants.map(function(variant) {
                    // Convert price to number and ensure it's not null
                    variant.price = variant.price ? parseFloat(variant.price) : null;
                    // Convert stock_quantity to number
                    variant.stock_quantity = variant.stock_quantity ? parseInt(variant.stock_quantity) : null;
                    // Add deleted property
                    variant.deleted = false;
                    return variant;
                });
            } else {
                vm.product.variants = [createEmptyVariant()];
            }
            
            vm.setActiveTab('form');
            window.scrollTo(0, 0);
            
            // Debug: Log the product data to console
            console.log('Editing product:', vm.product);
        };
        
        vm.openCreateForm = function() {
            vm.cancelEdit();
            vm.setActiveTab('form');
            window.scrollTo(0, 0);
        };
        
        vm.cancelEdit = function() {
            vm.editingProduct = false;
            vm.initProduct();
            vm.setActiveTab('list');
        };
        
        // Delete product
        vm.deleteProduct = function(product) {
            vm.productToDelete = product;
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        };
        
        vm.confirmDelete = function() {
            if (!vm.productToDelete) return;
            
            $http.delete('/products/' + vm.productToDelete.id)
                .then(function(response) {
                    alert(response.data.message);
                    vm.loadProducts();
                    var modalElement = document.getElementById('deleteModal');
                    var modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    vm.productToDelete = null;
                })
                .catch(function(error) {
                    alert('Error deleting product: ' + (error.data && error.data.message || 'Unknown error'));
                });
        };
        
        // Load products
        vm.loadProducts = function() {
            $http.get('/products')
                .then(function(response) {
                    vm.products = response.data;
                    // Ensure proper data types for display
                    vm.products.forEach(function(product) {
                        if (product.variants) {
                            product.variants.forEach(function(variant) {
                                variant.price = parseFloat(variant.price);
                                variant.stock_quantity = parseInt(variant.stock_quantity);
                            });
                        }
                    });
                    vm.filterProducts();
                })
                .catch(function(error) {
                    console.error('Error loading products:', error);
                });
        };
        
        // Filter and pagination
        vm.filterProducts = function() {
            vm.currentPage = 1;
            
            // Filter by search text
            if (vm.searchText) {
                var searchLower = vm.searchText.toLowerCase();
                vm.filteredProducts = vm.products.filter(function(product) {
                    return product.name.toLowerCase().includes(searchLower) ||
                           (product.description && product.description.toLowerCase().includes(searchLower));
                });
            } else {
                vm.filteredProducts = vm.products.slice();
            }
            
            // Sort
            switch(vm.sortBy) {
                case 'newest':
                    vm.filteredProducts.sort(function(a, b) {
                        return new Date(b.created_at) - new Date(a.created_at);
                    });
                    break;
                case 'oldest':
                    vm.filteredProducts.sort(function(a, b) {
                        return new Date(a.created_at) - new Date(b.created_at);
                    });
                    break;
                case 'name_asc':
                    vm.filteredProducts.sort(function(a, b) {
                        return a.name.localeCompare(b.name);
                    });
                    break;
                case 'name_desc':
                    vm.filteredProducts.sort(function(a, b) {
                        return b.name.localeCompare(a.name);
                    });
                    break;
            }
            
            // Calculate pagination
            vm.totalPages = Math.ceil(vm.filteredProducts.length / vm.itemsPerPage);
            if (vm.currentPage > vm.totalPages) {
                vm.currentPage = Math.max(1, vm.totalPages);
            }
        };
        
        vm.getPageNumbers = function() {
            var pages = [];
            var maxPages = 5;
            var startPage = Math.max(1, vm.currentPage - Math.floor(maxPages / 2));
            var endPage = Math.min(vm.totalPages, startPage + maxPages - 1);
            
            if (endPage - startPage + 1 < maxPages) {
                startPage = Math.max(1, endPage - maxPages + 1);
            }
            
            for (var i = startPage; i <= endPage; i++) {
                pages.push(i);
            }
            return pages;
        };
        
        vm.goToPage = function(page) {
            if (page >= 1 && page <= vm.totalPages) {
                vm.currentPage = page;
            }
        };
        
        vm.prevPage = function() {
            if (vm.currentPage > 1) {
                vm.currentPage--;
            }
        };
        
        vm.nextPage = function() {
            if (vm.currentPage < vm.totalPages) {
                vm.currentPage++;
            }
        };
        
        // Tab management
        vm.setActiveTab = function(tab) {
            vm.activeTab = tab;
            if (tab === 'list') {
                vm.filterProducts();
            }
        };
        
        // Initialize CSRF token
        var csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            $http.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
        }
        
        // Load products on initialization
        vm.loadProducts();
    }])
    .filter('date', function() {
        return function(input) {
            if (!input) return '';
            try {
                var date = new Date(input);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            } catch (e) {
                return input;
            }
        };
    })
    .filter('number', function() {
        return function(input, fractionSize) {
            if (input === null || input === undefined) return '0.00';
            var num = parseFloat(input);
            return isNaN(num) ? '0.00' : num.toFixed(fractionSize || 2);
        };
    });
</script>
</body>
</html>
=======
    <!-- End Container -->
    <script>
        angular.module('productApp', [])

            .controller('ProductController', ['$http', function($http) {

                var vm = this;


                // ==========================
                // Variables
                // ==========================

                vm.products = {
                    data: []
                };

                vm.searchText = '';

                vm.itemsPerPage = 3;

                vm.loading = false;


                vm.statistics = {

                    total_products: 0,

                    total_variants: 0,

                    total_stock: 0,

                    total_inventory_value: 0,

                    low_stock_variants: 0

                };


                // Empty Product

                vm.product = {

                    id: null,

                    name: '',

                    description: '',

                    variants: [

                        {

                            sku: '',

                            size: '',

                            color: '',

                            price: null,

                            stock_quantity: null

                        }

                    ]

                };



                // ==========================
                // CSRF
                // ==========================

                $http.defaults.headers.common['X-CSRF-TOKEN'] =
                    document.querySelector('meta[name="csrf-token"]').getAttribute('content');





                // ==========================
                // Add Variant
                // ==========================

                vm.addVariant = function() {

                    let variant = {

                        sku: '',

                        size: '',

                        color: '',

                        price: null,

                        stock_quantity: null

                    };

                    vm.generateSKU(variant);

                    vm.product.variants.push(variant);

                };


                // ==========================
                // Remove Variant
                // ==========================

                vm.removeVariant = function(index) {

                    if (vm.product.variants.length > 1) {

                        vm.product.variants.splice(index, 1);

                    }

                };


                // ==========================
                // Generate SKU
                // ==========================


                vm.generateSKU = function(variant) {

                    if (!vm.product.name) {

                        variant.sku = '';

                        return;

                    }

                    let product = vm.product.name.substring(0, 3).toUpperCase();

                    let size = (variant.size || 'NA').substring(0, 2).toUpperCase();

                    let color = (variant.color || 'NA').substring(0, 2).toUpperCase();

                    variant.sku = product + '-' + size + '-' + color;

                };

                vm.getTotalVariants = function() {

                    return vm.product.variants.length;

                };

                vm.getTotalStock = function() {

                    let total = 0;

                    angular.forEach(vm.product.variants, function(variant) {

                        total += Number(variant.stock_quantity || 0);

                    });

                    return total;

                };

                vm.getInventoryValue = function() {

                    let total = 0;

                    angular.forEach(vm.product.variants, function(variant) {

                        total += Number(variant.price || 0) * Number(variant.stock_quantity || 0);

                    });

                    return total.toFixed(2);

                };

                vm.getAveragePrice = function() {

                    if (vm.product.variants.length === 0) {

                        return 0;

                    }

                    let total = 0;

                    angular.forEach(vm.product.variants, function(variant) {

                        total += Number(variant.price || 0);

                    });

                    return (total / vm.product.variants.length).toFixed(2);

                };


                // ==========================
                // Save Product
                // ==========================

                vm.submitForm = function() {

                    let combinations = [];

                    for (let i = 0; i < vm.product.variants.length; i++) {

                        let key = (
                            (vm.product.variants[i].size || '').trim() +
                            '-' +
                            (vm.product.variants[i].color || '').trim()
                        ).toLowerCase();

                        if (combinations.includes(key)) {

                            Swal.fire({

                                icon: 'warning',

                                title: 'Duplicate Variant',

                                text: 'Same Size & Color already exists.'

                            });

                            return;

                        }

                        combinations.push(key);

                    }


                    vm.loading = true;


                    let url = '/products';

                    let method = 'post';



                    if (vm.product.id) {

                        url = '/products/' + vm.product.id;

                        method = 'put';

                    }

                    $http[method](url, vm.product)

                        .then(function(response) {


                            Swal.fire({

                                icon: 'success',

                                title: 'Success',

                                text: response.data.message,

                                timer: 1500,

                                showConfirmButton: false

                            });



                            vm.resetForm();

                            vm.loadProducts();

                            vm.loadStatistics();


                        })

                        .catch(function(error) {


                            Swal.fire({

                                icon: 'error',

                                title: 'Error',

                                text: 'Something went wrong'

                            });


                        })

                        .finally(function() {

                            vm.loading = false;

                        });


                };


                // ==========================
                // Reset Form
                // ==========================

                vm.resetForm = function() {


                    vm.product = {

                        id: null,

                        name: '',

                        description: '',

                        variants: [

                            {

                                sku: '',

                                size: '',

                                color: '',

                                price: null,

                                stock_quantity: null

                            }

                        ]

                    };


                };


                // ==========================
                // Load Products
                // ==========================

                vm.loadProducts = function(url) {


                    url = url || '/products';



                    $http.get(url, {

                            params: {

                                search: vm.searchText,

                                per_page: vm.itemsPerPage

                            }

                        })

                        .then(function(response) {


                            vm.products = response.data;


                        });


                };


                // ==========================
                // Pagination
                // ==========================

                vm.changePage = function(url) {

                    if (url) {

                        vm.loadProducts(url);

                    }

                };


                // ==========================
                // Dashboard Statistics
                // ==========================

                vm.loadStatistics = function() {


                    $http.get('/statistics')

                        .then(function(response) {


                            vm.statistics = response.data;


                        });


                };


                // ==========================
                // Edit Product
                // ==========================

                vm.editProduct = function(product) {

                    vm.product = angular.copy(product);

                    // Regenerate SKU for all variants
                    angular.forEach(vm.product.variants, function(variant) {
                        vm.generateSKU(variant);
                    });

                    window.scrollTo({

                        top: 0,

                        behavior: 'smooth'

                    });

                };


                // ==========================
                // Delete Product SweetAlert
                // ==========================

                vm.deleteProduct = function(product) {


                    Swal.fire({

                            title: 'Delete Product?',

                            text: product.name + ' will be deleted',

                            icon: 'warning',

                            showCancelButton: true,

                            confirmButtonText: 'Yes Delete'


                        })

                        .then(function(result) {


                            if (result.isConfirmed) {



                                $http.delete('/products/' + product.id)

                                    .then(function(response) {


                                        Swal.fire({

                                            icon: 'success',

                                            title: 'Deleted',

                                            text: response.data.message,

                                            timer: 1500,

                                            showConfirmButton: false

                                        });


                                        vm.loadProducts();

                                        vm.loadStatistics();


                                    });



                            }


                        });



                };


                // ==========================
                // Initial Load
                // ==========================

                vm.loadProducts();

                vm.loadStatistics();



            }])


            .filter('date', function() {

                return function(value) {

                    if (!value) {

                        return '';

                    }


                    return new Date(value).toLocaleDateString();


                };


            });
    </script>

</body>

</html>
>>>>>>> development
