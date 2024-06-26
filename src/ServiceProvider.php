<?php

namespace AddonFoundry\FlexibleForms;

use Statamic\Providers\AddonServiceProvider;

use Statamic\Facades\CP\Nav;

class ServiceProvider extends AddonServiceProvider
{
  
    protected $vite = [ 
      'input' => [
          'resources/js/cp.js',
          'resources/css/cp.css',
      ],
      'publicDirectory' => 'resources/dist',
    ]; 

    /*
    protected $styles = [
      __DIR__.'/../resources/dist/css/cp.css',
    ];

    protected $scripts = [
      __DIR__.'/../resources/dist/js/cp.js',
    ];
    */

    protected $routes = [
      'cp' => __DIR__.'/../routes/cp.php',
    ];

    public function bootAddon()
    {
        
      // boot navigation
      $this->bootNavigation();

    }

    private function bootNavigation()
    {

      $formSvg = '<svg width="59" height="63" viewBox="0 0 59 63" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M57.9965 40.8789C58.6157 41.4293 58.6715 42.3774 58.1211 42.9966L42.3011 60.7941C42.0645 61.0603 41.7412 61.2692 41.3503 61.3511C40.9786 61.429 40.6582 61.3689 40.4408 61.2962C40.2268 61.2248 40.0658 61.1263 39.9678 61.0584C39.9155 61.022 39.8717 60.9878 39.8371 60.959C39.8196 60.9444 39.8039 60.9308 39.7901 60.9185L39.7707 60.9009L39.7619 60.8927L39.7578 60.8889L39.7558 60.8869L39.7548 60.886C39.7543 60.8855 39.7538 60.8851 40.7778 59.8072L39.7538 60.8851L29.9669 51.5875C29.3663 51.0169 29.3419 50.0675 29.9125 49.4669C30.4831 48.8663 31.4325 48.8419 32.0331 49.4125L40.909 57.8446L55.8789 41.0035C56.4293 40.3843 57.3774 40.3285 57.9965 40.8789Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 4C0.5 2.067 2.06701 0.5 4 0.5H48C49.933 0.5 51.5 2.067 51.5 4V34C51.5 34.8284 50.8284 35.5 50 35.5C49.1716 35.5 48.5 34.8284 48.5 34V4C48.5 3.72386 48.2761 3.5 48 3.5H4C3.72386 3.5 3.5 3.72386 3.5 4V59C3.5 59.2761 3.72386 59.5 4 59.5H24C24.8284 59.5 25.5 60.1716 25.5 61C25.5 61.8284 24.8284 62.5 24 62.5H4C2.067 62.5 0.5 60.933 0.5 59V4Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 16C10.5 15.1716 11.1716 14.5 12 14.5H40C40.8284 14.5 41.5 15.1716 41.5 16C41.5 16.8284 40.8284 17.5 40 17.5H12C11.1716 17.5 10.5 16.8284 10.5 16Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 27C10.5 26.1716 11.1716 25.5 12 25.5H40C40.8284 25.5 41.5 26.1716 41.5 27C41.5 27.8284 40.8284 28.5 40 28.5H12C11.1716 28.5 10.5 27.8284 10.5 27Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 37C10.5 36.1716 11.1716 35.5 12 35.5H30C30.8284 35.5 31.5 36.1716 31.5 37C31.5 37.8284 30.8284 38.5 30 38.5H12C11.1716 38.5 10.5 37.8284 10.5 37Z" fill="currentColor"/> </svg>';

      Nav::extend(function ($nav) use ($formSvg) {

      $nav->create(__('Flexible Forms'))
          ->section('Flexible Forms')
          ->icon($formSvg)
          ->route('flexible-forms.index')
          ->children(function () use ($nav) {
            return [
              $nav->create(__('Forms'))
                  ->route('flexible-forms.index')
                  ->can('Configure Flexible Forms'),
            ];
          });
        });

    }

}
