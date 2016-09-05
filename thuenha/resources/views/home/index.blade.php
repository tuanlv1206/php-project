@extends('layouts.master')

@section('title', $heading)

@section('content')

<div class="container">
  <!-- Advanced fields visibility !-->
  {{ Form::hidden('af_visibility', $af_visibility, array('id' => 'af_visibility')) }}
  <div class="row">
    <div class="col-md-9 col-sm-8 result-panel" id="left-panel">
      @include('home.list')
    </div>
    <div class="col-md-3 col-sm-4 right-panel" id="right-panel">
      @include('home.search')
      @include('home.links')
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script src="/assets/js/index.js"></script>

@endsection
