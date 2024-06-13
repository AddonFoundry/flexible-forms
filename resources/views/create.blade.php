@extends('statamic::layout')
@section('title', __('Forms'))

@section('content')

    <create-flexible-form
        route="{{ cp_route('forms.store') }}"> <!-- this.route used in the vue component -->
    </create-flexible-form

@endsection