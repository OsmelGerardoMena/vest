<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Customer;

use Vest\Http\Requests\CreateCustomerRequest;
use Vest\Http\Requests\EditCustomerRequest;

use Illuminate\Support\Facades\Session;

use Illuminate\Routing\Route;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('@findCustomer', 
            ['only' => ['show', 'edit', 'update', 'destroy'] ]);
    }

    ///Para buscar el cliewnte y tenerlo en $this->customer
    public function findCustomer(Route $route)
    {
        $this->customer = Customer::findOrFail($route->getParameter('customers'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $customers = Customer::filterCustomers($request->get('name'));
        $customers->setPath('customers');
        return view('dashboard.customers.customers', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        $message = $customer->name.trans('messages.new');
      
        Session::flash('new', $message);
    
        return redirect()->route('dashboard.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('dashboard.customers.show')->with('customer', $this->customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.customers.edit')
                ->with('customer', $this->customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditCustomerRequest $request, $id)
    {
        $this->customer->fill($request->all());

        $this->customer->save();

        $message = $this->customer->name.trans('messages.edit');

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
        $this->customer->delete();

        $message = $this->customer->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.customers.index');
    }

    /*** Metodo Extra  para activar/desactivar status del cliente ***/
    public function customerStatus($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->status = ($customer->getStatus()) ? false : true;
        
        $customer->save();
        
        $message = $customer->name.trans('messages.status');
        Session::flash('status', $message);
        return redirect()->back();
    }
}
