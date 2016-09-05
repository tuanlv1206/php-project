<div class="panel panel-default">
  <div class="panel-heading">
    <h1>{{ $heading }}</h1>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-12">
        <h2>{!! $heading2 !!}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="pull-right count">
          {{ trans('home/list.there_is') }} <span class="result-count">{{ number_format($total) }}</span> {{ trans('home/list.realestate') }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2 col-sm-4">
        <div class="list-post">
          <i class="fa fa-list fa-lg"></i> <span class="hidden-xs">{{ trans('home/list.list_post') }}</span>
        </div>
      </div>
      <div class="col-xs-10 col-sm-8">
        <div class="pull-right sort">
          {{ trans('home/list.sort_by') }}:
          <select id="sort" class="form-control" name="sort" form="search-form" onchange="this.form.submit()">
            <option value="0" {{ $sort_type == 0 ? "selected" : "" }}>{{ trans('home/list.newest') }}</option>
            <option value="1" {{ $sort_type == 1 ? "selected" : "" }}>{{ trans('home/list.price_decreased') }}</option>
            <option value="2" {{ $sort_type == 2 ? "selected" : "" }}>{{ trans('home/list.price_increased') }}</option>
            <option value="3" {{ $sort_type == 3 ? "selected" : "" }}>{{ trans('home/list.square_decreased') }}</option>
            <option value="4" {{ $sort_type == 4 ? "selected" : "" }}>{{ trans('home/list.square_increased') }}</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <ul class="list-unstyled houses-list">
          @foreach ($houses as $house)
          <li class="list-item">
            <div class="row">
              <div class="col-xs-12 col-sm-3">
                <div class="row">
                  <div class="col-xs-12">
                    <a href="{{ '/ha-noi/'.$house['slug'].'-'.$house['id'] }}"><img src="/uploads/avatars/{{ $house['avatar'] }}" alt="{{ $house['title'] }}" class="img-responsive"></a>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-9">
                <div class="row">
                  <div class="col-xs-12">
                    <h3>
                      <a href="{{ '/ha-noi/'.$house['slug'].'-'.$house['id'] }}" class="title">{{ $house['title'] }}</a>
                    </h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-10">
                    <i class="fa fa-map-marker"></i> {{ trans('home/list.area') }}: <span class="info">{{ $house['area'] }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6">
                    {{ trans('home/list.house_id') }}: <span class="info">{{ $house['id'] }}</span>
                  </div>
                  <div class="col-xs-6">
                    {{ trans('home/list.square')}}: <span class="info">{{ $house['square'] + 0 }} m²</span>
                  </div>
                </div>
                <div class="row description">
                  <div class="col-xs-12">
                    {!! $house['description'] !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 updated-date">
                    {{ $house['updated_at'] }}
                  </div>
                  <div class="col-xs-6">
                    <div class="pull-right">
                      <span class="price-label">{{ trans('home/list.price')}}: </span><span class="price">{{ $house['price'] + 0 }} {{ trans('home/list.price_unit') }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <ul class="pagination pull-right">
          {{ $links }}
        </ul>
      </div>
    </div>
  </div>
</div>
