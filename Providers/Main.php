<?php

namespace Modules\Blokbay\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as Provider;
use Modules\Blokbay\Services\Views;

class Main extends Provider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'blokbay');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'blokbay');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // "Pay with Blokbay" in the Get paid box of the invoice page.
        View::composer('components.documents.show.get-paid', Views::class . '@getPaid');

        // Payment link under the notes of the invoice: invoice page, customer page, print and PDF.
        View::composer([
            'components.documents.template.default',
            'components.documents.template.classic',
            'components.documents.template.modern',
        ], Views::class . '@template');
    }

    public function register()
    {
        if (app()->routesAreCached()) {
            return;
        }

        foreach (['admin.php', 'portal.php', 'signed.php', 'webhook.php'] as $route) {
            $this->loadRoutesFrom(__DIR__ . '/../Routes/' . $route);
        }
    }

    public function provides()
    {
        return [];
    }
}
