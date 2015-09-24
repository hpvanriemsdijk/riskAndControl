<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\EnterpriseGoal;

class EnterpriseGoalsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = EnterpriseGoal::all()->toHierarchy();
		
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'enterpriseGoals/create', 'target' => '')
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
		$data = EnterpriseGoal::find($id)->getDescendants(1);
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexThreats($id)
	{
		$data = EnterpriseGoal::find($id)->Threats;
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
        		'controlDimentions' => EnterpriseGoal::$controlDimentions
        	]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, EnterpriseGoal::$validationRules);
		$item = EnterpriseGoal::create($request->all());
		return view('enterpriseGoals.listPanel', ['item' => $item]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//return Controlobjective::with(['controlframeworks', 'controlactivities', 'threats'])->find($id);
		$data = EnterpriseGoal::find($id);	

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Sub-goals", "model" => "enterpriseGoals"),
			array("label" => "Threats", "model" => "threats")
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'enterpriseGoals/'.$id.'/edit'),
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
		$data = EnterpriseGoal::find($id);

		return view('generic.create', [
				'data' => $data,
	        	'controlDimentions' => EnterpriseGoal::$controlDimentions
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
		$enterpriseGoal = EnterpriseGoal::findOrFail($id);
		$this->validate($request, EnterpriseGoal::$validationRules);
		$input = $request->all();
    	$enterpriseGoal->fill($input)->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		EnterpriseGoal::destroy($id);
	}

}
