<!DOCTYPE html>
<html lang="en" ng-app="productApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Variants Repeater - Laravel + AngularJS</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

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

    <div class="container mt-4">

        <!-- ================= Dashboard Statistics ================= -->
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body text-center">
                        <h6>Total Products</h6>
                        <h2>@{{ vm.statistics.total_products }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white shadow">
                    <div class="card-body text-center">
                        <h6>Total Variants</h6>
                        <h2>@{{ vm.statistics.total_variants }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning shadow">
                    <div class="card-body text-center">
                        <h6>Total Stock</h6>
                        <h2>@{{ vm.statistics.total_stock }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body text-center">
                        <h6>Inventory Value</h6>
                        <h3>$@{{ vm.statistics.total_inventory_value }}</h3>
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

                                    <input type="text" class="form-control" ng-model="vm.product.name" required>

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

                                    <div class="col-md-3">

                                        <label class="form-label">
                                            Size
                                        </label>

                                        <input type="text" class="form-control" ng-model="variant.size"
                                            placeholder="Size">

                                    </div>

                                    <div class="col-md-3">

                                        <label class="form-label">
                                            Color
                                        </label>

                                        <input type="text" class="form-control" ng-model="variant.color"
                                            placeholder="Color">

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
                                        class="badge bg-info text-dark me-1 mb-1">

                                        @{{ variant.size || '-' }}

                                        /

                                        @{{ variant.color || '-' }}

                                        |

                                        $@{{ variant.price }}

                                        |

                                        Qty :
                                        @{{ variant.stock_quantity }}

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

    <!-- End Container -->
    <script>

        angular.module('productApp', [])

            .controller('ProductController', ['$http', function ($http) {

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

                    total_inventory_value: 0

                };


                // Empty Product

                vm.product = {

                    id: null,

                    name: '',

                    description: '',

                    variants: [

                        {

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

                vm.addVariant = function () {

                    vm.product.variants.push({

                        size: '',

                        color: '',

                        price: null,

                        stock_quantity: null

                    });

                };




                // ==========================
                // Remove Variant
                // ==========================

                vm.removeVariant = function (index) {

                    if (vm.product.variants.length > 1) {

                        vm.product.variants.splice(index, 1);

                    }

                };





                // ==========================
                // Save Product
                // ==========================

                vm.submitForm = function () {


                    vm.loading = true;


                    let url = '/products';

                    let method = 'post';



                    if (vm.product.id) {

                        url = '/products/' + vm.product.id;

                        method = 'put';

                    }



                    $http[method](url, vm.product)

                        .then(function (response) {


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

                        .catch(function (error) {


                            Swal.fire({

                                icon: 'error',

                                title: 'Error',

                                text: 'Something went wrong'

                            });


                        })

                        .finally(function () {

                            vm.loading = false;

                        });


                };






                // ==========================
                // Reset Form
                // ==========================

                vm.resetForm = function () {


                    vm.product = {

                        id: null,

                        name: '',

                        description: '',

                        variants: [

                            {

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

                vm.loadProducts = function (url) {


                    url = url || '/products';



                    $http.get(url, {

                        params: {

                            search: vm.searchText,

                            per_page: vm.itemsPerPage

                        }

                    })

                        .then(function (response) {


                            vm.products = response.data;


                        });


                };







                // ==========================
                // Pagination
                // ==========================

                vm.changePage = function (url) {

                    if (url) {

                        vm.loadProducts(url);

                    }

                };








                // ==========================
                // Dashboard Statistics
                // ==========================

                vm.loadStatistics = function () {


                    $http.get('/statistics')

                        .then(function (response) {


                            vm.statistics = response.data;


                        });


                };








                // ==========================
                // Edit Product
                // ==========================

                vm.editProduct = function (product) {


                    vm.product = angular.copy(product);



                    window.scrollTo({

                        top: 0,

                        behavior: 'smooth'

                    });


                };







                // ==========================
                // Delete Product SweetAlert
                // ==========================

                vm.deleteProduct = function (product) {


                    Swal.fire({

                        title: 'Delete Product?',

                        text: product.name + ' will be deleted',

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonText: 'Yes Delete'


                    })

                        .then(function (result) {


                            if (result.isConfirmed) {



                                $http.delete('/products/' + product.id)

                                    .then(function (response) {


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



            .filter('date', function () {

                return function (value) {

                    if (!value) {

                        return '';

                    }


                    return new Date(value).toLocaleDateString();


                };


            });

    </script>

</body>

</html>