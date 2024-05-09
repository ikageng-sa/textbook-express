<?php

namespace App\Http\Controllers;

use App\Models\SalesListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesListingController extends Controller
{

    public function store(Request $request)
    {
        // Convert price to boolean before validation
        $request->merge([
            'price' => number_format($request->price, 2)
        ]);

        $request->validate([
            'book' => 'required|numeric',
            'price' => 'required|decimal:2',
            'condition' => 'required|string',
        ]);

        $bookListed = SalesListing::create([
            'book_id' => $request->book,
            'price' => $request->price,
            'condition' => $request->condition,
            'seller' => auth()->user()->id,
        ]);

        return redirect()->to('/home')->with('status', 'Your book was successfully listed');
    }

    public function search()
    {
        $query = request('query') ?? '';
        $books = [];

        if (!$query == '') {
            $books = DB::table('sales_listings as sl')
                ->select('b.id', 'b.title', 'b.author', 'b.isbn', 'b.description', 'b.edition', 'b.category', 'b.cover', 'sl.seller', 'sl.price', 'sl.condition', 'sl.status')
                ->join('books as b', 'b.id', '=', 'sl.book_id')
                ->whereAny(['b.title', 'b.category', 'b.publisher', 'b.author', 'b.isbn'], 'like', "%$query%")
                ->get();
        }
        return view('search', [
            'books' => $books,
            'query' => $query,
        ]);
    }
}
