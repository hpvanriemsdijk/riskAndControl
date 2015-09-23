<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Controlassesment;
use App\Controlactivity;
use App\User;

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
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
    		'controlactivities' => Controlactivity::orderBy('name', 'asc')->lists('name', 'id'), 
    		'users' => User::orderBy('name', 'asc')->lists('name', 'id'),
    		'conclusions' => Controlassesment::$conclusionTypes
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
		$data = Controlassesment::with(['auditor', 'auditee', 'approveer', 'controlactivity'])->find($id);

		//Child models, used for tabs
		$childModels = array(
			//array("label" => "Threaths", "model" => "threaths"),
			array("label" => "Deficiencies", "model" => "deficiencies", "active" => true)
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'controlassesments/'.$id.'/edit'),
			array('label' => 'Delete', 'route' => 'controlassesments/'.$id.'/destroy', 'target' => 'new' ),
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
		Controlassesment::destroy($id);
	}

}
