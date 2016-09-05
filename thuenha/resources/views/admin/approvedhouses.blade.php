@extends('layouts.master')

@section('title', trans('profile/create.title'))

@section('content')

<div class="container unapprovedhouses">
  <div class="row">
    <div class="col-sm-9 result-panel" id="left-panel">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12">
              <ul class="pagination pull-right">
                {!! $houseList->links() !!}
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <ul class="list-unstyled houses-list">
                @if (count($houseList) > 0)
                @foreach ($houseList as $house)
                  <li class="list-item">
                    <td>
                        <form action="/xem-tin-de-huy-duyet/{{ $house->id }}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" id="approve-house-{{ $house->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-bell"></i>Xem để bỏ duyệt
                            </button>
                        </form>
                    </td>
                    <div class="row">
                      <div class="col-xs-12 col-sm-3">
                        <div class="row">
                          <div class="col-xs-12">
                            <a href="/xem-tin-de-huy-duyet/{{ $house->id }}"><img src="/uploads/avatars/{{$house->avatar }}" alt="thuê nhà"></img></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-9">
                        <div class="row">
                          <div class="col-xs-12">
                            <a href="/xem-tin-de-huy-duyet/{{ $house->id }}" class="title">{{$house->title}}</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            Địa chỉ: <span class="info">{{$house->address}}</span>
                            @if (count($districts) > 0)
                                @foreach($districts as $district)
                                  @if ($district->id == $house->district_id)
                                    <span class="info">- {{$district->name}}</span>
                                  @endif
                                 @endforeach
                            @endif
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            {{trans('house/create.direction')}}: <span class="info">{{$house->direction_id}}</span> - {{trans('house/create.rooms')}}: <span class="info">{{$house->rooms}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            {{$house->description}}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            <h3>
                              @if (count($types) > 0)
                                @foreach($types as $type)
                                  @if ( $type->id == $house->type_id)
                                    <a href="#">{{$type->name}}</a>
                                  @endif
                                @endforeach
                              @endif
                              @if (count($streets) > 0)
                                @foreach($streets as $street)
                                  @if ( $street->id == $house->street_id)
                                    -&nbsp;<a href="#">{{$street->name}}</a>
                                  @endif
                                @endforeach
                              @endif
                              @if (count($wards) > 0)
                                @foreach($wards as $ward)
                                  @if ( $ward->id == $house->ward_id)
                                    -&nbsp;<a href="#">{{$ward->name}}</a>
                                  @endif
                                @endforeach
                              @endif
                              @if (count($types) > 0)
                                @foreach($districts as $district)
                                  @if ( $district->id == $house->district_id)
                                    -&nbsp;<a href="#">{{$district->name}}</a>
                                  @endif
                                @endforeach
                              @endif
                            </h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="pull-right">
                              <span class="price-label">Giá: </span><span class="price">{{$house->price}}&nbsp;triệu/tháng</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <ul class="pagination pull-right">
                {!! $houseList->links() !!}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 right-panel">
      @include('layouts.personalInfo')
    </div>
  </div>
</div>
@endsection

<link href="/assets/css/unapprovedhouses.css" rel="stylesheet">

