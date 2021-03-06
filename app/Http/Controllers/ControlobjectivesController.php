<?php

namespace App\Http\Controllers;

use App\Controlobjective;
use Illuminate\Http\Request;

class ControlobjectivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Controlobjective::all();

        $filter = [
            'sortFields' => [
                ['label' => 'Name', 'value' => 'name'],
            ],
            'filterGroups' => [
                [
                    'id'    => 'active',
                    'label' => 'Active',
                    'items' => [
                        ['label' => 'yes ', 'value' => '.enabled'],
                        ['label' => 'no', 'value' => '.disabled'],
                    ],
                ],
            ],
        ];

        //Menu actions
        $actions = [
            ['label' => 'add', 'route' => 'controlobjectives/create', 'target' => ''],
        ];

        return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexControlframeworks($id)
    {
        $data = Controlobjective::find($id)->Controlframeworks;

        return view('generic.list', ['data' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexControlactivities($id)
    {
        $data = Controlobjective::find($id)->Controlactivities;

        return view('generic.list', ['data' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexThreats($id)
    {
        $data = Controlobjective::find($id)->Threats;

        return view('generic.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Controlobjective::$validationRules);
        $item = Controlobjective::create($request->all());

        return view('controlobjectives.listPanel', ['item' => $item]);
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
        //return Controlobjective::with(['controlframeworks', 'controlactivities', 'threats'])->find($id);
        $data = Controlobjective::find($id);

        //Child models, used for tabs
        $childModels = [
            ['label' => 'Controlframeworks', 'model' => 'controlframeworks'],
            ['label' => 'Controlactivities', 'model' => 'controlactivities', 'active' => true],
            ['label' => 'Threats', 'model' => 'threats'],
        ];

        //Menu actions
        $actions = [
            ['label' => 'Edit', 'route' => 'controlobjectives/'.$id.'/edit'],
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
        $data = Controlobjective::find($id);

        return view('generic.create', [
                'data' => $data,
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
        $controlobjective = Controlobjective::findOrFail($id);
        $this->validate($request, Controlobjective::$validationRules);
        $input = $request->all();
        $controlobjective->fill($input)->save();
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
        Controlobjective::destroy($id);
    }
}
