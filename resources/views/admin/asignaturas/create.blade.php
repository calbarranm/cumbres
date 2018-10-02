@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.asignaturas.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.asignaturas.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('profesores', trans('quickadmin.asignaturas.fields.profesores').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-profesores">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-profesores">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('profesores[]', $profesores, old('profesores'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-profesores' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('profesores'))
                        <p class="help-block">
                            {{ $errors->first('profesores') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', trans('quickadmin.asignaturas.fields.nombre').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('slug', trans('quickadmin.asignaturas.fields.slug').'', ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('slug'))
                        <p class="help-block">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descripcion', trans('quickadmin.asignaturas.fields.descripcion').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('imagen_asignatura', trans('quickadmin.asignaturas.fields.imagen-asignatura').'', ['class' => 'control-label']) !!}
                    {!! Form::file('imagen_asignatura', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('imagen_asignatura_max_size', 2) !!}
                    {!! Form::hidden('imagen_asignatura_max_width', 4096) !!}
                    {!! Form::hidden('imagen_asignatura_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('imagen_asignatura'))
                        <p class="help-block">
                            {{ $errors->first('imagen_asignatura') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fecha_inicio', trans('quickadmin.asignaturas.fields.fecha-inicio').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fecha_inicio', old('fecha_inicio'), ['class' => 'form-control datetime', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fecha_inicio'))
                        <p class="help-block">
                            {{ $errors->first('fecha_inicio') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('activo', trans('quickadmin.asignaturas.fields.activo').'', ['class' => 'control-label']) !!}
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

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
    <script>
        $("#selectbtn-profesores").click(function(){
            $("#selectall-profesores > option").prop("selected","selected");
            $("#selectall-profesores").trigger("change");
        });
        $("#deselectbtn-profesores").click(function(){
            $("#selectall-profesores > option").prop("selected","");
            $("#selectall-profesores").trigger("change");
        });
    </script>
@stop