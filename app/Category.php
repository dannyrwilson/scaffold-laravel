<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'name',
		'parent_id'
	];

  public function childrenCategories()
	{
		return $this->hasMany(\App\Category::class, 'parent_id', 'id');
	}

	public function products()
	{
		return $this->hasMany(\App\Product::class, 'category_id', 'id');
	}

	public function parent()
	{
		return $this->hasOne(\App\Category::class, 'id', 'parent_id');
	}

	public function getSubCategoriesFormattedAttribute(){
		$names = $this->childrenCategories->pluck('name')->toArray();
		return implode(', ', $names);
	}

	public function getCreatedAtFormattedAttribute() {
  	return Carbon::parse($this->created_at)->format('d/m/Y h:i:s');
  }

}
