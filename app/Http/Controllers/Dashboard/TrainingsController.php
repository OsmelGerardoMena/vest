<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Training;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateTrainingRequest;
use Vest\Http\Requests\EditTrainingRequest;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class TrainingsController extends Controller
{
    // Atributo para guardar nuevo nombre del archivo a subir
    private $file_name = 'no_file';
    // Atributo para guardar las extensiones permitidas
    private $allowed = ['pdf', 'doc', 'docx'];
    // Atributo para almacenar mensaje de error al subir archivo
    private $error_message;

    // Construtor
    public function __construct()
    {
        $this->beforeFilter('@findTraining', ['only' => ['show','edit', 'update', 'destroy']]);
    }

    public function findTraining(Route $route)
    {
        $this->training = Training::findOrFail($route->getParameter('trainings'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trainings = Training::filterTrainings($request->get('product'));
        $trainings->setPath('trainings');
        return view('dashboard.trainings.trainings', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateTrainingRequest $request)
    {
        // se verifica si el campo content esta vacio
        // por defecto en el html tiene el string de abajo
        if(trim($request->get('content')) === "<p><br></p>"){
            Session::flash('error', trans('messages.content_required'));
            return redirect()->back()->withInput($request->all());
        }

        // Se crea un nuevo objeto Training
        $training = new Training();

        // se verifica si se ha recibido un archivo
        // No uso $request->hasFile xq devuelve false si el archivo se excede de 2Mb
        if($request->file('training_file')){
            // se intenta subir, pero si uploadFile retorna false
            if (!$this->uploadFile($request->file('training_file'))) {
                Session::flash('file_error', $this->error_message);
                return redirect()->back()->withInput($request->all());
            }           
        }
        
        // si se subio correctamente el archivo se almacena el nuevo nombre
        // de lo contrario, se almacena el valor que trae por defecto file_name
        $training->training_file = $this->file_name;

        // se almacena los otros datos recibidos
        $training->date = $request->get('date');
        $training->product_id = $request->get('product_id');
        $training->content = $request->get('content');

        $training->save();
      
        Session::flash('new', trans('messages.new_training'));
        return redirect()->route('dashboard.trainings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('dashboard.trainings.show')
                ->with('training', $this->training);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.trainings.edit')
                ->with('training', $this->training);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditTrainingRequest $request, $id)
    {
        if(trim($request->get('content')) === "<p><br></p>"){
            Session::flash('error', trans('messages.content_required'));
            return redirect()->back()->withInput($request->all());
        }

        if($request->file('training_file')){
            if (!$this->uploadFile($request->file('training_file'))) {
                Session::flash('file_error', $this->error_message);
                return redirect()->back()->withInput($request->all());
            }
            // si se pudo subir el nuevo archivo, se elimina el archivo viejo
            $this->deleteFile();
            // se alamacena el nombre del nuevo archivo
            $this->training->training_file = $this->file_name;
        }

        $this->training->date = $request->get('date');
        $this->training->product_id = $request->get('product_id');
        $this->training->content = $request->get('content');
        $this->training->save();

        Session::flash('edit', trans('messages.edit_training'));

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
        $this->deleteFile();
        $this->training->delete();

        Session::flash('delete', trans('messages.delete_training'));

        return redirect()->route('dashboard.trainings.index');
    }

    // metodo privado para subir un archivo
    private function uploadFile($file)
    {
        if(!$file->getError()){
            // se alamacena la extensiond el archivo en minusculas
            $file_extension = strtolower($file->getClientOriginalExtension());
            // se verifica si la extensión coincide con alguna de las permitidas
            if(in_array($file_extension, $this->allowed)){
                // se almacena nuevo nombre para el archivo
                $this->file_name = uniqid('', true).'.'.$file_extension;
                // se mueve el archivo al directoio donde se va a guardar
                $upload = $file->move(public_path('files/trainings'), $this->file_name);
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
                $this->error_message = trans('messages.extension_error');
            }
        }
        else{
            // Mensaje de error en el archivo
            $this->error_message = trans('messages.file_error');
        }

        return false;
    }

    // elimina un archivo si existe
    private function deleteFile()
    {
        if($this->training->hasFile()){
            \Storage::disk('local_training_file')
                ->delete($this->training->training_file);
        }
    }
}
