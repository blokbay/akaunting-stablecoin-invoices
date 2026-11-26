<?php

return [

    'name' => 'Blokbay',
    'description' => 'Ihr Kunde bezahlt die Rechnung in USDC oder USDT auf der Blokbay-Zahlungsseite, und die Zahlung wird automatisch auf der Rechnung verbucht.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Bezahlen Sie diese Rechnung in USDC oder USDT aus Ihrem Wallet auf der sicheren Blokbay-Zahlungsseite.',
    'pay_title' => 'Diese Rechnung in USDC oder USDT bezahlen',
    'pay_button' => 'In USDC/USDT bezahlen',
    'create_button' => 'Mit Blokbay bezahlen',
    'email_line' => 'Sie können diese Rechnung in USDC oder USDT bezahlen:',
    'taxes' => 'Steuern',
    'balance_line' => 'Restbetrag der Rechnung :number',

    'settings' => [
        'title' => 'Einstellungen',
        'api' => 'Blokbay-Konto',
        'api_description' => 'Schlüssel von der Seite Zahlungen von Ihrer Website im Blokbay-Dashboard.',
        'api_url' => 'API-URL',
        'secret_key' => 'Geheimer Schlüssel (sk_live_...)',
        'webhook_secret' => 'Webhook-Signaturgeheimnis (whsec_...)',
        'saved' => 'Gespeichert (:hint): leer lassen, um es zu behalten',
        'account' => 'Bankkonto für die Zahlungen',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay meldet Akaunting, wenn eine Rechnung bezahlt oder storniert wird.',
        'webhook_url' => 'Webhook-URL zum Kopieren in Ihr Blokbay-Dashboard',
        'webhook_events' => 'Ereignisse: invoice.paid, invoice.voided. Jedes Ereignis ist signiert und wird mit der API geprüft.',
        'how' => 'Öffnen Sie eine gesendete Rechnung und klicken Sie auf Mit Blokbay bezahlen: Der Zahlungslink erscheint auf der Rechnung, im PDF, auf der Kundenseite und in der Rechnungs-E-Mail. Wenn der Kunde bezahlt, wird die Zahlung auf dem hier gewählten Konto zur Rechnung gebucht.',
    ],

    'messages' => [
        'configure' => 'Fügen Sie Ihre Blokbay-Schlüssel hinzu, um USDC und USDT auf dieser Rechnung anzunehmen.',
        'create_help' => 'Zahlungslink erstellen: Ihr Kunde zahlt in USDC oder USDT und die Zahlung wird hier automatisch verbucht.',
        'created' => 'Blokbay-Zahlungslink für Rechnung :number erstellt.',
        'link_ready' => 'Zahlungslink der Blokbay-Rechnung :number, auch im PDF, auf der Kundenseite und in der Rechnungs-E-Mail.',
        'paid' => 'Mit Blokbay bezahlt (Rechnung :number).',
        'voided' => 'Der vorherige Zahlungslink wurde storniert.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: Fügen Sie zuerst den geheimen Schlüssel in den Einstellungen hinzu.',
        'unreachable' => 'Blokbay: Die API ist nicht erreichbar, versuchen Sie es in einigen Minuten erneut.',
        'api' => 'Die Anfrage wurde abgelehnt.',
        'unexpected' => 'Blokbay: unerwartete Antwort der API.',
        'currency' => 'Blokbay-Rechnungen akzeptieren :accepted, nicht :currency.',
        'email' => 'Fügen Sie dem Kunden eine E-Mail-Adresse hinzu: Blokbay benötigt sie für den Zahlungslink.',
        'not_payable' => 'Nur gesendete, noch nicht bezahlte Verkaufsrechnungen können mit Blokbay bezahlt werden.',
        'portal' => 'Diese Zahlungsart ist derzeit nicht verfügbar. Bitte versuchen Sie es später erneut.',
        'api_url' => 'Geben Sie die API-URL mit https ein, zum Beispiel https://blokbay.com.',
        'secret_key' => 'Der geheime Schlüssel beginnt mit sk_live_.',
        'webhook_secret' => 'Das Webhook-Geheimnis beginnt mit whsec_.',
        'account' => 'Wählen Sie ein Bankkonto.',
    ],

];
