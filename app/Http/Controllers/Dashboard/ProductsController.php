<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

//tablas a usar
use Vest\Tables\Product;
use Vest\User;

//Request para validar
use Vest\Http\Requests\CreateProductRequest;
use Vest\Http\Requests\EditProductRequest;

//para mensajes con sesiones
use Illuminate\Support\Facades\Session;

//para usar route como inyeccion de dependencia
use Illuminate\Routing\Route;

class ProductsController extends Controller
{
    ///Para buscar el producto y tenerlo en $this->product
    public function __construct()
    {
        $this->user = \Auth::user();

        if ($this->user->can('seller')) {
            // si se loguea un vendedor, se restringe todo excepto
            $this->middleware('is_admin', ['except' => ['index', 'show'] ]);
        }
        else if ($this->user->can('company')) {
            // si se loguea una empresa, se restringe todo
            $this->middleware('is_admin');
        }

        //$this->beforeFilter('@findProduct', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /*public function findProduct(Route $route)
    {
        $this->product = Product::findOrFail($route->getParameter('products'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($this->user->can('admin')) {
            $products = Product::filterProducts(
                $request->get('name'), 
                $request->get('company'),
                $request->get('category')
            );
        }
        else if ($this->user->can('seller')) {
            $products = Product::filterActiveProducts(
                $request->get('name'), 
                $request->get('company'),
                $request->get('category')
            );
        }
        
        $products->setPath('products');
        return view('dashboard.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        // se verifica si el company_id sea verdaderamente de una empresa
        $user = User::find($request->get('company_id'));
        if ($user->isCompany()) {
            $product = Product::create($request->all());

            // se guarda otro producto distinto al que se creó, si no hay guarda null
            $other_product = $product->company->products()
                    ->where('id', '!=', $product->id)
                    ->where('status_id', 1)->first();
            // se verifica si other_product es nulo o no
            if (!is_null($other_product)) {
                // si es mo es nulo verifico si la empresa del producto recien  
                // creado esta asignada a algún vendedor, verificando 
                // si other_product tiene vendedores
                if ($other_product->sellers()->exists()) {
                    // si existen vendedores, se guardan sus id 
                    $sellers_id = $other_product->sellers()->lists('user_id');
                    // como sellers_id no es un array , ya que lists() devuelve un 
                    // array dentro de un objeto, se deben pasar los id a otro array
                    foreach ($sellers_id as $id) {
                        $arrayId [] = $id; 
                    }
                    // se agrega a la tabla pivote (product_user) un registro con el id 
                    // de cada vendedor, y el id del producto recien creado
                    $product->sellers()->attach($arrayId);
                }
            }
            $message = $product->name.trans('messages.new');
            Session::flash('new', $message);
            return redirect()->route('dashboard.products.index');
        }
        Session::flash('error', trans('messages.error'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('dashboard.products.show')
                ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // se verifica si el company_id sea verdaderamente de una empresa
        $company = User::find($request->get('company_id'));
        if ($company->isCompany()) {
            // se verifica si va haber cambio de empresa
            if ($request->get('company_id') != $product->company_id) {
                // si la empresa que se va a guardar es distinta a la que está guardada
                // $company se convierte en la nueva empresa
                // se busca el primer producto de la empresa que esté activo
                $new_company_product = $company->products()->where('status_id', 1)->first();
                // se verifica que $new_company_product no sea nulo
                if (!is_null($new_company_product)) {
                    // si no es nulo se verifica si ese producto tiene vendedores
                    if ($new_company_product->sellers()->exists()) {
                        // si existen vendedores para $new_company_product, se guardan
                        $sellers = $new_company_product->sellers()->get();
                        // se colocan los id de dichos vendedores en arrayId
                        foreach ($sellers as $seller) {
                            $arrayId [] = $seller->id; 
                        }
                        // se sincronizan los vendedores que posee la nueva empresa
                        $product->sellers()->sync($arrayId);
                    }
                    else {
                        // si new_company_product no tiene vendedores, se 
                        // eliminan los vinculos de los vendedores al producto
                        // que se está editando, tenga o no tenga vinculados
                        $product->sellers()->detach();
                    }
                }
                else {
                    // si es nulo, quiere decir que la nueva empresa no tiene productos
                    // o tiene productos pero no estan activos. Por lo tanto al 
                    // producto que se está editando se le eliminan todos los 
                    // vendedores vinculados, tenga o no tenga
                    $product->sellers()->detach();
                }
            }
            $product->fill($request->all());
            $product->save();
            $message = $product->name.trans('messages.edit');
            Session::flash('edit', $message);
            return redirect()->back();
        }
        Session::flash('status', trans('messages.error'));
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
        $product = Product::findOrFail($id);

        $product->delete();

        $message = $product->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.products.index');
    }

    /*** Metodo Extra  para activar/desactivar status del producto ***/
    public function productStatus($id)
    {
        $product = Product::findOrFail($id);

        $product->status_id = ($product->isActive()) ? 2 : 1;

        $product->save();
        
        $message = $product->name.trans('messages.status');
        Session::flash('status', $message);
        return redirect()->back();
    }
}
