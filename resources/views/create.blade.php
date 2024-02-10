@extends('statamic::layout')
@section('title', __('Create Flexible Form'))

@section('content')
    <create-flexible-form
        route="{{ cp_route('forms.store') }}">
    </create-flexible-form
@stop