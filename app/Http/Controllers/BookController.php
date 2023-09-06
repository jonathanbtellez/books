<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
	public function index(Request $request)
	{
		$books  = Book::get();

		//Use  web
		if(!$request->ajax())return view('index', compact('books'));

		// Use api
		return response()->json([ 'books' => $books], 200);
	}

	// public function create()
	// {
	// 	return view();
	// }

	public function store(BookRequest $request)
	{
		$book = new Book($request->all());
		$book->save();

		return response()->json([ 'status' => 'book created', 'book' => $book], 201);
	}

	// public function edit()
	// {
	// 	return view();
	// }
	public function show(Book $book)
	{
		return response()->json([ 'book' => $book], 200);
	}

	public function update(BookRequest $request, Book $book)
	{
		$book->update($request->all());
		return response()->json([], 204);
	}


	public function destroy(Book $book)
	{
		$book->delete();
		return response()->json([], 204);
	}
}
