<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorSizeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/



###########################     Customer Auth FrontEnd Routes     ###########################
Route::get('customer/login', [CustomerAuthController::class, 'index'])->name('customer.auth.index');
Route::post('customer/login', [CustomerAuthController::class, 'signin'])->name('customer.auth.signin');
Route::post('customer/register', [CustomerAuthController::class, 'registerCustomer'])->name('customer.register');
Route::get('github/redirect', [CustomerAuthController::class, 'GitHubRedirect'])->name('customer.GitHub.Redirect');
Route::get('github/callback', [CustomerAuthController::class, 'GitHubCallback'])->name('customer.GitHub.callback');


#           Frontend Route
Route::get('/', [FrontendController::class, 'index'])->name('front.index');
Route::post('/get/product/size/', [FrontendController::class, 'getProductSize'])->name('front.product_size');
Route::get('/details/{slug}{product}', [FrontendController::class, 'signleProduct'])->name('front.product.details');

#           Cart Route
Route::get('cart/delete{cart}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('cart/update{cart}', [CartController::class, 'updatecart'])->name('cart.updatecart');
Route::get('/cart/{name?}', [CartController::class, 'index'])->name('cart.index');
Route::post('cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/get/district/list', [CartController::class, 'getDistrictList'])->name('cart.DistrictList');
Route::post('/get/town/list', [CartController::class, 'getTownList'])->name('cart.TownList');

#           Checkout Route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');






###########################     Admin's BackEnd Routes     ###########################
#           Dashboard
Route::get('dashboard', function () {
    return view('backend.dashboard');
})->name('dashboard')->middleware(['auth', 'administrator']);


Route::get('user/{user?}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('profile/post', [ProfileController::class, 'store'])->name('profile.store');
Route::get('change/{user}/password', [ProfileController::class, 'changePassword'])->name('profile.password');
Route::put('change/{user}/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

#           Category Route
Route::get('category/trash', [CategoryController::class, 'trash'])->name('category.trash');
Route::get('category/{category}/restore', [CategoryController::class, 'restore'])->name('category.restore');
Route::resource('category', CategoryController::class);

#           SubCategory Route
Route::get('subcategory/trash', [SubcategoryController::class, 'trash'])->name('subcategory.trash');
Route::get('subcategory/{subcategory}/restore', [SubcategoryController::class, 'restore'])->name('subcategory.restore');
Route::resource('subcategory', SubcategoryController::class);

#           Product Route
Route::get('product/{product}/gallery/{gallery}/delete', [ProductController::class, 'destroygallery'])->name('destroy.gallery');
Route::post('get/subcategory', [ProductController::class, 'ajaxGetSubcategory'])->name('get.subcategory');
Route::resource('product', ProductController::class);

#           Size and Color Route
Route::get('/color', [ColorSizeController::class, 'colorIndex'])->name('color.index');
Route::post('/color', [ColorSizeController::class, 'colorStore'])->name('color.store');
Route::get('/size', [ColorSizeController::class, 'sizeIndex'])->name('size.index');
Route::post('/size', [ColorSizeController::class, 'sizeStore'])->name('size.store');

#           Coupon Route
Route::resource('coupon', CouponController::class);

Route::get('assign/user', [RoleController::class, 'assignUser'])->name('role.assignUser');
Route::post('assign/user', [RoleController::class, 'assignUserStore'])->name('role.assignUserStore');
Route::get('new/admin', [RoleController::class, 'createAdmin'])->name('role.create.admin');
Route::post('new/admin', [RoleController::class, 'storeAdmin'])->name('role.store.admin');
Route::get('revoke/{role}/{user}', [RoleController::class, 'revoke'])->name('role.revoke');
Route::resource('role', RoleController::class);



require __DIR__ . '/auth.php';