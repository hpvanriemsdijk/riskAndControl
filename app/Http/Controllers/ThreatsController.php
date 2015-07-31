<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Threat;

class ThreatsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Threat::all();
		return view('generic.index', ['data' => $data]);
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Threat::create(Request::all());
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
		Threat::destroy($id);
	}

}