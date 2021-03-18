<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//以下用jquery重做
//行事曆
Route::get('/Company_lunch',[App\Http\Controllers\FullCalenderController::class, 'Company_lunch'])->name('fullcalender');
Route::get('/Company_dinner',[App\Http\Controllers\FullCalenderController::class, 'Company_dinner'])->name('fullcalender');
Route::post('/fullcalenderAjax',[App\Http\Controllers\FullCalenderController::class, 'Ajax'])->name('fullcalender');
Route::get('/Company_lunch_day',[App\Http\Controllers\FullCalenderController::class, 'Company_lunch_day'])->name('fullcalender');
Route::get('/Company_dinner_day',[App\Http\Controllers\FullCalenderController::class, 'Company_dinner_day'])->name('fullcalender');
Route::get('fullcalender', [App\Http\Controllers\FullCalenderController::class, 'index']);
Route::get('fullcalender2', [App\Http\Controllers\FullCalenderController2::class, 'index']);
Route::post('fullcalenderAjax2', [App\Http\Controllers\FullCalenderController2::class, 'ajax']);
Route::get('fullcalender3', [App\Http\Controllers\FullCalenderController3::class, 'index']);
Route::post('fullcalenderAjax3', [App\Http\Controllers\FullCalenderController3::class, 'ajax']);
Route::get('/Pay_lunch',[App\Http\Controllers\FullCalenderController::class, 'Pay_lunch'])->name('fullcalender');
Route::get('/Pay_dinner',[App\Http\Controllers\FullCalenderController::class, 'Pay_dinner'])->name('fullcalender');
Route::get('/Pay_lunch_day',[App\Http\Controllers\FullCalenderController::class, 'Pay_lunch_day'])->name('fullcalender');
Route::get('/Pay_dinner_day',[App\Http\Controllers\FullCalenderController::class, 'Pay_dinner_day'])->name('fullcalender');
Route::get('/delete_order', [App\Http\Controllers\FullCalenderController3::class, 'delete_order']);

//用餐意見
Route::get('/Note', [App\Http\Controllers\NoteController::class, 'api'])->name('Note');
Route::get('/api', [App\Http\Controllers\NoteController::class, 'index'])->name('api');
Route::resource('vuenotes','App\Http\Controllers\NoteController');

//訂餐資訊
Route::get('/order_information', 'App\Http\Controllers\order_informationController@api');
Route::get('/inf_api', 'App\Http\Controllers\order_informationController@index');
Route::resource('vueorder_informations','App\Http\Controllers\order_informationController');

//訂餐菜單
Route::get('/order_menu', 'App\Http\Controllers\order_menuController@api');
Route::get('/menu_api', 'App\Http\Controllers\order_menuController@index');
Route::resource('vueorder_menus','App\Http\Controllers\order_menuController');

//帳號維護
Route::get('/user', 'App\Http\Controllers\uidController@api');
Route::get('/user_api', 'App\Http\Controllers\uidController@index');
Route::resource('vueusers','App\Http\Controllers\uidController');

//密碼重設
Route::get('/pw', 'App\Http\Controllers\pwController@api');
Route::get('/pw_api', 'App\Http\Controllers\pwController@index');
Route::resource('vuepws','App\Http\Controllers\pwController');

//下拉
Route::get('/getEmployees/{id}/{id2}/{id3}', [App\Http\Controllers\DepartmentsController::class, 'getEmployees'])->name('select');
Route::get('/get_order_information/{id}/{id2}/{id3}', [App\Http\Controllers\DepartmentsController::class, 'get_order_information'])->name('select');

//查詢
Route::get('/search_index',[App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/search',[App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/search_index_month',[App\Http\Controllers\SearchController::class, 'index_month'])->name('search_month');
Route::get('/search_month',[App\Http\Controllers\SearchController::class, 'search_month'])->name('search_month');
Route::get('/search2',[App\Http\Controllers\SearchController::class, 'search2'])->name('search');

//公司訂餐-清單
Route::get('/index2', [App\Http\Controllers\HomeController::class, 'index2'])->name('index2');
//自付訂餐-清單
Route::get('/index3', [App\Http\Controllers\HomeController::class, 'index3'])->name('index3');
//test
Route::get('/index4', [App\Http\Controllers\HomeController::class, 'index4'])->name('index4');

//店家維護
Route::get('/restaurant', 'App\Http\Controllers\restaurantController@api');
Route::get('/rest_api', 'App\Http\Controllers\restaurantController@index');
Route::resource('vuerestaurants','App\Http\Controllers\restaurantController');

//上傳圖片
Route::any('/upload', 'App\Http\Controllers\StudentController@upload');