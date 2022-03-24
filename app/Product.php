<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    public $fillable = [
    	'name', 
    	'price', 
    	'category_id',
    	'description'
    ];

    public function category() {
    	return $this->hasOne(\App\Category::class, 'id', 'category_id')
    	->with('parent');
    }

    public function getCreatedAtFormattedAttribute() {
    	return Carbon::parse($this->created_at)->format('d/m/Y h:i:s');
    }
}
