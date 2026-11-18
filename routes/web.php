<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::view('/', 'home')->name('home');
Route::view('/sobre', 'sobre')->name('sobre');

// Login
Route::get('/login', [LoginController::class, 'create'])
    ->name('login');

Route::post('/login', [LoginController::class, 'attempt'])
    ->name('login.attempt');

// Logout - somente usuários logados
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Listagem pública de produtos
Route::get('/produtos', [ProdutoController::class, 'index'])
    ->name('produtos.index');

// Rotas que exigem login
Route::middleware('auth')->group(function () {

    // Cadastro de produtos - somente vendedores
    Route::get('/produtos/create', [ProdutoController::class, 'create'])
        ->middleware('vendedor')
        ->name('produtos.create');

    Route::post('/produtos', [ProdutoController::class, 'store'])
        ->middleware('vendedor')
        ->name('produtos.store');

    // Compras - usuários autenticados
    Route::get('/compras', [CompraController::class, 'index'])
        ->name('compras.index');

    Route::get('/compras/create', [CompraController::class, 'create'])
        ->name('compras.create');

    Route::post('/compras', [CompraController::class, 'store'])
        ->name('compras.store');
});

