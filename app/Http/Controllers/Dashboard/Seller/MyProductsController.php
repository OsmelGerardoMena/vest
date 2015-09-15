<?php

namespace Vest\Http\Controllers\Dashboard\Seller;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Vest\User;
use Vest\Tables\Product;

class MyProductsController extends Controller
{
    //metodo que devuelve los productos del vendedor o empresa
    public function getIndex(Request $request)
    {
        $me = Auth::user();

        if($me->type_id == 2){ //si id es 2 es un vendedor
            $products = User::filterSellerProducts($me->id, $request->get('nameproduct'));
        }
        else if($me->type_id == 3){ //si id es 3 es una empresa
            $products = User::filterCompanyProducts($me->id, $request->get('nameproduct'));
        }

        $products->setPath('my-products');

        return view('dashboard.myproducts.index', compact('products'))
            ->with('seller', $me);
    }

    public function getShow($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.myproducts.show')->with('product', $product);
    }

    //los productos no asignados solo para los vendedores
    public function getUnallocated(Request $request)
    {
        $me = Auth::user();

        $products = Product::filterProductsUnallocated($me->id,
                    $request->get('nameproduct'), 
                    $request->get('company')
        );

        $products->setPath('my-products/unallocated');

        return view('dashboard.myproducts.unallocated')->with('products', $products);
    }
}