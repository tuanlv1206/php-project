@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <ul class="nav nav-pills">
            <div class="col-md-4"></div>
            <div class="col-md-2">
              <li role="presentation" class="button button-alt-color app-link"><a href="dang-nhap">Đăng nhập</a></li>
            </div>

            <div class="col-md-2">
              <li role="presentation" class="button button-alt-color app-link"><a href="dang-ky">Đăng ký</a></li>
            </div>
            <div class="col-md-4"></div>
          </ul>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/dang-nhap') }}">
            {!! csrf_field() !!}

            <div>
               <label class="col-md-4 control-label">Kết nối bằng tài khoản:</label>
               <div class="col-md-6">
                  <a href="redirect/facebook"><img src="/icon_facebook.ico" height="42" width="42" alt="facebook"></a>
                  <a href="redirect/google"><img src="/icon_googleplus.ico" height="42" width="42" alt="G+"></a>
               </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">E-Mail</label>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Mật khẩu</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> Nhớ tài khoản
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-sign-in"></i>Đăng nhập
                </button>
                <a class="btn btn-link" href="{{ url('/dat-lai-mat-khau') }}">Quên mật khẩu?</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
