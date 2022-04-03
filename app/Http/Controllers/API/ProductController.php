<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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

        $sortable_fields = ['title' , 'price' , 'quantity' , 'created_at' ,'updated_at'];

        if (in_array(request()->input('order-by') , $sortable_fields ))
        {
            $order_by = request()->input('order-by');
        }

        $products = Product::with('categories:title,id')->orderBy($order_by , $type)->paginate($pagination);

        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with('categories')->findOrFail($id);
    }
    
    public function activeProducts()
    {
        $pagination = request()->input('paginate') ? request()->input('paginate') : 10;

        $order_by = 'created_at';

        $type = request()->input('type') ? request()->input('type') : 'desc' ;

        $sortable_fields = ['title' , 'price' , 'quantity' , 'created_at' ,'updated_at'];

        if (in_array(request()->input('order-by') , $sortable_fields ))
        {
            $order_by = request()->input('order-by');
        }

        $active_products = Product::with('categories:title,id')->where('is_active' , true)->orderBy($order_by , $type)->paginate($pagination);

        return $active_products;
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
            'price' => 'required|numeric',
            'stock'=>'required|numeric',
            'is_active'=>'required|boolean'
        ]);

        $product = Product::create($data);

        return $product;
        }
}
