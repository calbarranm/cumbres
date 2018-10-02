@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.preguntas.title')</h3>
    @can('pregunta_create')
    <p>
        <a href="{{ route('admin.preguntas.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('pregunta_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.preguntas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.preguntas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($preguntas) > 0 ? 'datatable' : '' }} @can('pregunta_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('pregunta_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.preguntas.fields.pregunta')</th>
                        <th>@lang('quickadmin.preguntas.fields.imagen-pregunta')</th>
                        <th>@lang('quickadmin.preguntas.fields.puntos')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($preguntas) > 0)
                        @foreach ($preguntas as $pregunta)
                            <tr data-entry-id="{{ $pregunta->id }}">
                                @can('pregunta_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='pregunta'>{!! $pregunta->pregunta !!}</td>
                                <td field-key='imagen_pregunta'>@if($pregunta->imagen_pregunta)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pregunta->imagen_pregunta) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $pregunta->imagen_pregunta) }}"/></a>@endif</td>
                                <td field-key='puntos'>{{ $pregunta->puntos }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('pregunta_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.preguntas.restore', $pregunta->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('pregunta_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.preguntas.perma_del', $pregunta->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('pregunta_view')
                                    <a href="{{ route('admin.preguntas.show',[$pregunta->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('pregunta_edit')
                                    <a href="{{ route('admin.preguntas.edit',[$pregunta->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('pregunta_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.preguntas.destroy', $pregunta->id])) !!}
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
        @can('pregunta_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.preguntas.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection