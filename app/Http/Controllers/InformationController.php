<?php

namespace App\Http\Controllers;

use App\Models\information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    private $informationModel ;
    public function __construct(information $information){
        $this->informationModel = $information;
    }
    public function index(){
        $all_information = $this->informationModel->all();
        return view('aPanal/Information/viewInformation' , ['informations' => $all_information]);
    }
    public function create(){
        return view('aPanal/Information/addInformation');
    }
    public function store(Request $request){
        $data = $request->validate([
            'location' => 'string',
            'open_days' => 'string',
            'open_hours' => 'string',
            'email1' => 'string',
            'email2' => 'string',
            'phone1' => 'string',
            'phone2' => 'string',
        ]);
        // dd("said");
        $this->informationModel->create($data);
        session()->flash('Add_success', 'Add Information Done');

        return redirect()->back();
    }
    public function update(Request $request , $informationId){
        $data = $request->validate([
            'location' => 'string',
            'open_days' => 'string',
            'open_hours' => 'string',
            'email1' => 'string',
            'email2' => 'nullable|string',
            'phone1' => 'string',
            'phone2' => 'nullable|string',
        ]);
        $this->informationModel->find($informationId)->update($data);
        session()->flash('Update_success', 'Update Information Done');
        return redirect()->back();

    }
    public function delete($informationId){
        $this->informationModel->find($informationId)->delete();
        return redirect()->back();
    }
}
