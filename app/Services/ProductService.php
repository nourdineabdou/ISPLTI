<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Product_C;

class ProductService
{
    public function __construct()
    {
        //
    }

    public function getProducts(): _IH_Product_C|Collection|array
    {
        return Product::all();
    }

    // getProductEmballage
    public static function getProductEmballage($id)
    {
        return Product::find($id)->emballages;
    }
}
