<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\CompanyCategories;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateCategoryRequest;
use Vest\Http\Requests\EditCategoryRequest;

use Illuminate\Support\Facades\Session;

class CompanyCategoriesController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('@findCategory', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findCategory(Route $route)
    {
        $this->category = CompanyCategories::
                findOrFail($route->getParameter('company_categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = CompanyCategories::filterCompanyCategories($request->get('name'));
        $categories->setPath('company-categories');
        return view('dashboard.companycategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.companycategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = CompanyCategories::create($request->all());

        $message = $category->name.trans('messages.new');

        Session::flash('new', $message);

        return redirect()->route('dashboard.company-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.companycategories.edit')
                ->with('category', $this->category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, $id)
    {
        $this->category->fill($request->all());

        $this->category->save();

        $message = $this->category->name.trans('messages.edit');

        Session::flash('edit', $message);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->category->name.trans('messages.delete');

        $this->category->delete();

        Session::flash('delete', $message);

        return redirect()->route('dashboard.company-categories.index');
    }
}
