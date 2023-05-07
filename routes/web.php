<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\Usr\UserDashBoardComponent;
use App\Http\Livewire\WishListIconComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminDashBoardComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',HomeComponent::class)->name('home.index');
Route::get('/shop',ShopComponent::class)->name('shop.index');
Route::get('/cart',CartComponent::class)->name('shop.cart');
Route::get('/wishlist',WishListIconComponent::class)->name('shop.wishlist');
Route::get('/checkout',CheckoutComponent::class)->name('home.index');
Route::get('/product/{slug}',DetailsComponent::class)->name("product.details");
Route::get('/product-category/{slug}',CategoryComponent::class)->name("product.category");
Route::get('/search',SearchComponent::class)->name('product.search');



 
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard',UserDashBoardComponent::class)->name('user.dashboard');
});

Route::middleware(['auth','authadmin'])->group(function () {
    Route::get('/admin/dashboard',AdminDashBoardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories',AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add',AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}',AdminEditCategoryComponent::class)->name('admin.category.edit');
});

require __DIR__.'/auth.php';
