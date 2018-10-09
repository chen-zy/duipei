@extends('admin.layouts.iframe')

@section('css')
@endsection

@section('js')
@endsection

@section('script')
    <script>
        $('.summernote').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function (files) {
                    var formData = new FormData();
                    $.each(files, function (key, file) {
                        formData.append(key, file);
                    });
                    $$.ajax({
                        url: '/api/upload',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $.each(data.files, function (key, file) {
                                $('.summernote').summernote('insertImage', file, function ($image) {
                                    $image.css('width', '100%');
                                });
                            });
                        }
                    });
                }
            }
        });
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Input box</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                    <span class="help-block">
                                    <strong>Help block message</strong>
                                </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Checkbox</label>
                                <div class="col-sm-10">
                                    <label class="checkbox-inline">
                                        <input type="checkbox"> 1
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox"> 2
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox"> 3
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Radio</label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio"> 1
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"> 2
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"> 3
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Editor</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection