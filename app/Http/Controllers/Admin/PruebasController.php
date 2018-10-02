<?php

namespace App\Http\Controllers\Admin;

use App\Prueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePruebasRequest;
use App\Http\Requests\Admin\UpdatePruebasRequest;

class PruebasController extends Controller
{
    /**
     * Display a listing of Prueba.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('prueba_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('prueba_delete')) {
                return abort(401);
            }
            $pruebas = Prueba::onlyTrashed()->get();
        } else {
            $pruebas = Prueba::all();
        }

        return view('admin.pruebas.index', compact('pruebas'));
    }

    /**
     * Show the form for creating new Prueba.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('prueba_create')) {
            return abort(401);
        }
        
        $asignaturas = \App\Asignatura::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $asignaturas = \App\Asignatura::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $preguntas = \App\Pregunta::get()->pluck('pregunta', 'id');


        return view('admin.pruebas.create', compact('asignaturas', 'asignaturas', 'preguntas'));
    }

    /**
     * Store a newly created Prueba in storage.
     *
     * @param  \App\Http\Requests\StorePruebasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePruebasRequest $request)
    {
        if (! Gate::allows('prueba_create')) {
            return abort(401);
        }
        $prueba = Prueba::create($request->all());
        $prueba->preguntas()->sync(array_filter((array)$request->input('preguntas')));



        return redirect()->route('admin.pruebas.index');
    }


    /**
     * Show the form for editing Prueba.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('prueba_edit')) {
            return abort(401);
        }
        
        $asignaturas = \App\Asignatura::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $asignaturas = \App\Asignatura::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $preguntas = \App\Pregunta::get()->pluck('pregunta', 'id');


        $prueba = Prueba::findOrFail($id);

        return view('admin.pruebas.edit', compact('prueba', 'asignaturas', 'asignaturas', 'preguntas'));
    }

    /**
     * Update Prueba in storage.
     *
     * @param  \App\Http\Requests\UpdatePruebasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePruebasRequest $request, $id)
    {
        if (! Gate::allows('prueba_edit')) {
            return abort(401);
        }
        $prueba = Prueba::findOrFail($id);
        $prueba->update($request->all());
        $prueba->preguntas()->sync(array_filter((array)$request->input('preguntas')));



        return redirect()->route('admin.pruebas.index');
    }


    /**
     * Display Prueba.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('prueba_view')) {
            return abort(401);
        }
        $prueba = Prueba::findOrFail($id);

        return view('admin.pruebas.show', compact('prueba'));
    }


    /**
     * Remove Prueba from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('prueba_delete')) {
            return abort(401);
        }
        $prueba = Prueba::findOrFail($id);
        $prueba->delete();

        return redirect()->route('admin.pruebas.index');
    }

    /**
     * Delete all selected Prueba at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('prueba_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Prueba::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Prueba from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('prueba_delete')) {
            return abort(401);
        }
        $prueba = Prueba::onlyTrashed()->findOrFail($id);
        $prueba->restore();

        return redirect()->route('admin.pruebas.index');
    }

    /**
     * Permanently delete Prueba from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('prueba_delete')) {
            return abort(401);
        }
        $prueba = Prueba::onlyTrashed()->findOrFail($id);
        $prueba->forceDelete();

        return redirect()->route('admin.pruebas.index');
    }
}
