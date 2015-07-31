<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;

use App\Deficiency;

class DeficienciesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Deficiency::all();
		return view('generic.index', ['data' => $data]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexImprovements($id)
	{
		$data = Deficiency::find($id)->Improvements;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexControlassesments($id)
	{
		$data = Deficiency::find($id)->Controlassesments;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Deficiency::create(Request::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//return Deficiency::find($id);
		$data = Deficiency::with(['owner'])->find($id);	

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Improvements", "model" => "improvements"),
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
		Deficiency::destroy($id);
	}

}
