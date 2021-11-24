<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Category.index',compact('categories'));
    }

    public function create()
	{
	    return view('Category.create');
	}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $new_category = new Category;
        $new_category->name = $request->name;
        $new_category->description = $request->description;
        $new_category->save();
        return back()->with('alert', 'added category');
    }

    public function edit($id)
	{
	    $category = Category::findOrfail($id);
	    return view('Category.edit', compact('category'));
	}

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $category = Category::findOrfail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return back()->with('alert', 'Category updated successfully');
    }

    public function destroy($id)
	{
	    $category = Category::findOrfail($id);
	    $category->delete();
	    return redirect(route('category.index'))->with(['alert' => 'Category Has Been Removed']);
	}


    public function ajax_destroy(Request $request)
	{
	    if($request->ajax()){
            $category = Category::findOrfail($request->category_id);
            $category->delete();
            return response()->json(["mensaje"=>"borrado"]);
        }
	}

}
