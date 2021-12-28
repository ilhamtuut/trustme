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
Route::get('/', 'WelcomeController@index');
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');
Route::get('/referral/{username}', 'Auth\RegisterController@referal')->name('referal');
Route::get('qrcode/{text}', function($text) {
    $qrcode = \App\Facades\Eth::qrCode($text);
    $data = array('qrcode'=>$qrcode);
    return response()->json($data);
});

//store
Route::group(['middleware' => 'storeAccess','prefix'=>'store'], function(){
  Route::get('/', 'ProductStoreController@index')->name('user.store');
  Route::get('/detail', 'ProductStoreController@detail');
});

Route::group(['middleware' => ['auth','block-user','revalidate']], function() {
    Route::get('/home', ['as' => 'home', 'uses'=>'HomeController@index']);
    Route::get('/pricing', ['as' => 'pricing', 'uses'=>'HomeController@pricing']);

   	// register package
   	Route::group(['prefix' => 'plan', 'as' => 'program.'], function() {
      Route::get('/invest', ['as' => 'index', 'uses' => 'ProgramController@index']);
      Route::get('/invest/admin', ['as' => 'by_admin', 'uses' => 'ProgramController@by_admin'])->middleware(['permission:administrator']);
      Route::post('/register', ['as' => 'register', 'uses' => 'ProgramController@register']);
      Route::post('/register/add_member', ['as' => 'register.add_member', 'uses' => 'ProgramController@register_add_member']);
      Route::post('/register/by_admin', ['as' => 'register_byadmin', 'uses' => 'ProgramController@register_byadmin'])->middleware(['permission:administrator']);
      Route::get('/history', ['as' => 'history', 'uses' => 'ProgramController@history']);
      Route::get('/list/{regby}', ['as' => 'list', 'uses' => 'ProgramController@list_program'])->middleware(['permission:administrator']);

      // stop & run capital back
      Route::get('/profit_capital/{type}/{desc}/{id}', ['as' => 'profit_capital', 'uses' => 'ProgramController@profit_capital'])->middleware(['permission:administrator']);

      // bonus
      Route::get('/bonus/{type}', ['as' => 'bonus_active', 'uses' => 'BonusController@bonus_active']);
      Route::get('/bonus/daily', ['as' => 'bonus_profit', 'uses' => 'BonusController@bonus_profit']);
      Route::get('/list/bonus/{type}', ['as' => 'list_bonus_active', 'uses' => 'BonusController@list_bonus_active'])->middleware(['permission:administrator']);
   	});

    //product
    Route::group(['middleware' => ['permission:administrator'], 'prefix' => 'product', 'as' => 'product.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'ProductController@index']);
        Route::post('/post', ['as' => 'post', 'uses' => 'ProductController@post']);
        Route::get('/categorie', ['as' => 'categorie', 'uses' => 'ProductController@categorie']);
        Route::post('/post-categorie', ['as' => 'postProductCategorie', 'uses' => 'ProductController@postCategorie']);
        Route::get('/order', ['as' => 'order', 'uses' => 'ProductController@order']);
        Route::post('/post-order', ['as' => 'postProductOrder', 'uses' => 'ProductController@postOrder']);
    });

    //store
    Route::group(['middleware' => 'storeAccess','prefix'=>'store'], function(){
      Route::get('/city', 'ProductStoreController@city');
      Route::get('/cost', 'ProductStoreController@cost');

      Route::get('/wishlist', 'ProductStoreController@wishlist');
      Route::post('/wishlist/post', 'ProductStoreController@wishlistPost');
      Route::get('/cart', 'ProductStoreController@cart');
      Route::post('/cart/post', 'ProductStoreController@cartPost');
      Route::get('/checkout', 'ProductStoreController@checkout');
      Route::get('/checkout-list', 'ProductStoreController@checkoutList');
      Route::post('/checkout/post', 'ProductStoreController@checkoutPost');
    });

    // user
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
      Route::get('/profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
      Route::get('/add_member', ['as' => 'add_member', 'uses' => 'UserController@add_member']);
      Route::post('/update/password', ['as' => 'updatePassword', 'uses' => 'UserController@updatePassword']);
      Route::post('/update/password/trx', ['as' => 'updatePasswordtrx', 'uses' => 'UserController@updatePasswordtrx']);
      Route::get('/list/donwline', ['as' => 'list_donwline', 'uses' => 'UserController@list_donwline']);
      Route::get('/downline/{id}', ['as' => 'list_donwline_user', 'uses' => 'UserController@list_donwline_user']);
      Route::get('/create', ['as' => 'index', 'uses' => 'UserController@index'])->middleware(['permission:administrator']);
      Route::post('/create', ['as' => 'create', 'uses' => 'UserController@create'])->middleware(['permission:administrator']);
      Route::get('/list/{role}', ['as' => 'list_user', 'uses' => 'UserController@list_user'])->middleware(['permission:administrator']);
      Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'UserController@edit'])->middleware(['permission:administrator']);
      Route::post('/updateData/{id}', ['as' => 'updateData', 'uses' => 'UserController@updateData'])->middleware(['permission:administrator']);
      Route::get('/get_user', ['as' => 'get_user', 'uses' => 'UserController@getUsername']);
      Route::post('/uploadFoto', ['as' => 'uploadFoto', 'uses' => 'UserController@uploadFoto']);
      Route::get('/searchUser', ['as' => 'searchUser', 'uses' => 'UserController@searchUser']);
      Route::get('/block_unclock/{id}', ['as' => 'block_unclock', 'uses' => 'UserController@block_unclock'])->middleware(['permission:administrator']);
      Route::get('/list_sponsor', ['as' => 'list_sponsor', 'uses' => 'UserController@list_sponsor'])->middleware(['permission:administrator']);
    });

    // balance
    Route::group(['prefix' => 'wallet', 'as' => 'balance.'], function() {
      Route::get('/', ['as' => 'user', 'uses' => 'BalanceController@balance_user'])->middleware(['permission:administrator']);
      Route::get('/usd_wallet', ['as' => 'my', 'uses' => 'BalanceController@balance_my']);
      Route::get('/register_wallet', ['as' => 'register', 'uses' => 'BalanceController@balance_register']);
      Route::get('/trustme_coin', ['as' => 'harvest', 'uses' => 'BalanceController@balance_harvest']);
      Route::get('/spartan_coin', ['as' => 'spartan', 'uses' => 'BalanceController@balance_spartan']);
      Route::get('/usd_wallet/{id}', ['as' => 'my_member', 'uses' => 'BalanceController@balance_my_member'])->middleware(['permission:administrator']);
      Route::get('/trustme_coin/{id}', ['as' => 'harvest_member', 'uses' => 'BalanceController@balance_harvest_member'])->middleware(['permission:administrator']);
      Route::get('/register_wallet/{id}', ['as' => 'register_member', 'uses' => 'BalanceController@balance_register_member'])->middleware(['permission:administrator']);
      Route::get('/spartan_coin/{id}', ['as' => 'spartan_member', 'uses' => 'BalanceController@balance_spartan_member'])->middleware(['permission:administrator']);
    });

    // convert
    Route::group(['prefix' => 'convert', 'as' => 'convert.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'ConvertController@index']);
      Route::post('/send', ['as' => 'send', 'uses' => 'ConvertController@send']);
      Route::get('/history', ['as' => 'history', 'uses' => 'ConvertController@history']);
      Route::get('/list', ['as' => 'list', 'uses' => 'ConvertController@list'])->middleware(['permission:administrator']);
    });

    // deposit
    Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'DepositController@index']);
      Route::post('/send', ['as' => 'send', 'uses' => 'DepositController@send']);
      Route::get('/history', ['as' => 'history', 'uses' => 'DepositController@history']);
      Route::get('/list', ['as' => 'list', 'uses' => 'DepositController@list'])->middleware(['permission:administrator']);
      Route::get('/confirm/{type}/{id}', ['as' => 'confirm', 'uses' => 'DepositController@confirm'])->middleware(['permission:administrator']);
    });

    // withdraw
    Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'WithdrawController@index']);
      Route::post('/send/{type}', ['as' => 'send', 'uses' => 'WithdrawController@withdraw']);
      Route::get('/history', ['as' => 'history', 'uses' => 'WithdrawController@history_withdraw']);
      Route::get('/list/{type}', ['as' => 'list_withdraw', 'uses' => 'WithdrawController@list_withdraw'])->middleware(['permission:administrator']);
      Route::post('/accept/{id}', ['as' => 'accept', 'uses' => 'WithdrawController@accept'])->middleware(['permission:administrator']);
      Route::get('/reject/{id}', ['as' => 'reject', 'uses' => 'WithdrawController@reject'])->middleware(['permission:administrator']);
      Route::get('/spartan', ['as' => 'spartan', 'uses' => 'WithdrawController@spartan']);
    });

    // setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'SettingController@index'])->middleware(['permission:administrator']);
      Route::post('/update', ['as' => 'update', 'uses' => 'SettingController@update'])->middleware(['permission:administrator']);
      Route::get('/roi', ['as' => 'package', 'uses' => 'SettingController@package'])->middleware(['permission:administrator']);
      Route::post('/update/package', ['as' => 'updatePackage', 'uses' => 'SettingController@updatePackage'])->middleware(['permission:administrator']);
    });

    // log
    Route::group(['prefix' => 'generate', 'as' => 'generate.'], function() {
      Route::get('/bonus', ['as' => 'viewGenerateBonus', 'uses' => 'GenerateController@viewGenerateBonus'])->middleware(['permission:administrator']);
      Route::get('/log', ['as' => 'log', 'uses' => 'GenerateController@log'])->middleware(['permission:administrator']);
      Route::get('/bonus_pasif', ['as' => 'bonus_pasif', 'uses' => 'GenerateController@bonus_pasif'])->middleware(['permission:administrator']);
    });

    // transfer
    Route::group(['prefix' => 'transfer', 'as' => 'transfer.'], function() {
      Route::get('/{type}', ['as' => 'wallet', 'uses' => 'TransferController@index']);
      Route::post('/send/{type}', ['as' => 'send', 'uses' => 'TransferController@send']);
      Route::get('/check/user', ['as' => 'check', 'uses' => 'TransferController@check']);
    });

    // composition
    Route::group(['prefix' => 'composition', 'as' => 'composition.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'CompositionController@index']);
      Route::post('/update', ['as' => 'update', 'uses' => 'CompositionController@update']);
    });

    // Bank
    Route::group(['prefix' => 'bank', 'as' => 'bank.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'BankController@index'])->middleware(['permission:administrator']);
      Route::post('/store', ['as' => 'store', 'uses' => 'BankController@store'])->middleware(['permission:administrator']);
      Route::post('/update/{id}', ['as' => 'update', 'uses' => 'BankController@update'])->middleware(['permission:administrator']);
      Route::get('/list', ['as' => 'list', 'uses' => 'BankController@list'])->middleware(['permission:administrator']);
      Route::get('/account', ['as' => 'account', 'uses' => 'BankController@mybank']);
      Route::post('/addBankUser', ['as' => 'addBankUser', 'uses' => 'BankController@addBankUser']);
      Route::get('/changeActive/{id}', ['as' => 'changeActive', 'uses' => 'BankController@changeActive']);
    });

    // Trustme Address
    Route::group(['prefix' => 'trustme_coin', 'as' => 'trustme_coin.'], function() {
      Route::get('/', ['as' => 'index', 'uses' => 'WalletController@index'])->middleware(['permission:administrator']);
      Route::get('/list', ['as' => 'list', 'uses' => 'WalletController@list'])->middleware(['permission:administrator']);
      Route::get('/myWallet', ['as' => 'myWallet', 'uses' => 'WalletController@myWallet']);
      Route::get('/check/{address}', ['as' => 'checkAddress', 'uses' => 'WalletController@checkAddress']);
      Route::post('/addWallet', ['as' => 'addWallet', 'uses' => 'WalletController@addWallet']);
      Route::post('/send', ['as' => 'send', 'uses' => 'WalletController@sendCoin']);
    });

    // Tokoku
    Route::group(['prefix' => 'tokoku', 'as' => 'tokoku.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'TokokuController@index']);
        Route::get('/item', ['as' => 'item', 'uses' => 'TokokuController@item']);
        Route::post('/buy', ['as' => 'buy', 'uses' => 'TokokuController@buy']);
      });

    // bounty
    Route::group(['prefix' => 'bounty', 'as' => 'bounty.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'HoldController@index']);
        Route::post('/holder', ['as' => 'holder', 'uses' => 'HoldController@holder']);
        Route::get('/history', ['as' => 'history', 'uses' => 'HoldController@history']);
        Route::get('/list', ['as' => 'list', 'uses' => 'HoldController@list'])->middleware(['permission:administrator']);
    });
});
