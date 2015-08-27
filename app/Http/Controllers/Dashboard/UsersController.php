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
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    public function findUser(Route $route){
        $this->user = User::findOrFail($route->getParameter('users'));
    }
    ///Para buscar el usuario y tenerlo en $this->user

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::filterUsers(Request::get('namemail'), Request::get('type'));
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
      
        Session::flash('new_user', trans('messages.new_user'));
    
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
        return view('dashboard.users.show')->with('user', $this->user);
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

        Session::flash('edit_user', trans('messages.edit_user'));

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

        $message = $this->user->name.trans('messages.delete_user');

        if(Request::ajax()){
            return response()->json([
                'id' => $this->user->id,
                'message' => $message
            ]);
        }

        Session::flash('delete_user', $message);

        return redirect()->route('dashboard.users.index');
    }
}
