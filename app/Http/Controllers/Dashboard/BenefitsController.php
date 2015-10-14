<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Benefit;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateBenefitRequest;
use Vest\Http\Requests\EditBenefitRequest;

use Illuminate\Support\Facades\Session;

class BenefitsController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('@findBenefit', 
            ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findBenefit(Route $route)
    {
        $this->benefit = Benefit::findOrFail($route->getParameter('benefits'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $benefits = Benefit::filterBenefits($request->get('product'));

        $benefits->setPath('benefits');
        return view('dashboard.benefits.benefits', compact('benefits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.benefits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateBenefitRequest $request)
    {
        $benefit = Benefit::create($request->all());

        Session::flash('new', trans('messages.new_benefit'));

        return redirect()->route('dashboard.benefits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.benefits.edit')
                ->with('benefit', $this->benefit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditBenefitRequest $request, $id)
    {
        $this->benefit->fill($request->all());

        $this->benefit->save();

        Session::flash('edit', trans('messages.edit_benefit'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->benefit->delete();

        Session::flash('delete', trans('messages.delete_benefit'));

        return redirect()->route('dashboard.benefits.index');
    }
}
