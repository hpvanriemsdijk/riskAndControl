<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Controlassesment;

class ControlassesmentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Controlassesment::all();
		
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'controlassesments/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
	}

	/**
	 * Display a listing of the child controlobjectives.
	 *
	 * @return Response
	 */
	/*
	public function indexThreaths($id)
	{
		$data = Controlassesment::find($id)->threaths;
		return view('generic.list', ['data' => $data]);
	}	
	*/

	/**
	 * Display a listing of the child Deficiencies.
	 *
	 * @return Response
	 */
	public function indexDeficiencies($id)
	{
		$data = Controlassesment::find($id)->deficiencies;
		return view('generic.list', ['data' => $data]);
	}	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Controlassesment::create(Request::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Controlassesment::with(['auditor', 'auditee', 'approveer', 'controlactivity'])->find($id);

		//Child models, used for tabs
		$childModels = array(
			//array("label" => "Threaths", "model" => "threaths"),
			array("label" => "Deficiencies", "model" => "deficiencies", "active" => true)
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
		Controlassesment::destroy($id);
	}

}
