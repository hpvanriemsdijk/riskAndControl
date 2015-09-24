<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Controlactivity;
use App\Role;

class ControlactivitiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Controlactivity::all();

		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'controlactivities/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
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
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
        		'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
        		'performFrequencies' => Controlactivity::$performFrequencies,
        		'controlTypes' => Controlactivity::$controlTypes,
        		'controlExecution' => Controlactivity::$controlExecution,
        		'implementationStatus' => Controlactivity::$implementationStatus
			]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Controlactivity::$validationRules);
		$item = Controlactivity::create($request->all());
		return view('controlactivities.listPanel', ['item' => $item]);
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

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'controlactivities/'.$id.'/edit'),
			array('label' => 'Delete', 'action' => 'deleteItem('.$id.')'),
		);

	    return view('generic.item', ['data' => $data, 'childModels' => $childModels, 'actions' => $actions]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Controlactivity::find($id);

		return view('generic.create', [
				'data' => $data,
        		'roles' => Role::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'),
        		'performFrequencies' => Controlactivity::$performFrequencies,
        		'controlTypes' => Controlactivity::$controlTypes,
        		'controlExecution' => Controlactivity::$controlExecution,
        		'implementationStatus' => Controlactivity::$implementationStatus
			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$controlactivity = Controlactivity::findOrFail($id);
		$this->validate($request, Controlactivity::$validationRules);
		$input = $request->all();
    	$controlactivity->fill($input)->save();
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
