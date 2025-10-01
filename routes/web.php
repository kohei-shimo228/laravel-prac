<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\WelcomeController::class, 'index']);

Route::get('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/test_out', [App\Http\Controllers\TestController::class, 'test_out']);
Route::get('/api-test', [App\Http\Controllers\TestController::class, 'apiTest']);
Route::get('/api-out', [App\Http\Controllers\TestController::class, 'apiOut']);

Route::get('/cuel-front', [App\Http\Controllers\CueLController::class, 'front']);
Route::get('/cuel-back', [App\Http\Controllers\CueLController::class, 'back']);

// TODO管理システムのルート
Route::resource('todos', App\Http\Controllers\TODOController::class);
Route::patch('todos/{todo}/toggle', [App\Http\Controllers\TODOController::class, 'toggle'])->name('todos.toggle');

Route::get('/test2', [App\Http\Controllers\test2Controller::class, 'index']);

// React アプリケーション
Route::get('/react', function () {
    return view('react-app');
});
