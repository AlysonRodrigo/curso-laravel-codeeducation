<?php

namespace CookieSoftCommerce\Http\Controllers;

use CookieSoftCommerce\Category;
use CookieSoftCommerce\Http\Requests;
use CookieSoftCommerce\Product;
use CookieSoftCommerce\ProductImage;
use CookieSoftCommerce\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        $products = $this->productModel->paginate(9);

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

        $inputTags = explode(',',$request->get('tags'));

        $product = $this->productModel->fill($request->all());
        $product->save();

        $this->storeTag($inputTags,$product->id);

        return redirect()->route('products');
    }

    private function storeTag($inputTags,$id)
    {
        $tag = new Tag();

        $countTags = count($inputTags);

        foreach ($inputTags as $key => $value) {
            $newTag = $tag->firstOrCreate(["name" => trim($value)]);
            $idTags[] = $newTag->id;
        }

        $product = $this->productModel->find($id);
        $product->tags()->sync($idTags);

    }

    /**
     * @param $id
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Category $category){

        $product = $this->productModel->find($id);
        $categories = $category->lists('name','id');

        $tags = implode(',', $product->tags()->lists('name')->toArray());

        return view('products.edit',compact('product','categories', 'tags'));
    }

    /**
     * @param Requests\ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\ProductRequest $request, $id){

        $inputTags = explode(",", $request->get('tags'));

        $this->productModel->find($id)->update($request->all());
        $this->storeTag($inputTags,$id);
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

    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id,'extension'=>$extension]);

        // Public local Storage para adicionar
        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        // S3 Storage para adicionar
        //Storage::disk('s3')->put($image->id.'.'.$extension, File::get($file));
        return redirect()->route('products.images',['id' => $id]);

    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);

        // Public Local Storage para delete
        if(file_exists(public_path() . '/uploads/'.$image->id.'.'.$image->extension)){
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }


        /** S3 Local Storage para delete
        if(Storage::disk('s3')->exists($image->id.'.'.$image->extension)){
            Storage::disk('s3')->delete($image->id.'.'.$image->extension);
        }
         **/

        $product = $image->product;
        $image->delete();

        return redirect()->route('products.images',['id' => $product->id]);
    }



}
