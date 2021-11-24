<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Str;
use File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('Product.index',compact('products'));
    }

    public function create()
	{
	    $categories = Category::all();
	    return view('Product.create', compact('categories'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	        'name' => 'required|string|max:100',
	        'description' => 'required',
	        'category_id' => 'required|exists:categories,id',
	        'price' => 'required',
	        'image' => 'required|image|mimes:png,jpeg,jpg'
	    ]);

	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/products', $filename);

	        /*$product = Product::create([
	            'name' => $request->name,
				'description' => $request->description,
	            'category_id' => $request->category_id,
	            'price' => $request->price,
				'image' => $filename,
	        ]);*/

			$new_product = new Product;
			$new_product->name = $request->name;
			$new_product->description = $request->description;
			$new_product->category_id = $request->category_id;
			$new_product->price  = $request->price;
			$new_product->image  = $filename;
			$new_product->save();
	        return redirect(route('product.index'))->with('alert', 'added product');
	    }
	}

	public function edit($id)
	{
	    $product = Product::findOrfail($id);
	    $categories = Category::all();
	    return view('Product.edit', compact('product', 'categories'));
	}

	public function update(Request $request, $id)
	{
	    $this->validate($request, [
	        'name' => 'required|string|max:100',
	        'description' => 'required',
	        'category_id' => 'required|exists:categories,id',
	        'price' => 'required',
	        'image' => 'required|image|mimes:png,jpeg,jpg'
	    ]);

	    $product = Product::findOrfail($id);
	    $filename = $product->image;
	  
	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/products', $filename);
	        File::delete(storage_path('app/public/products/' . $product->image));
	    }
		
	    /*$product->update([
	        'name' => $request->name,
			'description' => $request->description,
			'category_id' => $request->category_id,
			'price' => $request->price,
			'image' => $filename,
	    ]);*/

		$product->name = $request->name;
		$product->description = $request->description;
		$product->category_id = $request->category_id;
		$product->price  = $request->price;
		$product->image  = $filename;
		$product->save();


	    return back()->with('alert', 'Product updated successfully');
	}

	/*public function destroy($id)
	{
	    $product = Product::find($id);
	    File::delete(storage_path('app/public/products/' . $product->image));
	    $product->delete();
	    return redirect(route('product.index'))->with(['success' => 'Product Has Been Removed']);
	}*/

	public function destroy(Request $request)
	{
	    if($request->ajax()){
            $product = Product::findOrfail($request->product_id);
			File::delete(storage_path('app/public/products/' . $product->image));
            $product->delete();
            return response()->json(["mensaje"=>"borrado"]);
        }
	}

}
