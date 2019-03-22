<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\DataTables\CategoriesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param CategoriesDataTable $categorysDataTable
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $categorysDataTable)
    {
        return $categorysDataTable->render('admin.categories.index', ['title' => 'Categories']);
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
            'name' => 'required|string',
        ]);

        Category::create($data);
        alert('success', 'a record has been added successfully', 'success');
        return back();
//        return response(['success' => 'admin has been added successfully']);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', $category);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $table = $category->getTable();
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        $records = DB::table($table)->get();
        $title = $category->name;
        return view('admin.categories.show', compact('category','title', 'columns','records'));
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
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);
        $category->update($request->all());
        alert('success', 'a record has been updated successfully', 'success');
        return redirect('admin/categories');
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
        $category = Category::findOrFail($id);
        $category->delete();

        if (\request()->ajax()) {
            return response(['success' => 'record has been deleted successfully']);
        }
        alert()->success('success', 'record has been deleted successfully');
        return back();
    }

    /**
     * Delete more records in one click
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function multi_destroy() {
        if (is_array(request('item'))) {
            Category::destroy(request('item'));
        } else {
            Category::find(request('item'))->delete();
        }
        session()->flash('success','The records have been deleted successfully');
        return redirect(aurl('categories'));
    }
}
