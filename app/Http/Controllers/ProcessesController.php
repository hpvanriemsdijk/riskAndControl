<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Process;
use App\Role;

class ProcessesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Process::all()->toHierarchy();
				
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'processes/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
	}

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexChildren($id)
	{
		$data = Process::find($id)->getDescendants(1);
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexThreats($id)
	{
		$data = Process::find($id)->Threats;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexAssets($id)
	{
		$data = Process::find($id)->Assets;
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
        		'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id')
			]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Process::$validationRules);
		$item = Process::create($request->all());
		return view('processes.listPanel', ['item' => $item]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//return Process::find($id);
		$data = Process::with(['owner', 'maintainer'])->find($id);	
		$data->ancestors = Process::find($id)->getAncestorsAndSelf();

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Child processes", "model" => "processes"),
			array("label" => "Assets", "model" => "assets"),
			array("label" => "Threats", "model" => "threats")
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'processes/'.$id.'/edit'),
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
		$data = Process::find($id);

		return view('generic.create', [
				'data' => $data,
	        	'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id')
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
		$process = Process::findOrFail($id);
		$this->validate($request, Process::$validationRules);
		$input = $request->all();
    	$process->fill($input)->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Process::destroy($id);
	}

}
