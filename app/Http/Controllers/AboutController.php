<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\About;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    private $aboutModel;
    function __construct(About $about)
    {
        $this->aboutModel = $about;
    }
    public function index()
    {
        $data = $this->aboutModel->first();
        // dd($data);
        return view('/aPanal/About/aboutView', ['data' => $data]);
    }

    public function update(Request $request)
    {
       
        $updateAbout = $this->aboutModel->first();
        // dd($updateAbout->image);

        if ($updateAbout) {

            $path = 'images/about/';
            $oldeImage = public_path($path) . $updateAbout->image;

            $data = $request->validate([
                'title' => 'string|required|max:100',
                'image' => 'nullable|image',
                'information' => 'string|required',
                'descreption' => 'string|required'
            ]);

            if ($request->hasFile('image')) {
                $fileName = '_About' . time() . '.' . $request['image']->extension();
                $request->image->move(public_path($path), $fileName);
                $data['image'] = $fileName;

                $updateAbout->update($data);
                // dd($oldeImage);
                if (File::exists($oldeImage)) {
                    unlink($oldeImage);
                }
            } else {
                $updateAbout->update($data);
            }

            session()->flash('update_success', 'Update About Done');
            return redirect()->back();
        }
    }
}
