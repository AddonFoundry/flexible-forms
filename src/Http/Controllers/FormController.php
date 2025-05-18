<?php

namespace AddonFoundry\FlexibleForms\Http\Controllers;

use Statamic\Facades\User;
use Illuminate\Http\Request;
use Statamic\Facades\Form;
use Statamic\Contracts\Forms\Form as FormContract;
use Statamic\Http\Controllers\CP\CpController;
use Statamic\Support\Arr;
use Statamic\CP\Column;
use Statamic\Http\Controllers\CP\Fields\ManagesBlueprints;
use Statamic\Facades\Blueprint;
use Statamic\Http\Requests\FilteredRequest;
use Statamic\Http\Resources\CP\Submissions\Submissions;
use Statamic\Query\Scopes\Filters\Concerns\QueriesFilters;

use Statamic\Facades\Action;
use Facades\Statamic\Fields\FieldtypeRepository;
use Statamic\Exceptions\NotFoundHttpException;

class FormController extends CpController
{
    use ManagesBlueprints;
    use QueriesFilters;

    protected $configs = [];

    public function index(Request $request)
    {
        $user = User::current();

        abort_unless($user->isSuper() || $user->hasPermission('view flexible forms'), 401);

        $columns = [
            Column::make('title')->label(__('Title')),
            Column::make('submissions')->label(__('Submissions')),
        ];

        $forms = Form::all()
            ->map(function ($form) {
                return [
                    'id' => $form->handle(),
                    'title' => __($form->title()),
                    'submissions' => $form->submissions()->count(),
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
            'title' => 'Flexible Forms',
            'user' => $user,
        ]);
    }

    public function create()
    {
        $user = User::current();

        abort_unless($user->isSuper() || $user->hasPermission('create flexible forms'), 401);

        return view('flexible-forms::create', [
            'title' => 'Flexible Forms',
            'action' => cp_route('flexible-forms.create'),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeProIf(Form::all()->count() >= 1);

        $user = User::current();

        abort_unless($user->isSuper() || $user->hasPermission('create flexible forms'), 401);

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

        return ['redirect' => '/cp/flexible-forms/' . $handle . '/build'];
    }

    public function build($form)
    {
        $this->authorize('edit flexible forms', $form);

        $blueprint = $form->blueprint();

        // Get fieldtypes
        $fieldtypes = app('statamic.fieldtypes')
        ->unique() // Remove any dupes in the case of aliases. Aliases are defined later so they will win.
        ->map(function ($class) {
            return app($class);
        });

        $selectableMethod = 'selectableInForms';
        $fieldtypes = $fieldtypes->filter->$selectableMethod();

        // Define the desired order of categories
        $categoryOrder = [
        'text' => 0,
        'controls' => 1,
        'media' => 2,
        'number' => 3,
        'relationship' => 4,
        'special' => 5,
        ];

        // Sorting function for fieldtypes
        $sortedFieldtypes = $fieldtypes->sortBy(function ($fieldtype) use ($categoryOrder) {
        // Assuming there's a method or accessor for retrieving categories
        $categories = $fieldtype->categories(); // or $fieldtype->getCategories()

        // Find the first matching category from the order list
        foreach ($categories as $category) {
            if (isset($categoryOrder[$category])) {
                return $categoryOrder[$category];
            }
        }

        // Default to a high number if no matching category is found
        return 999;
        })->values();

        return view('flexible-forms::build', [
        'form' => $form,
        'blueprint' => $blueprint,
        'blueprintVueObject' => $this->toVueObject($blueprint),
        'availableFieldtypes' => $sortedFieldtypes,
        ]);

    }

    public function update($form, Request $request)
    {
        $this->authorize('edit flexible forms', $form);

        $request->validate(['tabs' => 'array']);

        $this->updateBlueprint($request, $form->blueprint());

    }

    public function settings($form, Request $request)
    {
        $this->authorize('edit flexible forms', $form);

        $this->extraConfigFor($form->handle());

        $fields = $this->editFormBlueprint($form)->fields()->addValues($request->all());

        $fields->validate();

        $values = $fields->process()->values()->all();

        $data = collect($values)->except(['title', 'honeypot', 'store', 'email']);

        $form
            ->title($values['title'])
            ->honeypot($values['honeypot'])
            ->store($values['store'])
            ->email($values['email'])
            ->merge($data);

        $form->save();

        $this->success(__('Saved'));
    }

    // Add custom fields to the form config
    public function appendConfigFields($handles, string $display, array $fields)
    {
        $this->configs[] = [
            'display' => $display,
            'handles' => Arr::wrap($handles),
            'fields' => $fields,
        ];
    }

    // // Get custom fields for the form config
    public function extraConfigFor($handle)
    {
        $reserved = ['title', 'honeypot', 'store', 'email'];

        return collect($this->configs)
            ->filter(function ($config) use ($handle) {
                return in_array('*', $config['handles']) || in_array($handle, $config['handles']);
            })
            ->flatMap(function ($config) use ($reserved) {

                return [
                    Str::snake($config['display']) => [
                        'display' => $config['display'],
                        'fields' => collect($config['fields'])
                            ->filter(fn ($field, $index) => ! in_array($field['handle'] ?? $index, $reserved))
                            ->all(),
                    ],
                ];
            })
            ->all();
    }


    public function edit($form)
    {
        $this->authorize('edit', $form);

        $values = array_merge($form->data()->all(), [
            'handle' => $form->handle(),
            'title' => __($form->title()),
            'honeypot' => $form->honeypot(),
            'store' => $form->store(),
            'email' => $form->email(),
        ]);

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

    // public function edit($form)
    // {
    //     $this->authorize('edit flexible forms', $form);
        
    //     $values = [
    //         'handle' => $form->handle(),
    //         'title' => __($form->title()),
    //         'honeypot' => $form->honeypot(),
    //         'store' => $form->store(),
    //         'email' => $form->email(),
    //     ];

    //     $fields = ($blueprint = $this->editFormBlueprint($form))
    //         ->fields()
    //         ->addValues($values)
    //         ->preProcess();

    //     return view('flexible-forms::edit', [
    //         'blueprint' => $blueprint->toPublishArray(),
    //         'values' => $fields->values(),
    //         'meta' => $fields->meta(),
    //         'form' => $form,
    //     ]);
    // }

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

    public function delete(Request $request, $formHandle)
    {

       try {

        $this->authorize('delete flexible forms', $formHandle);


        $forms = Form::all();

        $form = $forms->first(function ($form) use ($formHandle) {
            return $form->handle() === $formHandle;
        });
      
        if ($form) {
            $form->submissions()->each->delete();
            $form->delete();
    
            return response()->json(['message' => 'Form and associated data deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Form not found'], 404);
        }

      } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
          return response()->json(['error' => 'You are not authorized to delete this form.'], 403);
      }

    }

    public function submissions(Request $request, $form)
    {
        if (!$form->blueprint()) {
            return ['data' => [], 'meta' => ['columns' => []]];
        }

        $query = $this->indexQuery($form);

        $activeFilterBadges = $this->queryFilters($query, $request->filters, [
            'form' => $form->handle(),
        ]);

        $sortField = request('sort', 'date');
        $sortDirection = request('order', $sortField === 'date' ? 'desc' : 'asc');

        if ($sortField) {
            $query->orderBy($sortField, $sortDirection);
        }

        $submissions = $query->paginate(request('perPage'));

        if ($request->wantsJson()) {
            return (new Submissions($submissions))
                ->blueprint($form->blueprint())
                ->columnPreferenceKey("forms.{$form->handle()}.columns")
                ->additional(['meta' => [
                    'activeFilterBadges' => $activeFilterBadges,
                ]]);
        }

        return view('flexible-forms::submissions', [
            'form' => $form,
            'submissions' => $submissions,
        ]);
    }

    public function submission(Request $request, $form, $submission)
    {
        if (!$submission = $form->submission($submission)) {
            return $this->pageNotFound();
        }

        $this->authorize('edit flexible forms', $form);

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
    }

    public function submissionData(FilteredRequest $request, $form)
    {
        if (!$form->blueprint()) {
            return ['data' => [], 'meta' => ['columns' => []]];
        }

        $query = $this->indexQuery($form);

        $activeFilterBadges = $this->queryFilters($query, $request->filters, [
            'form' => $form->handle(),
        ]);

        $sortField = request('sort', 'date');
        $sortDirection = request('order', $sortField === 'date' ? 'desc' : 'asc');

        if ($sortField) {
            $query->orderBy($sortField, $sortDirection);
        }

        $submissions = $query->paginate(request('perPage'));

        return (new Submissions($submissions))
            ->blueprint($form->blueprint())
            ->columnPreferenceKey("forms.{$form->handle()}.columns")
            ->additional(['meta' => [
                'activeFilterBadges' => $activeFilterBadges,
            ]]);
    }

//     public function submissionData(FilteredRequest $request, $form)
// {
//     if (!$form->blueprint()) {
//         return ['data' => [], 'meta' => ['columns' => []]];
//     }

//     $query = $this->indexQuery($form);

//     $activeFilterBadges = $this->queryFilters($query, $request->filters, [
//         'form' => $form->handle(),
//     ]);

//     $sortField = request('sort', 'date');
//     $sortDirection = request('order', $sortField === 'date' ? 'desc' : 'asc');

//     if ($sortField) {
//         $query->orderBy($sortField, $sortDirection);
//     }

//     $submissions = $query->paginate(request('perPage'));

//     // Create a new collection with actions added to each submission
//     $submissionsWithActions = $submissions->map(function ($submission) {
//         // Get all registered actions
//         $actions = Action::for($submission);
        
//         // Filter actions based on your addon's permissions
//         $filteredActions = $actions->filter(function ($action) use ($submission) {
//             // Check if the action class has a custom authorize method
//             if (method_exists($action, 'authorizeForFlexibleForms')) {
//                 return $action::authorizeForFlexibleForms(User::current(), $submission);
//             }
//             // Fallback to checking flexible forms permissions
//             return User::current()->can('edit flexible forms');
//         });
        
//         // Add the filtered actions to the submission
//         $submission->actions = $filteredActions->values();
        
//         return $submission;
//     });

//     // Replace the original submissions with our modified collection
//     $submissions->setCollection($submissionsWithActions);

//     $response = (new Submissions($submissions))
//         ->blueprint($form->blueprint())
//         ->columnPreferenceKey("forms.{$form->handle()}.columns")
//         ->additional(['meta' => [
//             'activeFilterBadges' => $activeFilterBadges,
//         ]]);

//     // Add permissions meta data
//     $response->additional(['meta' => [
//         'permissions' => [
//             'view' => User::current()->can('view flexible forms'),
//             'edit' => User::current()->can('edit flexible forms'),
//         ]
//     ]]);

//     return $response;
// }

    protected function indexQuery($form)
    {
        $query = $form->querySubmissions();

        if ($search = request('search')) {
            $query->where('date', 'like', '%'.$search.'%');

            $form->blueprint()->fields()->all()
                ->filter(function ($field) {
                    return in_array($field->type(), ['text', 'textarea', 'integer']);
                })
                ->each(function ($field) use ($query, $search) {
                    $query->orWhere($field->handle(), 'like', '%'.$search.'%');
                });
        }

        return $query;
    }

    protected function getSelectedItems($items, $context)
    {
        $form = $this->request->route('form');

        return $items->map(function ($item) use ($form) {
            return $form->submission($item);
        });
    }

    public function export($form, $type)
    {
        $this->authorize('view flexible forms', $form);

        if (! $exporter = $form->exporter($type)) {
            throw new NotFoundHttpException;
        }

        return $this->request->has('download') ? $exporter->download() : $exporter->response();
    }

    protected function editFormBlueprint($form)
    {
        $fields = [
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
            // ...

        ];

        foreach (Form::extraConfigFor($form->handle()) as $handle => $config) {
            $merged = false;
            foreach ($fields as $sectionHandle => $section) {
                if ($section['display'] == __($config['display'])) {
                    $fields[$sectionHandle]['fields'] += $config['fields'];
                    $merged = true;
                }
            }

            if (! $merged) {
                $fields[$handle] = $config;
            }
        }

        return Blueprint::makeFromTabs($fields);
    }

}