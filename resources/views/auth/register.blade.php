@extends('layouts.master')

@section('script')
    <script>
        $('.J_send-verify-code').click(function () {
            $$.ajax({
                url: '/api/verify-code',
                data: {'mobile': $('[name="mobile"]').val()},
                success: function (data) {
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">Mobile</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="mobile" type="tel" class="form-control" name="mobile" value="{{ old('mobile') }}" required>
                                        <span class="input-group-btn">
                                        <button class="btn btn-default J_send-verify-code" type="button">Verify</button>
                                    </span>
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('vcode') ? ' has-error' : '' }}">
                                <label for="vcode" class="col-md-4 control-label">Verify Code</label>
                                <div class="col-md-6">
                                    <input id="vcode" type="number" class="form-control" name="vcode" value="{{ old('vcode') }}" required>
                                    @if ($errors->has('vcode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('vcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
