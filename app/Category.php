<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  //
	public function categories()
  {
    return $this->hasMany(\App\Category::class, 'parent_id', 'id');
  }

  public function childrenCategories()
	{
		return $this->hasMany(\App\Category::class, 'parent_id', 'id')->with('categories');
	}

	public function products()
	{
		return $this->hasMany(\App\Product::class, 'id', 'category_id');
	}
}
