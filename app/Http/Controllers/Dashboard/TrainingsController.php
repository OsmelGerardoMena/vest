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

class TrainingsController extends Controller
{
    public function __construct(){
        $this->beforeFilter('@findTraining', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function findTraining(Route $route){
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
        $training = Training::create($request->all());
      
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
        $this->training->fill($request->all());

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
        $this->training->delete();

        Session::flash('delete', trans('messages.delete_training'));

        return redirect()->route('dashboard.trainings.index');
    }
}
