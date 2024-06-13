@extends('statamic::layout')
@section('title', __('Forms'))




@section('content')

    <build-flexible-form
        action="{{ cp_route('forms.blueprint.update', $form->handle()) }}"
        :initial-blueprint="{{ json_encode($blueprintVueObject) }}"
        :use-tabs="false"
        :is-form-blueprint="true">
    </build-flexible-form>

@endsection
