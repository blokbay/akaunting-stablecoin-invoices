<?php

namespace Modules\Blokbay\Listeners;

use App\Events\Module\Installed as Event;
use App\Traits\Permissions;

class FinishInstallation
{
    use Permissions;

    public $alias = 'blokbay';

    public function handle(Event $event)
    {
        if ($event->alias != $this->alias) {
            return;
        }

        // c=create, r=read, u=update: settings page and the "Pay with Blokbay" button.
        $this->attachPermissionsToAdminRoles([
            $this->alias . '-settings' => 'r,u',
            $this->alias . '-invoices' => 'c',
        ]);
    }
}
