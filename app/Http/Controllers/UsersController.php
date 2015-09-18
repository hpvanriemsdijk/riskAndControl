<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = User::all();
				
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'users/create', 'target' => '')
		);

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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return User::create(Request::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = User::find($id);

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Roles", "model" => "roles"),
		);

	    return view('generic.item', ['data' => $data, 'childModels' => $childModels]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
	}

}
