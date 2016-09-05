@extends('layouts.master')

@section('title', trans('house/create.title'))

@section('content')

<div class="container">
  <input type="hidden" name="ward_hidden_id" id="ward_hidden_id" value="{{ Session::get('ward_id') }}">
  <input type="hidden" name="street_hidden_id" id="street_hidden_id" value="{{ Session::get('street_id') }}">
  <div class="row">
    <div class="col-sm-9 left-panel house">
      <div class="row">
        <div class="col-xs-12">
          <div class="create-title">
            <h1><i class="fa fa-edit"></i> {{ trans('house/create.title') }}</h1>
          </div>
        </div>
      </div>
      {{ Form::open(array('url' => 'luu-tin', 'id' => 'form-create', 'files' => true)) }}
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default info-panel">
              <div class="panel-body">
                @if (count($errors) > 0)
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                @endif
                @if (Session::has('success_message'))
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ Session::get('success_message')}}</div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-xs-12">
                    <h2>{{ trans('house/create.basic_info') }}</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.type') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::select('type_id', $types, '', array('id' => 'type', 'class' => 'selectpicker')) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.location') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::select('district_id', $districts, '', array('id' => 'district', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-5 col-md-4 col-sm-push-3">
                    {{ Form::select('ward_id', $wards, '', array('id' => 'ward', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
                  </div>
                  <div class="col-sm-4 col-sm-push-3 col-md-push-4 street">
                    {{ Form::select('street_id', $streets, '', array('id' => 'street', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.address') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('address', '', array('class' => 'form-control', 'placeholder' => trans('house/create.address_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.square') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('square', '', array('id' => 'square', 'class' => 'form-control', 'placeholder' => trans('house/create.square_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.price') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('price', '', array('id' => 'price', 'class' => 'form-control', 'placeholder' => trans('house/create.price_hint'))) }}
                  </div>
                </div>
                <div class="row detail-info">
                  <div class="col-xs-12">
                    <h2>{{ trans('house/create.detail_info') }}</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.heading') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-9">
                    {{ Form::text('title', '', array('id' => 'title', 'class' => 'form-control', 'placeholder' => trans('house/create.heading_hint'))) }}
                  </div>
                </div>
                <div class="row" id="title-suggestion-container">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.title_suggestion') }}: </label>
                  </div>
                  <div class="col-sm-9">
                    <label id="title-suggestion"></label>
                    <div><a href='javascript:void(0)' id="use-title-suggestion" class="btn btn-link">{{ trans('house/create.use_title_suggestion') }}</a></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.description') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-9">
                    {{ Form::textarea('description', '', array('class' => 'form-control', 'placeholder' => trans('house/create.description_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <label class="required">{{ trans('house/create.image_note') }}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.avatar') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-9">
                    {{ Form::file('avatar', array('title' => trans('house/create.avatar_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.detail_images') }}: </label>
                  </div>
                  <div class="col-sm-9">
                    {{ Form::file('images[]', array('multiple' => 'multiple', 'title' => trans('house/create.detail_images_hint'))) }}
                  </div>
                </div>
                <div class="row other-info">
                  <div class="col-xs-12">
                    <h2>{{ trans('house/create.other_info') }}</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.beds') }}: </label>
                  </div>
                  <div class="col-xs-8 col-sm-3">
                    {{ Form::text('beds', '', array('class' => 'form-control', 'placeholder' => trans('house/create.beds_hint'))) }}
                  </div>
                  <div class="toilets col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.toilets') }}: </label>
                  </div>
                  <div class="toilets col-xs-8 col-sm-3">
                    {{ Form::text('toilets', '', array('class' => 'form-control', 'placeholder' => trans('house/create.toilets_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.floors') }}: </label>
                  </div>
                  <div class="col-xs-8 col-sm-3">
                    {{ Form::text('floors', '', array('class' => 'form-control', 'placeholder' => trans('house/create.floors_hint'))) }}
                  </div>
                  <div class="facade col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.facade') }}: </label>
                  </div>
                  <div class="facade col-xs-8 col-sm-3">
                    {{ Form::text('facade', '', array('class' => 'form-control', 'placeholder' => trans('house/create.facade_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.direction') }}: </label>
                  </div>
                  <div class="col-xs-8 col-sm-3">
                    {{ Form::select('direction_id', $directions, '', array('class' => 'selectpicker')) }}
                  </div>
                  <div class="frontline col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.frontline') }}: </label>
                  </div>
                  <div class="frontline col-xs-8 col-sm-3">
                    {{ Form::text('frontline', '', array('class' => 'form-control', 'placeholder' => trans('house/create.frontline_hint'))) }}
                  </div>
                </div>
                <div class="row owner-info">
                  <div class="col-xs-12">
                    <h2>{{ trans('house/create.owner_info') }}</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.owner_name') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('owner_name', '', array('class' => 'form-control', 'placeholder' => trans('house/create.owner_name_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.owner_phone') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('owner_phone', '', array('class' => 'form-control', 'placeholder' => trans('house/create.owner_phone_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('house/create.owner_additional_phone') }}: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('owner_additional_phone', '', array('class' => 'form-control', 'placeholder' => trans('house/create.owner_additional_phone_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.owner_birth_year') }}: </label>
                  </div>
                  <div class="col-xs-8 col-sm-3">
                    {{ Form::text('owner_birth_year', '', array('class' => 'form-control', 'placeholder' => trans('house/create.owner_birth_year_hint'))) }}

                  </div>
                  <div class="frontline col-xs-4 col-sm-3">
                    <label>{{ trans('house/create.owner_gender') }}: </label>
                  </div>
                  <div class="frontline col-xs-8 col-sm-3">
                    {{ Form::select('owner_gender', array('' => trans('house/create.owner_gender_hint'), 0 => trans('common.male'), 1 => trans('common.female')), '', array('class' => 'selectpicker')) }}
                  </div>
                </div>
                <div class="row btn-post">
                  <div class="col-xs-12 text-center">
                    {{ Form::button(trans('house/create.post'), array('class' => 'btn btn-success', 'type' => 'submit')) }}
                    {{ Form::button(trans('house/create.cancel'), array('id' => 'btn-cancel', 'class' => 'btn btn-danger btn-cancel')) }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      {{ Form::close() }}
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
