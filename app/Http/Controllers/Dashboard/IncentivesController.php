<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Incentive;
use Vest\Tables\Product;

use Illuminate\Routing\Route;

use Vest\Http\Requests\CreateIncentiveRequest;
use Vest\Http\Requests\EditIncentiveRequest;

use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class IncentivesController extends Controller
{
    // Atributo para guardar nuevo nombre de la imagen a subir
    private $img_name;
    // Atributo para guardar las extensiones permitidas
    private $allowed = ['jpg', 'png', 'gif', 'jpeg']; //'bmp', 'svg'
    // Atributo para almacenar mensaje de error al subir imagen
    private $error_message;

    public function __construct(){
        $this->user = \Auth::user();

        if ($this->user->can('seller')) {
            // si se loguea un vendedor, se restringe todo
            $this->middleware('is_admin');
        }
        else if ($this->user->can('company')) {
            // si se loguea una empresa, se restringe solo
            $this->middleware('is_admin', ['only' => ['show', 'destroy'] ]);
        }

        //$this->beforeFilter('@findIncentive', ['only' => ['edit', 'update', 'destroy']]);
    }

    /*public function findIncentive(Route $route){
        $this->incentive = Incentive::findOrFail($route->getParameter('incentives'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($this->user->can('admin')) {
            $incentives = Incentive::filterIncentives(
                $request->get('award'), 
                $request->get('product')
            );
        }
        else if($this->user->can('company')) {
            // si es empresa, se busca los id de productos de dicha empresa
            $idArray = Product::where('company_id', $this->user->id)->lists('id');
            $incentives = Incentive::filterCompanyIncentives(
                $idArray, 
                $request->get('award'), 
                $request->get('product')
            );
        }

        $incentives->setPath('incentives');
        return view('dashboard.incentives.incentives', compact('incentives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.incentives.create')->with('today', Carbon::now()->toDateString());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateIncentiveRequest $request)
    {
        $incentive = new Incentive();

        if ($request->file('img')) {
            if ($this->uploadImage($request->file('img'))) {
                $incentive->fill($request->all());
                $incentive->img = $this->img_name;
                $incentive->save();
                Session::flash('new', trans('messages.new_incentive'));
                return redirect()->route('dashboard.incentives.index');
            }
            Session::flash('file_error', $this->error_message);
        }
        else{
            Session::flash('file_error', trans('messages.required_img'));
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
        $incentive = Incentive::findOrFail($id);

        return view('dashboard.incentives.edit')
                ->with('incentive', $incentive)
                ->with('today', Carbon::now()->toDateString());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EditIncentiveRequest $request, $id)
    {
        $incentive = Incentive::findOrFail($id);

        if ($request->file('img')) {
            if (!$this->uploadImage($request->file('img'))) {
                Session::flash('file_error', $this->error_message);
                return redirect()->back()->withInput($request->all());
            }
            // si se pudo subir la nueva imagen, se elimina la vieja
            $this->deleteImage($incentive);
            // se alamacena el nombre de la nueva imagen
            $incentive->img = $this->img_name;
        }

        $incentive->fill($request->all());
        $incentive->save();

        Session::flash('edit', trans('messages.edit_incentive'));
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
        $incentive = Incentive::findOrFail($id);

        $this->deleteImage($incentive);

        $incentive->delete();

        Session::flash('delete', trans('messages.delete_incentive'));

        return redirect()->route('dashboard.incentives.index');
    }

    // metodo privado para subir una imagen
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
                $upload = $file->move(public_path('files/incentives'), $this->img_name);
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
                $this->error_message = trans('messages.extension_error_image');
            }
        }
        else{
            // Mensaje de error en el archivo
            $this->error_message = trans('messages.file_error');
        }

        return false;
    }

    // elimina un archivo si existe
    private function deleteImage($incentive)
    {
        // hasFile(), es un metodo del modelo Incentive
        if($incentive->hasFile()){
            \Storage::disk('local_incentive_img')->delete($incentive->img);
        }
    }
}
