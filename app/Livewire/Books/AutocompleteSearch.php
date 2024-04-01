<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AutocompleteSearch extends Component
{

    public $query, $table, $results= [], $selectedBook = null;


    public function updatedQuery() {

        if(!auth()){
            return;
        }
        if(empty($this->query)) {
            $this->results = [];
        }

        $this->results = DB::table('books')->where('title', 'like', '%'.$this->query.'%')->limit(5)->get();
    }

    public function bookSelected($book_id) {
        $this->query = '';
        $this->selectedBook = Book::where('id', $book_id)->first();
    }

    public function unsetBook() {
        $this->selectedBook = null;
    }

    public function render()
    {
        return view('livewire.books.autocomplete-search');
    }
}
