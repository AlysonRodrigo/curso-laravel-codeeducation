<?php

namespace CookieSoftCommerce\Http\Controllers;

use CookieSoftCommerce\Product;
use Illuminate\Http\Request;

use CookieSoftCommerce\Http\Requests;
use CookieSoftCommerce\Http\Controllers\Controller;

class ProductsController extends Controller
{

    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function index(){

        $products = $this->productModel->all();

        return view('products.index',compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Requests\ProductRequest $request){

        $input = $request->all();

        $product = $this->productModel->fill($input);

        $product->save();

        return redirect()->route('products');
    }

    public function edit($id){

        $product = $this->productModel->find($id);

        return view('products.edit',compact('product'));
    }

    public function update(Requests\ProductRequest $request, $id){

        $this->productModel->find($id)->update($request->all());

        return redirect()->route('products');
    }

    public function destroy($id){

        $this->productModel->find($id)->delete();

        return redirect()->route('products');
    }

}
