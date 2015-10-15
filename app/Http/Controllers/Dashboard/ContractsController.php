<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Contract;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateContractRequest;
use Vest\Http\Requests\EditContractRequest;

use Illuminate\Support\Facades\Session;

class ContractsController extends Controller
{
    // Atributo para guardar nuevo nombre del archivo a subir
    private $file_name;
    // Atributo para guardar las extensiones permitidas
    private $allowed = ['pdf', 'doc', 'docx'];
    // Atributo para almacenar mensaje de error al subir archivo
    private $error_message;

    public function __construct()
    {
        $this->beforeFilter('@findContract', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findContract(Route $route)
    {
        $this->contract = Contract::findOrFail($route->getParameter('contracts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contracts = Contract::filterContracts(
            $request->get('name'), 
            $request->get('product')
        );

        $contracts->setPath('contracts');
        return view('dashboard.contracts.contracts', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateContractRequest $request)
    {
        $contract = new Contract();

        // se verifica si se ha recibido un archivo
        // No uso $request->hasFile xq devuelve false si se excede de 2Mb
        if($request->file('contract_file')){
            // se intenta subir el archivo
            if ($this->uploadFile($request->file('contract_file'))) {
                // si se subio correctamente el archivo se almacena el nuevo nombre
                $contract->contract_file = $this->file_name;
                // se almacena los otros datos recibidos
                $contract->name = $request->get('name');
                $contract->product_id = $request->get('product_id');
                $contract->save();

                $message = $contract->name.trans('messages.new');
                Session::flash('new', $message);
                return redirect()->route('dashboard.contracts.index');
            }
            // de lo contrario se alamace error generado
            Session::flash('file_error', $this->error_message);
        }
        else{
            // si no hay archivo se devuelve error, ya que es obligatorio
            Session::flash('file_error', trans('messages.required_file'));
        }
        return redirect()->back()->withInput($request->all());
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
        return view('dashboard.contracts.edit')
                ->with('contract', $this->contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditContractRequest $request, $id)
    {
        if($request->file('contract_file')){
            if (!$this->uploadFile($request->file('contract_file'))) {
                Session::flash('file_error', $this->error_message);
                return redirect()->back()->withInput($request->all());
            }
            // si se pudo subir el nuevo archivo, se elimina el archivo viejo
            $this->deleteFile();
            // se alamacena el nombre del nuevo archivo
            $this->contract->contract_file = $this->file_name;
        }

        $this->contract->name = $request->get('name');
        $this->contract->product_id= $request->get('product_id');
        $this->contract->save();

        $message = $this->contract->name.trans('messages.edit');

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
        //elimino primero el archivo de contrato
        $this->deleteFile();

        // luego elimino el registro de la base de datos
        $this->contract->delete();

        $message = $this->contract->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.contracts.index');
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
                $upload = $file->move(public_path('files/contracts'), $this->file_name);
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
        if($this->contract->hasFile()){
            \Storage::disk('local_contract_file')
                ->delete($this->contract->contract_file);
        }
    }
}
