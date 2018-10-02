@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.preguntas.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.preguntas.fields.pregunta')</th>
                            <td field-key='pregunta'>{!! $pregunta->pregunta !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.preguntas.fields.imagen-pregunta')</th>
                            <td field-key='imagen_pregunta'>@if($pregunta->imagen_pregunta)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pregunta->imagen_pregunta) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $pregunta->imagen_pregunta) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.preguntas.fields.puntos')</th>
                            <td field-key='puntos'>{{ $pregunta->puntos }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#opciones_preguntas" aria-controls="opciones_preguntas" role="tab" data-toggle="tab">Opciones preguntas</a></li>
<li role="presentation" class=""><a href="#pruebas" aria-controls="pruebas" role="tab" data-toggle="tab">Pruebas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="opciones_preguntas">
<table class="table table-bordered table-striped {{ count($opciones_preguntas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.opciones-preguntas.fields.pregunta')</th>
                        <th>@lang('quickadmin.opciones-preguntas.fields.texto-opcion')</th>
                        <th>@lang('quickadmin.opciones-preguntas.fields.correcto')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($opciones_preguntas) > 0)
            @foreach ($opciones_preguntas as $opciones_pregunta)
                <tr data-entry-id="{{ $opciones_pregunta->id }}">
                    <td field-key='pregunta'>{{ $opciones_pregunta->pregunta->pregunta ?? '' }}</td>
                                <td field-key='texto_opcion'>{!! $opciones_pregunta->texto_opcion !!}</td>
                                <td field-key='correcto'>{{ Form::checkbox("correcto", 1, $opciones_pregunta->correcto == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('opciones_pregunta_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.opciones_preguntas.restore', $opciones_pregunta->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('opciones_pregunta_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.opciones_preguntas.perma_del', $opciones_pregunta->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('opciones_pregunta_view')
                                    <a href="{{ route('admin.opciones_preguntas.show',[$opciones_pregunta->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('opciones_pregunta_edit')
                                    <a href="{{ route('admin.opciones_preguntas.edit',[$opciones_pregunta->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('opciones_pregunta_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.opciones_preguntas.destroy', $opciones_pregunta->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="pruebas">
<table class="table table-bordered table-striped {{ count($pruebas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.pruebas.fields.asignatura')</th>
                        <th>@lang('quickadmin.pruebas.fields.asignaturas')</th>
                        <th>@lang('quickadmin.pruebas.fields.titulo')</th>
                        <th>@lang('quickadmin.pruebas.fields.descripcion')</th>
                        <th>@lang('quickadmin.pruebas.fields.preguntas')</th>
                        <th>@lang('quickadmin.pruebas.fields.activo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($pruebas) > 0)
            @foreach ($pruebas as $prueba)
                <tr data-entry-id="{{ $prueba->id }}">
                    <td field-key='asignatura'>{{ $prueba->asignatura->nombre ?? '' }}</td>
                                <td field-key='asignaturas'>{{ $prueba->asignaturas->nombre ?? '' }}</td>
                                <td field-key='titulo'>{!! $prueba->titulo !!}</td>
                                <td field-key='descripcion'>{!! $prueba->descripcion !!}</td>
                                <td field-key='preguntas'>
                                    @foreach ($prueba->preguntas as $singlePreguntas)
                                        <span class="label label-info label-many">{{ $singlePreguntas->pregunta }}</span>
                                    @endforeach
                                </td>
                                <td field-key='activo'>{{ Form::checkbox("activo", 1, $prueba->activo == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('prueba_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.pruebas.restore', $prueba->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('prueba_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.pruebas.perma_del', $prueba->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('prueba_view')
                                    <a href="{{ route('admin.pruebas.show',[$prueba->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('prueba_edit')
                                    <a href="{{ route('admin.pruebas.edit',[$prueba->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('prueba_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.pruebas.destroy', $prueba->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.preguntas.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


