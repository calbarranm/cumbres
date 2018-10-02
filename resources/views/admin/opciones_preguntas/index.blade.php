@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.opciones-preguntas.title')</h3>
    @can('opciones_pregunta_create')
    <p>
        <a href="{{ route('admin.opciones_preguntas.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('opciones_pregunta_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.opciones_preguntas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.opciones_preguntas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($opciones_preguntas) > 0 ? 'datatable' : '' }} @can('opciones_pregunta_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('opciones_pregunta_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('opciones_pregunta_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('opciones_pregunta_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.opciones_preguntas.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection