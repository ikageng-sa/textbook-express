<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\SalesListing;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $myBooks = DB::table('sales_listings as sl')
            ->select('b.id', 'b.title', 'b.author', 'b.cover', 'b.edition', 'b.isbn', 'sl.price', 'sl.condition', 'sl.status')
            ->join('books as b', 'b.id', '=', 'sl.book_id')
            ->where('sl.seller', '=', auth()->user()->id)
            ->get();

        $newBooks = SalesListing::select('books.id', 'books.title', 'books.author', 'books.cover', 'books.edition', 'books.isbn', 'sales_listings.seller', 'sales_listings.price', 'sales_listings.condition', 'sales_listings.status')
        ->join('books', 'books.id', '=', 'sales_listings.book_id')
        ->where('sales_listings.seller', '=', auth()->user()->id)
        ->last7Days('sales_listings.created_at')
        ->get();

        return view('general.home', [
            'myBooks' => $myBooks,
            'newBooks' => $newBooks,
        ]);
    }

}
