<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Vest\Tables\Sale;

class CompanySalesController extends Controller
{
	// arreglos para guardar conteo de ventas por producto y por vendedor
	private $products = [], $sellers = [];

    public function __construct()
    {
    	$this->middleware('is_company');

        $this->company = Auth::user();
    }

    public function getIndex()
    {
        // obtengo todas las ventas facturadas
    	$sales = Sale::whereNotNull('invoice')->get();

    	// conteo de ventas por producto y por vendedor
    	$this->getSalesPerProductAndSeller($sales);

    	return view('dashboard.companysales.index')
    			->with('products', $this->products)
    			->with('sellers', $this->sellers);
    }

    ///** Metodo privado alamacena en array las ventas por producto y vendedor **///
    private function getSalesPerProductAndSeller($sales)
    {
    	foreach ($sales as $sale) {
    		// se verifica primero si los productos vendidos 
    		// pertenecen a la empresa actual
    		if($sale->product->company_id == $this->company->id){
    			// si el id de producto ya existe como key en el array
    			if (array_key_exists($sale->product_id, $this->products)) {
    				// entonces simplemente se incrementa el contador de ventas
                    // con la cantidad que tenga alamacenada en quantity
    				$this->products[$sale->product_id]['count'] += $sale->quantity;
    			}
    			else{
    				// de lo contrario se guarda en el array (products) por 
    				// primera vez el producto vendido y la cantidad vendida se 
                    // coloca en el contador de ventas
    				$this->products[$sale->product_id] = [
	    				'product_name' => $sale->product->name,
	    				'count' => $sale->quantity,
    				];
    			}

    			// si el id de vendedor ya existe como key en el array
    			if (array_key_exists($sale->seller_id, $this->sellers)) {
    				// entonces simplemente se incrementa el contador de ventas
                    // con la cantidad que tenga alamacenada en quantity
    				$this->sellers[$sale->seller_id]['count'] += $sale->quantity;
    			}
    			else{
    				// de lo contrario se guarda en el array (sellers) por 
    				// primera vez el vendedor y la cantidad vendida se 
                    // coloca en el contador de ventas
    				$this->sellers[$sale->seller_id] = [
	    				'seller_name' => $sale->seller->name,
	    				'count' => $sale->quantity,
    				];
    			}
    		}
    	}
    }
}
