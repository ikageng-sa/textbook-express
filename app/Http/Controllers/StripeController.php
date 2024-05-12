<?php

namespace App\Http\Controllers;

use App\Enums\TransactionStatus;
use App\Enums\SalesListingStatus;
use App\Events\PurchaseSuccessful;
use App\Models\Book;
use App\Models\Order;
use App\Models\SalesListing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function checkout(SalesListing $book) 
    {

      Stripe::setApiKey(config('stripe.default.key'));

      $book = DB::table('books as b')
          ->select('b.id', 'sl.id as slID', 'b.title', 'b.author', 'b.isbn', 'b.description', 'b.edition', 'b.category', 'b.cover', 'sl.price', 'sl.condition', 'sl.status')
          ->join('sales_listings as sl', 'sl.book_id', '=', 'b.id')
          ->where('b.id', '=', $book->book_id)
          ->first();

      
        // Create a new transaction record
        $transaction = Transaction::create([
          'amount' => $book->price,
        ]);

        $session =  Session::create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'zar',
                'product_data' => [
                  'name' => $book->title,
                ],
                'unit_amount' => $book->price * 100,
            ],
              'quantity' => 1,
        ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['transaction' => $transaction->id]),
            'cancel_url' => route('checkout.cancel', ['transaction' => $transaction->id]),
        ]);

        $transaction->update([
          'session' => $session->id,
        ]);

        // Record the product order
        $order = Order::create([
          'transaction_id' => $transaction->id,
          'item_id' => $book->slID,
        ]);

        return redirect($session->url);
            
    }

    public function success(Transaction $transaction) 
    {

      // Verify that the page wasn't visited before concerning the same transaction
      if($transaction->status == TransactionStatus::PAID->value){
        abort(419);
      }

      $transaction->update([
        'status' => TransactionStatus::PAID,
      ]);


      PurchaseSuccessful::dispatch($transaction);      

      return view('general.checkout.success');
    }

    public function cancel(Transaction $transaction) 
    {
      // Verify if page was visited before
      if($transaction->status == TransactionStatus::CANCELLED->value){
        abort(419);
      }

      $transaction->update([
        'status' => TransactionStatus::CANCELLED,
      ]);

      return view('general.checkout.cancel');
    }

    public function webhook()
    {
      // TODO
    }
}
