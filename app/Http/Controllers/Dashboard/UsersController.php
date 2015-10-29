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
    // Atributo para guardar nuevo nombre de la foto a subir
    private $img_name;
    // Atributo para guardar las extensiones permitidas
    private $allowed = ['jpg', 'png', 'gif', 'jpeg'];
    // Atributo para almacenar mensaje de error al subir foto
    private $error_message;

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
        $user = new User();

        // si recibo company_category_id con algun valor
        if ($request->has('company_category_id')) {
            // se almacena en el atributo company_category_id
            $user->company_category_id = $request->get('company_category_id');
        }

        // se verifica si se recibio la foto
        if ($request->file('photo')) {
            if (!$this->uploadImage($request->file('photo'))) {
                Session::flash('file_error', $this->error_message);
                return redirect()->back()->withInput($request->all());
            }
            // se guarda el nombre de la foto
            $user->photo = $this->img_name;
        }

        // con foto o sin foto se rellenan todos los otros datos
        $user->fill($request->all());
        
        $user->save();
        
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
        if ($request->get('type_id') == 3) {
            // si se esta editando una empresa, se alamacena su categoria
            $this->user->company_category_id = $request->get('company_category_id');
        }
        else {
            // si no se esta editando una empresa, se verifica si el campo 
            // company_category_id no tiene un valor nulo
            if (!is_null($this->user->company_category_id)) {
                // si no tiene el valor NULL, quiere decir que tenia alamacenado
                // algún Id de categoria. Se alamacena NULL nuevamente debido a que 
                // el usuario no es una empresa
                $this->user->company_category_id = null;
            }
        }

        // se verifica si se recibio una foto
        if ($request->file('photo')) {
            if (!$this->uploadImage($request->file('photo'))) {
                Session::flash('file_error', $this->error_message);
                return redirect()->back()->withInput($request->all());
            }
            // si se pudo subir la nueva foto, se elimina la vieja
            $this->deletePhoto($this->user);
            // se guarda el nombre de la nueva foto
            $this->user->photo = $this->img_name;
        }

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
        $this->deletePhoto($this->user);

        $this->user->delete();

        $message = $this->user->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.users.index');
    }

    /*** Metodo Extra para activar/desactivar status del usuario ***/
    public function userStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status_id = ($user->isActive()) ? 2 : 1;
        
        $user->save();
        
        $message = $user->name.trans('messages.status');
        Session::flash('status', $message);
        return redirect()->back();
    }

    /*** Metodo Extra para subir una imagen ***/
    private function uploadImage($file)
    {
        if(!$file->getError()){
            // se alamacena la extension del archivo en minusculas
            $file_extension = strtolower($file->getClientOriginalExtension());
            // se verifica si la extensión coincide con alguna de las permitidas
            if(in_array($file_extension, $this->allowed)){
                // se almacena nuevo nombre para el archivo
                $this->img_name = uniqid('', true).'.'.$file_extension;
                // se mueve el archivo al directoio donde se va a guardar
                $upload = $file->move(public_path('assets/photos'), $this->img_name);
                // se verifica la carga
                if($upload){
                    return true;
                }
                else{
                    // Mensaje de error al subir
                    $this->error_message = trans('messages.uploading_error');
                }
            }
            else{
                // Mensaje de error de extension
                $this->error_message = trans('messages.extension_error_photo');
            }
        }
        else{
            // Mensaje de error en el archivo
            $this->error_message = trans('messages.photo_error');
        }

        return false;
    }

     /*** Metodo Extra para eliminar una foto si existe ***/
    private function deletePhoto($user)
    {
        // hasFile(), es un metodo del modelo user
        if($user->hasFile()){
            // se elimina siempre y cuando no sea default.jpg
            if($user->photo != 'default.jpg')
                \Storage::disk('local_user_photo')->delete($user->photo);
        }
    }
}
