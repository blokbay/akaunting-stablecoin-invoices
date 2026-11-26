<?php

namespace Modules\Blokbay\Listeners;

use App\Notifications\Sale\Invoice as InvoiceNotification;
use Illuminate\Notifications\Events\NotificationSending as Event;
use Modules\Blokbay\Models\BlokbayInvoice;

/**
 * Invoice email: the {blokbay_payment_link} placeholder of the email template is replaced with the payment link, and when the template
 * has no placeholder the "Pay in USDC or USDT" button is added after the text.
 */
class AddLinkToInvoiceEmail
{
    public const TAG = '{blokbay_payment_link}';

    public function handle(Event $event)
    {
        $notification = $event->notification;

        if (! $notification instanceof InvoiceNotification || $event->channel !== 'mail' || empty($notification->invoice)) {
            return;
        }

        $url = BlokbayInvoice::openUrl($notification->invoice);
        $custom = is_array($notification->custom_mail) ? $notification->custom_mail : [];

        $body = ! empty($custom['body']) ? (string) $custom['body'] : (! empty($notification->template) ? $notification->replaceTags((string) $notification->template->body) : '');

        if ($body === '') {
            return;
        }

        if (! $url) {
            if (str_contains($body, self::TAG)) {
                $custom['body'] = str_replace(self::TAG, '', $body);
                $notification->custom_mail = $custom;
            }

            return;
        }

        if (str_contains($body, $url)) {
            return;
        }

        $link = e($url);

        $html = str_contains($body, self::TAG)
            ? str_replace(self::TAG, '<a href="' . $link . '">' . $link . '</a>', $body)
            : $body . view('blokbay::email', ['url' => $url])->render();

        $custom['body'] = $html;
        $notification->custom_mail = $custom;
    }
}
