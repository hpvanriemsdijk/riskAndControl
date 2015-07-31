<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use App\Controlactivity;

class ControlactivitiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Controlactivity::all();
		return view('generic.index', ['data' => $data]);
	}

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexControlobjectives($id)
	{
		$data = Controlactivity::find($id)->controlobjectives;
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexTestsofcontrol($id)
	{
		$data = Controlactivity::find($id)->testsofcontrol;
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	public function indexControlassesments($id)
	{
		$data = Controlactivity::find($id)->controlassesments;
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Controlactivity::create(Request::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Controlactivity::with(['owner'])->find($id);

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Control objectives", "model" => "controlobjectives"),
			array("label" => "Tests of control", "model" => "testsofcontrol"),
			array("label" => "Control assesments", "model" => "controlassesments", "active" => true),
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
		Controlactivity::destroy($id);
	}

}
