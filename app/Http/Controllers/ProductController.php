<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use App\Http\Services\CategoryService;

class ProductController extends Controller
{

    public function __construct() {
        $this->productService  = new ProductService;
        $this->categoryService = new CategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];

        if(isset($request->categoryId)
            && !empty($request->categoryId)){
            $filters['category_id'][] = $request->categoryId;
        }

        $category = $this->categoryService->getCategory($request->categoryId);
        
        // top level category, pass other children IDs
        if( is_null($category->parent_id) ) {
            $filters['category_id_children'] = $category->childrenCategories->pluck('id')->toArray();
        }

        return view('products.products_list', [
            'products' => $this->productService->getAllProducts($filters),
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('products.product_edit', [
            'categoryId' => $request->get('categoryId') ? $request->get('categoryId') : null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->productService->store($request);
        $append = '/?categoryId='.$request->category_id;
        return redirect(route('products.index').$append);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
