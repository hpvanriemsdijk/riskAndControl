<?php

namespace App\Http\Controllers;

use App\Improvement;
use App\Role;
use Illuminate\Http\Request;

class ImprovementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Improvement::all();

        //Filter settings
        $filter = [];

        //Menu actions
        $actions = [
            ['label' => 'add', 'route' => 'improvements/create', 'target' => ''],
        ];

        return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexDeficiencies($id)
    {
        $data = Improvement::find($id)->Deficiencies;

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
                'roles'             => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
                'improvementStatus' => Improvement::$improvementStatus,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Improvement::$validationRules);
        $item = Improvement::create($request->all());

        return view('improvements.listPanel', ['item' => $item]);
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
        //return Improvement::find($id);
        $data = Improvement::with(['owner'])->find($id);

        //Child models, used for tabs
        $childModels = [
            ['label' => 'Deficiencies', 'model' => 'deficiencies'],
        ];

        //Menu actions
        $actions = [
            ['label' => 'Edit', 'route' => 'improvements/'.$id.'/edit'],
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
        $data = Improvement::find($id);

        return view('generic.create', [
                'data'              => $data,
                'roles'             => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
                'improvementStatus' => Improvement::$improvementStatus,
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
        $improvement = Improvement::findOrFail($id);
        $this->validate($request, Improvement::$validationRules);
        $input = $request->all();
        $improvement->fill($input)->save();
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
        Improvement::destroy($id);
    }
}
