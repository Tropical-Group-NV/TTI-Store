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
    session('currency', 'SRD');
   return view('home');
})->name('home');

Route::get('/audits', function ()
{
    if (Auth::user()->users_type_id == 1)
    {
        return view('audits');
    }
   else
   {
       return die('Access Denied');
   }
})->name('audits');

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
})->middleware('auth')->name('orders');

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

Route::get('session-info', function( Request $request)
{
//    $request->session()->remove('currency');
    return session()->all();
});
Route::get('currency/set-usd', function( Request $request)
{
    $request->session()->put('currency', 'USD');
    $request->session()->put('exchangeRate', '27.500000');
    return session()->all();
});
Route::post('currency/set', function( Request $request)
{
    if ($request->currency == 'SRD')
    {
        $request->session()->remove('currency');
        $request->session()->remove('exchangeRate');
    }
    else
    {
        $currency = DB::connection('qb_sales')->table('qb_currency')->where('CurrencyCode', $request->currency)->first();
         $request->session()->put('currency', $request->currency);
         $request->session()->put('exchangeRate', $currency->ExchangeRate);

    }
    return redirect(session()->get('_previous')['url']);
})->name('setCurrency');

//Route::get('customer/register', function( Request $request)
//{
//    return view('customer-register');
//})->name('customer-registration');


Route::resources
(
    [
        'customer-registration' => \App\Http\Controllers\CustomerRegistration::class,
        'new-customers' => \App\Http\Controllers\TemporaryUserInfoController::class
    ]
);

Route::get('vue/home', function( Request $request)
{
    return view('test-home');
})->name('vue-home');



