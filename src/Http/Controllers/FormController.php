<?php

namespace AddonFoundry\FlexibleForms\Http\Controllers;

use Statamic\Facades\User;
use Illuminate\Http\Request;
use GertTimmerman\StatamicZapier\Webhooks;
use Statamic\Http\Controllers\CP\CpController;
use Statamic\Support\Arr;

use Statamic\Facades\Form;
use Statamic\Contracts\Forms\Form as FormContract;
use Statamic\Http\Controllers\CP\Fields\ManagesBlueprints;

use Statamic\Facades\Blueprint;
use Statamic\Support\Str;
use Statamic\Facades\Action;
use Statamic\CP\Column;

use Facades\Statamic\Fields\FieldtypeRepository;



class FormController extends CpController
{

  use ManagesBlueprints;

  public function __construct()
  {
      $this->middleware(\Illuminate\Auth\Middleware\Authorize::class.':configure form fields');
  }

      // tests
      public function tests($form)
      {

        $this->authorize('edit', $form);

          $values = [
            'handle' => $form->handle(),
            'title' => __($form->title()),
            'honeypot' => $form->honeypot(),
            'store' => $form->store(),
            'email' => $form->email(),
        ];

        $fields = ($blueprint = $this->editFormBlueprint($form))
            ->fields()
            ->addValues($values)
            ->preProcess();

        return view('flexible-forms::tests', [
            'blueprint' => $blueprint->toPublishArray(),
            'values' => $fields->values()->all(), // $fields->values()
            'meta' => $fields->meta(),
            'form' => $form,
        ]);

  
      }


    public function index(Request $request)
    {

      $user = User::current();

      $columns = [
        Column::make('title')->label(__('Title')),
        Column::make('submissions')->label(__('Submissions')),
     ];

      $forms = Form::all()
            ->filter(function ($form) {
                return User::current()->can('view', $form);
            })
            ->map(function ($form) {
                return [
                    'id' => $form->handle(),
                    'title' => __($form->title()),
                    'submissions' => $form->submissions()->count(),
                    //'show_url' => $form->showUrl(),
                    //'edit_url' => $form->editUrl(),
                    //'blueprint_url' => cp_route('forms.blueprint.edit', $form->handle()),
                    'can_edit' => User::current()->can('edit', $form),
                    //'can_edit_blueprint' => User::current()->can('configure form fields', $form),
                    //'actions' => Action::for($form),
                ];
            })
            ->values();

            if ($request->wantsJson()) {
              return [
                  'meta' => [
                      'columns' => $columns,
                      'activeFilterBadges' => [],
                  ],
                  'data' => $forms,
              ];
          }

        return view('flexible-forms::index', [
            'forms' => $forms,
            //'initialColumns' => $columns,
            'title' => 'Flexible Forms',
            //'actionUrl' => cp_route('flexible-forms.index'),
            'user' => $user,
        ]);

    }

    public function create()
    {
       
      return view('flexible-forms::create', [
        'title' => 'Flexible Forms',
        'action' => cp_route('flexible-forms.create'),
      ]);

    }

    public function store(Request $request)
    {
        $this->authorizeProIf(Form::all()->count() >= 1);

        $this->authorize('create', FormContract::class, __('You are not authorized to create forms.'));

        $request->validate([
            'title' => 'required',
            'handle' => 'nullable|alpha_dash',
        ]);

        $handle = $request->handle ?? Str::snake($request->title);

        if (Form::find($handle)) {
            throw new \Exception(__('Form already exists'));
        }

        $form = tap(Form::make($handle)->title($request->title))->save();

        session()->flash('success', __('Form created'));

        //return ['redirect' => $form->editUrl()];

        return ['redirect' => '/cp/flexible-forms/' . $handle . '/edit' ];

    } 

    public function build($form) {

      $this->authorize('edit', $form);

      $blueprint = $form->blueprint();

      return view('flexible-forms::build', [
          'form' => $form,
          'blueprint' => $blueprint,
          'blueprintVueObject' => $this->toVueObject($blueprint),
      ]);

    }

    public function edit($form) {

      $this->authorize('edit', $form);

      $values = [
          'handle' => $form->handle(),
          'title' => __($form->title()),
          'honeypot' => $form->honeypot(),
          'store' => $form->store(),
          'email' => $form->email(),
      ];

      $fields = ($blueprint = $this->editFormBlueprint($form))
          ->fields()
          ->addValues($values)
          ->preProcess();

      return view('flexible-forms::edit', [
          'blueprint' => $blueprint->toPublishArray(),
          'values' => $fields->values(),
          'meta' => $fields->meta(),
          'form' => $form,
      ]);

    }

    // return list of all forms
    public function forms()
    {
        $forms = Form::all()->map(function ($form) {
            return [
                'handle' => $form->handle(),
                'title' => $form->title(),
                'submissions' => $form->submissions()->count(),
            ];
        });

        return response()->json($forms);
    }

    // delete a form by handle
    public function delete(Request $request, $formHandle)
    {
        // Retrieve the form by handle
        $forms = Form::all();

        $form = $forms->first(function ($form) use ($formHandle) {
          return $form->handle() === $formHandle;
        });

        // Check if the form exists
        if ($form) {
            // Delete the form
            $form->delete();

            // Optionally, you can delete associated submissions if needed
            // $form->submissions()->delete();

            return response()->json(['message' => 'Form deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Form not found'], 404);
        }
    }

