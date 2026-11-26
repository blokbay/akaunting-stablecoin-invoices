<?php

namespace Modules\Blokbay\Services;

use Illuminate\View\View;
use Modules\Blokbay\Models\BlokbayInvoice;

/**
 * View composers: the "Pay with Blokbay" box on the invoice page and the payment link under the notes of the invoice
 * (invoice page, customer page, print view and PDF).
 */
class Views
{
    /** Last content pushed into the notes of a template, removed before the next invoice (bulk PDF export). */
    protected static ?string $pushed = null;

    public function getPaid(View $view): void
    {
        $document = $view->getData()['document'] ?? null;

        if (empty($document) || ($document->type ?? '') !== 'invoice' || ! user() || user()->cannot('create-blokbay-invoices')) {
            return;
        }

        if (in_array($document->status, ['paid', 'cancelled', 'draft']) && ! BlokbayInvoice::forDocument($document)) {
            return;
        }

        $html = view('blokbay::get-paid', [
            'document' => $document,
            'row' => BlokbayInvoice::forDocument($document),
            'configured' => Blokbay::isConfigured(),
            'can_pay' => Blokbay::canPay($document),
        ])->render();

        $view->getFactory()->startPush('timeline_get_paid_body_button_payment_end', $html);
    }

    public function template(View $view): void
    {
        $factory = $view->getFactory();
        $document = $view->getData()['document'] ?? null;

        $this->forgetPrevious($factory);

        $url = BlokbayInvoice::openUrl($document);

        if (! $url) {
            return;
        }

        static::$pushed = view('blokbay::link', ['url' => $url])->render();

        $factory->startPush('notes_input_end', static::$pushed);
    }

    /**
     * Blade stacks live for the whole request: when several invoices are rendered (bulk PDF), the link of the previous one is removed.
     */
    protected function forgetPrevious($factory): void
    {
        if (static::$pushed === null) {
            return;
        }

        $old = static::$pushed;
        static::$pushed = null;

        try {
            \Closure::bind(function () use ($old) {
                foreach ($this->pushes['notes_input_end'] ?? [] as $count => $content) {
                    $this->pushes['notes_input_end'][$count] = str_replace($old, '', $content);
                }
            }, $factory, get_class($factory))();
        } catch (\Throwable $e) {
            // Older or different view factory: the link of the previous invoice may stay, nothing else changes.
        }
    }
}
