<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChefController extends Controller
{
    private $chefModel;
    public function __construct(Chef $chef)
    {
        $this->chefModel = $chef;
    }
    public function index()
    {
        $all_chef = $this->chefModel->all();
        return view('aPanal/Chef/viewChef', ["chefs" => $all_chef]);
    }
    public function create()
    {
        return view('aPanal/Chef/addChef');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => "string|required",
            'job_title' => "string|required",
            'image' => "image|required",
        ]);

        if ($request->hasFile('image')) {
            $path = "/Images/Chef";
            $image_name = "_Chef" . time() . "." . $request->image->extension();
            // dd($image_name);
            $request->image->move(public_path($path), $image_name);
            $data['image'] = $image_name;
            $this->chefModel->create($data);
            session()->flash('Add_success', 'Add Chef Done');

        }
        return redirect()->back();
    }

    public function edit($chefId)
    {
        $chef = $this->chefModel->find($chefId);
        return view("aPanal/Chef/editChef", ['chef' => $chef]);
    }

    public function update(Request $request, $chefId)
    {
        $chef = $this->chefModel->find($chefId);
        if ($chef) {
            $data = $request->validate([
                'name' => "string|required",
                'job_title' => "string|required",
                'image' => "image|nullable",
            ]);

            if ($request->hasFile('image')) {
                $path = "/Images/Chef";
                $old_image = public_path($path) . $chef->image;
                $image_name = "_Chef" . time() . "." . $request->image->extension();
                // dd($image_name);
                $request->image->move(public_path($path), $image_name);
                $data['image'] = $image_name;
                $this->chefModel->find($chefId)->update($data);
                if (File::exists($old_image)) {
                    unlink($old_image);
                }
            } else {
                $this->chefModel->find($chefId)->update($data);
            }
            session()->flash('Update_success', 'Update Chef Done');

        }
        return redirect()->back();
    }
    public function delete($chefId){
        $chef = $this->chefModel->find($chefId);
        $path = "Images/Chef";
        $old_image = public_path($path) . $chef->image;
        // dd($old_image);
        if (File::exists($old_image)) {
            unlink($old_image);
        }
        $this->chefModel->find($chefId)->delete();
        return redirect()->back();
    }
}
