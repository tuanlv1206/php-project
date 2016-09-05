@extends('layouts.master')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Đổi mật khẩu</div>
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
            . Bạn đợi <span id="timer"></span> giây hoạc click vào đây để chuyển về trang chủ
            <a href="/">nhà đất 68</a>
          </div>
          <script type="text/javascript">

          var count=8;
          var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

          function timer()
          {
            count=count-1;
            if (count <= 0)
            {
               clearInterval(counter);
               return;
            }

           document.getElementById("timer").innerHTML=count; // watch for spelling
          }
            (function(){
               setTimeout(function(){
                 window.location.href="/";
               },8000);
            })();

          </script>
        @endif
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="/doi-mat-khau">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('currentpassword') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Mật khẩu cũ</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="currentpassword">

                @if ($errors->has('currentpassword'))
                  <span class="help-block">
                    <strong>{{ $errors->first('currentpassword') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Mật khẩu mới</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Nhập lại mật khẩu mới</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-refresh"></i>Đổi mật khẩu
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
