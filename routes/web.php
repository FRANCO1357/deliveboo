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


// Route::get('/', function () {
//     return view('guest.home');
// });

Auth::routes();


Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){

    Route::get('/', 'HomeController@index')->name('home');

    //Restaurant routes
    Route::resource('restaurants', 'RestaurantController');

    //Dish routes
    Route::resource('dishes', 'DishController');

    //Dish routes
    Route::resource('orders', 'OrderController');

    Route::get('/{any}', function(){
        abort('404');
    })->where('any', '.*' );    
});

// PAYMENTS ROUTES
Route::get('/cart', function(){

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey'),
    ]);


    $token = $gateway->ClientToken()->generate();

    return view('guest.home', ['token' => $token]);

});

Route::post('/checkout', function(Request $request){

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey'),
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);
//! (||!is_null($result->transaction) --- DA VERIFICARE CHE QUESTO ULTERIORE CONTROLLO FUNZIONI(PER I VALORI NEGATIVI)
    if ($result->success || !is_null($result->transaction)) {
        $transaction = $result->transaction;

        // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);

        return back()->with('success_message', 'Transazione avvenuta con successo. Il codice di transazione è:' . $transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");

        return back()->withErrors('Transazione Fallita' . $result->message);

    }
});


//Guest routes
Route::get('/{any?}', function () {
    return view('guest.home');
})->where('any', '.*' );