<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Vest\Http\Requests\EditAccountRequest;

use Illuminate\Support\Facades\Session;

use Gate;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = [];

        // tambien se puede usar $this->user->can('seller')
        if(Gate::allows('seller')){ //si es vendedor
            $products = $this->user->addedproducts;
        }
        else if(Gate::allows('company')){ // si es empresa
            $products = $this->user->products;
        }
        
        return view('dashboard.account.account', compact('products'))
                        ->with('user', $this->user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //si intentan ingresar otro id en la barra de direccion
        if($id != $this->user->id){ //se verifican los id
            return redirect()->route('dashboard.account.edit', $this->user->id);
        }
        
        return view('dashboard.account.edit')->with('user', $this->user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditAccountRequest $request, $id)
    {
        $this->user->fill($request->all());

        $this->user->save();

        Session::flash('edit', trans('messages.edit_account'));

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
        //
    }
}