<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::get();
        return view('aPanal/Table/tablesView', compact('tables'));
    }
    public function create(){
        return view('aPanal/Table/tablesAdd');
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => "string|required"
        ]);
        Table::create($data);
        return back();
    }
    public function edit($id)
    {
        $table = Table::find($id);
        return view('aPanal/Table/tablesEdit', compact('table'));
    }
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => "string|required"
        ]);
        Table::find($id)->update($data);
        return back();
    }
    public function delete($id){
        Table::find($id)->delete();
        return back();
    }
}
