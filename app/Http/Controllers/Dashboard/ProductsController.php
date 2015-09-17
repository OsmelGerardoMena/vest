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
        $this->beforeFilter('@findProduct', [
            'only' => ['show', 'edit', 'update', 'destroy']
        ]);
    }

    public function findProduct(Route $route)
    {
        $this->product = Product::findOrFail($route->getParameter('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = Product::filterProducts(
            $request->get('name'), 
            $request->get('company')
        );

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
        return view('dashboard.products.show')
                ->with('product', $this->product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.products.edit')->with('product', $this->product);
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
        $this->product->fill($request->all());

        $this->product->save();

        $message = $this->product->name.trans('messages.edit');

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
        $this->product->delete();

        $message = $this->product->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.products.index');
    }

    /*** Metodo Extra  para activar/desactivar status del usuario ***/
    public function productStatus($id)
    {
        $product = Product::findOrFail($id);

        if($product->getStatusId() == 1)
            $product->status_id = 2;
        else if($product->getStatusId() == 2)
            $product->status_id = 1;
        
        $product->save();
        
        $message = $product->name.trans('messages.status');
        Session::flash('status', $message);
        return redirect()->back();
    }
}
