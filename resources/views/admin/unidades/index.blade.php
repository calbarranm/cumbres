@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.unidades.title')</h3>
    @can('unidade_create')
    <p>
        <a href="{{ route('admin.unidades.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('unidade_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.unidades.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.unidades.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($unidades) > 0 ? 'datatable' : '' }} @can('unidade_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('unidade_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.unidades.fields.unidad')</th>
                        <th>@lang('quickadmin.unidades.fields.nombre')</th>
                        <th>@lang('quickadmin.unidades.fields.slug')</th>
                        <th>@lang('quickadmin.unidades.fields.imagen-unidad')</th>
                        <th>@lang('quickadmin.unidades.fields.texto-corto')</th>
                        <th>@lang('quickadmin.unidades.fields.texto-largo')</th>
                        <th>@lang('quickadmin.unidades.fields.posicion')</th>
                        <th>@lang('quickadmin.unidades.fields.recursos')</th>
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
                                @can('unidade_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='unidad'>{{ $unidade->unidad->nombre ?? '' }}</td>
                                <td field-key='nombre'>{{ $unidade->nombre }}</td>
                                <td field-key='slug'>{{ $unidade->slug }}</td>
                                <td field-key='imagen_unidad'>@if($unidade->imagen_unidad)<a href="{{ asset(env('UPLOAD_PATH').'/' . $unidade->imagen_unidad) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $unidade->imagen_unidad) }}"/></a>@endif</td>
                                <td field-key='texto_corto'>{!! $unidade->texto_corto !!}</td>
                                <td field-key='texto_largo'>{!! $unidade->texto_largo !!}</td>
                                <td field-key='posicion'>{{ $unidade->posicion }}</td>
                                <td field-key='recursos'> @foreach($unidade->getMedia('recursos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
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
    </div>
@stop

@section('javascript') 
    <script>
        @can('unidade_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.unidades.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection