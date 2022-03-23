<?php
namespace App\Http\Services;

/**
 * categoryService.php
 * Handle business logic between controller & view.
 */

class CategoryService
{
	public $category;
	
	/**
	 * Inject the Category Model via __construct
	 */
	public function __construct(Category $category) {
		$this->category = $category;
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

		$categories = $this->category
			->with(['category']);

		if( isset($filters)
				&& is_array($filters)
				&& count($filters) > 0) {

			// Category ID Filter
			if( isset( $category_id ) {
				$categories = $categories->where('category_id', $category_id);
			}

		}

		$categories = $categories->get();

		return $categories;
	}

}
?>