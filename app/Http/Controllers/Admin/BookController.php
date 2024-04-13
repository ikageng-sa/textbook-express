<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookCoverRequest;
use App\Http\Requests\UpdateBookDetailsRequest;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:view book', ['only' => ['index', 'search', 'show']]);
        $this->middleware('permission:create book', ['only' => ['create', 'store']]);
        $this->middleware('permission:update book', ['only' => ['update', 'updateBookCover', 'edit']]);
        $this->middleware('permission:delete book', ['only' => 'destroy']);
    }

    public function index()
    {
        $pageTitle = 'Incomplete Books';
        $books = Book::select('books.*', 'adder.name as adder', 'reviewer.name as reviewer')
            ->leftJoin('users as reviewer', 'books.reviewed_by', '=', 'reviewer.id')
            ->join('users as adder', 'books.added_by', '=', 'adder.id')
            ->orWhereNull('books.edition')
            ->orWhereNull('books.category')
            ->orWhereNull('books.language')
            ->orWhereNull('books.reviewed_by')
            ->orWhereNull('books.cover')
            ->get();

        return view('admin.books.index', [
            'pageTitle' => $pageTitle,
            'books' => $books,
        ]);
    }

    public function create() {

        return view('admin.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $path = $this->saveImage($request);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'publication_date' => $request->publication_date,
            'category' => $request->category,
            'language' => $request->language,
            'description' => $request->description,
            'cover' => 'storage/'.$path,
            'added_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('status', 'Book was successfully added');
        
    }

    public function search(Request $request)
    {
        $pageTitle = 'Search Results';
        $query = request('query') ?? '';

        $query = Book::select('books.*', 'adder.name as adder', 'reviewer.name as reviewer')
            ->leftJoin('users as reviewer', 'books.reviewed_by', '=', 'reviewer.id')
            ->join('users as adder', 'books.added_by', '=', 'adder.id');

            if(isset($request->text) && $request->text !== null) {
                $query->whereAny(['title', 'category', 'publisher', 'author', 'isbn'], 'like', "%$request->text%");
            }

            if(isset($request->reviewed) && $request->reviewed !== null) {
                if($request->reviewed == 'true')
                    $query->whereNotNull('books.reviewed_by');
                elseif($request->reviewed == 'false')
                    $query->whereNull('books.reviewed_by');
            }

            if(isset($request->added_by) && $request->added_by) {
                $query->whereBetween('books.created_at', [$request->added_by, Carbon::now()]);
            }

            $books= $query->get();
            session()->flashInput($request->input());

        return view('admin.books.index', [
            'pageTitle' => $pageTitle,
            'books' => $books,
            'query' => $query,
        ]);
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', [
            'book' => $book,
        ]);
    }

    public function update(UpdateBookDetailsRequest $request, Book $book)
    {
        $book->update($request->all());

        $this->reviewDetails($book);

        return redirect()->back()->with('detailsStatus', 'Book details where successfully updated');
    }

    public function updateBookCover(UpdateBookCoverRequest $request, Book $book)
    {

        $path = $this->saveImage($request, $book);

        $bookUpdated = $book->update([
            'cover' => 'storage/'.$path,
        ]);

        return redirect()->back()->with('coverStatus', 'Book cover was successfully updated');

    }

    private function reviewDetails($book)
    {
        if(
            $book->title !== null && 
            $book->author !== null && 
            $book->isbn !== null && 
            $book->description !== null && 
            $book->category !== null && 
            $book->language !== null && 
            $book->cover !== null && 
            $book->edition !== null
        ) {
            return $book->update(['reviewed_by' => auth()->user()->id]);
        }
        return false;
    }

        private function saveImage($request, $book = null): string 
        {
            $path = '';
            //  Check if an image is submitted and store if true then retrieve the path
            if($request->cover){
                $path = $request->file('cover')->store('covers', 'public');
            }
    
            // Delete the existing book cover if available
            if($book !== null && $old_cover = $book->cover) {
                Storage::disk('public')->delete($old_cover);            
            }

            return $path;
        }
}
