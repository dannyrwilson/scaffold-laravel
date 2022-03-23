<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'name',
		'parent_id'
	];

  //
	public function categories()
  {
    return $this->hasMany(\App\Category::class, 'parent_id', 'id');
  }

  public function childrenCategories()
	{
		return $this->hasMany(\App\Category::class, 'parent_id', 'id')->with('categories');
	}

	public function parent()
	{
		return $this->hasOne(\App\Category::class, 'parent_id', 'id');
	}

	public function products()
	{
		return $this->hasMany(\App\Product::class, 'id', 'category_id');
	}

	public function getSubCategoriesFormattedAttribute(){
		$names = $this->childrenCategories->pluck('name')->toArray();
		return implode(', ', $names);
	}

}
