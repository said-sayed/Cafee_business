<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $superAdmin = Admin::find(1);
        if (auth()->guard('admin')->user()->email == $superAdmin->email) {
            $admins = Admin::all();
            return view('aPanal/Admin/viewAdmin', ['admins' => $admins]);
        } else {
            return redirect("/dashboard");
        }
    }
    public function create()
    {
        $superAdmin = Admin::find(1);
        if (auth()->guard('admin')->user()->email == $superAdmin->email) {
            return view('aPanal/Admin/addAdmin');
        } else {
            return redirect("/dashboard");
        }
    }
    public function edit($id)
    {
        $admin = Admin::find($id);
        $superAdmin = Admin::find(1);
        if (auth()->guard('admin')->user()->email == $superAdmin->email) {
            return view('aPanal/Admin/editAdmin', ['admin' => $admin]);
        } else {
            return redirect("/dashboard");
        }
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|required|confirmed'
        ]);
        $data['password'] = bcrypt($data['password']);
        Admin::create($data);
        session()->flash('Add_success', 'Add About Done');
        return back();
    }

    public function update(Request $request, $adminId)
    {

        $data = $request->validate([
            'name' => 'string',
            'email' => 'email',
        ]);

        $admin = Admin::find($adminId);
        // dd($admin->password);
        if ($request->password == null) {
            $data['password'] = $admin->password;
        } else {
            $data['password'] = bcrypt($request->password);
        }
        $admin->update($data);
        session()->flash('Update_success', 'Update About Done');
        return back();
    }
    public function delete($adminId)
    {
        $superAdmin = Admin::find(1);
        if (auth()->guard('admin')->user()->email == $superAdmin->email) {
            Admin::find($adminId)->delete();
            return back();
        } else {
            return redirect("/dashboard");
        }
    }

    function is_login(Request $request)
    {
        $is_admin = auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($is_admin)
            return redirect(url('/dashboard'));
        else
            return redirect(url('/login'));
    }
    public function logout()
    {
        if (auth()->guard('admin')->user()) {
            auth()->guard('admin')->logout();
        }
        return redirect(url('/login'));
    }
}
