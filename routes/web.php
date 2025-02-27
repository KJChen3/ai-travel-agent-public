<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\dropdownListController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// 登入
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::post('/chat', [ChatController::class, 'chat'])->name('chat');
});


// 首頁
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// 景點推薦
// Route::resource('products', ProductController::class)
//     ->middleware(['auth', 'verified'])
//     ->except(['index', 'show']);
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


//個人喜好
Route::get('/preference', function () {
    return view('userPreference.preference');
})->name('preference');

//儲存個人喜好
Route::post('/preference/store', [PreferenceController::class, 'store'])->name('preference.store');
Route::get('/preference/success', [PreferenceController::class, 'success'])->name('preference.success');

//獲取個人喜好
Route::get('/dashboard', [PreferenceController::class, 'showUserPreference'])->name('dashboard');


//生成行程
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');
Route::get('/generate', function () {
    return view('journey.generate');
})->name('generate');

//下拉式選單
Route::get('/dropdownList', function () {
    return view('dropdownList.dropdownList');
})->name('dropdownList');

//下拉式選單生成行程
Route::post('/submitSelection', [dropdownListController::class, 'submitSelectionChat'])->name('submitSelection');

//修改重新生成行程
Route::post('/updateItinerary', [ChatController::class, 'updateItinerary'])->name('updateItinerary');

//收藏行程
Route::post('/saveJourney', [JourneyController::class, 'store'])->name('saveJourney');

//瀏覽收藏的行程
Route::get('/user/journeys', [JourneyController::class, 'showSavedJourneys']);

Route::get('/viewSavedJourney', function () {
    return view('journey.viewSavedJourney');  // 返回 viewSavedJourney.blade.php 頁面
})->name('viewSavedJourney');

require __DIR__.'/auth.php';
