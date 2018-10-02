@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#asignaturas" aria-controls="asignaturas" role="tab" data-toggle="tab">Asignaturas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="asignaturas">
<table class="table table-bordered table-striped {{ count($asignaturas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.asignaturas.fields.profesores')</th>
                        <th>@lang('quickadmin.asignaturas.fields.nombre')</th>
                        <th>@lang('quickadmin.asignaturas.fields.slug')</th>
                        <th>@lang('quickadmin.asignaturas.fields.descripcion')</th>
                        <th>@lang('quickadmin.asignaturas.fields.imagen-asignatura')</th>
                        <th>@lang('quickadmin.asignaturas.fields.fecha-inicio')</th>
                        <th>@lang('quickadmin.asignaturas.fields.activo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($asignaturas) > 0)
            @foreach ($asignaturas as $asignatura)
                <tr data-entry-id="{{ $asignatura->id }}">
                    <td field-key='profesores'>
                                    @foreach ($asignatura->profesores as $singleProfesores)
                                        <span class="label label-info label-many">{{ $singleProfesores->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='nombre'>{{ $asignatura->nombre }}</td>
                                <td field-key='slug'>{{ $asignatura->slug }}</td>
                                <td field-key='descripcion'>{!! $asignatura->descripcion !!}</td>
                                <td field-key='imagen_asignatura'>@if($asignatura->imagen_asignatura)<a href="{{ asset(env('UPLOAD_PATH').'/' . $asignatura->imagen_asignatura) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $asignatura->imagen_asignatura) }}"/></a>@endif</td>
                                <td field-key='fecha_inicio'>{{ $asignatura->fecha_inicio }}</td>
                                <td field-key='activo'>{{ Form::checkbox("activo", 1, $asignatura->activo == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('asignatura_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.asignaturas.restore', $asignatura->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('asignatura_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.asignaturas.perma_del', $asignatura->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('asignatura_view')
                                    <a href="{{ route('admin.asignaturas.show',[$asignatura->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('asignatura_edit')
                                    <a href="{{ route('admin.asignaturas.edit',[$asignatura->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('asignatura_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.asignaturas.destroy', $asignatura->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


