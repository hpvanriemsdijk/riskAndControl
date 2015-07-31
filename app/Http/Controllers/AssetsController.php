<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use App\Asset;

class AssetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Asset::all()->toHierarchy();
		return view('generic.index', ['data' => $data]);
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
	}	/**
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Asset::create(Request::all());
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
		Asset::destroy($id);
	}

}
