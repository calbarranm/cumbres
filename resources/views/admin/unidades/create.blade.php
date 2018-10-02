@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.unidades.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.unidades.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('unidad_id', trans('quickadmin.unidades.fields.unidad').'', ['class' => 'control-label']) !!}
                    {!! Form::select('unidad_id', $unidads, old('unidad_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('unidad_id'))
                        <p class="help-block">
                            {{ $errors->first('unidad_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', trans('quickadmin.unidades.fields.nombre').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('slug', trans('quickadmin.unidades.fields.slug').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('imagen_unidad', trans('quickadmin.unidades.fields.imagen-unidad').'', ['class' => 'control-label']) !!}
                    {!! Form::file('imagen_unidad', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('imagen_unidad_max_size', 2) !!}
                    {!! Form::hidden('imagen_unidad_max_width', 4096) !!}
                    {!! Form::hidden('imagen_unidad_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('imagen_unidad'))
                        <p class="help-block">
                            {{ $errors->first('imagen_unidad') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('texto_corto', trans('quickadmin.unidades.fields.texto-corto').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('texto_corto', old('texto_corto'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('texto_corto'))
                        <p class="help-block">
                            {{ $errors->first('texto_corto') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('texto_largo', trans('quickadmin.unidades.fields.texto-largo').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('texto_largo', old('texto_largo'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('texto_largo'))
                        <p class="help-block">
                            {{ $errors->first('texto_largo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('posicion', trans('quickadmin.unidades.fields.posicion').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('posicion', old('posicion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('posicion'))
                        <p class="help-block">
                            {{ $errors->first('posicion') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('recursos', trans('quickadmin.unidades.fields.recursos').'', ['class' => 'control-label']) !!}
                    {!! Form::file('recursos[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'recursos',
                        'data-filekey' => 'recursos',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('recursos'))
                        <p class="help-block">
                            {{ $errors->first('recursos') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('activo', trans('quickadmin.unidades.fields.activo').'', ['class' => 'control-label']) !!}
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

    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Unidade',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
@stop