<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Incentive;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateIncentiveRequest;
use Vest\Http\Requests\EditIncentiveRequest;

use Illuminate\Support\Facades\Session;

class IncentivesController extends Controller
{
    public function __construct(){
        $this->beforeFilter('@findIncentive', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findIncentive(Route $route){
        $this->incentive = Incentive::findOrFail($route->getParameter('incentives'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $incentives = Incentive::filterIncentives(
            $request->get('award'), 
            $request->get('product')
        );
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
        return view('dashboard.incentives.edit')
                ->with('incentive', $this->incentive);
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
        $this->incentive->fill($request->all());

        $this->incentive->save();

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
        $this->incentive->delete();

        Session::flash('delete', trans('messages.delete_incentive'));

        return redirect()->route('dashboard.incentives.index');
    }
}
