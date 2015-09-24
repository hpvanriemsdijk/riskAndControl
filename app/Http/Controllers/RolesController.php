<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Role;
use App\User;

class RolesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Role::all();
				
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'roles/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
	}

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexOwnControlframeworks($id)
	{
		$data = Role::find($id)->ownControlframeworks;
		return view('generic.list', ['data' => $data, 'view' => 'controlframeworks']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexOwnControlactivities($id)
	{
		$data = Role::find($id)->ownControlactivities;
		return view('generic.list', ['data' => $data, 'view' => 'controlactivities']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexOwnDeficiencies($id)
	{
		$data = Role::find($id)->ownDeficiencies;
		return view('generic.list', ['data' => $data, 'view' => 'deficiencies']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexOwnImprovements($id)
	{
		$data = Role::find($id)->ownImprovements;
		return view('generic.list', ['data' => $data, 'view' => 'improvements']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexOwnAssets($id)
	{
		$data = Role::find($id)->ownAssets;
		return view('generic.list', ['data' => $data, 'view' => 'assets']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexMaintainAssets($id)
	{
		$data = Role::find($id)->maintainAssets;
		return view('generic.list', ['data' => $data, 'view' => 'assets']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexOwnProccess($id)
	{
		$data = Role::find($id)->ownProccess;
		return view('generic.list', ['data' => $data, 'view' => 'processes']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexMaintainProcess($id)
	{
		$data = Role::find($id)->maintainProcess;

		//Set view to overrule automagic view selection
		return view('generic.list', ['data' => $data, 'view' => 'processes']);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexUsers($id)
	{
		$data = Role::find($id)->user;
		return view('generic.list', ['data' => $data, 'view' => 'users']);
	}	

	/**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
        		'users' => User::orderBy('name', 'asc')->lists('name', 'id')
			]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Role::$validationRules);
		$item = Role::create($request->all());
		return view('roles.listPanel', ['item' => $item]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Role::find($id);

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Own Frameworks", "model" => "owncontrolframeworks"),
			array("label" => "Own Activities", "model" => "owncontrolactivities"),
			array("label" => "Own Deficiencies", "model" => "owndeficiencies"),
			array("label" => "Own Improvements", "model" => "ownimprovements"),
			array("label" => "Own Assets", "model" => "ownassets"),
			array("label" => "Maintain Assets", "model" => "maintainassets"),
			array("label" => "Own Proccess", "model" => "ownproccess"),
			array("label" => "Maintain Process", "model" => "maintainprocess"),
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'roles/'.$id.'/edit'),
			array('label' => 'Delete', 'action' => 'deleteItem('.$id.')'),
		);

	    return view('generic.item', ['data' => $data, 'childModels' => $childModels, 'actions' => $actions]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Role::find($id);

		return view('generic.create', [
				'data' => $data,
				'users' => User::orderBy('name', 'asc')->lists('name', 'id')
			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$role = Role::findOrFail($id);
		$this->validate($request, Role::$validationRules);
		$input = $request->all();
    	$role->fill($input)->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Role::destroy($id);
	}

}
