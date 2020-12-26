<?php
// print_r($_SERVER); exit;
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

 Route::get('/', function () {
     return view('comingsoon');
 });

Route::redirect('/irsadmin', 'login', 301);
Auth::routes();
Route::get('irsadmin/home', 'HomeController@index')->name('admin.dashboard');
Route::resource('irsadmin/user', 'UserController');
Route::resource('irsadmin/role', 'RoleController');
Route::resource('irsadmin/permission', 'PermissionController');
Route::resource('irsadmin/currency', 'CurrencyController');
Route::resource('irsadmin/category', 'CategoryController');
Route::resource('irsadmin/subcategory', 'SubCategoryController');
Route::resource('irsadmin/storecategory', 'StoreCategoryController');
Route::resource('irsadmin/brand', 'BrandController');
Route::resource('irsadmin/product', 'ProductController');
Route::resource('irsadmin/store', 'StoreController');
Route::resource('irsadmin/manufacturer', 'ManufacturerController');
Route::resource('irsadmin/retailerspurchase', 'RetailerPurchaseDetailController');
Route::resource('irsadmin/country', 'CountryController');
Route::resource('irsadmin/city', 'CityController');
Route::resource('irsadmin/state', 'StateController');
Route::post('add-permission', 'PermissionController@create');
Route::post('edit-permission', 'PermissionController@edit');
Route::post('set-status', 'AjaxController@setStatus'); 
Route::post('check-email', 'AjaxController@checkEmail');
Route::post('check-unique-entry', 'AjaxController@checkUniqueEntry');
Route::post('submit-order-product', 'RetailerPurchaseDetailController@submitOrderData');
Route::post('get-state', 'AjaxController@getState');
Route::post('get-city', 'AjaxController@getCity');
Route::post('get-product-value', 'AjaxController@getProductValue');
Route::post('upload-file', 'UploadController@fileUpload');
// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');