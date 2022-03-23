<?php
namespace App\Http\Services;

/**
 * CategoryService.php
 * Handle business logic between controller & view.
 */

class CategoryService
{
	public $category;
	
	/**
	 * Inject the Category Model via __construct
	 */
	public function __construct() {
		$this->category = new \App\Category;
	}

	/**
   * Store the given category.
   *
   * @param  Request $request
   * @return Booleen
   */
	public function store($request) {
    $this->category->fill($request->all());
		return $category->save();
	}

	/**
   * Update the given category.
   *
   * @param  Request $request
   * @return Booleen
   */
	public function update($request, $category) {
		$category->fill($request->all());
		return $category->save();
	}

	/**
   * Get the selected categories
   *
   * @param  Category ID $category_id
   * @return Array
   */
	public function getAllCategories( $category_id ) {

		$categories = $this->category->with(['childrenCategories', 'products']);


		// Category ID Filter
		if( isset( $category_id ) && !is_null( $category_id ) ) {
			$categories = $categories->where('id', $category_id);
		} else {
			$categories = $categories->whereNull('parent_id');
		}
		

		$categories = $categories->get();

		return $categories;
	}

}
?>