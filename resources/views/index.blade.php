@extends('statamic::layout')
@section('title', __('Forms'))

@section('content')

    @unless($forms->isEmpty())

        <div class="flex items-center mb-6">
            <h1 class="flex-1">{{ __('Flexible Forms') }}</h1>

            @if (Statamic::pro() && $user->can('create', 'Statamic\Contracts\Forms\Form'))
                <a href="/cp/flexible-forms/create" class="btn-primary">{{ __('Create Form') }}</a>
            @endif
        </div>

      
        <list-flexible-forms></list-flexible-forms>


    @else

      <div class="no-results md:mt-4 max-w-md mx-auto">
        <div class="card rounded-xl text-center p-6 lg:py-10">
            <h1 class="mb-8">Flexible Forms</h1>
            <div class="hidden md:block">
            <svg width="125" height="125" viewBox="0 0 125 125" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="62.5" cy="62.5" r="62.5" fill="#E2E6F1"/>
              <mask id="mask0_27_355" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="125" height="125">
              <circle cx="62.5" cy="62.5" r="62.5" fill="#E2E6F1"/>
              </mask>
              <g mask="url(#mask0_27_355)">
              <g filter="url(#filter0_d_27_355)">
              <rect x="22.0378" y="18" width="77.7213" height="108" rx="3" fill="#F3F5F9"/>
              </g>
              <rect x="29.998" y="51.5353" width="61.8787" height="11.2353" rx="1.5" stroke="#9A9FAF"/>
              <rect width="29.8407" height="2.44706" rx="1.22353" transform="matrix(1 0 0 -1 34.8267 58.3765)" fill="#9A9FAF"/>
              <rect x="29.998" y="68.6647" width="61.8787" height="11.2353" rx="1.5" stroke="#9A9FAF"/>
              <rect width="29.8407" height="2.44706" rx="1.22353" transform="matrix(1 0 0 -1 34.8267 75.5059)" fill="#9A9FAF"/>
              <g opacity="0.5">
              <rect x="63.0361" y="34.4059" width="28.8407" height="11.2353" rx="1.5" stroke="#9A9FAF" stroke-dasharray="2 2"/>
              </g>
              <rect x="29.998" y="34.4059" width="28.8407" height="11.2353" rx="1.5" stroke="#9A9FAF"/>
              <rect width="13.8546" height="2.44706" rx="1.22353" transform="matrix(1 0 0 -1 32.6953 41.2471)" fill="#9A9FAF"/>
              <rect x="67.2988" y="31.9588" width="28.8407" height="11.2353" rx="1.5" stroke="#9A9FAF"/>
              <rect width="13.8546" height="2.44706" rx="1.22353" transform="matrix(1 0 0 -1 69.9961 38.8)" fill="#9A9FAF"/>
              <rect x="44.094" y="86" width="34.6595" height="11" rx="2" fill="#D5D9E3"/>
              <rect width="18.9052" height="3" rx="1.5" transform="matrix(1 0 0 -1 52.4961 93)" fill="#B1B6C4"/>
              <path d="M91.6294 49.3129C92.2596 49.058 93.2044 49.2464 93.561 49.3425L90.635 44.2417C90.3345 43.7177 90.5344 43.0355 91.055 42.733C91.5756 42.4305 92.2625 42.5973 92.5631 43.1212L94.249 46.0603C94.4671 46.4407 94.8876 46.2617 94.7206 45.8529C94.3783 45.0142 95.4291 44.2658 96.1297 45.2921C96.3024 45.545 96.6619 45.4065 96.5546 45.0626C96.3099 44.2708 97.3544 43.6548 98.095 44.6579C98.2879 44.9203 98.6723 44.7726 98.5132 44.4368C98.3513 44.0975 98.3887 43.905 98.5458 43.8137C99.0751 43.5061 100.221 44.1464 100.886 45.3064C102.081 47.3902 100.638 48.2358 102.554 51.5756L97.734 54.3766C96.4769 52.5572 93.9973 51.7412 91.8613 51.1647C91.4903 51.0646 91.2171 50.8585 91.0747 50.6101C90.8158 50.1589 90.9707 49.5786 91.6294 49.3129Z" fill="#6A7081"/>
              </g>
              <path d="M22 21C22 19.3431 23.3431 18 25 18H97C98.6569 18 100 19.3431 100 21V25H22V21Z" fill="#9DA6B6"/>
              <defs>
              <filter id="filter0_d_27_355" x="15.0378" y="11" width="91.7212" height="122" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix"/>
              <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
              <feOffset/>
              <feGaussianBlur stdDeviation="3.5"/>
              <feComposite in2="hardAlpha" operator="out"/>
              <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0"/>
              <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_27_355"/>
              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_27_355" result="shape"/>
              </filter>
              </defs>
            </svg>
            </div>
            <p class="text-gray-700 leading-normal my-8 text-lg antialiased">
            Flexible Forms is a form builder that allows you to easily build customizable forms directly in the control panel.
            </p>
            <!-- TODO: Add link to create form -->
            <a href="/cp/flexible-forms/create" class="btn-primary btn-lg">Create Flexible Form</a>
        </div>
      </div>

      @endunless

@endsection