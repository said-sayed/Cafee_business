<?php

namespace App\Http\Controllers;

use App\Models\ImagesResturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImagesResturantController extends Controller
{
    //
    private $imagesModel;
    public function __construct(ImagesResturant $images)
    {
        $this->imagesModel = $images;
    }

    public function index()
    {
        $all_images  = $this->imagesModel->all();
        return view("aPanal/Images/viewImages", ["images" => $all_images]);
    }

    public function create()
    {
        return view('aPanal/Images/addImage');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'images' => "required|image"
        ]);
        if ($request->hasFile("images")) {
            $path = "Images/Images/";
            $image_name = "_Image" . time() . "." . $request->images->extension();
            $request->images->move(public_path($path), $image_name);
            $data['images'] = $image_name;
            $this->imagesModel->create($data);
            session()->flash('Add_success', 'Add Image Of Resturant Done');
        }
        return redirect()->back();
    }

    public function update(Request $request, $imageId)
    {
        $image = $this->imagesModel->find($imageId);
        // dd($imageId);
        if ($image) {
            $data = $request->validate([
                'images' => "required|image"
            ]);

            if ($request->hasFile("images")) {
                $path = "Images/Images/";
                $old_image = public_path($path) . $image->images;
                // dd($old_image);
                $image_name = "_Image" . time() . "." . $request->images->extension();
                $request->images->move(public_path($path), $image_name);
                $data['images'] = $image_name;

                $this->imagesModel->find($imageId)->update($data);
                if (File::exists($old_image)) {
                    unlink($old_image);
                }
            }
            session()->flash('Update_success', 'Update Image Of Resturant Done');
        }
        return redirect()->back();
    }

    public function delete($imageId)
    {
        $image = $this->imagesModel->find($imageId);
        $path = "Images/Images/";
        $old_image = public_path($path) . $image->images;
        unlink($old_image);
        $this->imagesModel->find($imageId)->delete();
        return redirect()->back();
    }
}
