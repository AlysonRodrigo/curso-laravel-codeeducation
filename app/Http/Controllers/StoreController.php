<?php

namespace CookieSoftCommerce\Http\Controllers;

use CookieSoftCommerce\Category;
use CookieSoftCommerce\Product;
use Illuminate\Http\Request;

use CookieSoftCommerce\Http\Requests;
use CookieSoftCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{

    public function index(Request $request)
    {
    {

        $pFeatured = Product::featured()->get();
        $pRecommend = Product::recommend()->get();


        $categories = Category::all();

        $category = $request->all()['category'] ?? 0;

        if($category > 0){
            $products = Product::where('category_id','=',$category)
                ->orderBy('name','asc')
                ->paginate(9);
        }else{
            $products = Product::orderBy('name','asc')
                ->paginate(9);
        }
    }




        return view('store.index',compact('categories','pFeatured','pRecommend','products'));
    }
}
