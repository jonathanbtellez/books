<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AuthorController extends Controller
{
	public function index(Request $request)
	{
		$authors = Author::get();
		if (!$request->ajax()) return view('authors.index', compact('authors'));
		return response()->json([ 'authors' => $authors], 200);
	}

	public function getAllDt()
	{
		$authors = Author::query();
		return DataTables::of($authors)->toJson();
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
