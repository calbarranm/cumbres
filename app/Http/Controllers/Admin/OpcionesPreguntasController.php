<?php

namespace App\Http\Controllers\Admin;

use App\OpcionesPregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOpcionesPreguntasRequest;
use App\Http\Requests\Admin\UpdateOpcionesPreguntasRequest;

class OpcionesPreguntasController extends Controller
{
    /**
     * Display a listing of OpcionesPregunta.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('opciones_pregunta_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('opciones_pregunta_delete')) {
                return abort(401);
            }
            $opciones_preguntas = OpcionesPregunta::onlyTrashed()->get();
        } else {
            $opciones_preguntas = OpcionesPregunta::all();
        }

        return view('admin.opciones_preguntas.index', compact('opciones_preguntas'));
    }

    /**
     * Show the form for creating new OpcionesPregunta.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('opciones_pregunta_create')) {
            return abort(401);
        }
        
        $preguntas = \App\Pregunta::get()->pluck('pregunta', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.opciones_preguntas.create', compact('preguntas'));
    }

    /**
     * Store a newly created OpcionesPregunta in storage.
     *
     * @param  \App\Http\Requests\StoreOpcionesPreguntasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOpcionesPreguntasRequest $request)
    {
        if (! Gate::allows('opciones_pregunta_create')) {
            return abort(401);
        }
        $opciones_pregunta = OpcionesPregunta::create($request->all());



        return redirect()->route('admin.opciones_preguntas.index');
    }


    /**
     * Show the form for editing OpcionesPregunta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('opciones_pregunta_edit')) {
            return abort(401);
        }
        
        $preguntas = \App\Pregunta::get()->pluck('pregunta', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $opciones_pregunta = OpcionesPregunta::findOrFail($id);

        return view('admin.opciones_preguntas.edit', compact('opciones_pregunta', 'preguntas'));
    }

    /**
     * Update OpcionesPregunta in storage.
     *
     * @param  \App\Http\Requests\UpdateOpcionesPreguntasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpcionesPreguntasRequest $request, $id)
    {
        if (! Gate::allows('opciones_pregunta_edit')) {
            return abort(401);
        }
        $opciones_pregunta = OpcionesPregunta::findOrFail($id);
        $opciones_pregunta->update($request->all());



        return redirect()->route('admin.opciones_preguntas.index');
    }


    /**
     * Display OpcionesPregunta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('opciones_pregunta_view')) {
            return abort(401);
        }
        $opciones_pregunta = OpcionesPregunta::findOrFail($id);

        return view('admin.opciones_preguntas.show', compact('opciones_pregunta'));
    }


    /**
     * Remove OpcionesPregunta from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('opciones_pregunta_delete')) {
            return abort(401);
        }
        $opciones_pregunta = OpcionesPregunta::findOrFail($id);
        $opciones_pregunta->delete();

        return redirect()->route('admin.opciones_preguntas.index');
    }

    /**
     * Delete all selected OpcionesPregunta at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('opciones_pregunta_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = OpcionesPregunta::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore OpcionesPregunta from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('opciones_pregunta_delete')) {
            return abort(401);
        }
        $opciones_pregunta = OpcionesPregunta::onlyTrashed()->findOrFail($id);
        $opciones_pregunta->restore();

        return redirect()->route('admin.opciones_preguntas.index');
    }

    /**
     * Permanently delete OpcionesPregunta from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('opciones_pregunta_delete')) {
            return abort(401);
        }
        $opciones_pregunta = OpcionesPregunta::onlyTrashed()->findOrFail($id);
        $opciones_pregunta->forceDelete();

        return redirect()->route('admin.opciones_preguntas.index');
    }
}
