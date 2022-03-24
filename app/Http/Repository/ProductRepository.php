<?php
namespace App\Http\Repository;
use App\Product;
/**
 * ProductRepository.php
 * Handle layer between model & controller.
 */

class ProductRepository
{
	
	public $product;
	
	const PRODUCT_PAGINATION = 5;

	const FILTER_COLUMNS = [
		'id',
		'name',
		'price',
		'created_at'
	];

	const FILTER_TYPE = [
		'asc',
		'desc'
	];

	/**
	 * Inject the Product Model via __construct
	 */
	public function __construct(Product $product) {
		$this->product = $product;
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
   * Delete the given product.
   *
   * @param  Request $request
   * @param  Product $product
   * @return Booleen
   */
	public function delete($product) {
		return $product->delete();
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

		// if browsing top level products, show sub category products
		if( isset($filters['category_id_children']) ) {
			$products = $products->orWhereIn('category_id', $filters['category_id_children']);
		}

		// keyword match for free text search
		if( isset($filters['keyword']) && !empty($filters['keyword']) ) {
			$products = $products->where('name', 'LIKE', '%'.$filters['keyword'].'%');
		}

		// Sorting Filter and make sure only id, name, price sortable.
		if( 
			isset($filters['sort'])
			&& isset($filters['order'])
			&& in_array($filters['sort'], self::FILTER_COLUMNS)
			&& in_array($filters['order'], self::FILTER_TYPE) 
		) {
			$order    = isset($filters['order']) ? $filters['order'] : self::FILTER_TYPE[0];
			$products = $products->orderBy($filters['sort'], $order);
		}

		$products = $products->paginate(self::PRODUCT_PAGINATION);

		return $products;
	}

}
?>