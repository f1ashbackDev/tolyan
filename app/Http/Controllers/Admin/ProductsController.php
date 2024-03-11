<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Catalogs;
use App\Models\Image;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        return view('new_admin.product',[
            'products' => Products::with('category')->get(),
            'category' => Catalogs::all()
        ]);
    }

    public function create()
    {
        return view('new_admin.product-add', [
           'categories' => Catalogs::all()
        ]);
    }

    public function store(Request $request)
    {
        $path = $request->file('image')->store('products', 'public');
        $product = Products::create([
            'name' => $request->name,
            'count' => $request->count,
            'price' => $request->price,
            'image' => $path,
            'description' => $request->description,
            'category_id' => $request->category
        ]);
        return redirect()->route('admin.products.index');
    }

    public function edit(Products $products)
    {
        return view('new_admin.product-edit', [
           'product' => $products,
           'image' => $products->image,
           'name_category' => $products->category->categories_name,
            'category' => Catalogs::all()
        ]);
    }

    public function update(ProductRequest $request, Products $products)
    {
        if($request->name != null) {
            $products->update([
                'name' => $request->name
            ]);
        }
        else if ($request->count != null){
            $products->update([
                'count' => $request->count
            ]);
        }
        else if($request->price != null){
            $products->update([
                'price' => $request->price
            ]);
        }
        else if($request->description != null){
            $products->update([
               'description' => $request->description
            ]);
        }
        else if($request->category_id != null){
            $products->update([
                'category_id' => $request->category_id
            ]);
        }
        else if($request->file('image') != null){
            $image = Image::where(['products_id' => $products->id])->get();
            foreach ($image as $item){
                Storage::disk('public')->delete($item->image);
                $item->delete();
            }
            foreach ($request->file('image') as $item){
                $path = $item->store('products', 'public');
                $image = new Image();
                $image->image = $path;
                $image->products_id = $products->id;
                $image->save();
            }
        }
        return redirect()->route('admin.products.index');
    }

    public function delete(Products $products)
    {
        $image = Image::where(['products_id' => $products->id])->get();
        foreach ($image as $item){
            Storage::disk('public')->delete($item->image);
            $item->delete();
        }
        $products->delete();
        return redirect()->route('admin.products.index');
    }
}
