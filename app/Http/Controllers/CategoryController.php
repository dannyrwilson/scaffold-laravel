<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Repository\CategoryRepository;

class CategoryController extends Controller
{

    /**
     * The category repository implementation.
     *
     * @var CategoryRepository
     */
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @param  CategoryRepository  $category
     * @return void
     */
    public function __construct(CategoryRepository $category) {
        $this->categoryRepository = $category;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.categories_list', [
            'categories' => $this->categoryRepository->getAllCategories(null)
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
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.categories_list', [
            'category' => $category,
            'categories' => $this->categoryRepository->getAllCategories($category->id)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // handle validation, more complex validation can be moved to it's own Form Request.
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $appendParent = ( !is_null($request->parent_id) ) ? '/'.$request->parent_id : $appendParent = '';
        if($this->categoryRepository->store($request)){
            session()->flash('message', 'Category successfully added.');
        }else{
            session()->flash('message', 'Category failed to add.');
        }
        return redirect(route('categories.index').$appendParent);
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

        $request->validate([
            'name' => 'required'
        ]);

        $appendParent = ( !is_null($category->parent_id) ) ? '/'.$category->parent_id : $appendParent = '';
        if($this->categoryRepository->update($request, $category)){
            session()->flash('message', 'Category successfully updated.');
        }else{
            session()->flash('message', 'Category failed to update.');
        }
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
        if($this->categoryRepository->delete($category)){
            session()->flash('message', 'Category successfully deleted.');
        }else{
            session()->flash('message', 'Category failed to delete.');
        }
        return redirect()->back();
    }
}
