<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;

use App\Improvement;

class ImprovementsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Improvement::all();
		return view('generic.index', ['data' => $data]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexDeficiencies($id)
	{
		$data = Improvement::find($id)->Deficiencies;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Improvement::create(Request::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//return Improvement::find($id);
		$data = Improvement::with(['owner'])->find($id);

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Deficiencies", "model" => "deficiencies")
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
		Improvement::destroy($id);
	}

}
