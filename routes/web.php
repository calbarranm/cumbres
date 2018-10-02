<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('asignaturas', 'Admin\AsignaturasController');
    Route::post('asignaturas_mass_destroy', ['uses' => 'Admin\AsignaturasController@massDestroy', 'as' => 'asignaturas.mass_destroy']);
    Route::post('asignaturas_restore/{id}', ['uses' => 'Admin\AsignaturasController@restore', 'as' => 'asignaturas.restore']);
    Route::delete('asignaturas_perma_del/{id}', ['uses' => 'Admin\AsignaturasController@perma_del', 'as' => 'asignaturas.perma_del']);
    Route::resource('unidades', 'Admin\UnidadesController');
    Route::post('unidades_mass_destroy', ['uses' => 'Admin\UnidadesController@massDestroy', 'as' => 'unidades.mass_destroy']);
    Route::post('unidades_restore/{id}', ['uses' => 'Admin\UnidadesController@restore', 'as' => 'unidades.restore']);
    Route::delete('unidades_perma_del/{id}', ['uses' => 'Admin\UnidadesController@perma_del', 'as' => 'unidades.perma_del']);
    Route::resource('preguntas', 'Admin\PreguntasController');
    Route::post('preguntas_mass_destroy', ['uses' => 'Admin\PreguntasController@massDestroy', 'as' => 'preguntas.mass_destroy']);
    Route::post('preguntas_restore/{id}', ['uses' => 'Admin\PreguntasController@restore', 'as' => 'preguntas.restore']);
    Route::delete('preguntas_perma_del/{id}', ['uses' => 'Admin\PreguntasController@perma_del', 'as' => 'preguntas.perma_del']);
    Route::resource('opciones_preguntas', 'Admin\OpcionesPreguntasController');
    Route::post('opciones_preguntas_mass_destroy', ['uses' => 'Admin\OpcionesPreguntasController@massDestroy', 'as' => 'opciones_preguntas.mass_destroy']);
    Route::post('opciones_preguntas_restore/{id}', ['uses' => 'Admin\OpcionesPreguntasController@restore', 'as' => 'opciones_preguntas.restore']);
    Route::delete('opciones_preguntas_perma_del/{id}', ['uses' => 'Admin\OpcionesPreguntasController@perma_del', 'as' => 'opciones_preguntas.perma_del']);
    Route::resource('pruebas', 'Admin\PruebasController');
    Route::post('pruebas_mass_destroy', ['uses' => 'Admin\PruebasController@massDestroy', 'as' => 'pruebas.mass_destroy']);
    Route::post('pruebas_restore/{id}', ['uses' => 'Admin\PruebasController@restore', 'as' => 'pruebas.restore']);
    Route::delete('pruebas_perma_del/{id}', ['uses' => 'Admin\PruebasController@perma_del', 'as' => 'pruebas.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');



 
});
