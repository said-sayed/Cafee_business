<?php

namespace App\Http\Controllers;

use App\Models\OurFeature;
use Illuminate\Http\Request;

class OurFeatureController extends Controller
{
    private $featureModel;
    public function __construct(OurFeature $feature){
        $this->featureModel = $feature;
    }
    public function index(){
        $all_feature = $this->featureModel->all();
        // dd($all_feature);
        return view('/aPanal/Our_Feature/featuresView' , ['features' => $all_feature]);
    }
    public function create(){
        return view('/aPanal/Our_Feature/featureAdd');
    }
    public function store(Request $request){
        $data = $request->validate([
            'title' =>"string|required|max:300",
            'description'=> "string|required"
        ]);
        $this->featureModel->create($data);
        session()->flash('Add_success', 'Add Feature Done');

        return redirect()->back();
    }
    public function show($featureId){
        $feature = $this->featureModel->find($featureId);
        return view('/aPanal/Our_Feature/featureShow' , [
            "feature" => $feature
        ]);
    }
    public function edit($featureId){
        $feature = $this->featureModel->find($featureId);
        // dd($feature);
        return view('/aPanal/Our_Feature/featureEdit' , [
            'feature' => $feature
        ]);
    }
    public function update(Request $request, $featureId){
        $data = $request->validate([
            "title" => "string|required",
            "description" => "string|required"
        ]);
        $this->featureModel->find($featureId)->update($data);
        session()->flash('Update_success', 'Update Feature Done');

        return redirect()->back();
    }
    public function delete($featureId){
        $this->featureModel->find($featureId)->delete();
        return redirect()->back();
    }
}
