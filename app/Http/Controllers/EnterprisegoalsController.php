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
		return view('generic.index', ['data' => $data]);
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return EnterpriseGoal::create(Request::all());
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
		EnterpriseGoal::destroy($id);
	}

}
