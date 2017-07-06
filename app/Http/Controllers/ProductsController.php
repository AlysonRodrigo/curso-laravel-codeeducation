<?php

namespace CookieSoftCommerce\Http\Controllers;

use CookieSoftCommerce\Category;
use CookieSoftCommerce\Http\Requests;
use CookieSoftCommerce\Product;
use Illuminate\Support\Facades\Request;

class ProductsController extends Controller
{

    private $productModel;

    /**
     * ProductsController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $products = $this->productModel->paginate(10);

        return view('products.index',compact('products'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Category $category){

        $categories = $category->lists('name','id');

        return view('products.create',compact('categories'));
    }

    /**
     * @param Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\ProductRequest $request){

        $input = $request->all();
        $input['featured'] =  $request->get('featured') ? true : false;
        $input['recommend'] = $request->get('recommend') ? true : false;

        $product = $this->productModel->fill($input);

        $product->save();

        return redirect()->route('products');
    }

    /**
     * @param $id
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Category $category){

        $categories = $category->lists('name','id');

        $product = $this->productModel->find($id);

        return view('products.edit',compact('product','categories'));
    }

    /**
     * @param Requests\ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\ProductRequest $request, $id){

        $this->productModel->find($id)->update($request->all());

        return redirect()->route('products');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){

        $this->productModel->find($id)->delete();

        return redirect()->route('products');
    }

    public function images($id){
        $product = $this->productModel->find($id);

        return view('products.images',compact('product'));
    }

    public function createImage($id){
        $product = $this->productModel->find($id);

        return view('products.create_image',compact('product'));
    }

    public function storeImage(Request $request, $id){

    }



}
