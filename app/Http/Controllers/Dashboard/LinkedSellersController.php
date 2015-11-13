<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\User;
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
        $sellers = Product::filterProductSellers(
                $product,
                $request->get('nameseller')
        );

        $sellers->setPath($product->id);

        // ruta para botón back en la vista dashboard/linkedsellers/sellers
        $route_back = 'dashboard.products.show';
        // ruta para botón buscar y ver todo en la vista dashboard/linkedsellers/partials/search
        $search_route = 'dashboard.linkedsellers.product';
        // se verifica si en la ruta aparece la palabra 'product', si el metodo 
        // devuelve true si se mostrará la columna de acciones 
        $path = $this->pathContainsProduct();

        return view('dashboard.linkedsellers.sellers', 
                compact('sellers', 'route_back', 'search_route', 'path'))
                ->with('object', $product);
    }

    /*** Método se usa para mostrar y filtrar los vendedores de la empresa ***/
    public function getCompany(Request $request, $id)
    {
    	// $id contiene el id de la empresa
    	$company = User::findOrFail($id);
    	// como al agragar una empresa a un vendedor automaticamante tendrá todos
        // sus productos, se consulta solo uno para luego usar el metodo sellers()
        $product = $company->products()->where('status_id', 1)->first();
        // se verifica si es nulo o no, ya que puede haber empresa sin productos
        if (!is_null($product)) {
            // get('nameseller') contiene el nombre o email del vendedor a filtrar
            $sellers = Product::filterProductSellers(
                    $product,
                    $request->get('nameseller')
            );

            $sellers->setPath($company->id);
            // ruta para botón back en la vista dashboard/linkedsellers/sellers
            $route_back = 'dashboard.companies.show';
            // ruta para botón buscar y ver todo en la vista dashboard/linkedsellers/partials/search
            $search_route = 'dashboard.linkedsellers.company';
            // se verifica si en la ruta aparece la palabra 'product', si el metodo 
            // devuelve false no se mostrará la columna de acciones 
            $path = $this->pathContainsProduct();

            return view('dashboard.linkedsellers.sellers', 
                    compact('sellers', 'route_back', 'search_route', 'path'))
                    ->with('object', $company);
        }
        // de lo contrario si es nulo $product, quiere decir que la empresa no tiene productos
        Session::flash('error', trans('messages.without_sellers'));
        return redirect()->back();
    }

    /*** Metodo para activar/desactivar estatus del vinculo producto-vendedor ***/
    public function getLink(Request $request, $id)
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

    /*** Metodo para verificar si en la ruta aparece la palabra 'product' ***/
    private function pathContainsProduct()
    {
        return strpos(\URL::previous(), trans('route.product'));
    }
}
