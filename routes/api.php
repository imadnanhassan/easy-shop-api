<?php

use App\Http\Controllers\Api\Admin\AttributeController;
use App\Http\Controllers\Api\Admin\AttributeValueController;
use App\Http\Controllers\Api\Admin\BlogCategoryController;
use App\Http\Controllers\Api\Admin\BlogPostController;
use App\Http\Controllers\Api\Admin\BlogTagController;
use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\Admin\FaqController;
use App\Http\Controllers\Api\Admin\LanguageController;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\StaffController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\UnitController;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']);

//Admin Routes

Route::prefix('admins')->middleware(['auth:sanctum', 'abilities:admin'])->group(function () {
    // Brands
    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'index']);
        Route::post('/store', [BrandController::class, 'store']);
        Route::post('/update/{id}', [BrandController::class, 'update']);
        Route::get('/delete/{id}', [BrandController::class, 'delete']);
        Route::get('/status-change/{id}', [BrandController::class, 'changeStatus']);
    });
    // Language
    Route::prefix('languages')->group(function () {
        Route::get('/', [LanguageController::class, 'index']);
        Route::post('/store', [LanguageController::class, 'store']);
        Route::post('/update/{id}', [LanguageController::class, 'update']);
        Route::get('/delete/{id}', [LanguageController::class, 'delete']);
    });
    // Category
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::post('/update/{slug}', [CategoryController::class, 'update']);
        Route::get('/delete/{slug}', [CategoryController::class, 'delete']);
        Route::get('/restore/{slug}', [CategoryController::class, 'restore']);
        Route::get('/forceDelete/{slug}', [CategoryController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [CategoryController::class, 'onlyTrashed']);
    });

    // Attribute
    Route::prefix('attributes')->group(function () {
        Route::get('/', [AttributeController::class, 'index']);
        Route::post('/store', [AttributeController::class, 'store']);
        Route::post('/update/{id}', [AttributeController::class, 'update']);
        Route::get('/delete/{id}', [AttributeController::class, 'delete']);
    });
    // Attribute value
    Route::prefix('attribute-value')->group(function () {
        Route::get('/', [AttributeValueController::class, 'index']);
        Route::post('/store', [AttributeValueController::class, 'store']);
        Route::post('/update/{id}', [AttributeValueController::class, 'update']);
        Route::get('/delete/{id}', [AttributeValueController::class, 'delete']);
        Route::get('/restore/{id}', [AttributeValueController::class, 'restore']);
        Route::get('/forceDelete/{id}', [AttributeValueController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [AttributeValueController::class, 'onlyTrashed']);
    });
    // Blog Category
    Route::prefix('blog-category')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index']);
        Route::post('/store', [BlogCategoryController::class, 'store']);
        Route::post('/update/{id}', [BlogCategoryController::class, 'update']);
        Route::get('/delete/{id}', [BlogCategoryController::class, 'delete']);
        Route::get('/restore/{id}', [BlogCategoryController::class, 'restore']);
        Route::get('/forceDelete/{id}', [BlogCategoryController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [BlogCategoryController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [BlogCategoryController::class, 'statusChange']);
    });
    // Blog tag
    Route::prefix('blog-tag')->group(function () {
        Route::get('/', [BlogTagController::class, 'index']);
        Route::post('/store', [BlogTagController::class, 'store']);
        Route::post('/update/{id}', [BlogTagController::class, 'update']);
        Route::get('/delete/{id}', [BlogTagController::class, 'delete']);
        Route::get('/restore/{id}', [BlogTagController::class, 'restore']);
        Route::get('/forceDelete/{id}', [BlogTagController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [BlogTagController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [BlogTagController::class, 'statusChange']);
    });
    // Blog post
    Route::prefix('blog-post')->group(function () {
        Route::get('/', [BlogPostController::class, 'index']);
        Route::post('/store', [BlogPostController::class, 'store']);
        Route::post('/update/{id}', [BlogPostController::class, 'update']);
        Route::get('/delete/{id}', [BlogPostController::class, 'delete']);
        Route::get('/restore/{id}', [BlogPostController::class, 'restore']);
        Route::get('/forceDelete/{id}', [BlogPostController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [BlogPostController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [BlogPostController::class, 'statusChange']);
    });
    // Unit
    Route::prefix('units')->group(function () {
        Route::get('/', [UnitController::class, 'index']);
        Route::post('/store', [UnitController::class, 'store']);
        Route::post('/update/{id}', [UnitController::class, 'update']);
        Route::get('/delete/{id}', [UnitController::class, 'delete']);
        Route::get('/restore/{id}', [UnitController::class, 'restore']);
        Route::get('/forceDelete/{id}', [UnitController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [UnitController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [UnitController::class, 'statusChange']);
    });

    //Staff
    Route::prefix('staffs')->group(function () {
        Route::get('/', [StaffController::class, 'index']);
        Route::post('/store', [StaffController::class, 'store']);
        Route::post('/update/{id}', [StaffController::class, 'update']);
        Route::get('/delete/{id}', [StaffController::class, 'delete']);
        Route::get('/status-change/{id}', [StaffController::class, 'statusChange']);
    });
    // slider
    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'index']);
        Route::post('/store', [SliderController::class, 'store']);
        Route::post('/update/{id}', [SliderController::class, 'update']);
        Route::get('/delete/{id}', [SliderController::class, 'delete']);
        Route::get('/restore/{id}', [SliderController::class, 'restore']);
        Route::get('/forceDelete/{id}', [SliderController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [SliderController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [SliderController::class, 'statusChange']);
    });
    // faq
    Route::prefix('faqs')->group(function () {
        Route::get('/', [FaqController::class, 'index']);
        Route::post('/store', [FaqController::class, 'store']);
        Route::post('/update/{id}', [FaqController::class, 'update']);
        Route::get('/delete/{id}', [FaqController::class, 'delete']);
        Route::get('/restore/{id}', [FaqController::class, 'restore']);
        Route::get('/forceDelete/{id}', [FaqController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [FaqController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [FaqController::class, 'statusChange']);
    });
    // color
    Route::prefix('colors')->group(function () {
        Route::get('/', [ColorController::class, 'index']);
        Route::post('/store', [ColorController::class, 'store']);
        Route::post('/update/{id}', [ColorController::class, 'update']);
        Route::get('/delete/{id}', [ColorController::class, 'delete']);
        Route::get('/restore/{id}', [ColorController::class, 'restore']);
        Route::get('/forceDelete/{id}', [ColorController::class, 'forceDelete']);
        Route::get('/onlyTrashed', [ColorController::class, 'onlyTrashed']);
        Route::get('/status-change/{id}', [ColorController::class, 'statusChange']);
    });
});