    // return list of all forms
    public function submissions(Request $request, $formHandle)
    {
        // Retrieve the form by handle
        $forms = Form::all();

        $form = $forms->first(function ($form) use ($formHandle) {
          return $form->handle() === $formHandle;
        });

        if ($form) {

           $submissions = $form->submissions();

           return view('flexible-forms::submissions', [
              'form' => $form,
              'submissions' => $submissions,
          ]);

        }

    }


    // return single submission
    public function submission(Request $request, $form, $submission)
    {
        
      if (! $submission = $form->submission($submission)) {
        return $this->pageNotFound();
      }

      $this->authorize('view', $submission);

      $blueprint = $submission->blueprint();
      $fields = $blueprint->fields()->addValues($submission->data()->all())->preProcess();

      return view('flexible-forms::submission', [
        'form' => $form,
        'submission' => $submission,
        'blueprint' => $blueprint->toPublishArray(),
        'values' => $fields->values(),
        'meta' => $fields->meta(),
        'title' => $submission->formattedDate(),
      ]);

      /*

      return view('statamic::forms.submission', [
        'form' => $form,
        'submission' => $submission,
        'blueprint' => $blueprint->toPublishArray(),
        'values' => $fields->values(),
        'meta' => $fields->meta(),
        'title' => $submission->formattedDate(),
      ]);

      */

      /*

        if ($form) {

           $submissions = $form->submissions();

           return view('flexible-forms::submission', [
              'form' => $form,
              'submissions' => $submissions,
          ]);

        }

        */

    }


    protected function editFormBlueprint($form)
    {
        return Blueprint::makeFromTabs([
            'name' => [
                'display' => __('Name'),
                'fields' => [
                    'title' => [
                        'type' => 'text',
                        'validate' => 'required',
                        'instructions' => __('statamic::messages.form_configure_title_instructions'),
                    ],
                ],
            ],
            'fields' => [
                'display' => __('Fields'),
                'fields' => [
                    'blueprint' => [
                        'type' => 'html',
                        'instructions' => __('statamic::messages.form_configure_blueprint_instructions'),
                        'html' => ''.
                            '<div class="text-xs">'.
                            '   <a href="'.cp_route('forms.blueprint.edit', $form->handle()).'" class="text-blue">'.__('Edit').'</a>'.
                            '</div>',
                    ],
                    'honeypot' => [
                        'type' => 'text',
                        'instructions' => __('statamic::messages.form_configure_honeypot_instructions'),
                    ],
                ],
            ],
            'submissions' => [
                'display' => __('Submissions'),
                'fields' => [
                    'store' => [
                        'display' => __('Store Submissions'),
                        'type' => 'toggle',
                        'instructions' => __('statamic::messages.form_configure_store_instructions'),
                    ],
                ],
            ],
            'email' => [
                'display' => __('Email'),
                'fields' => [
                    'email' => [
                        'type' => 'grid',
                        'mode' => 'stacked',
                        'add_row' => __('Add Email'),
                        'instructions' => __('statamic::messages.form_configure_email_instructions'),
                        'fields' => [
                            [
                                'handle' => 'to',
                                'field' => [
                                    'type' => 'text',
                                    'display' => __('Recipient(s)'),
                                    'validate' => [
                                        'required',
                                    ],
                                    'instructions' => __('statamic::messages.form_configure_email_to_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'cc',
                                'field' => [
                                    'type' => 'text',
                                    'display' => __('CC Recipient(s)'),
                                    'instructions' => __('statamic::messages.form_configure_email_cc_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'bcc',
                                'field' => [
                                    'type' => 'text',
                                    'display' => __('BCC Recipient(s)'),
                                    'instructions' => __('statamic::messages.form_configure_email_bcc_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'from',
                                'field' => [
                                    'type' => 'text',
                                    'display' => __('Sender'),
                                    'instructions' => __('statamic::messages.form_configure_email_from_instructions').' ('.config('mail.from.address').').',
                                ],
                            ],
                            [
                                'handle' => 'reply_to',
                                'field' => [
                                    'type' => 'text',
                                    'display' => __('Reply To'),
                                    'instructions' => __('statamic::messages.form_configure_email_reply_to_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'subject',
                                'field' => [
                                    'type' => 'text',
                                    'display' => __('Subject'),
                                    'instructions' => __('statamic::messages.form_configure_email_subject_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'html',
                                'field' => [
                                    'type' => 'template',
                                    'display' => __('HTML view'),
                                    'instructions' => __('statamic::messages.form_configure_email_html_instructions'),
                                    'folder' => config('statamic.forms.email_view_folder'),
                                ],
                            ],
                            [
                                'handle' => 'text',
                                'field' => [
                                    'type' => 'template',
                                    'display' => __('Text view'),
                                    'instructions' => __('statamic::messages.form_configure_email_text_instructions'),
                                    'folder' => config('statamic.forms.email_view_folder'),
                                ],
                            ],
                            [
                                'handle' => 'markdown',
                                'field' => [
                                    'type' => 'toggle',
                                    'display' => __('Markdown'),
                                    'instructions' => __('statamic::messages.form_configure_email_markdown_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'attachments',
                                'field' => [
                                    'type' => 'toggle',
                                    'display' => __('Attachments'),
                                    'instructions' => __('statamic::messages.form_configure_email_attachments_instructions'),
                                ],
                            ],
                            [
                                'handle' => 'mailer',
                                'field' => [
                                    'type' => 'select',
                                    'instructions' => __('statamic::messages.form_configure_mailer_instructions'),
                                    'options' => array_keys(config('mail.mailers')),
                                    'clearable' => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            // metrics
        ]);
    }
    

}