<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SalesListing;
use App\Rules\ISBN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
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

    public function create() 
    {
        return view('books.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|min:2',
            'author' => 'required|string|min:2',
            'isbn' => ['required', new ISBN],
            'edition' => 'required|string|max:5',
            'language' => 'required|string',
        ]);

        $addedBook = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'edition' => $request->edition,
            'language' => $request->language,
            'added_by' => auth()->user()->id,
        ]);

        return redirect()
            ->route('sell')
            ->with('status', $addedBook);
    }

    public function show(SalesListing $book)
    {

        $book = DB::table('sales_listings as sl')
            ->select('b.id', 'sl.id as slID', 'b.title', 'b.author', 'b.isbn', 'b.description', 'b.edition', 'b.category', 'b.cover', 'sl.price', 'sl.condition', 'sl.status', 'b.quantity')
            ->join('books as b', 'b.id', '=', 'sl.book_id')
            ->where('sl.id', '=', $book->id)
            ->first();        

        return view('books.show', [
            'book' => $book,
        ]);

    }
}
