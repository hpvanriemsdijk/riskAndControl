<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'WelcomeController@index');
Route::get('/home', 'AppController@home');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*
 * CRUD routes
 */
Route::resource('assets', 'AssetsController');
Route::get('assets/{id}/assets', 'AssetsController@indexChildren');
Route::resource('assets.processes', 'AssetsController@indexProcesses');
Route::resource('assets.threats', 'AssetsController@indexThreats');
Route::resource('controlframeworks', 'ControlframeworksController');
Route::resource('controlframeworks.create', 'ControlframeworksController');
Route::get('controlframeworks/{id}/destroy', 'ControlframeworksController@destroy');
Route::resource('controlframeworks.controlobjectives', 'ControlframeworksController@indexControlobjectives');
Route::resource('controlobjectives', 'ControlobjectivesController');
Route::resource('controlobjectives.controlframeworks', 'ControlobjectivesController@indexControlframeworks');
Route::resource('controlobjectives.controlactivities', 'ControlobjectivesController@indexControlactivities');
Route::resource('controlobjectives.threats', 'ControlobjectivesController@indexThreats');
Route::resource('controlactivities', 'ControlactivitiesController');
Route::resource('controlactivities.controlobjectives', 'ControlactivitiesController@indexControlobjectives');
Route::resource('controlactivities.testsofcontrol', 'ControlactivitiesController@indexTestsofcontrol');
Route::resource('controlactivities.controlassesments', 'ControlactivitiesController@indexControlassesments');
Route::resource('controlassesments', 'ControlassesmentsController');
Route::resource('controlassesments.threaths', 'ControlassesmentsController@indexThreaths');
Route::resource('controlassesments.deficiencies', 'ControlassesmentsController@indexDeficiencies');
Route::resource('deficiencies', 'DeficienciesController');
Route::resource('deficiencies.improvements', 'DeficienciesController@indexImprovements');
Route::resource('deficiencies.controlassesments', 'DeficienciesController@indexControlassesments');
Route::resource('enterpriseGoals', 'EnterprisegoalsController');
Route::get('enterpriseGoals/{id}/enterpriseGoals', 'EnterprisegoalsController@indexChildren');
Route::resource('enterpriseGoals.threats', 'EnterprisegoalsController@indexThreats');
Route::resource('improvements', 'ImprovementsController');
Route::resource('improvements.deficiencies', 'ImprovementsController@indexDeficiencies');
Route::resource('processes', 'ProcessesController');
Route::get('processes/{id}/processes', 'ProcessesController@indexChildren');
Route::resource('processes.threats', 'ProcessesController@indexThreats');
Route::resource('processes.assets', 'ProcessesController@indexAssets');
Route::resource('roles', 'RolesController');
Route::resource('roles.owncontrolframeworks', 'RolesController@indexOwnControlframeworks');
Route::resource('roles.owncontrolactivities', 'RolesController@indexOwnControlactivities');
Route::resource('roles.owndeficiencies', 'RolesController@indexOwnDeficiencies');
Route::resource('roles.ownimprovements', 'RolesController@indexOwnImprovements');
Route::resource('roles.ownassets', 'RolesController@indexOwnAssets');
Route::resource('roles.maintainassets', 'RolesController@indexMaintainAssets');
Route::resource('roles.ownproccess', 'RolesController@indexOwnProccess');
Route::resource('roles.maintainprocess', 'RolesController@indexMaintainProcess');
Route::resource('roles.users', 'RolesController@indexUsers');
Route::resource('testsofcontrol', 'TestsofcontrolController');
Route::resource('threats', 'ThreatsController');
Route::get('threats/{id}/threats', 'ThreatsController@indexChildren');
Route::resource('threats.controlobjectives', 'ThreatsController@indexControlobjectives');
Route::resource('threats.assets', 'ThreatsController@indexAssets');
Route::resource('threats.enterpriseGoals', 'ThreatsController@indexenterprisegoals');
Route::resource('threats.processes', 'ThreatsController@indexProcesses');
Route::resource('users', 'UsersController');
Route::resource('users.roles', 'UsersController@indexRoles');

/*
 * Json routes
 *
Route::resource('api/assets', 'AssetsController', ['except' => ['create','edit']]);
Route::resource('api/attachments', 'AttachmentsController', ['except' => ['create','edit']]);
Route::resource('api/controlactivities', 'ControlactivitiesController', ['except' => ['create','edit']]);
Route::resource('api/controlassesments', 'ControlassesmentsController', ['except' => ['create','edit']]);
Route::resource('api/controlframeworks', 'ControlframeworksController', ['except' => ['create','edit']]);
Route::resource('api/controlframeworks.controlobjectives', 'ControlframeworksController@indexControlobjectives');
Route::resource('api/controlobjectives', 'ControlobjectivesController', ['except' => ['create','edit']]);
Route::resource('api/controlobjectives.controlframeworks', 'ControlobjectivesController@indexControlframeworks');
Route::resource('api/controlobjectives.controlactivities', 'ControlobjectivesController@indexControlactivities');
Route::resource('api/controlobjectives.threats', 'ControlobjectivesController@indexThreats');
Route::resource('api/deficiencies', 'DeficienciesController', ['except' => ['create','edit']]);
Route::resource('api/enterpriseGoals', 'EnterpriseGoalsController', ['except' => ['create','edit']]);
Route::resource('api/improvements', 'ImprovementsController', ['except' => ['create','edit']]);
Route::resource('api/processes', 'ProcessesController', ['except' => ['create','edit']]);
Route::resource('api/roles', 'RolesController', ['except' => ['create','edit']]);
Route::resource('api/testofcontrols', 'TestofcontrolsController', ['except' => ['create','edit']]);
Route::resource('api/threats', 'ThreatsController', ['except' => ['create','edit']]);
Route::resource('api/threatareas', 'ThreatareasController', ['except' => ['create','edit']]);
Route::resource('api/users', 'UsersController', ['except' => ['create','edit']]);
 */