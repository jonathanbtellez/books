<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Traits\UploadFile;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
	use UploadFile;
	public function index(Request $request)
	{
		$books = Book::with('author', 'category')->get();

		$authors = Author::get();
		//Use  web
		if (!$request->ajax()) return view('books.index', compact('books', 'authors'));

		// Use api
		return response()->json(['books' => $books], 200);

		//throw $th;

	}

	public function store(BookRequest $request)
	{
		try {			// Handel insertions using transactions
			DB::beginTransaction();
			$book = new Book($request->all());
			$book->save();
			$this->uploadImage($book, $request);
			DB::commit();
			return response()->json(['status' => 'book created', 'book' => $book], 201);
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
		}
	}

	public function show(Book $book)
	{
		return response()->json(['book' => $book], 200);
	}

	public function update(BookUpdateRequest $request, Book $book)
	{
		try {
			// Handel insertions using transactions
			DB::beginTransaction();
			$book->update($request->all());
			$this->uploadImage($book, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
		}
	}


	public function destroy(Book $book)
	{
		$book->delete();
		$this->deleteFile($book);
		return response()->json([], 204);
	}
}
