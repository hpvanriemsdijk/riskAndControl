<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asset;
use App\Role;
use App\Threat;
use App\Process;

class AssetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Asset::all()->toHierarchy();

		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'assets/create', 'target' => '')
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
		$data = Asset::find($id)->getDescendants(1);
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexProcesses($id)
	{
		$data = Asset::find($id)->processes;
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the child threats.
	 *
	 * @return Response
	 */
	public function indexThreats($id)
	{
		$data = Asset::find($id)->threats;
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
    		'threats' => Threat::orderBy('name', 'asc')->lists('name', 'id'), 
    		'processes' => Process::orderBy('name', 'asc')->lists('name', 'id'), 
    		'assetTypes' => asset::$assetTypes
		]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Asset::$validationRules);
		$item = Asset::create($request->all());
		return view('assets.listPanel', ['item' => $item]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Asset::with(['owner', 'maintainer'])->find($id);
		$data->ancestors = Asset::find($id)->getAncestorsAndSelf();
		
		//Child models, used for tabs
		$childModels = array(
			array("label" => "Child assets", "model" => "assets"),
			array("label" => "Processes", "model" => "processes"),
			array("label" => "Threats", "model" => "threats")
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'assets/'.$id.'/edit'),
			array('label' => 'Delete', 'route' => 'assets/'.$id.'/destroy', 'target' => 'new' ),
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
		$data = Asset::find($id);

		return view('generic.create', [
				'data' => $data,
	        	'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'), 
	    		'threats' => Threat::orderBy('name', 'asc')->lists('name', 'id'), 
	    		'processes' => Process::orderBy('name', 'asc')->lists('name', 'id'), 
	    		'assetTypes' => asset::$assetTypes
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
		$asset = Asset::findOrFail($id);
		$this->validate($request, Asset::$validationRules);
		$input = $request->all();
    	$asset->fill($input)->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = Asset::find($id);
		Asset::destroy($id);
		return redirect('controlframeworks')->with('status', 'Controlframework "' . $data->name . '" succesfully deleted.');
	}

}
