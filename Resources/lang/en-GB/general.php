<?php

return [

    'name' => 'Blokbay',
    'description' => 'Your customer pays the invoice in USDC or USDT on the Blokbay payment page, and the payment is registered on the invoice by itself.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Pay this invoice in USDC or USDT from your wallet on the secure Blokbay payment page.',
    'pay_title' => 'Pay this invoice in USDC or USDT',
    'pay_button' => 'Pay in USDC/USDT',
    'create_button' => 'Pay with Blokbay',
    'email_line' => 'You can pay this invoice in USDC or USDT:',
    'taxes' => 'Taxes',
    'balance_line' => 'Balance of invoice :number',

    'settings' => [
        'title' => 'Settings',
        'api' => 'Blokbay account',
        'api_description' => 'Keys from the Payments from your site page of your Blokbay dashboard.',
        'api_url' => 'API URL',
        'secret_key' => 'Secret key (sk_live_...)',
        'webhook_secret' => 'Webhook signing secret (whsec_...)',
        'saved' => 'Saved (:hint): leave empty to keep it',
        'account' => 'Bank account for the payments',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay tells Akaunting when an invoice is paid or cancelled.',
        'webhook_url' => 'Webhook URL to copy in your Blokbay dashboard',
        'webhook_events' => 'Events: invoice.paid, invoice.voided. Every event is signed and checked with the API.',
        'how' => 'Open a sent invoice and click Pay with Blokbay: the payment link goes on the invoice, its PDF, the customer page and the invoice email. When the customer pays, the payment is added to the invoice in the account chosen here.',
    ],

    'messages' => [
        'configure' => 'Add your Blokbay keys to accept USDC and USDT on this invoice.',
        'create_help' => 'Create the payment link: your customer pays in USDC or USDT and the payment is registered here by itself.',
        'created' => 'Blokbay payment link created for invoice :number.',
        'link_ready' => 'Payment link of Blokbay invoice :number, also on the PDF, the customer page and the invoice email.',
        'paid' => 'Paid with Blokbay (invoice :number).',
        'voided' => 'The previous payment link was cancelled.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: add the secret key in the settings first.',
        'unreachable' => 'Blokbay: the API cannot be reached, try again in a few minutes.',
        'api' => 'The request was refused.',
        'unexpected' => 'Blokbay: unexpected answer from the API.',
        'currency' => 'Blokbay invoices accept :accepted, not :currency.',
        'email' => 'Add an email address to the customer: Blokbay needs it for the payment link.',
        'not_payable' => 'Only sent sales invoices that are not paid yet can be paid with Blokbay.',
        'portal' => 'This payment method is not available right now. Please try again later.',
        'api_url' => 'Enter the API URL with https, for example https://blokbay.com.',
        'secret_key' => 'The secret key starts with sk_live_.',
        'webhook_secret' => 'The webhook secret starts with whsec_.',
        'account' => 'Choose a bank account.',
    ],

];
