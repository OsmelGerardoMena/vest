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
        $benefits = Benefit::filterBenefits(
            $request->get('name'), 
            $request->get('product')
        );
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

        $message = $benefit->name.trans('messages.new');
      
        Session::flash('new', $message);
    
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

        $message = $this->benefit->name.trans('messages.edit');

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
        $this->benefit->delete();

        $message = $this->benefit->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.benefits.index');
    }
}
