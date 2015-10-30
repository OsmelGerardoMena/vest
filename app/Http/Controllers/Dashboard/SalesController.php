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
use Vest\Http\Requests\EditInvoiceRequest;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->user = \Auth::user();

        if ($this->user->can('company')) {
            // si es company se restringe todo excepto
            $this->middleware('is_admin', ['except' => ['index', 'show', 'addInvoice', 'saveInvoice'] ]);
        }
        else if ($this->user->can('seller')) {
            // si es seller se restringe solo
            $this->middleware('is_admin', ['only' => ['destroy', 'addInvoice', 'saveInvoice'] ]);
        }
        else {
            // si es admin se restringe solo
            $this->middleware('is_company', ['only' => ['addInvoice', 'saveInvoice'] ]);
        }

        //$this->beforeFilter('@findSale', ['only' => ['show', 'edit', 'update', 'destroy'] ]);
    }

    ///Para buscar la venta y tenerlo en $this->sale
    /*public function findSale(Route $route)
    {
        $this->sale = Sale::findOrFail($route->getParameter('sales'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($this->user->can('seller')) {
            $sales = Sale::filterSellerSales($this->user->id, $request->get('seller'), 
                    $request->get('product'), $request->get('customer'));
        }
        else if($this->user->can('company')) {
            $ids = Product::where('company_id', $this->user->id)->lists('id');

            $sales = Sale::filterCompanySales($ids, $request->get('seller'), 
                    $request->get('product'), $request->get('customer'));
        }
        else {
            $sales = Sale::filterSales($request->get('seller'), 
                    $request->get('product'), $request->get('customer'));
        }
        
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
        // valor de la primera opción del selector productos
        $firts_option = ['' => '-- '.trans('dashboard.selectors.products').' --'];
        return view('dashboard.sales.create')->with('firts_option', $firts_option);
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

        // busco el producto para almacenar el monto
        $product = Product::where('id', $request->get('product_id'))->first();
        $sale->amount = $product->price;
        // se rellenan los demas datos
        $sale->fill($request->all());

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
        $sale = Sale::findOrFail($id);
        return view('dashboard.sales.show')->with('sale',$sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);

        // se verifica primero si la venta ya tiene asiganada una factura
        if (!is_null($sale->invoice)) {

            // si no es nulo quiere decir que ya tiene factura
            // y no va a poder editar la venta
            Session::flash('error', trans('messages.no_edit_sale'));
            return redirect()->route('dashboard.sales.index');
        }
        else {
            // de lo contrario, si es nulo, si se va a poder editar
            // firts_option contiene valor de la primera opción del selector productos
            $firts_option = ['' => '-- '.trans('dashboard.selectors.products').' --'];
            return view('dashboard.sales.edit')->with('sale', $sale)->with('firts_option', $firts_option);
        }
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
        $sale = Sale::findOrFail($id);

        $product = Product::where('id', $request->get('product_id'))->first();
        $sale->amount = $product->price;

        $sale->fill($request->all());

        $sale->save();

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
        $sale = Sale::findOrFail($id);

        $sale->delete();

        Session::flash('delete', trans('messages.delete_sale'));

        return redirect()->route('dashboard.sales.index');
    }

    /*** Metodo para mostrar solamente los productos asignados al vendedor al crear ***/
    public function sellerProducts(Request $request)
    {
        // se verifica si hay una peticion ajax
        if($request->ajax()){
            // se busca el vendedor con el id recibido
            $seller = User::find(trim($request->get('id')));
            // se almacenan los productos del vendedor, excepto el general
            // tambien el vinculo entre el vendedor y el producto de estar activo
            $seller_products = $seller->addedproducts()
                    ->whereNotIn('product_id', [1])->where('status', true)->get();
            
            $products = []; // array productos vacio
            // se rellena el array siempre y cuando tenga el vendedor productos
            foreach ($seller_products as $product) {
                if($product->isActive()){
                    $products [$product->id] = $product->name;
                }
            }
            return $products;
        }
    }

    /*** Metodo extra para mostrar formulario de agregar factura ***/
    public function addInvoice($id)
    {
        $sale = Sale::findOrFail($id);
        return view('dashboard.sales.save_edit_invoice')->with('sale', $sale);
    }

    /*** Metodo extra para guardar numero de factura ***/
    public function saveInvoice(EditInvoiceRequest $request, $id)
    {
        $sale = Sale::findOrFail($id);
        
        $sale->invoice = trim($request->get('invoice'));

        $sale->save();

        Session::flash('edit', trans('messages.save_invoice'));

        return redirect()->back();
    }
}