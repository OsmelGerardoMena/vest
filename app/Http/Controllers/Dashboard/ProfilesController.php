<?php

namespace Vest\Http\Controllers\Dashboard;

//use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

//tablas a usar
use Vest\Tables\UserTypes;
use Vest\Tables\Submodule;

//para recibir datos y usar Request::**
use Illuminate\Support\Facades\Request;

//Request para validar
use Vest\Http\Requests\CreateProfileRequest;
use Vest\Http\Requests\EditProfileRequest;

//para mensajes con sesiones
use Illuminate\Support\Facades\Session;

//para usar route como inyeccion de dependencia
use Illuminate\Routing\Route;

class ProfilesController extends Controller
{
    //se usan al crear un nuevo profile
    private $modules = '', $submodules = '';

    ///Para buscar el perfil y tenerlo en $this->profile
    public function __construct(){
        $this->beforeFilter('@findProfile', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findProfile(Route $route){
        $this->profile = UserTypes::findOrFail($route->getParameter('profiles'));
    }

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
        $this->addModulesSubmodules($request);

        if(!empty($this->submodules)){
            $profile = new UserTypes();

            $profile->name = $request->name;

            $profile->activated_modules = $this->modules;

            $profile->activated_submodules = $this->submodules;

            $profile->save();

            Session::flash('new_profile', trans('messages.new_profile'));
            return redirect()->route('dashboard.profiles.index');
        }
        
        Session::flash('no_submodule', trans('messages.submodule_not_slected'));
        return redirect()->back();
    }

    //para agregar los modulos y submodulos al crear o editar
    private function addModulesSubmodules($request){
        $centinel = ['1' => 0, '2'=> 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0];
        
        $allsub = Submodule::get();

        foreach ($allsub as $submod) {
            if($request->has($submod->description)){

                if($centinel[$submod->module_id] == 0){

                    $this->modules .= (empty($this->modules)) 
                            ? $submod->module_id : ','.$submod->module_id;

                    $centinel[$submod->module_id] = 1;
                }

                $this->submodules .= (empty($this->submodules)) ? $submod->id 
                                    : ','.$submod->id;
            }
        }
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
        return view('dashboard.profiles.edit')->with('profile', $this->profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditProfileRequest $request, $id)
    {
        $this->addModulesSubmodules($request);
        
        if(!empty($this->submodules)){
            $this->profile->name = $request->name;

            $this->profile->activated_modules = $this->modules;

            $this->profile->activated_submodules = $this->submodules;

            $this->profile->save();

            Session::flash('edit_profile', trans('messages.edit_profile'));
            return redirect()->back();
        }

        Session::flash('no_submodule', trans('messages.submodule_not_slected'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->profile->delete();

        $message = $this->profile->name.trans('messages.delete_profile');

        Session::flash('delete_profile', $message);
        
        return redirect()->route('dashboard.profiles.index');
    }
}
