<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Asignaturas
        Gate::define('asignatura_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('asignatura_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('asignatura_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('asignatura_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('asignatura_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Unidades
        Gate::define('unidade_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('unidade_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('unidade_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('unidade_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('unidade_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Preguntas
        Gate::define('pregunta_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('pregunta_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('pregunta_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('pregunta_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('pregunta_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Opciones preguntas
        Gate::define('opciones_pregunta_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('opciones_pregunta_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('opciones_pregunta_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('opciones_pregunta_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('opciones_pregunta_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        // Auth gates for: Pruebas
        Gate::define('prueba_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('prueba_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('prueba_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('prueba_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('prueba_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

    }
}
