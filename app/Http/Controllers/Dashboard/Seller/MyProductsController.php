<?php

namespace Vest\Http\Controllers\Dashboard\Seller;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Vest\User;

class MyProductsController extends Controller
{
    //metodo que devuelve los productos del vendedor
    public function getIndex(Request $request)
    {
        $me = Auth::user();

        $products = User::filterSellerProducts($me->id, $request->get('nameproduct'));

        $products->setPath('my-products');

        return view('dashboard.myproducts.index', compact('products'))
            ->with('seller', $me);
    }

    public function getShowProduct($id)
    {
        return "hola";
    }
}
