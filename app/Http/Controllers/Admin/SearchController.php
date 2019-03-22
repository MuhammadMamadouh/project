<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class SearchController extends Controller
{

    /**
     * Show results of query search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_results()
    {
        $title = 'Search Results';
        $query = \request('query');

        //=========================================
        // News Search
        //=========================================

        $news = News::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")->get();

        //=========================================
        // Category Search
        //=========================================
        $categories = Category::where('name', 'like', "%$query%")->get();

        return view('admin.search', compact('categories', 'news', 'title'));
    }

    /**
     * Get Category results
     *
     * @param Builder $builder
     * @param $search
     * @return Builder
     */
    public function getCategories(Builder $builder, $search)
    {

        $categories = Category::where('name', 'like', "%$search%")->get();
        if (request()->ajax()) {
            return datatables($categories)
                ->addColumn('Edit', 'admin.categories.btn.edit')
                ->addColumn('Delete', 'admin.categories.btn.delete')
                ->addColumn('checkbox', 'admin.categories.btn.checkbox')
                ->addColumn('show', 'admin.categories.btn.show')
                ->rawColumns(['Edit', 'Delete', 'show', 'checkbox'])->toJson();
        }

        $categories_dataTable = $builder->columns($this->getCategoryColumns())->minifiedAjax();

        return $categories_dataTable;
    }

    /**
     * Get News results
     *
     * @param Builder $builder
     * @param $search
     * @return Builder
     */
    public function getNews(Builder $builder, $search)
    {

        $news = News::where('title', 'like', "%$search%")
            ->orWhere('content', 'like', "%$search%")->get();

        if (request()->ajax()) {
            return datatables($news)
                ->addColumn('Edit', 'admin.news.btn.edit')
                ->addColumn('Delete', 'admin.news.btn.delete')
                ->addColumn('checkbox', 'admin.news.btn.checkbox')
                ->addColumn('show', 'admin.news.btn.show')
                ->rawColumns(['Edit', 'Delete', 'show', 'checkbox']);
        }
        $news_dataTable = $builder->columns($this->getNewsColumns())->minifiedAjax();

        return $news_dataTable;
    }

    /**
     * Get columns of NEWS table.
     *
     * @return array
     */
    protected function getNewsColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="checkAll()">',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ], [
                'name' => 'id',
                'data' => 'id',
                'title' => '#',
            ],
            [
                'name' => 'title',
                'data' => 'title',
                'title' => 'Title',
            ],
            [
                'name' => 'Edit',
                'data' => 'Edit',
                'title' => 'Edit',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'name' => 'Delete',
                'title' => 'Delete',
                'data' => 'Delete',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'name' => 'show',
                'title' => 'Show',
                'data' => 'show',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Get columns of categories table
     *
     * @return array
     */
    protected function getCategoryColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="checkAll()">',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ], [
                'name' => 'id',
                'data' => 'id',
                'title' => '#',
            ],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name',
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'created_at',
            ],
            [
                'name' => 'Edit',
                'data' => 'Edit',
                'title' => 'Edit',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'name' => 'Delete',
                'title' => 'Delete',
                'data' => 'Delete',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'name' => 'show',
                'title' => 'Show',
                'data' => 'show',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

}
