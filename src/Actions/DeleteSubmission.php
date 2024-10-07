<?php

namespace AddonFoundry\FlexibleForms\Actions;

use Statamic\Actions\Action;
use Statamic\Facades\User;
use Statamic\Actions\Delete;

class DeleteSubmission extends Action
{
  protected $dangerous = true;


  public static function title()
  {
      return __('Delete');
  }

  public function visibleTo($item)
  {

    $user = User::current();

    if ($user->isSuper()) {
      return false; // avoid multiple delete actions - default delete action allowed for super users
    }

    if ($user->hasPermission('edit flexible forms')) {
      return true;  // allow for users with edit permission but without super user
    }

    return false;

  }

  public function authorize($user, $item)
  {

    return $user->can('edit flexible forms', $item);

  }

  public function run($items, $values)
  {
    
    $items->each->delete();

  }
}
