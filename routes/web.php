<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('orders/{id}', function( Request $request)
{
    $id = $request->id;
    return view('order', compact('id'));
})->name('order');




