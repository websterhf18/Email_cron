<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function showArchivosbyCarrera($id){
		/*$archivos = DB::table('archivos')->count();
		$materias = DB::table('pensumpersonal')->count();
		SELECT , archivos.locate FROM archivos INNER JOIN pensumpersonal ON archivos.carpetas_materias_id = pensumpersonal.materias_id WHERE pensumpersonal.programas_id= 7457
		'http://duis.dev/archivo/623'*/
		$archivos = DB::table('archivos')
            ->join('pensumpersonal', 'archivos.carpetas_materias_id', '=', 'pensumpersonal.materias_id')
            ->where('pensumpersonal.programas_id', '=', $id)
            ->whereBetween('archivos.updated_at', array('2015-11-16', '2016-01-13'))
            ->select('archivos.id', 'archivos.nombre')
            ->get();
        return $archivos;
	}
	public function showUsersEmailbyCarrera($id){
		$users = DB::table('users')
            ->where('users.programas_id', '=', $id)
            ->select('users.id', 'users.email', 'users.nombre')
            ->get();
        return $users;
	}
	public function showWelcome()
	{
		$archivos = $this->showArchivosbyCarrera('7457');
		$usuarios = $this->showUsersEmailbyCarrera('7457');

        return View::make('hello', ['archivos' => $archivos,'usuarios' => $usuarios]);
		//return View::make('hello');
	}
	public function sendPromo(){
		$archivos = $this->showArchivosbyCarrera('7496');
		//return View::make('email', ['archivos' => $archivos]);
		Mail::send('email', array('archivos' => $archivos), function($message)
		{
		    $message->to('hfgarcia3@misena.edu.co', 'Hugo garcia')->subject('Promo duis');
		});
	}


}
