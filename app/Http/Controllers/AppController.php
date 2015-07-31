<?php namespace App\Http\Controllers;

class AppController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function home()
	{
		$data = array(
			(object)["label" => "Enterprise Goals", "route" => "enterpriseGoals", "class" => "Company"],
			(object)["label" => "Roles", "route" => "roles", "class" => "Company"],
			(object)["label" => "Processes", "route" => "processes", "class" => "Company"],
			(object)["label" => "Assets", "route" => "assets", "class" => "Company"],
			(object)["label" => "Controlassesments", "route" => "controlassesments", "class" => "Governance"],
			(object)["label" => "Controlframeworks", "route" => "controlframeworks", "class" => "Governance"],
			(object)["label" => "Controlobjectives", "route" => "controlobjectives", "class" => "Governance"],
			(object)["label" => "Controlactivities", "route" => "controlactivities", "class" => "Governance"],
			(object)["label" => "Threats", "route" => "threats", "class" => "Risk management"],
			(object)["label" => "Deficiencies", "route" => "deficiencies", "class" => "Governance"],
			(object)["label" => "Improvements", "route" => "improvements", "class" => "Governance"],
			(object)["label" => "Tests of control", "route" => "testsofcontrol", "class" => "Governance"],
			(object)["label" => "Users", "route" => "users", "class" => "Company"],				
		);

        $filter = array(
            'sortFields' => array(
                array('label' => 'Name', 'value' => 'name')
            )
        );

		return view('generic.index', ['data' => $data, 'filter' => $filter]);
			}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function control()
	{
		return view('controlApp');
	}

}
