@extends('layouts.master')

@section('title', trans('profile/create.title'))

@section('content')

<div class="container profile">
  <div class="row">
    <div class="col-sm-9 left-panel">
      <div class="row">
        <div class="col-xs-12">
          <div class="create-title">
            <h1><i class="fa fa-edit"></i> {{ trans('profile/create.title') }}</h1>
            <h1>Sửa hồ sơ</h1>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          </div>
        </div>
      </div>
      {{ Form::open(array('url' => 'luu-ho-so', 'id' => 'form-create', 'files' => true)) }}
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default info-panel">
              <div class="panel-body">
              <div class="row">
                  <div class="col-xs-12">
                    @if (Session::has('flash_message'))
                      <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ Session::get('flash_message')}}</div>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12">
                    <h2>{{ trans('profile/create.basic_info') }}</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.name') }}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('name', $userProfile->name, array('class' => 'form-control', 'placeholder' => trans('profile/create.name_hint'))) }}
                  </div>
                </div>

                                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.register_name') }}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('register_name', $userProfile->register_name, array('class' => 'form-control','readonly'=>"readonly", 'placeholder' => trans('profile/create.register_name_hint'))) }}
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.email')}}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('email', $userProfile->email, array('class' => 'form-control','readonly'=>"readonly", 'placeholder' => trans('profile/create.email_hint'))) }}
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.mobile_phone')}}<span class="required">(*)</span></label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('mobile_phone', $userProfile->mobile_phone, array('class' => 'form-control')) }}
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.home_phone')}}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('home_phone', $userProfile->home_phone, array('class' => 'form-control')) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.address') }} <span class="required">(*)</span>: </label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::select('district_id', $districts, $userProfile->district_id, array('id' => 'district', 'class' => 'selectpicker', 'data-live-search' => 'true')) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.address_details') }}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('address', '', array('class' => 'form-control', 'placeholder' => trans('profile/create.address_details_hint'))) }}
                  </div>
                </div>
                <div class="row owner-info">
                  <div class="col-xs-12">
                    <h2>{{ trans('profile/create.other_info') }}</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.facebook') }}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('facebook', $userProfile->facebook, array('class' => 'form-control', 'placeholder' => trans('profile/create.facebook_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.skype') }}</label>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    {{ Form::text('skype', $userProfile->skype, array('class' => 'form-control', 'placeholder' => trans('profile/create.skype_hint'))) }}
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <label>{{ trans('profile/create.avatar') }} <span class="required">(*)</span></label>
                  </div>
                  <div class="col-sm-9">
                    {{ Form::file('avatar', array('title' => trans('profile/create.avatar_hint'))) }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 col-sm-push-3">
                    <img src="/uploads/profile_avatars/{{$userProfile->avatar }}"  alt="{{ trans('profile/create.avatar') }}"></img>
                  </div>
                </div>

                <div class="row btn-post">
                  <div class="col-xs-12 text-center">
                    {{ Form::button(trans('profile/create.post_edit'), array('class' => 'btn btn-success', 'type' => 'submit')) }}
                    {{ Form::button(trans('profile/create.cancel'), array('id' => 'profileupd-btn-cancel', 'class' => 'btn btn-danger btn-cancel')) }}
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
<link href="/assets/css/profile.css" rel="stylesheet">
@section('scripts')

<script src="/assets/js/profile.js"></script>

@endsection
