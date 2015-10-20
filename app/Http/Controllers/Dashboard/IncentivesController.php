<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Incentive;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateIncentiveRequest;
use Vest\Http\Requests\EditIncentiveRequest;

use Illuminate\Support\Facades\Session;

class IncentivesController extends Controller
{
    public function __construct(){
        $this->user = \Auth::user();

        if ($this->user->can('seller')) {
            // si se loguea un vendedor, se restringe todo
            $this->middleware('is_admin');
        }
        else if ($this->user->can('company')) {
            // si se loguea una empresa, se restringe solo
            $this->middleware('is_admin', ['only' => ['show', 'destroy'] ]);
        }

        //$this->beforeFilter('@findIncentive', ['only' => ['edit', 'update', 'destroy']]);
    }

    /*public function findIncentive(Route $route){
        $this->incentive = Incentive::findOrFail($route->getParameter('incentives'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($this->user->can('admin')) {
            $incentives = Incentive::filterIncentives(
                $request->get('award'), 
                $request->get('product')
            );
        }
        else if($this->user->can('company')) {
            // si es empresa, se busca los id de productos de dicha empresa
            $idArray = Product::where('company_id', $this->user->id)->lists('id');
            $incentives = Incentive::filterCompanyIncentives(
                $idArray, 
                $request->get('award'), 
                $request->get('product')
            );
        }

        $incentives->setPath('incentives');
        return view('dashboard.incentives.incentives', compact('incentives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.incentives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateIncentiveRequest $request)
    {
        $incentive = Incentive::create($request->all());
      
        Session::flash('new', trans('messages.new_incentive'));
    
        return redirect()->route('dashboard.incentives.index');
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
        $incentive = Incentive::findOrFail($id);

        return view('dashboard.incentives.edit')
                ->with('incentive', $incentive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditIncentiveRequest $request, $id)
    {
        $incentive = Incentive::findOrFail($id);

        $incentive->fill($request->all());

        $incentive->save();

        Session::flash('edit', trans('messages.edit_incentive'));

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
        $incentive = Incentive::findOrFail($id);

        $incentive->delete();

        Session::flash('delete', trans('messages.delete_incentive'));

        return redirect()->route('dashboard.incentives.index');
    }
}
