<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        $query = Book::withCount(['reviews' => function ($query) {
            $query->where('status', 1);
        }])
            ->withAvg(['reviews' => function ($query) {
                $query->where('status', 1);
            }], 'rating')
            ->where('deleted', 0)
            ->where('status', 1)
            ->where('image', '!=', null)
            ->orderBy('created_at', 'DESC');
        if (!empty($req->keyword)) {
            $query->where('title', 'like', '%' . $req->keyword . '%');
        }
        $books = $query->paginate(8);
        // dd($books);
        return view('home', ['books' => $books]);
    }
    public function detail($slug)
    {
        $book = Book::withCount(['reviews' => function ($query) {
            $query->where('status', 1);
        }])
            ->withAvg(['reviews' => function ($query) {
                $query->where('status', 1);
            }], 'rating')
            ->where('slug', $slug)->firstOrFail();

        if ($book->status == 0) {
            abort(404);
        }
        $bookreview = Review::where('status', '=', 1)->where('book_id', $book->id)->with('user')->get();
        $relatedBooks = Book::where('deleted', 0)->where('id', '!=', $book->id)->where('status', 1)->where('image', '!=', null)->take(3)->inRandomOrder()->get();
        return view('book-detail', ['book' => $book, 'relatedBooks' => $relatedBooks, 'bookreview' => $bookreview]);
    }
}
