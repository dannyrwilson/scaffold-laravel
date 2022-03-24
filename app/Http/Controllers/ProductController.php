<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Repository\ProductRepository;
use App\Http\Repository\CategoryRepository;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    /**
     * The product repository implementation.
     *
     * @var ProductRepository
     */
    protected $product;

    /**
     * The category repository implementation.
     *
     * @var CategoryRepository
     */
    protected $category;

    /**
     * The product service implementation.
     *
     * @var ProductService
     */
    protected $productService;

    /**
     * Create a new controller instance.
     *
     * @param  ProductRepository  $product
     * @param  ProductService $productService
     * @param  CategoryRepository  $category
     * @return void
     */
    public function __construct(
        ProductRepository $product, 
        ProductService $productService, 
        CategoryRepository $category) {

        $this->productRepository  = $product;
        $this->categoryRepository = $category;
        $this->productService     = $productService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( is_null($request->categoryId) ) abort(404);
    
        // find selected category
        $category = $this->categoryRepository->getCategory($request->categoryId);

        // default filters
        $filters = $this->productService->getFilters($request, $category);

        return view('products.products_list', [
            'products' => $this->productRepository->getAllProducts($filters),
            'category' => $category,
            'filters' => $filters
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
     * Show the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.product_view', [
            'product' => $product
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

        // handle validation, more complex validation can be moved to it's own Form Request.
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if($request->validated() && $this->productRepository->store($request)){
            session()->flash('message', 'Product successfully created.');   
        }else{
            session()->flash('message', 'Product failed to create.');
        }
        return redirect('products?categoryId='.$request->category_id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.product_edit', [
            'product' => $product
        ]);
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
        if($this->productRepository->update($request, $product)){
            session()->flash('message', 'Product successfully updated.');   
        }else{
            session()->flash('message', 'Product failed to update.');
        }
        return redirect('/products?categoryId='.$product->category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($this->productRepository->delete($product)){
            session()->flash('message', 'Product successfully deleted.');
        }else{
            session()->flash('message', 'Product failed to delete.');
        }
        return redirect()->back();
    }
}
