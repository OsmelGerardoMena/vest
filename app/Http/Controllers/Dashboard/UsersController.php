<?php

namespace Vest\Http\Controllers\Dashboard;

//use Illuminate\Http\Request; Para inyeccion de dependencias

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\User;

//para recibir datos y usar Request::**
use Illuminate\Support\Facades\Request;

//Request para validar
use Vest\Http\Requests\CreateUserRequest;
use Vest\Http\Requests\EditUserRequest;

//para mensajes con sesiones
use Illuminate\Support\Facades\Session;

//para usar route como inyeccion de dependencia
use Illuminate\Routing\Route;

class UsersController extends Controller
{
    ///Para buscar el usuario y tenerlo en $this->user
    public function __construct(){
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 
                            'update', 'destroy']]);
    }

    public function findUser(Route $route){
        $this->user = User::findOrFail($route->getParameter('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::filterUsers(Request::get('namemail'), Request::get('type'));
        $users->setPath('users');
        return view('dashboard.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    { 
        $user = User::create($request->all());

        $message = $user->name.trans('messages.new');
      
        Session::flash('new', $message);
    
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $products = [];
        if($this->user->type_id == 2){ //vendedor
            $products = $this->user->addedproducts;
        }
        else if($this->user->type_id == 3){ //empresa
            $products = $this->user->products;
        }
        return view('dashboard.users.show')->with('user', $this->user)
                    ->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.users.edit')->with('user', $this->user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $this->user->fill($request->all());

        $this->user->save();

        $message = $this->user->name.trans('messages.edit');

        Session::flash('edit', $message);

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
        $this->user->delete();

        $message = $this->user->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.users.index');
    }

    /*** Metodo Extra ***/
    public function statusUser($id)
    {
        $user = User::findOrFail($id);

        if($user->status->id == 1){
            $user->status_id = 2;
        }
        else if($user->status->id == 2){
            $user->status_id = 1;
        }
        $user->save();
        
        $message = $user->name.trans('messages.status');
        Session::flash('status', $message);
        return redirect()->back();
    }
}
