@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.preguntas.title')</h3>
    
    {!! Form::model($pregunta, ['method' => 'PUT', 'route' => ['admin.preguntas.update', $pregunta->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
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
                    @if ($pregunta->imagen_pregunta)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$pregunta->imagen_pregunta) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$pregunta->imagen_pregunta) }}"></a>
                    @endif
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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

