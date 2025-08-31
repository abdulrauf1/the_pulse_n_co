<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\{
  
    ProfileController,
    AdminDashboardController,
    AdminProductController,
    AdminCategoryController,
    AdminOrderController,
    AdminCustomerController,
    AdminSettingController,
    AdminPromotionController

};

use App\Http\Controllers\Public\{
    HomeController,
    ProductController,
    CartController,
    CheckoutController,
    CategoryController,
    ShopController,
    PageController,
};

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop Routes
Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop');
    Route::get('/products/{product:slug}', [ShopController::class, 'show'])->name('products.show');

});

// Shop Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('shop.category');
    
});

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/items', [CartController::class, 'items'])->name('cart.items');

    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    
    // Route::post('/', [CartController::class, 'store'])->name('cart.store');
    // Route::patch('/{rowId}', [CartController::class, 'update'])->name('cart.update');
    // Route::delete('/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
});


// Checkout Routes
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
    Route::get('/receipt/{order}', [CheckoutController::class, 'receipt'])->name('checkout.receipt');    
});



// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submit'])->name('contact.submit');

Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/shipping', [PageController::class, 'shipping'])->name('shipping');
Route::get('/returns', [PageController::class, 'returns'])->name('returns');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');


Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Additional dashboard routes can be added here
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Products
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Product listing and management
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/inventory', [AdminProductController::class, 'inventory'])->name('products.inventory');
    
    // Product creation
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    
    // Product display and editing
    Route::get('/products/{product:slug}', [AdminProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    
    // Product deletion
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    
    // Image management
    Route::post('/products/{product}/images/{image}/set-primary', [AdminProductController::class, 'setPrimaryImage'])
         ->name('products.setPrimaryImage');
    Route::delete('/products/images/{image}', [AdminProductController::class, 'destroyImage'])
         ->name('products.destroyImage');
});

// Promotions Routes    
Route::middleware('auth')->group(function () {
    Route::get('promotions', [AdminPromotionController::class, 'index'])->name('admin.promotions.index');
    Route::get('promotions/create', [AdminPromotionController::class, 'create'])->name('admin.promotions.create');
    Route::get('promotions/{promotion}/edit', [AdminPromotionController::class, 'edit'])->name('admin.promotions.edit');
    Route::post('promotions/store', [AdminPromotionController::class, 'store'])->name('admin.promotions.store');
    Route::put('promotions/{promotion}', [AdminPromotionController::class, 'update'])->name('admin.promotions.update');

    // Promotion Products Management
    Route::get('promotions/{promotion}/products', [AdminPromotionController::class, 'manageProducts'])->name('admin.promotions.products');
    Route::put('promotions/{promotion}/products', [AdminPromotionController::class, 'updateProducts'])->name('admin.promotions.products.update');
    Route::delete('promotions/{promotion}', [AdminPromotionController::class, 'destroy'])->name('admin.promotions.destroy');
}); 


// Categories
Route::middleware('auth')->group(function () {
    Route::resource('admin/categories', AdminCategoryController::class)->name('index', 'admin.categories.index');
    Route::get('admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('admin/categories/store', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

// Oreders
Route::middleware('auth')->group(function () {
    Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('admin/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
});

// Customers
Route::middleware('auth')->group(function () {
    Route::get('admin/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('admin/customers/{customer}', [AdminCustomerController::class, 'show'])->name('admin.customers.show');
});





// Settings
// Admin Settings Routes
Route::middleware('auth')->prefix('admin/settings')->group(function () {
    // Main settings page
    Route::get('/', [AdminSettingController::class, 'index'])->name('admin.settings');
    
    // Carousel management
    Route::put('/carousel', [AdminSettingController::class, 'updateCarousel'])->name('admin.settings.carousel.update');
    Route::post('/carousel/add', [AdminSettingController::class, 'addCarouselItem'])->name('admin.settings.carousel.add');
    Route::delete('/carousel/{carousel}', [AdminSettingController::class, 'deleteCarouselItem'])->name('admin.settings.carousel.delete');
    
});


require __DIR__.'/auth.php';
