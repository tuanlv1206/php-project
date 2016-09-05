<div class="row info-panel">
  <div class="col-xs-12">
    <div class="info-title">
      <h3><i class="fa fa-info-circle"></i> {{ trans('layouts/personalInfo.personal_info') }}</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default info-panel">
      <div class="panel-heading">
        <h4>{{ trans('layouts/personalInfo.manage_account') }}</h4>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
          <li>
            <a href="#"><i class="fa fa-chevron-right"></i> {{ trans('layouts/personalInfo.change_password') }}</a>
          </li>
          <li>
            <a href="sua-ho-so"><i class="fa fa-chevron-right"></i> {{ trans('layouts/personalInfo.change_personal_info') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default info-panel">
      <div class="panel-heading">
        <h4>{{ trans('layouts/personalInfo.change_posts') }}</h4>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
          <li>
            <a href="#"><i class="fa fa-chevron-right"></i> {{ trans('layouts/personalInfo.draft_posts') }}</a> (5)
          </li>
          <li>
            <a href="/tin-dang-chua-duyet"><i class="fa fa-chevron-right"></i> {{ trans('layouts/personalInfo.pendding_posts') }}</a> (28)
          </li>
          <li>
            <a href="/tin-da-duyet"><i class="fa fa-chevron-right"></i> {{ trans('layouts/personalInfo.approved_posts') }}</a> (28)
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

