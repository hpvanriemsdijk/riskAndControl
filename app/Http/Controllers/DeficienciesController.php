<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;

use App\Deficiency;
use App\Controlassesments;
use App\Role;

class DeficienciesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Deficiency::all();
			
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'deficiencies/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
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
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
        		'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
			]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Deficiency::$validationRules);
		$item = Deficiency::create($request->all());
		return view('deficiencies.listPanel', ['item' => $item]);
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

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'deficiencies/'.$id.'/edit'),
			array('label' => 'Delete', 'route' => 'deficiencies/'.$id.'/destroy', 'target' => 'new' ),
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
		Deficiency::destroy($id);
	}

}
