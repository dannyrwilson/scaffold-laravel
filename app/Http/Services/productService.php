<?php
namespace App\Http\Services;

/**
 * ProductService.php
 * Handle business logic between controller & view.
 */

class ProductService
{

	/**
   * Parse filters for product filtering
   *
   * @param  Request $request
   * @param  Category $category
   * @return Array
   */
	public function getFilters($request, $category) {

		$filters = [
        'keyword' => null,
        'order' => 'asc',
        'sort' => 'id',
        'category_id' => null
    ];
    
    $filters['category_id'] = $request->categoryId;

    // top level category, pass other children IDs
    if( is_null($category->parent_id) ) {
        $filters['category_id_children'] = $category->childrenCategories->pluck('id')->toArray();
    }

    if($request->keyword){
        $filters['keyword'] = $request->keyword;
    }

    if($request->sort){
        $filters['sort'] = $request->sort;
    }

    if($request->order) {
        $filters['order'] = ($request->order === 'asc') ? 'desc' : 'asc';
    }

    return $filters;

	}
}
?>