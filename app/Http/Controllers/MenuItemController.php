<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    private $itemModel;
    private $categoryModel;
    public function __construct(MenuItem $menuItem  , MenuCategory $category){
        $this->itemModel = $menuItem;
        $this->categoryModel = $category;
    }
    public function index(){
        $all_items = $this->itemModel->all();
        return view('/aPanal/Menu/viewMenu'  , [
            'items' => $all_items 
        ]);
    }
    public function create(){
        $all_categoy = $this->categoryModel->all();
        return view('/aPanal/Menu/addMenu' , ['categories' => $all_categoy]);
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'string|required',
            'price'=>'string|required',
            'description' => 'string|required',
            'category_id' => 'integer|required'
        ]);
        $this->itemModel->create($data);
        session()->flash('Add_success', 'Add Menu Done');

        return redirect()->back();
    }
    public function edit($itemId , $categoryId){
        $item = $this->itemModel->find($itemId);
        $all_categoy = $this->categoryModel->all();
        $category = $this->categoryModel->find($categoryId);

        return view('/aPanal/Menu/editMenu'  , [
            'item' => $item,
            'categories' => $all_categoy,
            'category' => $category
        ]);
    }
    public function update(Request $request , $itemId){
        $data = $request->validate([
            'name' => 'string|required',
            'price'=>'string|required',
            'description' => 'string|required',
            'category_id' => 'integer|required'
        ]);
        // dd($data);

        $this->itemModel->find($itemId)->update($data);
        session()->flash('Update_success', 'Update Menu Done');

        return redirect()->back();
    }
    public function delete($itemId){
        $this->itemModel->find($itemId)->delete();
        return redirect()->back();
    }
}
