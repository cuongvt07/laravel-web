<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use Illuminate\Http\Request;
use App\Models\Silder;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    private $menu;
    private $slider;
    public function __construct(Silder $slider)
    {
        $this->slider =$slider;
    }
    //
    public function index(){
        $sliders= $this->slider->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.add');
    }

    public function store(SliderAddRequest $Request){
        $dataInsert=[
            'name' =>$Request->name,
            'description' =>$Request->description,
        ];
        $dataImageSlider = $this->StorageTraitUpload($Request, 'image_path', 'slider');
        if(!empty($dataImageSlider)){
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
            $dataInsert['image_path'] = $dataImageSlider['file_path'];

        }
        $this->slider->create($dataInsert);
        return redirect()->route('slider.index'); 
      }

      public function edit($id){
        $sliders= $this->slider->find($id);
        return view('admin.slider.edit',compact('sliders'));
      }
      public function update($id, Request $Request){
        $dataUpdate=[
            'name' =>$Request->name,
            'description' =>$Request->description,
        ];
        $dataImageSlider = $this->StorageTraitUpload($Request, 'image_path', 'slider');
        if(!empty($dataImageSlider)){
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
            $dataInsert['image_path'] = $dataImageSlider['file_path'];

        }
        $this->slider->find($id)->update($dataUpdate);
        return redirect()->route('slider.index'); 
      }
      public function delete($id){
        try{
            $this->slider->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'delete succses',
            ],200);

        }catch(\Exception $exception){
            Log::error('Message: ' . $exception->getMessage(). 'Line : ' . $exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'delete succses',
            ],500);
        } 
      }
}
