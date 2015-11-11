<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\User;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Session;

class SellersController extends Controller
{
    ///Para buscar el vendedor y tenerlo en $this->seller
    public function __construct()
    {
        $this->beforeFilter('@findSeller', 
            ['only' => ['show', 'edit', 'update']]);
    }

    public function findSeller(Route $route)
    {
        //el id #2 de user_types es el perfil vendedor
        $this->seller = User::where('type_id', 2)
                ->findOrFail($route->getParameter('sellers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sellers = User::filterSellers($request->get('seller'));
        $sellers->setPath('sellers');
        return view('dashboard.sellers.sellers', compact('sellers'));
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
    public function show(Request $request, $id)
    {
        // el metodo se usa para mostrar y filtrar los productos del vendedor
        // $id contiene el id del vendedor
        // get('nameproduct') contiene el nombre del producto a filtrar
        $sellerProducts = User::filterSellerProducts($id, 
                $request->get('nameproduct'), $request->get('company'));

        $sellerProducts->setPath($this->seller->id);

        return view('dashboard.sellers.seller_products', compact('sellerProducts'))
                ->with('seller', $this->seller);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.sellers.add_product')
                ->with('seller', $this->seller);
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
        $arrayId = []; //para almacenar los id de los productos
        // se recore el array con los id de las empresas recibidos
        foreach ($request->all() as $company_id) {
            if(is_numeric($company_id)){
                $company = User::findOrFail($company_id);
                // se almacena los productos activos de la empresa
                $products_id =  $company->products()->where('status_id', 1)->lists('id');
                // se recorre el array de los productos activos de la empresa para
                // alamacenar en arrayId los id de dichos productos
                foreach ($products_id as $id) {
                    $arrayId [] = $id; 
                }
            }
        }

        // sincronizo los productos del array con los de la tabla pivote
        $this->seller->addedproducts()->sync($arrayId);

        if(!empty($arrayId)) // si no esta vacio, se añadieron corretamente
            Session::flash('add_products', trans('messages.add_products'));
        else // si esta vacio, se eliminaron todos los productos para el vendedor
            Session::flash('remove_products', trans('messages.remove_products'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    // Este metodo no se esta utilizando
    public function destroy(Request $request, $id)
    {
        // metodo para desvincular un producto de un vendedor especifico
        // recibe un campo oculto get('product_id')
        // y el id del vendedor
    
        // almaceno el id de producto a eliminar
        /*$productId = $request->get('product_id');

        // busco el producto para mostrar su nombre en mensaje
        $product =  $this->seller->addedproducts()
                    ->where('product_id', $productId)
                    ->first();

        // se elimina el producto al vendedor especifico
        $this->seller->addedproducts()->detach($productId);

        $message = $product->name.trans('messages.delete_seller_product');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.sellers.show', $this->seller->id);*/
    }

    /*** Metodo Extra para activar/desactivar vinculo vendedor-producto ***/
    public function productLink(Request $request, $id)
    {
        // se busca el vendedor
        $seller = User::where('type_id', 2)->findOrFail($id);

        // busco el producto vinculado con el vendedor anterior
        $product = $seller->addedproducts()
                    ->where('product_id', $request->get('product_id'))
                    ->first();
        
        // se verifica el estatus del vinculo
        if($product->getLinkStatus())
            $product->pivot->status = false;
        else
            $product->pivot->status = true;
        
        $product->pivot->save();
        
        $message = $product->name.trans('messages.link_status');
        Session::flash('status', $message);
        return redirect()->back();
    }
}
