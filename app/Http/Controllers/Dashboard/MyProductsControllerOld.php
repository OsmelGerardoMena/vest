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

class MyProductsController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();

        // middleware especifico para este controlador
        if($this->user->can('company')){
            // si es empresa, se restringe solo getUnallocated
            $this->middleware('is_seller', ['only' => ['getUnallocated'] ]);
        }
        else{
            // el vendedor tiene acceso a todo este apartado, el admin no
            $this->middleware('is_seller');
        }
    }

    // metodo que devuelve los productos del vendedor o empresa
    public function getIndex(Request $request)
    {

        if($this->user->can('seller')){ //si es un vendedor
            $products = User::filterSellerProducts($this->user->id, $request->get('nameproduct'));
        }
        else if($this->user->can('company')){ //si es una empresa
            $products = User::filterCompanyProducts($this->user->id, $request->get('nameproduct'));
        }

        $products->setPath('my-products');

        return view('dashboard.myproducts.index', compact('products'));
    }

    // ver algun producto de un vendedor o empresa
    public function getShow($id)
    {
        // este metodo puede usarse para mostrar productos asigandos al
        // vendedor, puede usarse para mostrar productos de la empresa
        // como tambien puede mostrar los porductos no asignados al vendedor

        // se verifica si 'unallocated' se encuentra en el estring
        // de la url anterior (desde donde se viene -> URL::previous())
        // strpos Devuelve la posición donde el string existe, 
        // si no devuelve false
        $position = strpos(URL::previous(), trans('dashboard.unallocated'));

        if($this->user->can('company') || $position !== false){
            // si es una empresa la que está consultando algunos de sus 
            // productos, simplemente se se busca con Product::findOrFail
            // Si no es empresa y $position no es false, quiere
            // decir que es un vendedor, pero viene de la url de 
            // los productos que NO tiene asignado, por lo tanto se 
            // usará Product::findOrFail en vez de addedproducts()
            $product = Product::findOrFail($id);
        }
        else if($this->user->can('seller')){
            // si no entra en la condicion anterior, aparte que es un 
            // vendedor, se sabe que viene de la url de los productos que 
            // SI tiene asignado, por lo tanto se usa addedproducts
            $product = $this->user->addedproducts()->findOrFail($id);
        }

        return view('dashboard.myproducts.show')
                    ->with('product', $product)
                    ->with('position', $position);
    }

    // los productos no asignados solo para los vendedores
    public function getUnallocated(Request $request)
    {
        $products = Product::filterProductsUnallocated($this->user->id,
                    $request->get('nameproduct'), 
                    $request->get('company')
        );

        $products->setPath('my-products/unallocated');

        return view('dashboard.myproducts.unallocated')->with('products', $products);
    }
}