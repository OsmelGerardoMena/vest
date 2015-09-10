<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\User;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Session;

class CompaniesController extends Controller
{
    ///Para buscar la empresa y tenerla en $this->company
    public function __construct()
    {
        $this->beforeFilter('@findCompany', 
            ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    public function findCompany(Route $route)
    {
        //el id #3 de user_types es el perfil empresa
        $this->company = User::where('type_id', 3)
                ->findOrFail($route->getParameter('companies'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $companies = User::filterCompanies($request->get('company'));
        return view('dashboard.companies.companies', compact('companies'));
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
        //el metodo se usa para mostrar la info y filtrar los productos de la empresa
        //$id contiene el id de la empresa
        //get('nameproduct') contiene el nombre del producto a filtrar
        $companyProducts = User::filterCompanyProducts($id, $request->get('nameproduct'));
        
        return view('dashboard.companies.company_products', compact('companyProducts'))
                ->with('company', $this->company);
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
    public function destroy($id)
    {
        //
    }
}
