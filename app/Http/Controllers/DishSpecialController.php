<?php

namespace App\Http\Controllers;

use App\Models\DishSpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DishSpecialController extends Controller
{
    private $dishModel;
    public function __construct(DishSpecial $dish)
    {
        $this->dishModel = $dish;
    }
    public function index()
    {
        $all_dish = $this->dishModel->all();
        return view('/aPanal/Special/viewSpecial', ['dishs' => $all_dish]);
    }
    public function create()
    {
        return view('/aPanal/Special/addSpecial');
    }
    public function store(Request $request)
    {
        // dd(gettype($request->dish_image));
        $data = $request->validate([
            'dish_name' => 'string|required|max:100',
            'dish_title' => 'string|required|max:400',
            'dish_desc_top' => 'string|required',
            'dish_desc_bottom' => 'string|required',
            'dish_image' => 'required|image',

        ]);
        if ($request->hasFile('dish_image')) {
            $path = '/images/special';
            $image_name = "_Special" . time() . "." . $request['dish_image']->extension();
            $request->dish_image->move(public_path($path), $image_name);
            $data['dish_image'] = $image_name;
        }
        $this->dishModel->create($data);
        session()->flash('Add_success', 'Add Dish Special Done');

        return redirect()->back();
    }
    public function edit($dishId)
    {
        $dish = $this->dishModel->find($dishId);
        return view('/aPanal/Special/editSpecial', ['dish' => $dish]);
    }
    public function update(Request $request, $dishId)
    {

        $updateDish = $this->dishModel->find($dishId);

        if ($updateDish) {
            $path = "images/special/";
            $old_image = public_path($path) . $updateDish->dish_image;

            $data = $request->validate([
                'dish_name' => 'string|required|max:100',
                'dish_title' => 'string|required|max:400',
                'dish_desc_top' => 'string|required',
                'dish_desc_bottom' => 'string|required',
                'dish_image' => 'nullable|image',
            ]);


            if ($request->hasFile('dish_image')) {
                $image_name = "_Special" . time() . "." . $request->dish_image->extension();
                $request->dish_image->move(public_path($path), $image_name);
                $data['dish_image'] = $image_name;

                $this->dishModel->find($dishId)->update($data);
                if (File::exists($old_image)) {
                    unlink($old_image);
                }
            } else {
                $this->dishModel->find($dishId)->update($data);
            }
            session()->flash('Update_success', 'Update Dish Special Done');
        }
        return redirect()->back();
    }
    public function delete($dishId)
    {
        $this->dishModel->find($dishId)->delete();
        return redirect()->back();
    }
}
