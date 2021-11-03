@extends(front_view_path('layouts.default'))


<x-administrable::seotags :model="$page" />


@section('content')
<div class='container mt-5'>
  <h2>{!! $page->getTag('contact','title') !!}</h2>
  {!! $page->getTag('contact','content') !!}
  {!! form_start($form) !!}
  @honeypot
  {!! form_rest($form) !!}
  <button type="submit" class="btn btn-primary btn-block">
      <i class="fa fa-location-arrow"></i>
      {{ Lang::get('administrable-mailbox::translations.default.save') }}
  </button>
  {!! form_end($form) !!}
</div>
@endsection
