<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

use Vest\User;
use Vest\Tables\Product;

use Illuminate\Support\Facades\Session;

//Form Request para validar
use Vest\Http\Requests\CreateMyProductRequest;
use Vest\Http\Requests\EditMyProductRequest;

use Illuminate\Routing\Route;

class MyProductsController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();

        // middleware especifico para este controlador
        if($this->user->can('company')){
            // si no es vendedor, se restringe solo getUnallocated y destroy
            $this->middleware('is_seller', ['only' => ['unallocated', 'destroy'] ]);
        }
        else if($this->user->can('seller')){
            // si no es empresa, se restringe todo excepto
            $this->middleware('is_company', ['except' => ['index', 'show', 'unallocated']]);
        }
        else{
            // si es admin, se le restringe todo ya que no es ni vendedor ni empresa
            $this->middleware('is_company');
        }
        // no se uso beforeFilter ya que se ejecutaba antes que los middleware
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   // metodo que devuelve los productos del vendedor o empresa
        
        if($this->user->can('seller')){ //si es un vendedor
            $products = User::filterSellerProducts(
                    $this->user->id, 
                    $request->get('nameproduct'), 
                    $request->get('company')
            );
        }
        else if($this->user->can('company')){ //si es una empresa
            $products = User::filterCompanyProducts(
                    $this->user->id, 
                    $request->get('nameproduct'), 
                    $request->get('company')
            );
        }

        $products->setPath('my-products');

        return view('dashboard.myproducts.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.myproducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMyProductRequest $request)
    {
        $product = new Product();

        $product->fill($request->all());

        $product->status_id = 2; // tiene que estar desactivado

        $product->save();

        $message = $product->name.trans('messages.new');
      
        Session::flash('new', $message);
    
        return redirect()->route('dashboard.my-products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // este metodo puede usarse para mostrar productos asigandos al
        // vendedor, puede usarse para mostrar productos de la empresa
        // como tambien puede mostrar los porductos no asignados al vendedor

        // se verifica si 'unallocated' se encuentra en el estring
        // de la url anterior (desde donde se viene -> URL::previous())
        // strpos Devuelve la posición donde el string existe, 
        // si no devuelve false
        $unallocated = strpos(URL::previous(), trans('route.unallocated'));

        if($this->user->can('company') || $unallocated !== false){
            // si es una empresa la que está consultando algunos de sus 
            // productos, simplemente se se busca con Product::findOrFail
            // Si no es empresa y $unallocated no es false, quiere
            // decir que es un vendedor, pero viene de la url de 
            // los productos que NO tiene asignado, por lo tanto se 
            // usará Product::findOrFail en vez de addedproducts()
            $product = Product::findOrFail($id);
        }
        else if($this->user->can('seller')){
            // si no entra en la condicion anterior, aparte que es un 
            // vendedor, se sabe que la url anterior es 'my-products'
            // es decir de los productos que si estan asignados al vendedor
            $product = $this->user->addedproducts()->findOrFail($id);
        }

        return view('dashboard.myproducts.show')
                    ->with('product', $product)
                    ->with('unallocated', $unallocated);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.myproducts.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditMyProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$product = Product::findOrFail($id);

        $product->delete();

        $message = $product->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.my-products.index');*/
    }

    // los productos no asignados se muestran solo para los vendedores
    public function unallocated(Request $request)
    {
        $products = Product::filterProductsUnallocated($this->user->id,
                    $request->get('nameproduct'), 
                    $request->get('company')
        );

        $products->setPath('my-products/unallocated');

        return view('dashboard.myproducts.unallocated')->with('products', $products);
    }
}
