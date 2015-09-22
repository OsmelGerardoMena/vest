<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Contract;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateContractRequest;
use Vest\Http\Requests\EditContractRequest;

use Illuminate\Support\Facades\Session;

class ContractsController extends Controller
{
    public function __construct(){
        $this->beforeFilter('@findContract', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findContract(Route $route){
        $this->contract = Contract::findOrFail($route->getParameter('contracts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contracts = Contract::filterContracts(
            $request->get('name'), 
            $request->get('product')
        );

        $contracts->setPath('contracts');
        return view('dashboard.contracts.contracts', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateContractRequest $request)
    {
        return dd($request->file('file'));
        $contract = Contract::create($request->all());

        $message = $contract->name.trans('messages.new');
      
        Session::flash('new', $message);
    
        return redirect()->route('dashboard.contracts.index');
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
        return view('dashboard.contracts.edit')
                ->with('contract', $this->contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditContractRequest $request, $id)
    {
        $this->contract->fill($request->all());

        $this->contract->save();

        $message = $this->contract->name.trans('messages.edit');

        Session::flash('edit', $message);

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
        $this->contract->delete();

        $message = $this->contract->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.contracts.index');
    }
}
