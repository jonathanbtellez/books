<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
		$books = Book::with('author','category','file')
			->whereHas('category')
			->where('stock', '>', 0 )
			->get();
        return view('index', compact('books'));
    }
}
