@extends('statamic::layout')
@section('title', __('Submissions'))

@section('content')

  @include('statamic::partials.breadcrumb', [
      'url' => '/cp/flexible-forms',
      'title' => 'Flexible Forms'
  ])

    <div class="flex items-center mb-6">
        <h1 class="flex-1">{{ __('Submissions') }}</h1>
        <a class="btn" href="/cp/forms/{{ $form->handle() }}/export/csv?download=1">Export Submissions</a>
    </div>



    

    <submissions-flexible-form
        initial-title="{{ $form->title() }}"
        :submissions="{{ json_encode($submissions) }}"
        form="{{ $form->handle() }}">
    </submissions-flexible-form>

@endsection