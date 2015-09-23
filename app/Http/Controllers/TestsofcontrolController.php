<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Testofcontrol;
use App\Controlactivity;

class TestsofcontrolController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Testofcontrol::all();
				
		//Filter settings
		$filter = array();
	
		//Menu actions
		$actions = array(
			array('label' => 'add', 'route' => 'testsofcontrol/create', 'target' => '')
		);

		return view('generic.index', ['data' => $data, 'filter' => $filter, 'actions' => $actions]);
	}

	/**
     * Show the form for creating a new controlframework.
     *
     * @return Response
     */
    public function create()
    {
        return view('generic.create', [
        		'controlactivities' => Controlactivity::where('active', '=', 1)->orderBy('name', 'asc')->lists('name', 'id'), 
        	]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, Testofcontrol::$validationRules);
		$item = Testofcontrol::create($request->all());
		return view('testofcontrols.listPanel', ['item' => $item]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Testofcontrol::with(['controlactivity'])->find($id);

		//Menu actions
		$actions = array(
			array('label' => 'Edit', 'route' => 'assets/'.$id.'/edit'),
			array('label' => 'Delete', 'route' => 'assets/'.$id.'/destroy', 'target' => 'new' ),
		);

	    return view('generic.item', ['data' => $data, 'actions' => $actions]);
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
		Testofcontrol::destroy($id);
	}

}
