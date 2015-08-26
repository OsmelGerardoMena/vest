<?php

namespace Vest\Http\Controllers\Dashboard;

//use Illuminate\Http\Request; Para inyeccion de dependencias

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\User;

//Resquest para recibir datos y usar Resquest::**
use Illuminate\Support\Facades\Request;

//Request para validar
use Vest\Http\Requests\CreateUserRequest;
use Illuminate\Routing\Redirector;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::simplePaginate(3);
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
        $user = new User();
        $user->type_id = $request->get('type');
        $user->fill($request->all());
        $user->save();

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
