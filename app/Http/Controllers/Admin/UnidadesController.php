<?php

namespace App\Http\Controllers\Admin;

use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUnidadesRequest;
use App\Http\Requests\Admin\UpdateUnidadesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class UnidadesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Unidade.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('unidade_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('unidade_delete')) {
                return abort(401);
            }
            $unidades = Unidade::onlyTrashed()->get();
        } else {
            $unidades = Unidade::all();
        }

        return view('admin.unidades.index', compact('unidades'));
    }

    /**
     * Show the form for creating new Unidade.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('unidade_create')) {
            return abort(401);
        }
        
        $unidads = \App\Asignatura::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.unidades.create', compact('unidads'));
    }

    /**
     * Store a newly created Unidade in storage.
     *
     * @param  \App\Http\Requests\StoreUnidadesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnidadesRequest $request)
    {
        if (! Gate::allows('unidade_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $unidade = Unidade::create($request->all());


        foreach ($request->input('recursos_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $unidade->id;
            $file->save();
        }


        return redirect()->route('admin.unidades.index');
    }


    /**
     * Show the form for editing Unidade.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('unidade_edit')) {
            return abort(401);
        }
        
        $unidads = \App\Asignatura::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $unidade = Unidade::findOrFail($id);

        return view('admin.unidades.edit', compact('unidade', 'unidads'));
    }

    /**
     * Update Unidade in storage.
     *
     * @param  \App\Http\Requests\UpdateUnidadesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnidadesRequest $request, $id)
    {
        if (! Gate::allows('unidade_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $unidade = Unidade::findOrFail($id);
        $unidade->update($request->all());


        $media = [];
        foreach ($request->input('recursos_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $unidade->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $unidade->updateMedia($media, 'recursos');


        return redirect()->route('admin.unidades.index');
    }


    /**
     * Display Unidade.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('unidade_view')) {
            return abort(401);
        }
        $unidade = Unidade::findOrFail($id);

        return view('admin.unidades.show', compact('unidade'));
    }


    /**
     * Remove Unidade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('unidade_delete')) {
            return abort(401);
        }
        $unidade = Unidade::findOrFail($id);
        $unidade->deletePreservingMedia();

        return redirect()->route('admin.unidades.index');
    }

    /**
     * Delete all selected Unidade at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('unidade_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Unidade::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Unidade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('unidade_delete')) {
            return abort(401);
        }
        $unidade = Unidade::onlyTrashed()->findOrFail($id);
        $unidade->restore();

        return redirect()->route('admin.unidades.index');
    }

    /**
     * Permanently delete Unidade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('unidade_delete')) {
            return abort(401);
        }
        $unidade = Unidade::onlyTrashed()->findOrFail($id);
        $unidade->forceDelete();

        return redirect()->route('admin.unidades.index');
    }
}
