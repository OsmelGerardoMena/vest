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
        $this->user = \Auth::user();

        if ($this->user->can('seller')) {
            // si se loguea un vendedor, se restringe todo
            $this->middleware('is_admin');
        }
        else if ($this->user->can('company')) {
            // si se loguea una empresa, se restringe solo
            $this->middleware('is_admin', ['only' => ['show', 'destroy'] ]);
        }

        //$this->beforeFilter('@findBenefit', ['only' => ['edit', 'update', 'destroy']]);
    }

    /*public function findBenefit(Route $route)
    {
        $this->benefit = Benefit::findOrFail($route->getParameter('benefits'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($this->user->can('admin')) {
            // no se envia el parametro idArray al filtro
            $benefits = Benefit::filterBenefits($request->get('product'));
        }
        else if($this->user->can('company')){
            // si es empresa, se busca los id de productos de dicha empresa
            $idArray = Product::where('company_id', $this->user->id)->lists('id');
            $benefits = Benefit::filterCompanyBenefits($idArray, $request->get('product'));
        }

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
        $benefit = Benefit::findOrFail($id);

        return view('dashboard.benefits.edit')
                ->with('benefit', $benefit);
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
        $benefit = Benefit::findOrFail($id);

        $benefit->fill($request->all());

        $benefit->save();

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
        $benefit = Benefit::findOrFail($id);

        $benefit->delete();

        Session::flash('delete', trans('messages.delete_benefit'));

        return redirect()->route('dashboard.benefits.index');
    }
}
