<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;

use App\Controlobjective;

class ControlobjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Controlobjective::all();

		$filter = array(
            'sortFields' => array(
                array('label' => 'Name', 'value' => 'name')
            ),
            'filterGroups' => array(
				array(
					'id' => 'active',
					'label' => 'Active',
					'items' => array(
						array('label' => 'yes ', 'value' => ".enabled"),
	            		array('label' => 'no', 'value' => ".disabled")
	            	)
				)        	
            ), 
        );
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'controlobjectives/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexControlframeworks($id)
	{
		$data = Controlobjective::find($id)->Controlframeworks;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexControlactivities($id)
	{
		$data = Controlobjective::find($id)->Controlactivities;
		return view('generic.list', ['data' => $data]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexThreats($id)
	{
		$data = Controlobjective::find($id)->Threats;
		return view('generic.list', ['data' => $data]);
	}

	/**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', []);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Controlobjective::$validationRules);
		$item = Controlobjective::create($request->all());
		return view('controlobjectives.listPanel', ['item' => $item]);
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
		$data = Controlobjective::find($id);	

		//Child models, used for tabs
		$childModels = array(
			array("label" => "Controlframeworks", "model" => "controlframeworks"),
			array("label" => "Controlactivities", "model" => "controlactivities", "active" => true),
			array("label" => "Threats", "model" => "threats")
		);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'controlobjectives/'.$id.'/edit'),
			array('label' => 'Delete', 'route' => 'controlobjectives/'.$id.'/destroy', 'target' => 'new' ),
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
		Controlobjective::destroy($id);
	}

}
