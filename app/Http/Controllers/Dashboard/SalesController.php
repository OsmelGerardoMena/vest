<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Sale;
use Vest\Tables\Product;
use Vest\Tables\Customer;
use Vest\Tables\Notification;
use Vest\User;

use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Session;

use Vest\Http\Requests\CreateSaleRequest;
use Vest\Http\Requests\EditSaleRequest;
use Vest\Http\Requests\EditInvoiceRequest;

use Carbon\Carbon;

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
        // se verifican si existen vendedores y clientes para crear ventas
        $sellers = User::where('type_id', 2)->where('status_id', 1)->exists();
        $customers = Customer::where('status', true)->exists();
        if (!$sellers || !$customers) {
            // si no existen se manda mensaje
            Session::flash('error', trans('messages.error_sale'));
        }

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

        return redirect()->route('dashboard.sales.index');
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

            // si no hay ningún prodyucto asignado al vendedor igual se envia
            // un mensaje dentro de el array products para que aparezca en el select
            if ($seller_products->count() == 0) {
                $products [''] = trans('messages.has_no_products');
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

        $sale->invoice_created_at = Carbon::now()->toDateTimeString();

        $sale->save();

        $this->createNotification($sale);

        Session::flash('edit', trans('messages.save_invoice'));

        return redirect()->back();
    }

    private function createNotification($sale)
    {
        // $sale contiene la venta recien facturada
        // verifico si el producto de la venta tiene incentivo
        if ($sale->product->incentives()->exists()) {
            // se almacenan los incentivos del producto vendido
            $incentives = $sale->product->incentives;
            // alamaceno fecha y hora actual usando carbon
            $today = Carbon::now()->toDateTimeString();
            // se recorren todos los incentivos
            foreach ($incentives as $incentive) {
                // se compara la fecha actual con la fecha (desde-hasta) de cada incentivo
                if ($today >= $incentive->date_from && $today <= $incentive->date_to) {
                    // si la fecha-hora actual es mayor o igual que la fecha_desde
                    // y la fecha actual es menor o igual que la fecha_hasta
                    // almaceno las otras ventas facturadas que sean del mismo
                    // vendedor, del mismo producto, sin tomar en cuenta la venta
                    // que se acaba de facturar, que el campo factura no sea nulo
                    // y que la fecha-hora de creacion de la factura sea mayor o igual 
                    // a la fecha_desde y menor o igual a la fecha_hasta
                    $invoiced_sales = Sale::where('seller_id', $sale->seller_id)
                        ->where('product_id', $sale->product_id)
                        ->where('id', '!=', $sale->id)
                        ->whereNotNull('invoice')
                        ->where('invoice_created_at', '>=', $incentive->date_from)
                        ->where('invoice_created_at', '<=', $incentive->date_to)
                        ->get();
                    // total_sum es para guardar la suma total de las ventas 
                    // facturadas, en principio va a contener el total de 
                    // la venta recien facturada ($sale)
                    $total_sum = $sale->amount * $sale->quantity;
                    // recorro las otras ventas facturadas
                    foreach ($invoiced_sales as $invoiced_sale) {
                        // sumo los totales de las otras ventas facturadas
                        $total_sum += $invoiced_sale->amount * $invoiced_sale->quantity;
                    }
                    // se verifica si la suma total es igual o mayor que la meta del incentivo
                    if ($total_sum >= $incentive->goal) {
                        // se verifica que no exista una notificacion con el
                        // user_id e incentive_id que se quieren guardar
                        // para no repetir la notificación
                        $exists = Notification::where('user_id', $sale->seller_id)
                                ->where('incentive_id', $incentive->id)->exists();
                        // si no existe se crea la notificacion
                        if (!$exists) {
                            $notification = new Notification();
                            $notification->title = $sale->seller->name
                                .' '.trans('dashboard.notification.title');
                            $notification->content = 
                                    trans('dashboard.notification.content_1')
                                    .$incentive->product->name
                                    .trans('dashboard.notification.content_2')
                                    .$incentive->award;
                            $notification->user_id = $sale->seller_id;
                            $notification->incentive_id = $incentive->id;
                            $notification->save();
                        }
                    }
                }
            }
        }
    }
}