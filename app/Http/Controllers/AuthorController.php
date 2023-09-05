<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
	public function index()
	{
		$authors = Author::get();

		return response()->json([ 'authors' => $authors], 200);
	}

	// public function create()
	// {
	// 	return view();
	// }

	public function store(AuthorRequest $request)
	{
		$author = new Author($request->all());
		$author->save();

		return response()->json([ 'status' => 'author created', 'author' => $author], 201);
	}

	// public function edit()
	// {
	// 	return view();
	// }
	public function show(Author $author)
	{
		return response()->json([ 'author' => $author], 200);
	}

	public function update(AuthorRequest $request, Author $author)
	{
		$author->update($request->all());
		return response()->json([], 204);
	}


	public function destroy(Author $author)
	{
		$author->delete();
		return response()->json([], 204);
	}
}
