<?php

namespace App\Http\Controllers;

use App\Controlactivity;
use App\Controlassesment;
use App\User;
use Illuminate\Http\Request;

class ControlassesmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Controlassesment::all();

        //Filter settings
        $filter = [];

        //Menu actions
        $actions = [
            ['label' => 'add', 'route' => 'controlassesments/create', 'target' => ''],
        ];

        return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
    }

    /**
     * Display a listing of the child controlobjectives.
     *
     * @return Response
     */
    /*
    public function indexThreaths($id)
    {
        $data = Controlassesment::find($id)->threaths;
        return view('generic.list', ['data' => $data]);
    }
    */

    /**
     * Display a listing of the child Deficiencies.
     *
     * @return Response
     */
    public function indexDeficiencies($id)
    {
        $data = Controlassesment::find($id)->deficiencies;

        return view('generic.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
            'controlactivities' => Controlactivity::orderBy('name', 'asc')->lists('name', 'id'),
            'users'             => User::orderBy('name', 'asc')->lists('name', 'id'),
            'conclusions'       => Controlassesment::$conclusionTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Controlassesment::$validationRules);
        $item = Controlassesment::create($request->all());

        return view('controlassesments.listPanel', ['item' => $item]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = Controlassesment::with(['auditor', 'auditee', 'approveer', 'controlactivity'])->find($id);

        //Child models, used for tabs
        $childModels = [
            //array("label" => "Threaths", "model" => "threaths"),
            ['label' => 'Deficiencies', 'model' => 'deficiencies', 'active' => true],
        ];

        //Menu actions
        $actions = [
            ['label' => 'Edit', 'route' => 'controlassesments/'.$id.'/edit'],
            ['label' => 'Delete', 'action' => 'deleteItem('.$id.')'],
        ];

        return view('generic.item', ['data' => $data, 'childModels' => $childModels, 'actions' => $actions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data = Controlassesment::find($id);

        return view('generic.create', [
                'data'              => $data,
                'controlactivities' => Controlactivity::orderBy('name', 'asc')->lists('name', 'id'),
                'users'             => User::orderBy('name', 'asc')->lists('name', 'id'),
                'conclusions'       => Controlassesment::$conclusionTypes,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $controlassesment = Controlassesment::findOrFail($id);
        $this->validate($request, Controlassesment::$validationRules);
        $input = $request->all();
        $controlassesment->fill($input)->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Controlassesment::destroy($id);
    }
}
