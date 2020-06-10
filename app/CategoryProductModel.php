<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProductModel extends Model
{
     public $timestamps = false; //set time to false
    protected $fillable = [
    	'TenLoai', 'slug_category_product'
    ];
    protected $primaryKey = 'IDLoai ';
 	protected $table = 'tbl_category_product';
}
