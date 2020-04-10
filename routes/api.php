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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

  Route::get('users', 'UserController@index');
  Route::post('users', 'UserController@create');
  Route::post('users/bulk', 'UserController@bulk');
  Route::get('users/{id}', 'UserController@show');
  Route::patch('users/{id}', 'UserController@update');
  Route::delete('users/{id}', 'UserController@delete');

  Route::get('posts', 'PostController@index');
  Route::post('posts', 'PostController@create');
  Route::post('posts/bulk', 'PostController@bulk');
  Route::get('posts/{id}', 'PostController@show');
  Route::patch('posts/{id}', 'PostController@update');
  Route::delete('posts/{id}', 'PostController@delete');

  Route::get('followers', 'FollowerController@index');
  Route::post('followers', 'FollowerController@create');
  Route::post('followers/bulk', 'FollowerController@bulk');
  Route::get('followers/{id}', 'FollowerController@show');
  Route::patch('followers/{id}', 'FollowerController@update');
  Route::delete('followers/{id}', 'FollowerController@delete');

  Route::get('comments', 'CommentController@index');
  Route::post('comments', 'CommentController@create');
  Route::post('comments/bulk', 'CommentController@bulk');
  Route::get('comments/{id}', 'CommentController@show');
  Route::patch('comments/{id}', 'CommentController@update');
  Route::delete('comments/{id}', 'CommentController@delete');

  Route::get('likes', 'LikeController@index');
  Route::post('likes', 'LikeController@create');
  Route::post('likes/bulk', 'LikeController@bulk');
  Route::get('likes/{id}', 'LikeController@show');
  Route::patch('likes/{id}', 'LikeController@update');
  Route::delete('likes/{id}', 'LikeController@delete');

  Route::get('suppliers', 'SupplierController@index');
  Route::post('suppliers', 'SupplierController@create');
  Route::post('suppliers/bulk', 'SupplierController@bulk');
  Route::get('suppliers/{id}', 'SupplierController@show');
  Route::patch('suppliers/{id}', 'SupplierController@update');
  Route::delete('suppliers/{id}', 'SupplierController@delete');

  Route::get('categories', 'CategoryController@index');
  Route::post('categories', 'CategoryController@create');
  Route::post('categories/bulk', 'CategoryController@bulk');
  Route::get('categories/{id}', 'CategoryController@show');
  Route::patch('categories/{id}', 'CategoryController@update');
  Route::delete('categories/{id}', 'CategoryController@delete');

  Route::get('subcategories', 'SubCategoryController@index');
  Route::post('subcategories', 'SubCategoryController@create');
  Route::post('subcategories/bulk', 'SubCategoryController@bulk');
  Route::get('subcategories/{id}', 'SubCategoryController@show');
  Route::patch('subcategories/{id}', 'SubCategoryController@update');
  Route::delete('subcategories/{id}', 'SubCategoryController@delete');

  Route::get('stocks', 'StockController@index');
  Route::post('stocks', 'StockController@create');
  Route::post('stocks/bulk', 'StockController@bulk');
  Route::get('stocks/{id}', 'StockController@show');
  Route::patch('stocks/{id}', 'StockController@update');
  Route::delete('stocks/{id}', 'StockController@delete');

  Route::get('goods', 'GoodController@index');
  Route::post('goods', 'GoodController@create');
  Route::post('goods/bulk', 'GoodController@bulk');
  Route::get('goods/{id}', 'GoodController@show');
  Route::patch('goods/{id}', 'GoodController@update');
  Route::delete('goods/{id}', 'GoodController@delete');

  Route::get('stocks', 'StockController@index');
  Route::post('stocks', 'StockController@create');
  Route::post('stocks/bulk', 'StockController@bulk');
  Route::get('stocks/{id}', 'StockController@show');
  Route::patch('stocks/{id}', 'StockController@update');
  Route::delete('stocks/{id}', 'StockController@delete');

  Route::get('prices', 'PriceController@index');
  Route::post('prices', 'PriceController@create');
  Route::post('prices/bulk', 'PriceController@bulk');
  Route::get('prices/{id}', 'PriceController@show');
  Route::patch('prices/{id}', 'PriceController@update');
  Route::delete('prices/{id}', 'PriceController@delete');

  Route::get('purchasetransactions', 'PurchaseTransactionController@index');
  Route::post('purchasetransactions', 'PurchaseTransactionController@create');
  Route::post('purchasetransactions/bulk', 'PurchaseTransactionController@bulk');
  Route::get('purchasetransactions/{id}', 'PurchaseTransactionController@show');
  Route::patch('purchasetransactions/{id}', 'PurchaseTransactionController@update');
  Route::delete('purchasetransactions/{id}', 'PurchaseTransactionController@delete');

  Route::get('purchasetransactiondetails', 'PurchaseTransactionDetailController@index');
  Route::post('purchasetransactiondetails', 'PurchaseTransactionDetailController@create');
  Route::post('purchasetransactiondetails/bulk', 'PurchaseTransactionDetailController@bulk');
  Route::get('purchasetransactiondetails/{id}', 'PurchaseTransactionDetailController@show');
  Route::patch('purchasetransactiondetails/{id}', 'PurchaseTransactionDetailController@update');
  Route::delete('purchasetransactiondetails/{id}', 'PurchaseTransactionDetailController@delete');

  Route::get('customers', 'CustomerController@index');
  Route::post('customers', 'CustomerController@create');
  Route::post('customers/bulk', 'CustomerController@bulk');
  Route::get('customers/{id}', 'CustomerController@show');
  Route::patch('customers/{id}', 'CustomerController@update');
  Route::delete('customers/{id}', 'CustomerController@delete');

  Route::get('sellingtransactions', 'SellingTransactionController@index');
  Route::post('sellingtransactions', 'SellingTransactionController@create');
  Route::post('sellingtransactions/bulk', 'SellingTransactionController@bulk');
  Route::get('sellingtransactions/{id}', 'SellingTransactionController@show');
  Route::patch('sellingtransactions/{id}', 'SellingTransactionController@update');
  Route::delete('sellingtransactions/{id}', 'SellingTransactionController@delete');

  Route::get('sellingtransactiondetails', 'SellingTransactionDetailController@index');
  Route::post('sellingtransactiondetails', 'SellingTransactionDetailController@create');
  Route::post('sellingtransactiondetails/bulk', 'SellingTransactionDetailController@bulk');
  Route::get('sellingtransactiondetails/{id}', 'SellingTransactionDetailController@show');
  Route::patch('sellingtransactiondetails/{id}', 'SellingTransactionDetailController@update');
  Route::delete('sellingtransactiondetails/{id}', 'SellingTransactionDetailController@delete');

  Route::get('refractions', 'RefractionController@index');
  Route::post('refractions', 'RefractionController@create');
  Route::post('refractions/bulk', 'RefractionController@bulk');
  Route::get('refractions/{id}', 'RefractionController@show');
  Route::patch('refractions/{id}', 'RefractionController@update');
  Route::delete('refractions/{id}', 'RefractionController@delete');