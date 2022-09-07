<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    //
    private $menuRecusive;
    private $menu;


    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this-> menuRecusive = $menuRecusive;
        $this-> menu = $menu;
    }
    public function index(){
        $menus= $this->menu->paginate(10);     
           return view('admin.menus.index', compact('menus'));
    }
    public function create(){
        $test = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menus.add' , compact('test'));
    }

    public function storeAdd(REQUEST $request){
        $this->menu->create([
            'name' => $request->name,
            'parent_id' =>$request->parent_id,
            'slug'=> str::slug($request->name)
        ]);
        return redirect()->route('menus.index');

    }

    public function edit($id, REQUEST $request){
        $menuFoll= $this->menu->find($id);
        $test = $this->menuRecusive->menuRecusiveEdit($menuFoll->parent_id);
        return view('admin.menus.edit', compact('test','menuFoll'));

    }

    public function update($id, REQUEST $request){

        $this-> menu->find($id)->update([
            'name'=> $request->name,
            'parent_id'=> $request->parent_id,
            'slug'=> str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id){

        $this->menu->find($id)->delete();

    return redirect()->route('menus.index');


}
}
