<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;

class CategoryController extends Controller
{

    public function __construct(
        //CategoryService $categoryService
    ) {
        $this->categoryService = new CategoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.categories_list', [
            'categories' => $this->categoryService->getAllCategories(null)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('categories.category_edit', [
            'categoryId' => $request->get('categoryId') ? $request->get('categoryId') : ''
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
        $this->categoryService->store($request);
        $appendParent = ( !is_null($request->parent_id) ) ? '/'.$request->parent_id : $appendParent = '';
        return redirect(route('categories.index').$appendParent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.categories_list', [
            'category' => $category,
            'categories' => $this->categoryService->getAllCategories($category->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.category_edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->categoryService->update($request, $category);
        $appendParent = ( !is_null($category->parent_id) ) ? '/'.$category->parent_id : $appendParent = '';
        return redirect(route('categories.index').$appendParent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
