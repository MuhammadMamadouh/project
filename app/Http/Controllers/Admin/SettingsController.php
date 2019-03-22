<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NewsDataTable;
use App\Models\Category;
use App\Models\News;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    public function view()
    {
        $title = 'settings';
        return view('admin.settings', compact('columns', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveSetting(Request $request)
    {
        $data = $this->validate($request, [
            'logo' => validate_image(),
            'icon' => validate_image(),
            'status' => '',
            'description' => '',
            'keywords' => '',
            'message_maintenance' => '',
            'email' => '',
            'sitename' => '',
        ]);

        if (request()->hasFile('logo')) {
            $data['logo'] = upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'deleted_file' => setting()->logo,
                'new_name'=> str_random() . '.' . \request()->file('logo')->getClientOriginalExtension(),
            ]);
        }

        if (request()->hasFile('icon')) {
            $data['icon'] = upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'deleted_file' => setting()->icon,
                'new_name'=> str_random() . '.' . \request()->file('icon')->getClientOriginalExtension(),
            ]);
        }
        Settings::orderBy('id', 'desc')->update($data);
        alert('success', 'a record has been added successfully', 'success');
        return redirect('admin/settings');
    }
}
