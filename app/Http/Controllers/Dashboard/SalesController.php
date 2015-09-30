<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Sale;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Session;

use Vest\Http\Requests\CreateSaleRequest;
use Vest\Http\Requests\EditSaleRequest;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('@findSale', 
            ['only' => ['show', 'edit', 'update', 'destroy'] ]);
    }

    ///Para buscar el cliewnte y tenerlo en $this->customer
    public function findSale(Route $route)
    {
        $this->customer = Sale::findOrFail($route->getParameter('sales'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sales = Sale::filterSales($request->get('seller'), 
                    $request->get('product'), $request->get('customer'));
        
        $sales->setPath('sales');
        return view('dashboard.sales.sales', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateSaleRequest $request)
    {
        $sale = new Sale();

        // se verifica si ya existe una venta con los 3 ids recibidos
        if($sale->idsExists($request)){
            Session::flash('error', trans('messages.not_unique'));
            return redirect()->back()->withInput();
        }

        $sale->fill($request->all());

        $product = Product::where('id', $request->get('product_id'))->first();
        $sale->amount = $product->price;

        $sale->save();

        Session::flash('new', trans('messages.new_sale'));

        return redirect()->route('dashboard.sales.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
