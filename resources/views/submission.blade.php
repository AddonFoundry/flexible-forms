@extends('statamic::layout')
@section('title', __('Submission'))

@section('content')

  @include('statamic::partials.breadcrumb', [
      'url' => '/cp/flexible-forms/' . $submission->form->handle() . '/submissions',
      'title' => 'Submissions'
  ])

  <publish-form
      title="{{ $title }}"
      :blueprint='@json($blueprint)'
      :meta='@json($meta)'
      :values='@json($values)'
      read-only
  ></publish-form>
  
@endsection