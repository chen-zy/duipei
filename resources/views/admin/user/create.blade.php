@extends('admin.layouts.iframe')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="{{ route('admin.user.store') }}">
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">创建用户</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label>手机</label>
                                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>密码</label>
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>角色</label>
                                <div class="row">
                                    @foreach(\App\Role::all() as $role)
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"{{ is_array(old('roles')) && in_array($role->id, old('roles')) ? 'checked' : '' }}>{{ $role->display_name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection