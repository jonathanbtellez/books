<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
	public function getAll()
	{
		$categories  = Category::query();
		return DataTables::of($categories)->toJson();
	}
    public function index(Request $request)
	{
		$categories  = Category::get();
		if (!$request->ajax()) return view('categories.index');
		return response()->json([ 'categories' => $categories], 200);
	}

	// public function create()
	// {
	// 	return view();
	// }

	public function store(CategoryRequest $request)
	{
		$category = new category($request->all());
		$category->save();

		return response()->json([ 'status' => 'category created', 'category' => $category], 201);
	}

	// public function edit()
	// {
	// 	return view();
	// }
	public function show(Category $category)
	{
		return response()->json([ 'category' => $category], 200);
	}

	public function update(CategoryRequest $request, Category $category)
	{
		$category->update($request->all());
		return response()->json([], 204);
	}


	public function destroy(Category $category)
	{
		$category->delete();
		return response()->json([], 204);
	}
}
