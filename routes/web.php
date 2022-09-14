<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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



Route::get('/', function ()
{
   return redirect(\route('home'));
});

Route::get('/home', function ()
{
   return view('home');
})->name('home');

Route::middleware([
])->group(function () {
    Route::get('/items', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Route::middleware([
//])->group(function () {
//    Route::get('/items', function () {
//        return view('dashboard');
//    })->name('items');
//});



Route::get('items/{id}', function( Request $request)
{
    $id = $request->id;
    return view('item' , compact('id'));
})->name('item');

Route::get('checkout', function( Request $request)
{
    return view('checkout' );
})->name('checkout')->middleware('auth');

Route::get('api/customers', function ()
{

}
);

Route::get('orders', function( Request $request)
{
    return view('orders');
})->name('orders');

Route::get('api/get-customers',
    function( Request $request)
    {
        $id = $_REQUEST['id'];
        $search = $_REQUEST['search'];
        return view('getcustomers', compact('search', 'id'));

//    return view('orders');
    })->name('getCustomers');

Route::get('api/get-items',
    function( Request $request)
    {
        $search = $_REQUEST['search'];
        return view('api.item-search', compact('search'));
    })->name('getItems');


Route::get('orders/{id}', function( Request $request)
{
    $id = $request->id;
    return view('order', compact('id'));
})->middleware('auth')->name('order');

Route::get('backorders', function( Request $request)
{
    return view('backorders');
})->middleware('auth')->name('backorders');

//Route::get('customer/register', function( Request $request)
//{
//    return view('customer-register');
//})->name('customer-registration');


Route::resources
(
    [
        'customer-registration' => \App\Http\Controllers\CustomerRegistration::class
    ]
);




