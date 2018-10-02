@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pruebas.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.pruebas.fields.asignatura')</th>
                            <td field-key='asignatura'>{{ $prueba->asignatura->nombre ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pruebas.fields.asignaturas')</th>
                            <td field-key='asignaturas'>{{ $prueba->asignaturas->nombre ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pruebas.fields.titulo')</th>
                            <td field-key='titulo'>{!! $prueba->titulo !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pruebas.fields.descripcion')</th>
                            <td field-key='descripcion'>{!! $prueba->descripcion !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pruebas.fields.preguntas')</th>
                            <td field-key='preguntas'>
                                @foreach ($prueba->preguntas as $singlePreguntas)
                                    <span class="label label-info label-many">{{ $singlePreguntas->pregunta }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pruebas.fields.activo')</th>
                            <td field-key='activo'>{{ Form::checkbox("activo", 1, $prueba->activo == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.pruebas.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


