<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

//tablas a usar
use Vest\Tables\Product;
use Vest\Tables\User;

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
        $product = Product::create($request->all());

        // verifico si la empresa del producto recien creado esta asignada a 
        // algún vendedor buscando un producto que no sea el que se acaba de 
        // guardar y verificando si tiene vendedores
        $other_product = $product->company->products()->where('id', '!=', $product->id)
                ->where('status_id', 1)->first();

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

        $message = $product->name.trans('messages.new');
      
        Session::flash('new', $message);
    
        return redirect()->route('dashboard.products.index');
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

        // se verifica si va haber cambio de empresa
        if ($request->get('company_id') != $product->company_id) {
            // si la empresa que se va a guardar es distinta a la que está guardada
            // se busca la nueva empresa
            $new_company = User::findOrFail($request->get('company_id'));
            // se busca el primer producto de la empresa que esté activo
            $new_company_product = $new_company->products()->where('status_id', 1)->first();
            // se verifica si ese producto tiene vendedores
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
                $product->sellers()->detach(); // probar asi solo
                // si no tiene vendedores, se verifica si el producto que se 
                // quiere actualizar posee vendedores, es decir, si se encuentra 
                // en la tabla pivote
                /*if ($product->sellers()->exists()) {
                    // si es asi, se debe quitar de la tabla pivote ya que 
                    // $new_company_product no pertenece y por lo tanto $product tampoco 
                    // deberia ya que la empresa a la que pertenece no esta 
                    // asignada a ningun vendedor, se eliminan todos los vendedores de $product
                    $product->sellers()->detach();
                    // $product no estará vinculado a ningún vendedor
                }*/
            }
        }

        $product->fill($request->all());

        $product->save();

        $message = $product->name.trans('messages.edit');

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
