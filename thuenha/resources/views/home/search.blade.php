<div class="panel panel-default panel-search" id="panel-search">
  <div class="panel-heading" id="panel-search-heading">
    <h4><i class="fa fa-search fa-lg"></i> {{ trans('home/search.find_in')}} {{ $all_count }} {{ trans('home/list.realestate') }}</h4>
  </div>
  <div class="panel-body" id="panel-search-body">
    {{ Form::open(array('url' => '/', 'id' => 'search-form')) }}
      <div class="row">
        <div class="col-xs-12">
          <a class="btn-link pull-right" data-toggle="collapse" href="#collapseSearchGuide" aria-expanded="false" aria-controls="collapseSearchGuide"><i class="fa fa-lightbulb-o"></i> Hướng dẫn</a>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="collapse" id="collapseSearchGuide">
            <ul class="list-unstyled">
              <li>
                <i class="fa fa-caret-right"></i> Những mục nào không quan trọng, bạn để nguyên giá trị mặc định.
              </li>
              <li>
                <i class="fa fa-caret-right"></i> Từ khoá là những từ mà sẽ xuất hiện trong phần mô tả chi tiết ví dụ tiện kinh doanh, dân trí cao...
              </li>
              <li>
                <i class="fa fa-caret-right"></i> Để tìm kiếm chi tiết hơn, chọn <b>Tìm kiếm nâng cao</b>
              </li>
              <li>
                <i class="fa fa-caret-right"></i> Click vào ảnh đại diện hoặc tiêu đề của tin đăng để xem thông tin đầy đủ về bất động sản.
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          {{ Form::text('keyword', $skeyword, array('id' => 'keyword', 'placeholder' => trans('home/search.keyword_hint'), 'class' => 'form-control')) }}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          {{ Form::select('type_id', $types, $stype_id, array('id' => 'type', 'class' => 'selectpicker')) }}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          {{ Form::select('district_id', $districts, $sdistrict_id, array('id' => 'district', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
        </div>
      </div>
      <div class="row advanced-field">
        <div class="col-xs-12">
          {{ Form::select('ward_id', $wards, $sward_id, array('id' => 'ward', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
        </div>
      </div>
      <div class="row advanced-field">
        <div class="col-xs-12">
          {{ Form::select('street_id', $streets, $sstreet_id, array('id' => 'street', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          {{ trans('home/search.square') }}:
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          {{ Form::text('square_min', $ssquare_min, array('id' => 'square-min', 'placeholder' => trans('home/search.min'), 'class' => 'form-control')) }}
        </div>
        <div class="col-xs-6">
          {{ Form::text('square_max', $ssquare_max, array('id' => 'square-max', 'placeholder' => trans('home/search.max'), 'class' => 'form-control')) }}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          {{ trans('home/search.price') }}:
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          {{ Form::text('price_min', $sprice_min, array('id' => 'price-min', 'placeholder' => trans('home/search.min'), 'class' => 'form-control')) }}
        </div>
        <div class="col-xs-6">
          {{ Form::text('price_max', $sprice_max, array('id' => 'price-max', 'placeholder' => trans('home/search.max'), 'class' => 'form-control')) }}
        </div>
      </div>
      <div class="row advanced-field">
        <div class="col-xs-12">
          {{ Form::select('beds', $beds, $sbeds, array('id' => 'beds', 'class' => 'selectpicker')) }}
        </div>
      </div>
      <div class="row advanced-field">
        <div class="col-xs-12">
          {{ Form::select('direction_id', $directions, $sdirection_id, array('id' => 'direction', 'class' => 'selectpicker')) }}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <a href="" id="advanced-search" class="btn-link pull-right"><i class="fa fa-cog"></i> Tìm kiếm nâng cao</a>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <a href="" id="remove-advanced-search" class="btn-link pull-right"><i class="fa fa-close"></i> Bỏ tìm kiếm nâng cao</a>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <a href="" id="reset-search" class="btn-link"><i class="fa fa-refresh"></i> Chọn lại</a>
        </div>
        <div class="col-xs-6">
          {{ Form::button('<i class="fa fa-search"></i> Tìm kiếm', array('id' => 'search-btn', 'type' => 'submit', 'class' => 'btn btn-primary pull-right')) }}
        </div>
      </div>
    {{ Form::close() }}
  </div>
</div>
