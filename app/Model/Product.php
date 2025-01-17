<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{	
    protected $fillable = [
        'category_id', 'unit', 'description', 'name_product', 'price', 'picture'
    ];
    public function category()
    {
    	return $this->belongsTo('App\Model\ProductCategory');
    }

    public function receiptdetails()
    {
    	return $this->hasMany('App\Model\ReceiptDetail');
    }
}
