<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Threat;
use App\Process;
use App\EnterpriseGoal;
use App\Asset;

class ThreatsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Threat::all();
				
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'threats/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
	}

	/**
	 * Display a listing of the child assets.
	 *
	 * @return Response
	 */
	public function indexChildren($id)
	{
		$data = Threat::find($id)->getDescendants(1);
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexControlobjectives($id)
	{
		$data = Threat::find($id)->controlobjectives;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexThreatareas($id)
	{
		$data = Threat::find($id)->threatareas;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexAssets($id)
	{
		$data = Threat::find($id)->assets;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexEnterpriseGoals($id)
	{
		$data = Threat::find($id)->enterpriseGoals;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the child processes.
	 *
	 * @return Response
	 */
	public function indexProcesses($id)
	{
		$data = Threat::find($id)->processes;
		return view('generic.list', ['data' => $data]);
	}

	/**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
    	//@Todo: asset and enterpriseGoals can be subject of the threat as well
        return view('generic.create', [
        	'processes' => Process::orderBy('name', 'asc')->lists('name', 'id'), 
        	'assets' => Asset::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'), 
        	'enterpriseGoals' => EnterpriseGoal::orderBy('name', 'asc')->lists('name', 'id'), 
        ]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Threat::$validationRules);
		$item = Threat::create($request->all());
		return view('threats.listPanel', ['item' => $item]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Threat::find($id);
		$data->ancestors = Threat::find($id)->getAncestorsAndSelf();

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Sub-threats", "model" => "threats"),
			array("label" => "Controlobjectives", "model" => "controlobjectives"),
			array("label" => "Assets", "model" => "assets"),
			array("label" => "Enterprise goals", "model" => "enterpriseGoals"),
			array("label" => "Processes", "model" => "processes")
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'threats/'.$id.'/edit'),
			array('label' => 'Delete', 'route' => 'threats/'.$id.'/destroy', 'target' => 'new' ),
		);

	    return view('generic.item', ['data' => $data, 'childModels' => $childModels, 'actions' => $actions]);
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
		Threat::destroy($id);
	}

}