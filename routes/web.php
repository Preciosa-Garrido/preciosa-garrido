<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'ShopPageController@home')->name('start.page');

Route::get('/home', 'ShopPageController@home')->name('start.page');
Route::get('/shop', 'ShopPageController@index')->name('shop.page');
Route::get('/shop/product/{id}', 'ShopPageController@detail');

$this->group(['prefix' => 'cart'], function() {
    Route::get('/', 'CartPageController@index')->name('cart.page');
    Route::get('/product/checkout', 'CheckoutPageController@index')->name('checkout');
});

Route::get('/confirmation', 'ShopPageController@confirmation')->name('confirmation.page');
Route::get('/product/confirmation', 'ShopPageController@confirmation')->name('confirmation.page');

Route::get('/wishlist', 'WishlistPageController@index')->name('wishlist.page');
Route::post('/wishlist/store', 'WishlistPageController@store')->name('wishlist.store');
Route::get('/wishlist/destroy/{id}', 'WishlistPageController@destroy');

Route::get('/contacts', 'ContactPageController@index')->name('contacts');
Route::post('/contacts/store', 'ContactPageController@store');

Route::post('/newsletter', 'NewsletterPageController@store')->name('newsletter');


/**
 * ------------------------------------
 *           CONSUMIDOR
 * ------------------------------------
 */
$this->group(['prefix' => 'user'], function(){
    Route::get('/myaccount', 'UserPageController@index')->name('myaccount');
    Route::get('/mysales', 'UserPageController@sales')->name('mysales');
    Route::get('/mysales/{id}', 'UserPageController@productsForSale');
    Route::get('/edit', 'UserPageController@edit')->name('user.edit');
    Route::put('/update', 'UserPageController@update')->name('user.update');
});

Route::get('/chat', 'UserPageController@chat')->name('chat');
Route::get('/chat/admin/{id}', 'UserPageController@chatAdmin');
Route::get('/chat/painel/{id}', 'UserPageController@chatGestor');

/**
 * ------------------------------------
 *           GESTOR
 * ------------------------------------
 */

 $this->group(['prefix' => 'painel'], function(){
    Route::get('/login', 'Auth\GestorLoginController@showLoginForm')->name('gestor.login.form');
    Route::post('/login', 'Auth\GestorLoginController@login')->name('gestor.login');
});

$this->group(['prefix' => 'painel'], function(){
    Route::get('/', 'PainelPageController@index')->name('painel.homepage');
    Route::get('/home', 'PainelPageController@index')->name('painel.homepage');

    /**
     * ROTAS PARA AS VIEWS DO CHAT
     */
    Route::get('/chat', 'ChatPageController@index')->name('gestor.chat');
    Route::post('/chat/responder', 'ChatPageController@store')->name('gestor.responder');
    Route::get('/chat/show/{id}', 'ChatPageController@show');
    
    /**
     * ROTAS PARA AS VIEWS DOS PRODUTOS
     */
    Route::get('/products', 'ProductPageController@index')->name('products.consultar');
    Route::get('/products/images/edit/{id}', 'ImageController@edit');
    Route::get('/products/show/{id}', 'ProductPageController@show');
        
    /**
     * ROTAS PARA AS VIEWS DAS PROMOÇÕES
     */
    Route::get('/promotions', 'PromotionPageController@index')->name('promotion.consultar');


    /**
     * ROTAS PARA AS VIEWS DOS CLIENTES
     */
    Route::get('/clients', 'ClientesPageController@index')->name('clientes.consultar')->middleware('auth:gestor');
    Route::get('/clients/destroy/{id}', 'ClientesPageController@destroy')->middleware('auth:gestor');


    /**
     * ROTAS PARA AS VIEWS DAS COMPRAS
     */
    Route::get('/purchases', 'PurchasePageController@index')->name('purchase');


    /**
     * ROTAS PARA AS VIEWS DAS VENDAS
     */
    Route::get('/sales', 'SalesPageController@index')->name('sales');
    Route::get('/sales/show/{id}', 'SalesPageController@show');
    Route::get('/sales/edit/{id}', 'SalesPageController@edit');
    Route::put('/sales/update/{id}', 'SalesPageController@update');
    Route::get('/sales/destroy/{id}', 'SalesPageController@destroy');


    /**
     * ROTAS PARA AS VIEWS DOS CONTACTOS
     */
    Route::get('/contacts', 'ContactosPageController@index')->name('painel.contacts');
    Route::get('/contacts/show/{id}', 'ContactosPageController@show');
    Route::get('/contacts/destroy/{id}', 'ContactosPageController@destroy');
        

    /**
     * ROTAS PARA AS VIEWS DAS NEWSLETTER
     */
    Route::get('/newsletter', 'NewsletterPageController@index')->name('painel.newsletter');
    Route::get('/newsletter/destroy/{id}', 'NewsletterPageController@destroy');


    /**
     * ROTAS PARA AS VIEWS DAS NOTIFICAÇÕES
     */
    Route::get('/notifications', 'NotificationController@index')->name('notifications');
    Route::get('/notifications/seen', 'NotificationController@seen')->name('notifications.seen');
    Route::get('/notifications/notseen', 'NotificationController@notSeen')->name('notifications.notseen');
    Route::get('/notifications/update/{id}', 'NotificationController@update');
    Route::get('/notifications/destroy/{id}', 'NotificationController@destroy');

    /**
     * ROTAS PARA A VIEW DA LICENÇA
     */
    Route::view('/license', 'painel.license')->name('license');

    Route::get('/logout', 'Auth\GestorLoginController@logout')->name('gestor.logout');
});


