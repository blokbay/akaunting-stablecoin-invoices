<?php

namespace Modules\Blokbay\Listeners;

use App\Events\Document\DocumentCancelled as Event;
use Modules\Blokbay\Services\Blokbay;

/**
 * An Akaunting invoice marked as cancelled cancels its Blokbay payment link too.
 */
class VoidOnInvoiceCancelled
{
    public function handle(Event $event)
    {
        if (($event->document->type ?? '') !== 'invoice') {
            return;
        }

        Blokbay::voidInvoice($event->document);
    }
}
