@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.opciones-preguntas.title')</h3>
    
    {!! Form::model($opciones_pregunta, ['method' => 'PUT', 'route' => ['admin.opciones_preguntas.update', $opciones_pregunta->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pregunta_id', trans('quickadmin.opciones-preguntas.fields.pregunta').'', ['class' => 'control-label']) !!}
                    {!! Form::select('pregunta_id', $preguntas, old('pregunta_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pregunta_id'))
                        <p class="help-block">
                            {{ $errors->first('pregunta_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('texto_opcion', trans('quickadmin.opciones-preguntas.fields.texto-opcion').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('texto_opcion', old('texto_opcion'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('texto_opcion'))
                        <p class="help-block">
                            {{ $errors->first('texto_opcion') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('correcto', trans('quickadmin.opciones-preguntas.fields.correcto').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('correcto', 0) !!}
                    {!! Form::checkbox('correcto', 1, old('correcto', old('correcto')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('correcto'))
                        <p class="help-block">
                            {{ $errors->first('correcto') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

