<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', 'ShopPageController@categories');

Route::get('produtos', 'ShopPageController@search');
Route::get('products/{id}', 'ShopPageController@products');
Route::get('produtos/{qtd}', 'ShopPageController@produtos');
Route::get('products/category/{id}', 'ShopPageController@filtra');
Route::put('specifications/update/{id}', 'ShopPageController@updateSpecifications');

Route::get('reviews/{id}', 'Api\ReviewsController@index');
Route::post('reviews/store', 'Api\ReviewsController@store');

Route::get('comments/{id}', 'Api\CommentsController@index');
Route::post('comments/store', 'Api\CommentsController@store');

Route::get('wishlist/{id}', 'Api\WishlistController@index');
Route::post('wishlist/store', 'Api\WishlistController@store');
Route::delete('wishlist/destroy/{id}', 'Api\WishlistController@destroy');

Route::post('cart/store', 'Api\CartController@store');

Route::get('admin/chat/{id}/{cliente}', 'Admin\ChatPageController@indexVue');
Route::post('admin/chat/store', 'Admin\ChatPageController@store');

Route::get('painel/chat/{id}/{cliente}', 'ChatPageController@indexVue');
Route::post('painel/chat/store', 'ChatPageController@store');


Route::get('/chat/admin/{id}/{cliente}', 'ChatController@indexVue');
Route::post('/chat/admin/store', 'ChatController@store');

Route::get('/chat/painel/{id}/{cliente}', 'ChatController@show');
Route::post('/chat/painel/store', 'ChatController@store');

Route::post('checkout/buy', 'Api\CheckoutController@store');