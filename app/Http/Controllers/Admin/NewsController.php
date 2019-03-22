<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NewsDataTable;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param NewsDataTable $newsDataTable
     * @return \Illuminate\Http\Response
     */
    public function index(NewsDataTable $newsDataTable)
    {
        return $newsDataTable->render('admin.news.index', ['title' => 'News']);
    }

    public function create()
    {
        $categories = Category::all();
        $title = 'Create News';
        return view('admin.news.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|max:191',
            'content' => 'required|string',
            'image' => validate_image(),
            'sub_images.*' => validate_image(),
            'category_id' => 'numeric|exists:categories,id'
        ]);

        if (\request()->hasFile('image')) {
            $data['image'] = upload([
                'file' => 'image',
                'path' => 'news',
                'upload_type' => 'single',
                'deleted_file' => '',
                'new_name' => str_random() . '.' . \request()->file('image')->extension(),
            ]);
        }

        if (\request()->hasFile('sub_images')) {
            $names = [];
            $images = \request()->file('sub_images');
            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = $image->storeAs('news/', str_random() . '.' . $ext);
                array_push($names, $filename);
            }
            $data['sub_images'] = json_encode($names);
        }

        $news = News::create($data);
        alert('success', 'a record has been added successfully', 'success');
        return redirect('admin/news/' . $news->id);
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        $table = $news->getTable();
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        $records = DB::table($table)->get();
        $title = $news->name;
        return view('admin.news.show', compact('news', 'title', 'columns', 'records'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, News $news)
    {
        //
        $data = $this->validate($request, [
            'title' => 'required|string|max:191',
            'content' => 'required|string',
            'image' => validate_image(),
            'sub_images.*' => validate_image(),
            'category_id' => 'numeric|exists:categories,id'
        ]);

        if (\request()->hasFile('image')) {
            $data['image'] = upload([
                'file' => 'image',
                'path' => 'news',
                'upload_type' => 'single',
                'deleted_file' => $news->image,
                'new_name' => str_random() . '.' . \request()->file('image')->extension(),
            ]);
        }

        if (\request()->hasFile('sub_images')) {
            $names = [];
            $images = \request()->file('sub_images');
            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = $image->storeAs('news/', str_random() . '.' . $ext);
                array_push($names, $filename);
            }
            $data['sub_images'] = json_encode($names);
        }

        $news->update($data);
        alert('success', 'an record has been updated successfully', 'success');
        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return array
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        Storage::delete($news->image);
        foreach (json_decode($news->sub_images) as $image) {
            Storage::delete($image);
        }
        $news->delete();
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
    public function multi_destroy()
    {

        if (is_array(request('item'))) {
            News::destroy(request('item'));
        } else {
            News::find(request('item'))->delete();
        }
        session()->flash('success', 'The records have been deleted successfully');
        return redirect(aurl('news'));
    }

}
