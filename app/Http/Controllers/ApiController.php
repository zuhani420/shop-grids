<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $products, $categories;

    public function getAllCategory()
    {
        $this->categories = Category::all();
        foreach ($this->categories as $category)
        {
            $category->sub_category = $category->subCategories;
        }
        return response()->json($this->categories);
    }

    public function getAllTrendingProduct()
    {
        $this->products = Product::orderBy('id', 'desc')->take(8)->get(['id', 'name', 'category_id', 'selling_price', 'image']);
        foreach ($this->products as $product)
        {
            $product->image         = asset($product->image);
            $product->category_name = $product->category->name;
        }
        return response()->json($this->products);
    }

}
