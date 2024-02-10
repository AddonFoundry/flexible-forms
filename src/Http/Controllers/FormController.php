<?php

namespace AddonFoundry\FlexibleForms\Http\Controllers;

use Statamic\Facades\User;
use Illuminate\Http\Request;
use GertTimmerman\StatamicZapier\Webhooks;
use Statamic\Http\Controllers\CP\CpController;
use Statamic\Support\Arr;

class FormController extends CpController
{
    public function list()
    {
        /*
        abort_unless(User::current()->can('configure form zapier webhooks'), 403);

        $blueprint = Webhooks::blueprint();

        $fields = $blueprint
            ->fields()
            ->addValues(Webhooks::load()->all())
            ->preProcess();

            */

        return view('flexible-forms::index', [
            'title' => 'Flexible Forms',
            'action' => cp_route('flexible-forms.index'),
            //'blueprint' => $blueprint->toPublishArray(),
            //'meta' => $fields->meta(),
            //'values' => $fields->values()
        ]);

    }

    public function create()
    {
       
      return view('flexible-forms::create', [
        'title' => 'Flexible Forms',
        'action' => cp_route('flexible-forms.create'),
    ]);

    }

}