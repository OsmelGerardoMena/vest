<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Vest\Http\Requests\EditAccountRequest;

use Illuminate\Support\Facades\Session;

use Gate;

class AccountsController extends Controller
{
    // Atributo para guardar nuevo nombre de la foto a subir
    private $img_name;
    // Atributo para guardar las extensiones permitidas
    private $allowed = ['jpg', 'png', 'gif', 'jpeg'];
    // Atributo para almacenar mensaje de error al subir foto
    private $error_message;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = [];

        // tambien se puede usar $this->user->can('seller')
        if(Gate::allows('seller')){ //si es vendedor
            $products = $this->user->addedproducts()
                    ->whereNotIn('product_id', [1])->get();
            // se usa el whereNotIn para que no aparezca el producto general
            // se usa user_id porque debe ser de la tabla pivote
        }
        else if(Gate::allows('company')){ // si es empresa
            $products = $this->user->products;
        }
        
        return view('dashboard.account.account', compact('products'))
                        ->with('user', $this->user);
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
        //si intentan ingresar otro id en la barra de direccion
        if($id != $this->user->id){ //se verifican los id
            return redirect()->route('dashboard.account.edit', $this->user->id);
        }
        
        return view('dashboard.account.edit')->with('user', $this->user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditAccountRequest $request, $id)
    {
        // se verifica si se recibió una foto
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

        Session::flash('edit', trans('messages.edit_account'));

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
        //
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
                // se mueve el archivo al directorio donde se va a guardar
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