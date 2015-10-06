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
    public function __construct(){
        $this->beforeFilter('@findContract', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findContract(Route $route){
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
        $file = $request->file('contract_file');

        if(!$file){
            Session::flash('file_error', trans('messages.required_file'));
            return redirect()->back()->withInput($request->all());
        }
        else{
            if($file->getError() !== 0){
                Session::flash('file_error', trans('messages.file_error'));
                return redirect()->back()->withInput($request->all());
            }

            // se alamacena la extensiond el archivo en minusculas 
            $file_extension = strtolower($file->getClientOriginalExtension());
            // se almacena la extención permitida
            $allowed = ['pdf'];

            // se verifica si la extensión coincide con la permitida
            if(!in_array($file_extension, $allowed)){
                Session::flash('file_error', trans('messages.pdf_extension'));
                return redirect()->back()->withInput($request->all());
            }

            // nuevo nombre para el archivo
            $name = uniqid('', true).$file_extension;
            // se mueve el archivo al directoio donde se va a guardar
            $upload = $file->move(public_path('files/contracts'), $name);
           
            // se verifica la carga
            if(!$upload){
                Session::flash('file_error', trans('messages.uploading_error'));
                return redirect()->back()->withInput($request->all());
            }
        
            // se almacena los datos recibidos
            $contract->fill($request->all());
            // el nuevo nombre del archivo se guarda en el atributo contract_file
            $contract->contract_file = $name;
            // se guarda en la base de datos
            $contract->save();

            $message = $contract->name.trans('messages.new');
            Session::flash('new', $message);
            return redirect()->route('dashboard.contracts.index');
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
        $file = $request->file('contract_file');

        if($file){
            if($file->getError() !== 0){
                Session::flash('file_error', trans('messages.file_error'));
                return redirect()->back()->withInput($request->all());
            }

            // se alamacena la extensiond el archivo en minusculas 
            $file_extension = strtolower($file->getClientOriginalExtension());
            // se almacena la extención permitida
            $allowed = ['pdf'];

            // se verifica si la extensión coincide con la permitida
            if(!in_array($file_extension, $allowed)){
                Session::flash('file_error', trans('messages.pdf_extension'));
                return redirect()->back()->withInput($request->all());
            }

            // nuevo nombre para el archivo
            $name = uniqid('', true).$file->getClientOriginalName();
            // se mueve el archivo al directoio donde se va a guardar
            $upload = $file->move(public_path('files/contracts'), $name);
           
            // se verifica la carga
            if(!$upload){
                Session::flash('file_error', trans('messages.uploading_error'));
                return redirect()->back()->withInput($request->all());
            }
            //se elimina el archivo viejo
            if($this->contract->fileExists())
                \Storage::disk('local_pdf')->delete($this->contract->contract_file);
            
            // el nuevo nombre del archivo se guarda en el atributo contract_file
            $this->contract->contract_file = $name;
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
        if($this->contract->fileExists())
            \Storage::disk('local_pdf')->delete($this->contract->contract_file);

        // luego elimino el registro de la base de datos
        $this->contract->delete();

        $message = $this->contract->name.trans('messages.delete');

        Session::flash('delete', $message);

        return redirect()->route('dashboard.contracts.index');
    }
}
