<?php

namespace App\Http\Controllers;

use App\Controlactivity;
use App\Testofcontrol;
use Illuminate\Http\Request;

class TestsofcontrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Testofcontrol::all();

        //Filter settings
        $filter = [];

        //Menu actions
        $actions = [
            ['label' => 'add', 'route' => 'testsofcontrol/create', 'target' => ''],
        ];

        return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
    }

    /**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
                'controlactivities' => Controlactivity::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Testofcontrol::$validationRules);
        $item = Testofcontrol::create($request->all());

        return view('testsofcontrol.listPanel', ['item' => $item]);
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
        $data = Testofcontrol::with(['controlactivity'])->find($id);

        //Menu actions
        $actions = [
            ['label' => 'Edit', 'route' => 'testsofcontrol/'.$id.'/edit'],
            ['label' => 'Delete', 'action' => 'deleteItem('.$id.')'],
        ];

        return view('generic.item', ['data' => $data, 'actions' => $actions]);
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
        $data = Testofcontrol::find($id);

        return view('generic.create', [
                'data'              => $data,
                'controlactivities' => Controlactivity::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
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
        $testofcontrol = Testofcontrol::findOrFail($id);
        $this->validate($request, Testofcontrol::$validationRules);
        $input = $request->all();
        $testofcontrol->fill($input)->save();
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
        Testofcontrol::destroy($id);
    }
}
