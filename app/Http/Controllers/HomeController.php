<?php

namespace App\Http\Controllers;

use App\Enums\Conditions;
use App\Models\Book;
use App\Models\SalesListing;
use Illuminate\Http\Request;
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

        $books = DB::table('sales_listings as sl')
            ->select('b.id', 'b.title', 'b.edition', 'b.isbn', 'sl.price', 'sl.condition', 'sl.status')
            ->join('books as b', 'b.id', '=', 'sl.book_id')
            ->where('sl.seller', '=', auth()->user()->id)
            ->get();

        return view('home', [
            'books' => $books,
        ]);
    }

    public function sell() 
    {
        $conditions = array_column(Conditions::cases(), 'value');
        return view('sell', [
            'conditions' => $conditions,
        ]);
    }
}
