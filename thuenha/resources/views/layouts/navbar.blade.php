<nav class="navbar navbar-fixed-top navbar-default navbar-principal">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand hidden-xs" href="/"><img src="/assets/img/logo.png" alt="logo"></a>
      <a class="navbar-brand visible-xs" href="/"><img src="/assets/img/logo-xs.png" alt="logo"></a>
      {{ Form::open(array('url' => '/tim-theo-ma', 'class' => 'navbar-form pull-left', 'role' => 'search')) }}
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm theo mã BĐS" name="code">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      {{ Form::close() }}
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
        <li>
          <div class="navbar-btn">
            <a href="/dang-ky" class="btn btn-primary">Đăng ký</a>
          </div>
        </li>
        <li>
          <div class="navbar-btn">
            <a href="/dang-nhap" class="btn btn-success">Đăng nhập</a>
          </div>
        </li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
            <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/faq"><i class="fa fa-question fa-fw"></i> Câu hỏi thường gặp</a></li>
              <li class="divider"></li>
              <li><a href="/dang-tin"><i class="fa fa-edit fa-fw"></i> Đăng tin</a></li>
              <li><a href="/quan-ly-tin-dang"><i class="fa fa-book fa-fw"></i> Quản lý tin đăng</a></li>
              <li class="divider"></li>
              <li><a href="/doi-mat-khau"><i class="fa fa-key fa-fw"></i> Đổi mật khẩu</a></li>
              <li class="divider"></li>
              <li><a href="/thoat"><i class="fa fa-power-off fa-fw"></i> Thoát</a></li>
              <li><a href="/tao-ho-so"><i class="fa fa-edit fa-fw"></i> Tạo hồ sơ</a></li>
               @role('admin')
                <li><a href="/admin"><i class="fa fa-power-off fa-fw"></i> Admin</a></li>
              @endrole

            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav><!-- end top navigation -->
