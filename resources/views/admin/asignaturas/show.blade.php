@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.asignaturas.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.profesores')</th>
                            <td field-key='profesores'>
                                @foreach ($asignatura->profesores as $singleProfesores)
                                    <span class="label label-info label-many">{{ $singleProfesores->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.nombre')</th>
                            <td field-key='nombre'>{{ $asignatura->nombre }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.slug')</th>
                            <td field-key='slug'>{{ $asignatura->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.descripcion')</th>
                            <td field-key='descripcion'>{!! $asignatura->descripcion !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.imagen-asignatura')</th>
                            <td field-key='imagen_asignatura'>@if($asignatura->imagen_asignatura)<a href="{{ asset(env('UPLOAD_PATH').'/' . $asignatura->imagen_asignatura) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $asignatura->imagen_asignatura) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.fecha-inicio')</th>
                            <td field-key='fecha_inicio'>{{ $asignatura->fecha_inicio }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.asignaturas.fields.activo')</th>
                            <td field-key='activo'>{{ Form::checkbox("activo", 1, $asignatura->activo == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#unidades" aria-controls="unidades" role="tab" data-toggle="tab">Unidades</a></li>
<li role="presentation" class=""><a href="#pruebas" aria-controls="pruebas" role="tab" data-toggle="tab">Pruebas</a></li>
<li role="presentation" class=""><a href="#pruebas" aria-controls="pruebas" role="tab" data-toggle="tab">Pruebas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="unidades">
<table class="table table-bordered table-striped {{ count($unidades) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.unidades.fields.unidad')</th>
                        <th>@lang('quickadmin.unidades.fields.nombre')</th>
                        <th>@lang('quickadmin.unidades.fields.slug')</th>
                        <th>@lang('quickadmin.unidades.fields.imagen-unidad')</th>
                        <th>@lang('quickadmin.unidades.fields.texto-corto')</th>
                        <th>@lang('quickadmin.unidades.fields.texto-largo')</th>
                        <th>@lang('quickadmin.unidades.fields.posicion')</th>
                        <th>@lang('quickadmin.unidades.fields.activo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($unidades) > 0)
            @foreach ($unidades as $unidade)
                <tr data-entry-id="{{ $unidade->id }}">
                    <td field-key='unidad'>{{ $unidade->unidad->nombre ?? '' }}</td>
                                <td field-key='nombre'>{{ $unidade->nombre }}</td>
                                <td field-key='slug'>{{ $unidade->slug }}</td>
                                <td field-key='imagen_unidad'>@if($unidade->imagen_unidad)<a href="{{ asset(env('UPLOAD_PATH').'/' . $unidade->imagen_unidad) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $unidade->imagen_unidad) }}"/></a>@endif</td>
                                <td field-key='texto_corto'>{!! $unidade->texto_corto !!}</td>
                                <td field-key='texto_largo'>{!! $unidade->texto_largo !!}</td>
                                <td field-key='posicion'>{{ $unidade->posicion }}</td>
                                <td field-key='recursos'>@if($unidade->recursos)<a href="{{ asset(env('UPLOAD_PATH').'/' . $unidade->recursos) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='activo'>{{ Form::checkbox("activo", 1, $unidade->activo == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('unidade_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.unidades.restore', $unidade->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('unidade_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.unidades.perma_del', $unidade->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('unidade_view')
                                    <a href="{{ route('admin.unidades.show',[$unidade->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('unidade_edit')
                                    <a href="{{ route('admin.unidades.edit',[$unidade->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('unidade_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.unidades.destroy', $unidade->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('quickadmin.qa_no_entries_in_table')</td>
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

            <a href="{{ route('admin.asignaturas.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
