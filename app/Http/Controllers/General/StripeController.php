<?php

namespace App\Http\Controllers\General;

use App\Enums\TransactionStatus;
use App\Events\PurchaseSuccessful;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\SalesListing;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{

  public function process()
  {
    $user = auth()->user();

    // Redirect back if user doesn't have a cart
    if (!$user->cart || $user->cart->items->count() == 0)
      return redirect('/cart');

    // Create a new cart if user has a cart no order record
    if (!$user->cart->order) {
      $order = Order::create([
        'transaction_id' => $user->cart->id,
      ]);
    };

    return view('general.checkout.process');
  }

  public function overview()
  {
    $user = auth()->user();

    $order = $user->cart->orderWithDetails;

    return view('general.checkout.overview', [
      'cart_amount' => $user->cart->amount,
      'order' => $order,
    ]);
  }

  public function checkout()
  {
    Stripe::setApiKey(config('stripe.default.key'));

    $products = [];
    $user = auth()->user();
    $cart = $user->cart;
    $order = $user->cart->orderWithDetails;

    foreach ($cart->items as $book) {
      $products[] = [
        'price_data' => [
          'currency' => 'zar',
          'product_data' => [
            'name' => $book->title . ' ' . ($book->edition),
          ],
          'unit_amount' => $book->price * 100,
        ],
        'quantity' => 1,
      ];
    }

    $products = array_merge(
      $products,
      [[
        'price_data' => [
          'currency' => 'zar',
          'product_data' => [
            'name' => $order->method,
          ],
          'unit_amount' => $order->cost * 100,
        ],
        'quantity' => 1,
      ]]
    );
  
    $session =  Session::create([
      'line_items' => $products,
      'mode' => 'payment',
      'success_url' => route('checkout.success', ['transaction' => $user->cart]),
      'cancel_url' => route('checkout.cancel', ['transaction' => $user->cart]),
    ]);

    $cart->session = $session->id;
    $cart->save();

    return redirect($session->url);
  }

  public function success(Transaction $transaction)
  {
    // Verify that the page wasn't visited before concerning the same transaction
    // if ($transaction->status == TransactionStatus::PAID->value) {
    //   abort(419);
    // }

    $transaction->status = TransactionStatus::PAID;
    $transaction->save();

    PurchaseSuccessful::dispatch($transaction);

    return view('general.checkout.success');
  }

  public function cancel(Transaction $transaction)
  {
    // Verify if page was visited before
    if ($transaction->status == TransactionStatus::CANCELLED->value) {
      abort(419);
    }

    $transaction->update([
      'status' => TransactionStatus::CANCELLED,
    ]);

    $transaction->order->delete();

    return view('general.checkout.cancel');
  }

  public function webhook()
  {
    // TODO
  }
}