/**
 * ------------------------------------
 *          ADMINISTRADOR
 * ------------------------------------
 */

$this->group(['prefix' => 'admin'], function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register.form');
    Route::post('/register', 'Auth\AdminRegisterController@cadastrar')->name('admin.register');
});

$this->group(['prefix' => 'admin'], function(){
    Route::get('/', 'AdminPageController@index')->name('admin.homepage');
    Route::get('/home', 'AdminPageController@index')->name('admin.homepage');

    $this->group(['namespace' => 'Admin'], function(){
        /**
         * ROTAS PARA AS VIEWS DO CHAT
         */
        Route::get('/chat', 'ChatPageController@index')->name('admin.chat');
        Route::post('/chat/responder', 'ChatPageController@store')->name('admin.responder');
        Route::get('/chat/show/{id}', 'ChatPageController@show');

        /**
         * ROTAS PARA AS VIEWS DOS PARCEIROS
         */
        Route::get('/parceiros', 'ParceiroPageController@index')->name('parceiros.consultar');
        Route::get('/parceiros/register', 'ParceiroPageController@create')->name('admin.parceiro.register');
        Route::post('/parceiros/register', 'ParceiroPageController@store')->name('admin.parceiro.store');
        Route::get('/parceiros/show/{id}', 'ParceiroPageController@show');
        Route::get('/parceiros/edit/{id}', 'ParceiroPageController@edit');
        Route::put('/parceiros/update/{id}', 'ParceiroPageController@update');
        Route::delete('/parceiros/destroy/{id}', 'ParceiroPageController@destroy');


        /**
         * ROTAS PARA AS VIEWS DAS CATEGORIAS
         */
        Route::get('/categories/register', 'CategoryPageController@create')->name('admin.category.register');
        Route::post('/categories/register', 'CategoryPageController@store')->name('admin.category.store');
        Route::get('/categories', 'CategoryPageController@index')->name('admin.category.consultar');
        Route::get('/categories/show/{id}', 'CategoryPageController@show');
        Route::get('/categories/edit/{id}', 'CategoryPageController@edit');
        Route::put('/categories/update/{id}', 'CategoryPageController@update');
        Route::get('/categories/destroy/{id}', 'CategoryPageController@destroy');
        
        /**
         * ROTAS PARA AS VIEWS DOS PRODUTOS
         */
        Route::get('/products/register', 'ProductPageController@create')->name('admin.products.register');
        Route::post('/products/register', 'ProductPageController@store')->name('admin.products.store');
        Route::get('/products', 'ProductPageController@index')->name('admin.products.consultar');
        Route::get('/products/show/{id}', 'ProductPageController@show');
        Route::get('/products/show/specifications/{id}', 'ProductPageController@specifications');
        Route::get('/products/images/edit/{id}', 'ImageController@edit');
        Route::get('/products/edit/{id}', 'ProductPageController@edit');
        Route::delete('/products/destroy/{id}', 'ProductPageController@destroy');
        
        /**
         * ROTAS PARA AS VIEWS DAS PROMOÇÕES
         */
        Route::get('/promotions/register', 'PromotionPageController@create')->name('admin.promotion.register');
        Route::post('/promotions/register', 'PromotionPageController@store')->name('admin.promotion.store');
        Route::get('/promotions', 'PromotionPageController@index')->name('admin.promotion.consultar');
        Route::get('/promotions/show/{id}', 'PromotionPageController@show');
        Route::get('/promotions/edit/{id}', 'PromotionPageController@edit');
        Route::put('/promotions/update/{id}', 'PromotionPageController@update');
        Route::get('/promotions/destroy/{id}', 'PromotionPageController@destroy');
        
    
        /**
         * ROTAS PARA AS VIEWS DOS COUPONS
         */
        Route::get('/coupon', 'CouponPageController@index')->name('coupon.consultar');
        Route::get('/coupon/register', 'CouponPageController@create')->name('coupon.register');
        Route::post('/coupon/register', 'CouponPageController@store')->name('coupon.store');
        Route::get('/coupon/show/{id}', 'CouponPageController@show');
        Route::put('/coupon/update/{id}', 'CouponPageController@update');
        Route::get('/coupon/edit/{id}', 'CouponPageController@edit');
        Route::get('/coupon/destroy/{id}', 'CouponPageController@destroy');
        
        /**
         * ROTAS PARA AS VIEWS DAS VENDAS
         */
        Route::get('/sales', 'SalesPageController@index')->name('admin.sales');
        Route::get('/sales/show/{id}', 'SalesPageController@show');
        Route::get('/sales/edit/{id}', 'SalesPageController@edit');
        Route::put('/sales/update/{id}', 'SalesPageController@update');
        Route::get('/sales/destroy/{id}', 'SalesPageController@destroy');


        /**
         * ROTAS PARA AS VIEWS DOS CLIENTES
         */
        Route::get('/clients', 'ClientesPageController@index')->name('admin.clientes.consultar')->middleware('auth:admin');
        Route::get('/clients/update/{id}/{status}', 'ClientesPageController@update')->middleware('auth:admin');


        Route::get('/gestors', 'GestorPageController@index')->name('gestors.consultar');
        Route::get('/gestors/create', 'GestorPageController@create')->name('gestor.register.form');
        Route::get('/gestors/update/{id}/{status}', 'GestorPageController@update');


        /**
         * ROTAS PARA AS VIEWS DOS CONTACTOS
         */
        Route::get('/contacts', 'ContactPageController@index')->name('admin.contacts');
        Route::get('/contacts/show/{id}', 'ContactPageController@show');
        Route::get('/contacts/destroy/{id}', 'ContactPageController@destroy');
        

        /**
         * ROTAS PARA AS VIEWS DAS NEWSLETTER
         */
        Route::get('/newsletter', 'NewsletterPageController@index')->name('admin.newsletter');
        Route::get('/newsletter/destroy/{id}', 'NewsletterPageController@destroy');


        /**
         * ROTAS PARA AS VIEWS DAS NOTIFICAÇÕES
         */
        Route::get('/notifications', 'NotificationController@index')->name('admin.notifications');
        Route::get('/notifications/seen', 'NotificationController@seen')->name('admin.notifications.seen');
        Route::get('/notifications/notseen', 'NotificationController@notSeen')->name('admin.notifications.notseen');
        Route::get('/notifications/update/{id}', 'NotificationController@update');
        Route::get('/notifications/destroy/{id}', 'NotificationController@destroy');
    });

    /**
     * ROTAS PARA AS VIEWS DA LICENÇA
     */
    Route::view('/license', 'admin.license')->name('admin.license');

    Route::post('/gestor/create', 'Auth\GestorRegisterController@cadastrar')->name('gestor.register');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});