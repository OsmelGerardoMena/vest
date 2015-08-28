<?php

namespace Vest\Http\Controllers\Dashboard;

//use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\UserTypes;

//para recibir datos y usar Request::**
use Illuminate\Support\Facades\Request;

//Request para validar
use Vest\Http\Requests\CreateProfileRequest;
use Vest\Http\Requests\EditUserRequest;

//para mensajes con sesiones
use Illuminate\Support\Facades\Session;

//para usar route como inyeccion de dependencia
use Illuminate\Routing\Route;

class ProfilesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $profiles = UserTypes::filterProfiles(Request::get('name'));
        return view('dashboard.profiles.profiles', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        return 'En construccion';
        $profile = new UserTypes();

        $profile->name = $request->name;

        //si existe list_users

            //entonces busco el modulo al que pertenece

            //ingreso el modulo al string modules

            //ingreso el submodulo al string submodules

        //se hace lo mismo con cada opcion

        //se guarda los valores en activated_modules y en activated_submodules

        //se hace ->save() y listo

        foreach ($variable as $key => $value) {
            # code...
        }
        /*
          $table->increments('id');
            $table->string('name');
            $table->string('activated_modules');
            $table->string('activated_submodules');
            
            //Relationships
            $table->integer('status_id')->unsigned()->default(1);
            $table->foreign('status_id')->references('id')->on('status');

        $profile = UserTypes::create($request->all());
      
        Session::flash('new_profile', trans('messages.new_profile'));
    
        return redirect()->route('dashboard.profiles.index');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
