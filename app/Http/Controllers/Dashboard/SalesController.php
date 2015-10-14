<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Sale;
use Vest\Tables\Product;
use Vest\User;

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

    ///Para buscar la venta y tenerlo en $this->sale
    public function findSale(Route $route)
    {
        $this->sale = Sale::findOrFail($route->getParameter('sales'));
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
        return view('dashboard.sales.show')->with('sale',$this->sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.sales.edit')->with('sale', $this->sale);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditSaleRequest $request, $id)
    {
        // se verifica si ya existe una venta con los 3 ids recibidos
        if($this->sale->idsExists($request)){
            Session::flash('error', trans('messages.not_unique'));
            return redirect()->back()->withInput();
        }

        $this->sale->fill($request->all());

        $product = Product::where('id', $request->get('product_id'))->first();
        $this->sale->amount = $product->price;

        $this->sale->save();

        Session::flash('edit', trans('messages.edit_sale'));

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
        $this->sale->delete();

        Session::flash('delete', trans('messages.delete_sale'));

        return redirect()->route('dashboard.sales.index');
    }

    public function sellerProducts(Request $request)
    {
        return 'hey!';
        //return dd($request->get('seller_id'));
        //return response()->json(['mensaje' => 'Hola Como Tasss']);

        if($request->ajax()){
            $seller = User::find($request->get('seller_id'));
            $seller_products = $seller->addedproducts;
            $products = [];

            foreach ($seller_products as $product) {
                if($product->isActive()){
                    $products [$product->id] = $product->name;
                }
            }

            return 1;
        }
    }
}
