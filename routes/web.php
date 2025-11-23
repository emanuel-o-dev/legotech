<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('products.index');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Carrinho
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.index');
Route::post('/checkout/finish', [CheckoutController::class, 'finish'])->middleware('auth')->name('checkout.finish');


/*|--------------------------------------------------------------------------
| Rotas Usuário Autenticado
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->get('/me/orders', [UserOrderController::class, 'index'])
    ->name('user.orders');
Route::middleware(['auth'])
    ->get('/me/orders/{order}', [UserOrderController::class, 'show'])
    ->name('user.orders.show');

/*|--------------------------------------------------------------------------
| Rotas de Troca de Papel (Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::post('/toggle-role/{user}', [RoleController::class, 'toggle'])
        ->name('toggle.role');
});

/*
|--------------------------------------------------------------------------
| Login e Logout
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Rotas Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('categories', AdminCategoryController::class);
        Route::resource('products', AdminProductController::class);

        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    });


// Fallback dinâmico
Route::fallback(function () {
    if (Auth::check()) {
        // Usuário logado: exibe 404 interna ou redireciona pro dashboard
        return response()->view('errors.generic', [
            'code' => 404,
            'message' => 'Página não encontrada dentro do sistema.'
        ], 404);
        // ou: return redirect()->route('dashboard');
    }

    // Usuário não autenticado: exibe 404 pública
    return response()->view('errors.generic', [
        'code' => 404,
        'message' => 'A página que você procura não existe.'
    ], 404);
});
