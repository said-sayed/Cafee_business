<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    private $categoryModel;
    public function __construct(MenuCategory $menuCategory){
        $this->categoryModel = $menuCategory;
    }

    // public function index(){
    //     $all_category = $this->categoryModel->all();
    //     return view('/aPanal/Menu/add_view_category' , ['categories' => $all_category]);
    // }
    public function create(){
        $all_category = $this->categoryModel->all();

        return view('/aPanal/Menu/add_view_category' , ['categories' => $all_category]);
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' =>"string|required"
        ]);
        $this->categoryModel->create($data);
        session()->flash('Add_success', 'Add Category Done');

        return redirect()->back();
    }
    public function update(Request $request , $categoryId){
        $data = $request->validate([
            'name' =>"string|required"
        ]);
        // dd($categoryId);

        $this->categoryModel->find($categoryId)->update($data);
        session()->flash('Update_success', 'Update Category Done');

        return redirect()->back();
    }
    public function delete($categoryId){
        $this->categoryModel->find($categoryId)->delete();
        return redirect()->back();
    }
}
