# PHP_Laravel12_Repeater_Implement_Using_Angular.JS

## Project Overview

A complete Laravel 12 application demonstrating a dynamic repeater field implementation using AngularJS on the frontend and Laravel on the backend. This project allows users to create products with multiple variants (size, color, price, stock) using a dynamic form where fields can be added or removed without page refresh.

This project is suitable for learning dynamic forms, handling nested data, interviews, and real-world product variant management scenarios.

---

## Features

* Dynamic repeater fields for product variants
* Add and remove variant rows without page reload
* AngularJS two-way data binding
* Laravel 12 RESTful backend
* Server-side and client-side validation
* Bootstrap 5 responsive UI
* CSRF protection
* Clean MVC architecture

---

## Prerequisites

* PHP 8.1 or higher
* Composer
* Laravel 12
* MySQL or compatible database
* Node.js (optional, for asset building)

---

## Installation Guide

### Step 1: Clone Repository

```bash
git clone https://github.com/yourusername/laravel-angular-repeater.git
cd laravel-angular-repeater
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_repeater
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations

```bash
php artisan migrate
```

### Step 5: Start Application

```bash
php artisan serve
```

Open browser:

```
http://localhost:8000
```

---
## Screenshot
<img width="1761" height="969" alt="image" src="https://github.com/user-attachments/assets/a9f39e40-4076-42d1-b926-c0e80180e6d2" />

---

## Project Structure

```
laravel-angular-repeater/
├── app/
│   ├── Http/Controllers/
│   │   └── ProductController.php
│   └── Models/
│       ├── Product.php
│       └── ProductVariant.php
├── database/
│   └── migrations/
│       ├── create_products_table.php
│       └── create_product_variants_table.php
├── resources/
│   └── views/
│       └── products/
│           └── index.blade.php
├── routes/
│   └── web.php
└── README.md
```

---

## API Endpoints

| Method | Endpoint  | Description                  |
| ------ | --------- | ---------------------------- |
| GET    | /         | Main product form & list     |
| POST   | /products | Create product with variants |
| GET    | /products | Fetch products with variants |

---

## Database Schema

### Products Table

```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Product Variants Table

```sql
CREATE TABLE product_variants (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id BIGINT UNSIGNED NOT NULL,
    size VARCHAR(50) NULL,
    color VARCHAR(50) NULL,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

---

## Usage Instructions

### Adding a New Product

1. Enter product name (required)
2. Add product description (optional)
3. Click "Add Variant" to add variant rows
4. Fill variant details:

   * Size (optional)
   * Color (optional)
   * Price (required)
   * Stock quantity (required)
5. Click "Save Product"

### Managing Variants

* Add multiple variants dynamically
* Remove any variant except the first
* Reset form to clear all inputs

### Viewing Products

* All products are listed below the form
* Each product displays its associated variants

---

## Code Examples

### AngularJS Controller

```javascript
angular.module('productApp', [])
.controller('ProductController', ['$http', function($http) {
    var vm = this;

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

    vm.addVariant = function() {
        vm.product.variants.push({
            size: '',
            color: '',
            price: null,
            stock_quantity: null
        });
    };

    vm.removeVariant = function(index) {
        if (vm.product.variants.length > 1) {
            vm.product.variants.splice(index, 1);
        }
    };
}]);
```

### Laravel Controller Store Method

```php
public function store(Request $request)
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
        'message' => 'Product created successfully'
    ]);
}
```

---

## Customization

### Adding More Variant Fields

* Update migration
* Update ProductVariant model `$fillable`
* Update validation rules
* Update AngularJS form

### Styling

* Built with Bootstrap 5
* Modify grid layout in `index.blade.php`
* Customize colors and spacing via CSS

---

## Error Handling

* CSRF mismatch: ensure CSRF token is set in AJAX headers
* Database errors: verify `.env` configuration
* AngularJS errors: check browser console and CDN loading
* Validation errors: ensure required fields are filled

---

## Testing

### Manual Testing

* Add product with multiple variants
* Remove variants
* Submit invalid data
* Submit empty form

### Automated Testing

```bash
php artisan make:test ProductTest
```

---

## Performance Considerations

* Add database indexes for large datasets
* Use pagination for product listing
* Optimize assets for production
* Implement caching where required

---

## Security

* CSRF protection enabled
* Eloquent ORM prevents SQL injection
* Input validation on client and server
* XSS protection via Blade

---

## Deployment

For production:

```bash
php artisan config:cache
php artisan route:cache
```

Set correct file permissions and configure Apache/Nginx.

---
