@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.asignaturas.title')</h3>
    @can('asignatura_create')
    <p>
        <a href="{{ route('admin.asignaturas.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('asignatura_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.asignaturas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.asignaturas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($asignaturas) > 0 ? 'datatable' : '' }} @can('asignatura_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('asignatura_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('asignatura_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('asignatura_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.asignaturas.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection