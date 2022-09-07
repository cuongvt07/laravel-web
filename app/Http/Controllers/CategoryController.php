<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components;
use App\Components\Recusive;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    //
    private $tag;
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create()
    {
        $data = $this->category::all();
        $recusive = new Recusive($data);
        $tag =$recusive ->categoryRecustive();
        return view('admin.category.add', compact('tag'));
    }

    

    public function index()
    {
        $categories= $this->category->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $REQUEST){
        $this->category->create([
            'name'=> $REQUEST->name,
            'parent_id'=> $REQUEST->parent_id,
            'slug'=> str::slug($REQUEST->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function getCategory($parentId){

        $data =$this->category::all();
        $recusive =new Recusive($data);
        $tag= $recusive->categoryRe($parentId);
        return $tag;

    }

    public function edittool($id){
        $category= $this->category->find($id);
        $tag =$this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','tag'));

    }
    public function delete($id){

            $this->category->find($id)->delete();

        return redirect()->route('categories.index');


    }
    
    public function update($id, Request $REQUEST){
        $this->category->find($id)->update([
            'name'=> $REQUEST->name,
            'parent_id'=> $REQUEST->parent_id,
            'slug'=> str::slug($REQUEST->name)
        ]);
        return redirect()->route('categories.index');

    }

} 
