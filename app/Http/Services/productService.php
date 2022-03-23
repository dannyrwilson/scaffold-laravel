<?php
namespace App\Http\Services;

/**
 * productService.php
 * Handle business logic between controller & view.
 */

class ProductService
{
	public $product;
	
	/**
	 * Inject the Product Model via __construct
	 */
	public function __construct() {
		$this->product = new \App\Product;
	}

	/**
   * Store the given product.
   *
   * @param  Request $request
   * @return Booleen
   */
	public function store($request) {
    $this->product->fill($request->all());
		return $this->product->save();
	}

	/**
   * Store the given product.
   *
   * @param  Request $request
   * @param  Product $product
   * @return Booleen
   */
	public function update($request, $product) {
		$product->fill($request->all());
		return $product->save();
	}

	/**
   * Store the given category.
   *
   * @param  Filters $filters []
   * 				 - category_id
   *				 - sort
   * @return Booleen
   */

	public function getAllProducts( $filters ) {

		$products = $this->product;

		// Category ID Filter
		if( isset($filters['category_id']) ) {
			$products = $products->where('category_id', $filters['category_id']);

		}

		if( isset($filters['category_id_children']) ) {
			$products = $products->orWhereIn('category_id', $filters['category_id_children']);
		}

		// Sorting Filter
		if( isset($filters['sort']) ) {
			$order    = isset($filters['order']) ? $filters['order'] : 'asc';
			$products = $products->orderBy($filters['sort'], $order);
		}

		$products = $products->paginate(5);

		return $products;
	}

}
?>