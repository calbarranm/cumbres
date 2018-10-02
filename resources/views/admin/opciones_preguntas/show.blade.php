@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.opciones-preguntas.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.opciones-preguntas.fields.pregunta')</th>
                            <td field-key='pregunta'>{{ $opciones_pregunta->pregunta->pregunta ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.opciones-preguntas.fields.texto-opcion')</th>
                            <td field-key='texto_opcion'>{!! $opciones_pregunta->texto_opcion !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.opciones-preguntas.fields.correcto')</th>
                            <td field-key='correcto'>{{ Form::checkbox("correcto", 1, $opciones_pregunta->correcto == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.opciones_preguntas.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


