<?php

namespace App\Http\Controllers\General;

use App\Enums\Conditions;
use App\Enums\SalesListingStatus;
use App\Events\BookListedSuccessfully;
use App\Http\Controllers\Controller;
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
        $this->middleware('auth', ['only' => ['create', 'store', 'showSellForm', 'sell']]);
    }

    public function create()
    {
        return view('general.book.create');
    }

    public function store(Request $request)
    {
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

        return view('general.book.show', [
            'book' => $book,
        ]);
    }

    public function search()
    {
        $query = request('query') ?? '';
        $books = [];

        if (!$query == '') {
            $books = DB::table('sales_listings as sl')
                ->select('sl.id', 'b.title', 'b.author', 'b.isbn', 'b.description', 'b.edition', 'b.category', 'b.cover', 'sl.seller', 'sl.price', 'sl.condition', 'sl.status')
                ->join('books as b', 'b.id', '=', 'sl.book_id')
                ->whereAny(['b.title', 'b.category', 'b.publisher', 'b.author', 'b.isbn'], 'like', "%$query%")
                ->where('sl.status', '=', SalesListingStatus::AVAILABLE)
                ->where('b.reviewed_by', '!=', null);

            if(auth()->user()) 
                $books->where('seller', '!=', auth()->user()->id);
                
        }

        return view('general.book.search', [
            'books' => $books->get(),
            'query' => $query,
        ]);
    }


    public function showSellForm() 
    {
        $conditions = array_column(Conditions::cases(), 'value');
        return view('general.book.sell', [
            'conditions' => $conditions,
        ]);
    }

    public function sell(Request $request)
    {
        // Convert price to boolean before validation
        $request->merge([
            'price' => number_format($request->price, 2, '.', '')
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

        if($bookListed) {
            BookListedSuccessfully::dispatch($bookListed);
        } 

        return redirect()->route('general.home')->with('status', 'Your book was successfully listed');
    }
}
