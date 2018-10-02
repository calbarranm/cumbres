@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.preguntas.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.preguntas.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pregunta', trans('quickadmin.preguntas.fields.pregunta').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('pregunta', old('pregunta'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pregunta'))
                        <p class="help-block">
                            {{ $errors->first('pregunta') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('imagen_pregunta', trans('quickadmin.preguntas.fields.imagen-pregunta').'', ['class' => 'control-label']) !!}
                    {!! Form::file('imagen_pregunta', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('imagen_pregunta_max_size', 2) !!}
                    {!! Form::hidden('imagen_pregunta_max_width', 4096) !!}
                    {!! Form::hidden('imagen_pregunta_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('imagen_pregunta'))
                        <p class="help-block">
                            {{ $errors->first('imagen_pregunta') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('puntos', trans('quickadmin.preguntas.fields.puntos').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('puntos', old('puntos'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('puntos'))
                        <p class="help-block">
                            {{ $errors->first('puntos') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

