@extends('statamic::layout')
@section('title', __('Submissions'))

@section('content')

    <div class="flex items-center mb-6">
        <h1 class="flex-1">{{ __('Submissions') }}</h1>
    </div>

    <submissions-flexible-form
        initial-title="{{ $form->title() }}"
        :submissions="{{ json_encode($submissions) }}">
    </submissions-flexible-form>

@endsection