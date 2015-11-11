<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Product;
use Illuminate\Support\Facades\Session;

class LinkedSellersController extends Controller
{
	/*** Método se usa para mostrar y filtrar los vendedores del producto ***/
    public function getProduct(Request $request, $id)
    {
    	// $id contiene el id del producto
    	$product = Product::findOrFail($id);
        // get('nameseller') contiene el nombre o email del vendedor a filtrar
        $productSellers = Product::filterProductSellers(
                $id,
                $request->get('nameseller')
        );

        //$productSellers->setPath($product->id);

        $header = [
			'route' => ['dashboard.linkedsellers.product', $product->id], 
			'method' => 'GET',
			'class' => 'btn-group btn-group-xs'
		];
        return view('dashboard.linkedsellers.sellers', compact('productSellers', 'header'))
                ->with('object', $product);
    }

    /*** Método se usa para mostrar y filtrar los vendedores de la empresa ***/
    public function getCompany(Request $request, $id)
    {
    	return $id;
    }

    /*** Metodo Extra para activar/desactivar estatus del vinculo producto-vendedor ***/
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
