<?php

namespace App\Http\Controllers\Admin;

use App\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAsignaturasRequest;
use App\Http\Requests\Admin\UpdateAsignaturasRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class AsignaturasController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Asignatura.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('asignatura_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('asignatura_delete')) {
                return abort(401);
            }
            $asignaturas = Asignatura::onlyTrashed()->get();
        } else {
            $asignaturas = Asignatura::all();
        }

        return view('admin.asignaturas.index', compact('asignaturas'));
    }

    /**
     * Show the form for creating new Asignatura.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('asignatura_create')) {
            return abort(401);
        }
        
        $profesores = \App\User::get()->pluck('name', 'id');


        return view('admin.asignaturas.create', compact('profesores'));
    }

    /**
     * Store a newly created Asignatura in storage.
     *
     * @param  \App\Http\Requests\StoreAsignaturasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsignaturasRequest $request)
    {
        if (! Gate::allows('asignatura_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $asignatura = Asignatura::create($request->all());
        $asignatura->profesores()->sync(array_filter((array)$request->input('profesores')));



        return redirect()->route('admin.asignaturas.index');
    }


    /**
     * Show the form for editing Asignatura.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('asignatura_edit')) {
            return abort(401);
        }
        
        $profesores = \App\User::get()->pluck('name', 'id');


        $asignatura = Asignatura::findOrFail($id);

        return view('admin.asignaturas.edit', compact('asignatura', 'profesores'));
    }

    /**
     * Update Asignatura in storage.
     *
     * @param  \App\Http\Requests\UpdateAsignaturasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsignaturasRequest $request, $id)
    {
        if (! Gate::allows('asignatura_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->update($request->all());
        $asignatura->profesores()->sync(array_filter((array)$request->input('profesores')));



        return redirect()->route('admin.asignaturas.index');
    }


    /**
     * Display Asignatura.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('asignatura_view')) {
            return abort(401);
        }
        
        $profesores = \App\User::get()->pluck('name', 'id');
$unidades = \App\Unidade::where('unidad_id', $id)->get();$pruebas = \App\Prueba::where('asignatura_id', $id)->get();$pruebas = \App\Prueba::where('asignaturas_id', $id)->get();

        $asignatura = Asignatura::findOrFail($id);

        return view('admin.asignaturas.show', compact('asignatura', 'unidades', 'pruebas', 'pruebas'));
    }


    /**
     * Remove Asignatura from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('asignatura_delete')) {
            return abort(401);
        }
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->delete();

        return redirect()->route('admin.asignaturas.index');
    }

    /**
     * Delete all selected Asignatura at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('asignatura_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Asignatura::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Asignatura from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('asignatura_delete')) {
            return abort(401);
        }
        $asignatura = Asignatura::onlyTrashed()->findOrFail($id);
        $asignatura->restore();

        return redirect()->route('admin.asignaturas.index');
    }

    /**
     * Permanently delete Asignatura from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('asignatura_delete')) {
            return abort(401);
        }
        $asignatura = Asignatura::onlyTrashed()->findOrFail($id);
        $asignatura->forceDelete();

        return redirect()->route('admin.asignaturas.index');
    }
}
