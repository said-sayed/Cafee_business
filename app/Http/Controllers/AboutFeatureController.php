<?php

namespace App\Http\Controllers;

use App\Models\AboutFeature;
use Illuminate\Http\Request;

class AboutFeatureController extends Controller
{
    private $aboutFeatureModel;

    public function __construct(AboutFeature $aboutFeature)
    {
        $this->aboutFeatureModel = $aboutFeature;
    }
    public function index()
    {

        $all_feature = $this->aboutFeatureModel->all();
        return view('/aPanal/About/featuresView', ["features" => $all_feature]);
    }
   
    public function store(Request $request)
    {
        $data = $request->validate([
            "feature" => 'string|required|max:200'
        ]);

        $this->aboutFeatureModel->create($data);
        session()->flash('add_success' , 'Add Feature Done');
        return redirect()->back();
    }
    public function edit($featureId)
    {
       
        $feature = $this->aboutFeatureModel->find($featureId);
        // dd($feature);
        return view('/aPanal/About/featureEdit', ['feature' => $feature]);
    }
    public function update(Request $request ,  $featureId){
        // str_split($request->feature);
        // $x = str_split($request->feature);
        // // dd($x);
        // $endTime =  ':00';
        $data = $request->validate([
            'feature'=>'string|required|max:200'
        ]);

        $this->aboutFeatureModel->find($featureId)->update($data);
        session()->flash('update_success' , 'Update Feature Done');

        return redirect()->back();
    }
    public function delete($featureId){
        $this->aboutFeatureModel->find($featureId)->delete();
        return redirect()->back();
    }
}
