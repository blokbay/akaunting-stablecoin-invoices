<?php

namespace Modules\Blokbay\Listeners;

use App\Events\Menu\SettingsCreated as Event;
use App\Traits\Modules;
use App\Traits\Permissions;

class ShowInSettingsMenu
{
    use Modules, Permissions;

    public function handle(Event $event)
    {
        if (! $this->moduleIsEnabled('blokbay')) {
            return;
        }

        $title = trans('blokbay::general.name');

        if ($this->canAccessMenuItem($title, 'read-blokbay-settings')) {
            $event->menu->route('blokbay.settings.edit', $title, [], 110, ['icon' => 'account_balance_wallet', 'search_keywords' => trans('blokbay::general.description')]);
        }
    }
}
