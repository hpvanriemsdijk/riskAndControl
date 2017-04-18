<?php

namespace App\Http\Controllers;

use App\Controlframework;
use App\Role;
use Illuminate\Http\Request;

class ControlframeworksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Controlframework::all();

        $filter = [
            'sortFields' => [
                ['label' => 'Name', 'value' => 'name'],
                ['label' => 'Objectives met', 'value' => 'objectives_met'],
                ['label' => 'Objectives not met', 'value' => 'objectives_not_met'],
            ],
            'filterGroups' => [
                [
                    'id'    => 'objectives_met',
                    'label' => 'Objectives met',
                    'items' => [
                        ['label' => 'not', 'value' => '.objectives_not_met'],
                        ['label' => 'partly', 'value' => '.objectives_partly_met'],
                        ['label' => 'fully', 'value' => '.objectives_fully_met'],
                    ],
                ],
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
            ['label' => 'add', 'route' => 'controlframeworks/create', 'target' => ''],
        ];

        return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
    }

    /**
     * Display a listing of the child controlobjectives.
     *
     * @return Response
     */
    public function indexControlobjectives($id)
    {
        $data = Controlframework::find($id)->controlobjectives;

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
                'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Controlframework::$validationRules);
        $item = Controlframework::create($request->all());

        return view('controlframeworks.listPanel', ['item' => $item]);
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
        $data = Controlframework::with(['owner'])->find($id);

        //Child models, used for tabs
        $childModels = [
            ['label' => 'Controlobjectives', 'model' => 'controlobjectives', 'active' => true],
        ];

        //Menu actions
        $actions = [
            ['label' => 'Edit', 'route' => 'controlframeworks/'.$id.'/edit'],
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
        $data = Controlframework::find($id);

        return view('generic.create', [
            'data'  => $data,
            'roles' => Role::where('active', '=', 1)
                ->orderBy('name', 'asc')
                ->lists('name', 'id'),
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
        $controlframework = Controlframework::findOrFail($id);
        $this->validate($request, Controlframework::$validationRules);
        $input = $request->all();
        $controlframework->fill($input)->save();
        //return view('controlframeworks.listPanel', ['item' => $controlframework]);
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
        $data = Controlframework::with(['owner'])->find($id);
        Controlframework::destroy($id);

        return redirect('controlframeworks')->with('status', 'Controlframework "'.$data->name.'" succesfully deleted.');
    }
}
