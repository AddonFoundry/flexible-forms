@extends('statamic::layout')
@section('title', __('Create Flexible Form'))

@section('content')

  @include('statamic::partials.breadcrumb', [
      'url' => '/cp/flexible-forms',
      'title' => 'Flexible Forms'
  ])

  <edit-flexible-form
      initial-title="{{ $form->title() }}"
      edit-title="Edit Form"
      :blueprint="{{ json_encode($blueprint) }}"
      :initial-values="{{ json_encode($values) }}"
      :meta="{{ json_encode($meta) }}"
      url="{{ cp_route('forms.update', $form->handle()) }}"
      listing-url="{{ cp_route('forms.index') }}"
  ></edit-flexible-form>


@endsection