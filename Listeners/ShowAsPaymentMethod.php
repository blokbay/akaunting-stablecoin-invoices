<?php

namespace Modules\Blokbay\Listeners;

use App\Events\Module\PaymentMethodShowing as Event;
use Modules\Blokbay\Services\Blokbay;

/**
 * Blokbay in the payment methods: customer invoice page (signed link and portal) and the payment method of the transactions it registers.
 */
class ShowAsPaymentMethod
{
    public function handle(Event $event)
    {
        if (! Blokbay::isConfigured()) {
            return;
        }

        $event->modules->payment_methods[] = [
            'code' => 'blokbay',
            'name' => trans('blokbay::general.method_name'),
            'customer' => 1,
            'order' => 1,
        ];
    }
}
