<?php

use App\Models\QbCustomer;
use Illuminate\Support\Facades\Mail;
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

Route::get('/uni5pay-test', function ()
{
   return view('test.uni5pay-test');
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

Route::get('api/get-items-ads',
    function( Request $request)
    {
        $search = $_REQUEST['search'];
        return view('api.item-search-ad', compact('search'));
    })->name('getItemsAds');


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

Route::get('login-token/{token}', [\App\Http\Controllers\LoginTokenController::class, 'index'])->name('login-token');
Route::get('password-reset/{token}', [\App\Http\Controllers\PasswordResetController::class, 'show'])->name('reset-token');


Route::resources
(
    [
        'customer-registration' => \App\Http\Controllers\CustomerRegistration::class,
        'new-customers' => \App\Http\Controllers\TemporaryUserInfoController::class,
        'upload/ads' => \App\Http\Controllers\AdsController::class,
        'password-reset' => \App\Http\Controllers\PasswordResetController::class,
        'customer-profile' => \App\Http\Controllers\CustomerProfileController::class,
        'customers' => \App\Http\Controllers\CustomersController::class,
//        'map' => \App\Http\Controllers\MapController::class,
//        'visits' => \App\Http\Controllers\VisitsController::class,
        'crm' => \App\Http\Controllers\CrmInteractionsController::class,
        'quotations' => \App\Http\Controllers\QuotationsController::class
    ]
);

Route::get('vue/home', function( Request $request)
{
    return view('test-home');
})->name('vue-home');

Route::get('customer/profile', function( Request $request)
{
    return view('profile.profile');
})->name('vue-home');

Route::get('contact-us', function ()
{
    return view('contact');
}
)->name('contact-page');

Route::get('btw-calculator', function ()
{
    return view('calculator.btw-calculator');
}
)->name('btw-calculator');


//Route::get('salesrep-order-report', function ()
//{
//    return view('reports.salesrep-orders-report');
//}
//)->name('salesrep-order-report');


/** API's */
Route::POST('api/save-customer-location',
    function( Request $request)
    {
        $customer = $_REQUEST['customer'];
        $location = $_REQUEST['location'];
        if (\App\Models\CustomerLocation::query()->where('customer_id', $customer)->exists())
        {
            $saveLocation = \App\Models\CustomerLocation::query()->where('customer_id', $customer)->update(['loc' => trim($location, '()') ]);
            if ($saveLocation)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            $saveLocation = new \App\Models\CustomerLocation();
            $saveLocation->customer_id = $customer;
            $saveLocation->loc = $location;
            $saveLocation->save();
            return 1;
        }
    }
    )->name('saveCustomerLocation')->middleware('auth');

Route::get('api/order-confirm/{customer_id}/{id}', function( Request $request)
{
    \App\Models\SalesOrder::query()->where('id', $request->id)->update(['write_to_quickbook'=> null]);
    \App\Jobs\SendFirstOrderMail::dispatch($request->customer_id, \Illuminate\Support\Facades\Auth::user()->id);
        if (session()->has('currency'))
        {
            \App\Jobs\Import_Sales_Order_To_QB::dispatch($request->id, session()->get('currency'), session()->get('exchangeRate'));
        }
        else
        {
            \App\Jobs\Import_Sales_Order_To_QB::dispatch($request->id, 'SRD', 1);
        }
    return redirect(\route('home'));
})->name('confirm-order');

Route::get('api/payment-confirmed/{id}', function( Request $request)
{
    \App\Jobs\SendFirstOrderMail::dispatch('8000150C-1652181187', \Illuminate\Support\Facades\Auth::user()->id);
    $mail = Mail::raw('Order TTI-' . $request->id .' has successfully been paid for with Uni5Pay+',
        function($msg)
        {
            $msg->to('jamil.kasan@tropicalgroupnv.com')->subject('Payment has been made with Uni5Pay+');
        });
})->name('payment-confirmed');
/** End API's */
