@extends('layouts.master')

@section('title', $house->title)

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-9 left-panel">
      <div class="panel panel-default" id="show-panel">
        <div class="panel-body">
          <h1>{{ $house->title }}</h1>
          <h2><i class="fa fa-map-marker"></i> {{ trans('house/show.area') }}: <a href="{{ $house->area_link }}">{{ $house->area_anchor_text }}</a> - {{ $house->ward.$house->district_type.' '.$house->district_name }}</h2>
          <div class="row">
            <div class="col-xs-6">
              <label>{{ trans('house/show.price') }}</label>: <span class="house-info">{{ ($house->price + 0).' '.trans('house/show.price_unit') }}</span>
            </div>
            <div class="col-xs-6">
              <label>{{ trans('house/show.square') }}</label>: <span class="house-info">{{ ($house->square + 0).' '.trans('house/show.square_unit') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <hr/>
            </div>
          </div>
          <div class="row house-description">
            <div class="col-xs-12">
              {{ trans('house/show.description') }}
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              {!! $house->description !!}
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <hr/>
            </div>
          </div>
          @if (count($images) > 0)
            <div class="row house-description">
              <div class="col-xs-12">
                {{ trans('house/show.images') }} ({{ count($images) }})
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div id="carousel-images" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  @if (count($images) > 1)
                    <ol class="carousel-indicators">
                      @for ($i = 0; $i < count($images); $i++)
                        <li data-target="#carousel-images" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : ''}}"></li>
                      @endfor
                    </ol>
                  @endif
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    @for ($i = 0; $i < count($images); $i++)
                      <div class="item {{ $i == 0 ? 'active' : ''}}">
                        <img src="{{ '/uploads/images/'.$images[$i]->name }}" alt="{{ trans('house/create.detail_images') }}" class="img-responsive"></img>
                      </div>
                    @endfor
                  </div>
                  <!-- Controls -->
                  @if (count($images) > 1)
                    <a class="left carousel-control" href="#carousel-images" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">{{ trans('house/edit.previous') }}</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-images" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">{{ trans('house/edit.next') }}</span>
                    </a>
                  @endif
                </div>
              </div>
            </div>
          @endif
          <div class="row">
            <div class="col-xs-12">
              <hr/>
            </div>
          </div>
          <div class="row house-description">
            <div class="col-xs-12">
              {{ trans('house/show.characteristics') }}
            </div>
          </div>
          <table class="table table-condensed">
            <tr>
              <td>{{ trans('house/edit.id') }}</td>
              <td class="house-info">{{ $house->id }}</td>
              <td class="hidden-xs">{{ trans('house/edit.status') }}</td>
              <td class="house-info hidden-xs">{{ $house->status == 0 ? trans('house/edit.available') : trans('house/edit.rent') }}</td>
            </tr>
            <tr class="visible-xs">
              <td>{{ trans('house/edit.status') }}</td>
              <td class="house-info">{{ $house->status == 0 ? trans('house/edit.available') : trans('house/edit.rent') }}</td>
            </tr>
            <tr>
              <td>{{ trans('house/create.beds') }}</td>
              <td class="house-info">{{ $house->beds === NULL ? 'N/A' : $house->beds }}</td>
              <td class="hidden-xs">{{ trans('house/create.toilets') }}</td>
              <td class="house-info hidden-xs">{{ $house->toilets === NULL ? 'N/A' : $house->toilets }}</td>
            </tr>
            <tr class="visible-xs">
              <td>{{ trans('house/create.toilets') }}</td>
              <td class="house-info">{{ $house->toilets === NULL ? 'N/A' : $house->toilets }}</td>
            </tr>
            <tr>
              <td>{{ trans('house/create.floors') }}</td>
              <td class="house-info">{{ $house->floors === NULL ? 'N/A' : $house->floors + 0 }}</td>
              <td class="hidden-xs">{{ trans('house/show.facade') }}</td>
              <td class="house-info hidden-xs">{{ $house->facade === NULL ? 'N/A' : ($house->facade + 0).'m' }}</td>
            </tr>
            <tr class="visible-xs">
              <td>{{ trans('house/show.facade') }}</td>
              <td class="house-info">{{ $house->facade === NULL ? 'N/A' : ($house->facade + 0).'m' }}</td>
            </tr>
            <tr>
              <td>{{ trans('house/show.direction') }}</td>
              <td class="house-info">{{ $house->direction === NULL ? 'N/A' : $house->direction }}</td>
              <td class="hidden-xs">{{ trans('house/show.frontline') }}</td>
              <td class="house-info hidden-xs">{{ $house->frontline === NULL ? 'N/A' : ($house->frontline + 0).'m' }}</td>
              </td>
            </tr>
            <tr class="visible-xs">
              <td>{{ trans('house/show.frontline') }}</td>
              <td class="house-info">{{ $house->frontline === NULL ? 'N/A' : ($house->frontline + 0).'m' }}</td>
            </tr>
            <tr>
              <td>{{ trans('house/show.last_updated') }}</td>
              <td colspan="3" class="house-info hidden-xs">{{ $house->updated_at->format('d/m/Y h:i A') }}</td>
              <td class="house-info visible-xs">{{ $house->updated_at->format('d/m/Y h:i A') }}</td>
            </tr>
          </table>
          @if (\Auth::user() && \Auth::user()->hasRole('admin'))
            <div class="row">
              <div class="col-xs-12">
                <hr/>
              </div>
            </div>
            <div class="row house-description">
              <div class="col-xs-12">
                {{ trans('house/show.owner_info') }}
              </div>
            </div>
            <table class="table table-condensed">
              <tr>
                <td>{{ trans('house/create.owner_name') }}</td>
                <td class="house-info">{{ $house->owner_name }}</td>
                <td class="hidden-xs">{{ trans('house/create.owner_phone') }}</td>
                <td class="house-info hidden-xs">{{ $house->owner_phone }}</td>
              </tr>
              <tr class="visible-xs">
                <td>{{ trans('house/create.owner_phone') }}</td>
                <td class="house-info">{{ $house->owner_phone }}</td>
              </tr>
              <tr>
                <td>{{ trans('house/show.address') }}</td>
                <td class="house-info">{{ $house->address }}</td>
                <td class="hidden-xs">{{ trans('house/create.owner_additional_phone') }}</td>
                <td class="house-info hidden-xs">{{ $house->owner_additional_phone === NULL ? 'N/A' : $house->owner_additional_phone }}</td>
              </tr>
              <tr class="visible-xs">
                <td>{{ trans('house/create.owner_additional_phone') }}</td>
                <td class="house-info">{{ $house->owner_additional_phone === NULL ? 'N/A' : $house->owner_additional_phone }}</td>
              </tr>
              <tr>
                <td>{{ trans('house/create.owner_birth_year') }}</td>
                <td class="house-info">{{ $house->owner_birth_year }}</td>
                <td class="hidden-xs">{{ trans('house/create.owner_gender') }}</td>
                <td class="house-info hidden-xs">{{ $house->owner_gender === NULL ? 'N/A' : ($house->owner_gender == 0 ? trans('common.male') : trans('common.female')) }}</td>
              </tr>
              <tr class="visible-xs">
                <td>{{ trans('house/create.owner_gender') }}</td>
                <td class="house-info">{{ $house->owner_gender === NULL ? 'N/A' : ($house->owner_gender == 0 ? trans('common.male') : trans('common.female')) }}</td>
              </tr>
            </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-sm-3 right-panel">
      @include('layouts.personalInfo')
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script src="/assets/js/house.js"></script>

@endsection

