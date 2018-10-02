<?php

namespace App\Http\Controllers\Admin;

use App\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePreguntasRequest;
use App\Http\Requests\Admin\UpdatePreguntasRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class PreguntasController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Pregunta.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('pregunta_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('pregunta_delete')) {
                return abort(401);
            }
            $preguntas = Pregunta::onlyTrashed()->get();
        } else {
            $preguntas = Pregunta::all();
        }

        return view('admin.preguntas.index', compact('preguntas'));
    }

    /**
     * Show the form for creating new Pregunta.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('pregunta_create')) {
            return abort(401);
        }
        return view('admin.preguntas.create');
    }

    /**
     * Store a newly created Pregunta in storage.
     *
     * @param  \App\Http\Requests\StorePreguntasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreguntasRequest $request)
    {
        if (! Gate::allows('pregunta_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $pregunta = Pregunta::create($request->all());



        return redirect()->route('admin.preguntas.index');
    }


    /**
     * Show the form for editing Pregunta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('pregunta_edit')) {
            return abort(401);
        }
        $pregunta = Pregunta::findOrFail($id);

        return view('admin.preguntas.edit', compact('pregunta'));
    }

    /**
     * Update Pregunta in storage.
     *
     * @param  \App\Http\Requests\UpdatePreguntasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreguntasRequest $request, $id)
    {
        if (! Gate::allows('pregunta_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update($request->all());



        return redirect()->route('admin.preguntas.index');
    }


    /**
     * Display Pregunta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('pregunta_view')) {
            return abort(401);
        }
        $opciones_preguntas = \App\OpcionesPregunta::where('pregunta_id', $id)->get();$pruebas = \App\Prueba::whereHas('preguntas',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $pregunta = Pregunta::findOrFail($id);

        return view('admin.preguntas.show', compact('pregunta', 'opciones_preguntas', 'pruebas'));
    }


    /**
     * Remove Pregunta from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('pregunta_delete')) {
            return abort(401);
        }
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->delete();

        return redirect()->route('admin.preguntas.index');
    }

    /**
     * Delete all selected Pregunta at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('pregunta_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Pregunta::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Pregunta from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('pregunta_delete')) {
            return abort(401);
        }
        $pregunta = Pregunta::onlyTrashed()->findOrFail($id);
        $pregunta->restore();

        return redirect()->route('admin.preguntas.index');
    }

    /**
     * Permanently delete Pregunta from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('pregunta_delete')) {
            return abort(401);
        }
        $pregunta = Pregunta::onlyTrashed()->findOrFail($id);
        $pregunta->forceDelete();

        return redirect()->route('admin.preguntas.index');
    }
}
