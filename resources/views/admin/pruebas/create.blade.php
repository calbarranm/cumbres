@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pruebas.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.pruebas.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('asignatura_id', trans('quickadmin.pruebas.fields.asignatura').'', ['class' => 'control-label']) !!}
                    {!! Form::select('asignatura_id', $asignaturas, old('asignatura_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('asignatura_id'))
                        <p class="help-block">
                            {{ $errors->first('asignatura_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('asignaturas_id', trans('quickadmin.pruebas.fields.asignaturas').'', ['class' => 'control-label']) !!}
                    {!! Form::select('asignaturas_id', $asignaturas, old('asignaturas_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('asignaturas_id'))
                        <p class="help-block">
                            {{ $errors->first('asignaturas_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('titulo', trans('quickadmin.pruebas.fields.titulo').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('titulo', old('titulo'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('titulo'))
                        <p class="help-block">
                            {{ $errors->first('titulo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descripcion', trans('quickadmin.pruebas.fields.descripcion').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descripcion', old('descripcion'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('preguntas', trans('quickadmin.pruebas.fields.preguntas').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-preguntas">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-preguntas">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('preguntas[]', $preguntas, old('preguntas'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-preguntas' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('preguntas'))
                        <p class="help-block">
                            {{ $errors->first('preguntas') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('activo', trans('quickadmin.pruebas.fields.activo').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('activo', 0) !!}
                    {!! Form::checkbox('activo', 1, old('activo', false), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('activo'))
                        <p class="help-block">
                            {{ $errors->first('activo') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-preguntas").click(function(){
            $("#selectall-preguntas > option").prop("selected","selected");
            $("#selectall-preguntas").trigger("change");
        });
        $("#deselectbtn-preguntas").click(function(){
            $("#selectall-preguntas > option").prop("selected","");
            $("#selectall-preguntas").trigger("change");
        });
    </script>
@stop