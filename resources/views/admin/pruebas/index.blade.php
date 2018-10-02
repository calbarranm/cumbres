@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pruebas.title')</h3>
    @can('prueba_create')
    <p>
        <a href="{{ route('admin.pruebas.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('prueba_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.pruebas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.pruebas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pruebas) > 0 ? 'datatable' : '' }} @can('prueba_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('prueba_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('prueba_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('prueba_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.pruebas.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection