<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class AdminProductController extends Controller
{
    use StorageImageTrait;
    //
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;


    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag,ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage=$productImage;       
         $this->product = $product;
        $this->tag = $tag;
        $this->productTag = $productTag;

    }
    public function index()
    {
        $products =$this->product->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $rules= [
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ];
        $message=[
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm đã trùng',
            'price.required' => 'Giá tiền không được để trống',
            'name.max' => 'Tên sản phẩm không được được quá 255 kí tự',        'name.max' => 'Tên sản phẩm không được được quá 255 kí tự',
            'name.min' => 'Tên sản phẩm không được được nhỏ hơn 10   kí tự',
            'category_id.required' => 'Danh mục không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
        $tag=$this->getCategory($parentId='');
        return view('admin.product.add', compact('tag'));
    }
    public function getCategory($parentId)
    {

        $data = $this->category::all();
        $recusive = new Recusive($data);
        $tag = $recusive->categoryRe($parentId);
        return $tag;
    }
    public function store(ProductAddRequest $request){

        try{
            DB::beginTransaction();
            $dataProductCreate =[
                'name'=>$request->name,
                'price'=> $request->price,
                'content' =>$request->contents,
                'user_id'=>auth()->id(),
                'category_id'=>$request->category_id
            ];
    
            $dataUploadFeatureImage =$this->StorageTraitUpload($request,fieldName:'feature_image_path',foderName:'product');
            if(!empty($dataUploadFeatureImage))
            {
                $dataProductCreate['feature_image_name']=$dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path']=$dataUploadFeatureImage['file_path'];
            }
            $product=$this->product->create($dataProductCreate);
            // 
            if($request->hasFile('image_path')){
    
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail=$this->StorageTraitUploadMutiple($fileItem,'product');
                    $this->productImage->create([
                        'product_id'=>$product->id,
                        'image_path' =>$dataProductImageDetail['file_path'],
                        'image_name' =>$dataProductImageDetail['file_name']
                    ]);
    
                }
            }
            // insert product tags
            if(!empty($request->tags)){

                foreach($request->tags as $tagItem)
                {
                    $tagInstange=$this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[]=$tagInstange->id;
                }
            }

            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('product.index');

        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage(). 'Line : ' . $exception->getLine());

        }   
    }

    public function delete($id){
        try{
            $this->product->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'fail',
            ],200);

        }catch(\Exception $exception){
            Log::error('Message: ' . $exception->getMessage(). 'Line : ' . $exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail',
            ],500);
        }   
    }
}
