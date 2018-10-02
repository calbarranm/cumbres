@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.unidades.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.unidad')</th>
                            <td field-key='unidad'>{{ $unidade->unidad->nombre ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.nombre')</th>
                            <td field-key='nombre'>{{ $unidade->nombre }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.slug')</th>
                            <td field-key='slug'>{{ $unidade->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.imagen-unidad')</th>
                            <td field-key='imagen_unidad'>@if($unidade->imagen_unidad)<a href="{{ asset(env('UPLOAD_PATH').'/' . $unidade->imagen_unidad) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $unidade->imagen_unidad) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.texto-corto')</th>
                            <td field-key='texto_corto'>{!! $unidade->texto_corto !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.texto-largo')</th>
                            <td field-key='texto_largo'>{!! $unidade->texto_largo !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.posicion')</th>
                            <td field-key='posicion'>{{ $unidade->posicion }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.recursos')</th>
                            <td field-key='recursos's> @foreach($unidade->getMedia('recursos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.unidades.fields.activo')</th>
                            <td field-key='activo'>{{ Form::checkbox("activo", 1, $unidade->activo == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.unidades.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
