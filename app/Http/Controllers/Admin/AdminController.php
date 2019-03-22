<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\DataTables\AdminsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminsDataTable $adminsDataTable)
    {
        return $adminsDataTable->render('admin.admins.index', ['title' => 'Admins']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);
        $data['password'] = bcrypt(request('password'));

        Admin::create($data);
        alert('success', 'an admin has been added successfully', 'success');
        return back();
//        return response(['success' => 'admin has been added successfully']);
    }

    public function edit(Admin $admin){
        return view('admin.admins.edit', $admin);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        //
        $admin = Admin::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,email,' . $admin->id,
            'password' => 'sometimes|required|string|max:191'
        ]);
        $admin->update($request->all());
        alert('success', 'an admin has been updated successfully', 'success');
        return redirect('admin/admins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return array
     */
    public function destroy($id)
    {
        //
        $admin = Admin::findOrFail($id);
        $admin->delete();
        alert()->success('success', 'an admin has been deleted successfully');
        return back();
    }
}
