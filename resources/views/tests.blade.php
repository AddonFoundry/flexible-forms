@extends('statamic::layout')
@section('title', __('Forms'))

@section('content')



  <statamic-tests
    title='Contact Us'
    :blueprint='@json($blueprint)'
    :meta='@json($meta)'
    :values='@json($values)'
  ></statamic-tests>


@endsection