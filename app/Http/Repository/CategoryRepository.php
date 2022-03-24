<?php
namespace App\Http\Repository;
use App\Category;

/**
 * CategoryRepository.php
 * Handle layer between model & controller.
 */

class CategoryRepository
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
		return $this->category->save();
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

	public function delete($category) {

		// delete associated products so not left with dud rows
		$category->products()->delete();

		// finally, delete category
		$category->delete();

	}

	public function getCategory($categoryId) {
		return $this->category->find($categoryId);
	}

	/**
   * Get the selected categories
   *
   * @param  Category Parent ID $parent_id
   * @return Array
   */
	public function getAllCategories( $parent_id ) {

		$categories = $this->category->with(['childrenCategories', 'products']);


		// Category ID Filter
		if( isset( $parent_id ) && !is_null( $parent_id ) ) {
			$categories = $categories->where('parent_id', $parent_id);
		} else {
			$categories = $categories->whereNull('parent_id');
		}
		

		$categories = $categories->get();

		return $categories;
	}

}
?>