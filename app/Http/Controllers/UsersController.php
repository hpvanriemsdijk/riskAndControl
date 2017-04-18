<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = User::all();

        //Filter settings
        $filter = [];

        //Menu actions
        $actions = [
            ['label' => 'add', 'route' => 'users/create', 'target' => ''],
        ];

        return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
    }

    /**
     * Display a listing of the child processes.
     *
     * @return Response
     */
    public function indexRoles($id)
    {
        $data = User::find($id)->roles;

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
        $this->validate($request, User::$validationRules);
        $item = User::create($request->all());

        return view('users.listPanel', ['item' => $item]);
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
        $data = User::find($id);

        //Child models, used for tabs
        $childModels = [
            ['label' => 'Roles', 'model' => 'roles'],
        ];

        //Menu actions
        $actions = [
            ['label' => 'Edit', 'route' => 'users/'.$id.'/edit'],
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
        $data = User::find($id);

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
        $user = User::findOrFail($id);
        $this->validate($request, User::$validationRules);
        $input = $request->all();
        $user->fill($input)->save();
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
        User::destroy($id);
    }
}
