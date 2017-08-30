<?php

namespace CookieSoftCommerce\Http\Controllers;

use CookieSoftCommerce\Category;
use CookieSoftCommerce\Product;
use Illuminate\Http\Request;

use CookieSoftCommerce\Http\Requests;
use CookieSoftCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{

    public function index()
    {

        $pFeatured = Product::featured()->get();

        $categories = Category::all();

        return view('store.index',compact('categories','pFeatured'));
    }
}
