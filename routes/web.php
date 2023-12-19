<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AngelPostController;
use App\Http\Controllers\NotificationController;

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
Route::get('/back',function(){
    return back();
})->name('back');


Route::get('/loginPage',[AuthController::class,'loginPage'])->name('loginPage');
Route::get('/registerPage',[AuthController::class,'registerPage'])->name('registerPage');

// User Before Auth

// Home
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home',[HomepageController::class,'userHome'])->name('home');

// Angels
Route::get('/angels',[AngelPostController::class,'angelUser'])->name('user#angel');

//Food
Route::group(['prefix'=>'food'],function(){
    Route::get('/food/{type}',[FoodController::class,'foodUser'])->name('user#food');
});

// Accessory
Route::group(['prefix'=>'accessory'],function(){
    Route::get('/accessory/{type}',[AccessoryController::class,'accessoryUser'])->name('user#accessory');
});

// End Uesr Before Auth


// Authentication
Route::middleware(['auth'])->group(function(){

    // Role Check
    Route::get('/roleCheck',[AuthController::class,'roleCheck'])->name('roleCheck');

    //Admin
    Route::middleware(['adminAuth'])->group(function(){

        Route::group(['prefix'=>'admin'],function(){

            // Admin Registration
            Route::middleware(['mainAdminAuth'])->group(function(){
                Route::get('/register',[AdminController::class,'adminRegister'])->name('admin#register');
            });

            // Profile
            Route::get('/profileEdit',[AdminController::class,'profileEdit'])->name('admin#profileEdit');
            Route::post('/profileUpdate',[AdminController::class,'profileUpdate'])->name('admin#profileUpdate');
    
            // Home
            Route::group(['prefix'=>'home'],function(){
                Route::get('page',[HomepageController::class,'home'])->name('admin#home');

                // Notification
                Route::get('notification/{id}',[NotificationController::class,'checkNoti'])->name('admin#checkNoti');
                
                //Home Banner Edit
                Route::get('bannerEdit',[HomepageController::class,'bannerEdit'])->name('admin#bannerEdit');
                Route::post('bannerUpdate',[HomepageController::class,'bannerUpdate'])->name('admin#bannerUpdate');

                // Select Header
                Route::post('selectHeader',[HomepageController::class,'selectHeader'])->name('admin#selectHeader');
                
                // Select Food For Home Page
                Route::get('selectFood',[HomePageController::class,'selectFood'])->name('admin#selectFood');
                Route::post('selectedFood',[HomePageController::class,'selectedFood'])->name('admin#selectedFood');

                // Select Accessory For Home Page
                Route::get('selectAccessory',[HomepageController::class,'selectAccessory'])->name('admin#selectAccessory');
                Route::post('selectedAccessory',[HomePageController::class,'selectedAccessory'])->name('admin#selectedAccessory');

            });

            // Angel
            Route::group(['prefix'=>'angel'],function(){
                Route::get('page',[AngelPostController::class,'angelPage'])->name('admin#angelPage');
                Route::get('addPostPage',[AngelPostController::class,'addPostPage'])->name('admin#addPostPage');
                Route::post('addToAngelDb',[AngelPostController::class,'addToAngelDb'])->name('admin#addToAngelDb');
                Route::get('editPostPage/{id}',[AngelPostController::class,'editPage'])->name('admin#editPostPage#Angel');
                Route::post('updatePost',[AngelPostController::class,'updatePost'])->name('admin#updatePost#Angel');
                Route::get('deletePost/{id}',[AngelPostController::class,'deletePost'])->name('admin#deletePost#Angel');
            });

            // Order List
            Route::group(['prefix'=>'order'],function(){
               Route::get('page',[OrderController::class,'orderPageAdmin'])->name('admin#orderPage'); 
               Route::get('processDone/{id}',[OrderController::class,'processDone'])->name('admin#orderProcessDone');
               Route::get('processCancel/{id}',[OrderController::class,'processCancel'])->name('admin#orderProcessCancel');
            });

            // Search
            Route::get('search/{table}',[SearchController::class,'searchAdmin'])->name('admin#search');

            // Food
            Route::group(['prefix'=>'food'],function(){
                Route::get('food/{type}',[FoodController::class,'foodAdmin'])->name('admin#food');
                Route::get('addItemPage/{type}',[FoodController::class,'addItemPageAdmin'])->name('admin#addItemPage#Food');
                Route::post('addItemDb',[FoodController::class,'addItemDb'])->name('admin#addItemDb#Food');
                Route::get('editItem/{id}',[FoodController::class,'editItem'])->name('admin#editItem#Food');
                route::post('updateItem',[FoodController::class,'updateItem'])->name('admin#updateItem#Food');
                Route::get('deleteItem/{id}',[FoodController::class,'deleteItem'])->name('admin#deleteItem#Food');
            });

            // Accessory
            Route::group(['prefix'=>'acccessory'],function(){
                Route::get('accessory/{type}',[AccessoryController::class,'accessoryAdmin'])->name('admin#accessory');
                Route::get('addItemPage/{type}',[AccessoryController::class,'addItemPageAdmin'])->name('admin#addItemPage#Accessory');
                Route::post('addItemDb',[AccessoryController::class,'addItemDb'])->name('admin#addItemDb#Accessory');
                Route::get('editItem/{id}',[AccessoryController::class,'editItem'])->name('admin#editItem#Accessory');
                Route::post('updateItem',[AccessoryController::class,'updateItem'])->name('admin#updateItem#Accessory');
                Route::get('deleteItem/{id}',[AccessoryController::class,'deleteItem'])->name('admin#deleteItem#Accessory');

            });

            // Message
            Route::get('message/{user}',[MessageController::class,'messageAdmin'])->name('admin#message');
            Route::post('sendMessage',[MessageController::class,'sendMessageAdmin'])->name('admin#sendMessage');

            // Veterinarian
            Route::get('vetPage',[VetController::class,'vetPage'])->name('admin#vetPage');
            Route::get('addProfile',[VetController::class,'addProfile'])->name('admin#addProfile');
            Route::post('addToVetDb',[VetController::class,'addToVetDb'])->name('admin#addToVetDb');
            Route::get('deleteVetProfile/{id}',[VetController::class,'deleteVetProfile'])->name('admin#deleteVetProfile');
            Route::get('editVetProfile/{id}',[VetController::class,'editVetProfile'])->name('admin#editVetProfile');
            Route::post('updateVetProfile',[VetController::class,'updateVetProfile'])->name('admin#updateVetProfile');

            // About Us
            Route::get('aboutUs',[AboutUsController::class,'aboutUs'])->name('admin#aboutUs');
            Route::post('updateAboutUs',[AboutUsController::class,'updateAboutUs'])->name('admin#updateAboutUs');
        });
    });
    
    // User
    Route::middleware(['userAuth'])->group(function(){
        Route::group(['prefix'=>'user'],function(){
            Route::get('profileEdit',[UserController::class,'profileEdit'])->name('user#profileEdit');
            Route::post('profileUpdate',[UserController::class,'profileUpdate'])->name('user#profileUpdate');

            // Search
            Route::get('search/{table}',[SearchController::class,'searchUser'])->name('user#search');

            // Cart
            Route::get('cartPage',[CartController::class,'cartPage'])->name('user#cartPage');
            Route::post('addToCart',[CartController::class,'addToCart'])->name('user#addToCart');
            Route::get('decrease/{cartId}',[CartController::class,'decreaseCart'])->name('user#decreaseCart');
            Route::get('increase/{id}/{cartId}',[CartController::class,'increaseCart'])->name('user#increaseCart');
            Route::get('clearCart',[CartController::class,'clearCart'])->name('user#clearCart');

            // Order
            Route::get('buyPage',[OrderController::class,'buyPage'])->name('user#buyPage');
            Route::post('order',[OrderController::class,'order'])->name('user#order');
            Route::get('orderHistory',[OrderController::class,'orderHistory'])->name('user#orderHistory');

            // Angel
            Route::get('liked/{liked}/{id}',[AngelPostController::class,'liked'])->name('user#liked');

            // Contact Us
            Route::get('message',[MessageController::class,'message'])->name('user#message');
            Route::post('sendMessage',[MessageController::class,'sendMessage'])->name('user#sendMessage');

            // Veterinarian
            Route::get('vetPage',[VetController::class,'vetPageUser'])->name('user#vetPageUser');

            // About Us
            Route::get('aboutUs',[AboutUsController::class,'aboutUsUser'])->name('user#aboutUs');
    
        });
    });


});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
