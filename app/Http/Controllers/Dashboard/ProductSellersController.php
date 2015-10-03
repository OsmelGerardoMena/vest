<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Session;

class ProductSellersController extends Controller
{
    ///Para buscar el producto y tenerlo en $this->product
    public function __construct()
    {
        $this->beforeFilter('@findProduct', 
            ['only' => ['show', 'destroy']]);
    }

    public function findProduct(Route $route)
    {
        $this->product = Product::findOrFail(
            $route->getParameter('product_sellers')
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
        //el metodo se usa para mostrar y filtrar los vendedores del producto
        //$id contiene el id del producto
        //get('namemail') contiene el nombre o email del vendedor a filtrar
        $productSellers = Product::filterProductSellers(
                    $id,
                    $request->get('nameseller')
        );

        $productSellers->setPath($this->product->id);

        return view('dashboard.products.product_sellers', compact('productSellers'))
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
    public function destroy(Request $request, $id)
    {
        //metodo para eliminar un vendedor de un producto especifico
        //recibe un campo oculto get('seller_id')
        //y el id del producto

        //busco el vendedor para mostrar su nombre en mensaje
        $seller =  $this->product->sellers()
                    ->where('user_id', $request->get('seller_id'))
                    ->first();

        //se elimina el vendedor al producto especifico
        $this->product->sellers()->detach($request->get('seller_id'));

        $message = $seller->name.trans('messages.delete_product_seller');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.product-sellers.show', $this->product->id);
    }

    /*** Metodo Extra para activar/desactivar vinculo producto-vendedor ***/
    public function sellerLink(Request $request, $id)
    {   
        // se busca el producto
        $product = Product::findOrFail($id);

        // busco el vendedor vinculado con el producto anterior
        $seller = $product->sellers()
                    ->where('user_id', $request->get('seller_id'))
                    ->first();
        // se verifica el estatus del vinculo
        if($seller->getLinkStatus())
            $seller->pivot->status = false;
        else
            $seller->pivot->status = true;
        
        $seller->pivot->save();
        
        $message = $seller->name.trans('messages.link_status');
        Session::flash('status', $message);
        return redirect()->back();
    }
}
