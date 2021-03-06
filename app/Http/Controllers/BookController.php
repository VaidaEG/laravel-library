<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use PDF;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::all();

        // FILTRAVIMAS
        if ($request->author_id) {
            //$books = Book::where('author_id', $request->author_id)->get();
            if ($request->sort && 'asc' == $request->sort) {
                $books = Book::where('author_id', $request->author_id)->orderBy('title')->paginate(10);
                $filterBy = $request->author_id;
                $books->appends(['author_id' => $request->author_id]);// tam kad but galima filtre paginuoti
                $sortBy = 'asc';
            }
            else if ($request->sort && 'desc' == $request->sort) {
                $books = Book::where('author_id', $request->author_id)->orderBy('title', 'desc')->paginate(10);
                $filterBy = $request->author_id;
                $books->appends(['author_id' => $request->author_id]);// tam kad but galima filtre paginuoti
                $sortBy = 'desc';

            }
            else {
                $books = Book::where('author_id', $request->author_id)->paginate(10);
                $filterBy = $request->author_id;
                $books->appends(['author_id' => $request->author_id]);// tam kad but galima filtre paginuoti
            }
        }
        else {
            if ($request->sort && 'asc' == $request->sort) {
                $books = Book::orderBy('title')->paginate(10);
                $filterBy = $request->author_id;
                $books->appends(['author_id' => $request->author_id]);// tam kad but galima filtre paginuoti
                $sortBy = 'asc';
            }
            else if ($request->sort && 'desc' == $request->sort) {
                $books = Book::orderBy('title', 'desc')->paginate(10);
                $filterBy = $request->author_id;
                $books->appends(['author_id' => $request->author_id]);// tam kad but galima filtre paginuoti
                $sortBy = 'desc';
            }
            else {
                // $books = Book::all();
                $books = Book::paginate(10);
            }
        }
        
        // if ($request->sort && 'asc' == $request->sort) {
        //     $books = Book::where('author_id', $request->author_id)->orderBy('title')->paginate(10);
        // }
        // else if ($request->sort && 'desc' == $request->sort) {
        //     $books = Book::where('author_id', $request->author_id)->orderBy('title', 'desc')->paginate(10);
        // }
        // // $books = Book::where('author_id', $request->author_id)->orderBy('title', 'desc')->paginate(10);
        // // RUSIAVIMAS FILTRUOJANT
        // if ($request->sort && 'asc' == $request->sort) {
        //     $books = $books->sortBy('title');
        // }
        // else if ($request->sort && 'desc' == $request->sort) {
        //     $books = $books->sortByDesc('title');
        // }

        return view('book.index', ['books' => $books, 'authors' => $authors, 'filterBy' => $filterBy ?? 0, 'sortBy' => $sortBy ?? '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'The book has been successfully created. Nice job!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'The book has been successully updated. Nice job!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('info_message', 'The book has been successfully deleted. Nice job!');
    }
    public function pdf(Book $book)
    {
       
        $pdf = PDF::loadView('book.pdf', ['book' => $book]); // standartinis view
        return $pdf->download('book-id' . $book->id . '.pdf'); // failo pavadinimas
    }
    
}
