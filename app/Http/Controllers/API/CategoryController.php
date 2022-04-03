<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = request()->input('paginate') ? request()->input('paginate') : 10;

        $order_by = 'created_at';

        $type = request()->input('type') ? request()->input('type') : 'desc' ;
        $sortable_fields = ['title' , 'updated_at'];

        if (in_array(request()->input('order-by') , $sortable_fields))
        {
            $order_by = request()->input('order-by');
        }

        $categories = Category::with('products:title,id')->orderBy($order_by , $type)->paginate($pagination);

        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
        ]);

        $category = Category::create($data);

        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::with('products')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function associateProduct($id , Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $category = Category::findOrFail($id);

        $category->products()->sync($product->id);

        return response()->json([
            'message' => 'Product added to Category successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
