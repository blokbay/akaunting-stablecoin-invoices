<?php

return [

    'name' => 'Blokbay',
    'description' => 'Twój klient płaci fakturę w USDC lub USDT na stronie płatności Blokbay, a płatność sama zapisuje się na fakturze.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Zapłać tę fakturę w USDC lub USDT ze swojego portfela na bezpiecznej stronie płatności Blokbay.',
    'pay_title' => 'Zapłać tę fakturę w USDC lub USDT',
    'pay_button' => 'Zapłać w USDC/USDT',
    'create_button' => 'Zapłać przez Blokbay',
    'email_line' => 'Możesz zapłacić tę fakturę w USDC lub USDT:',
    'taxes' => 'Podatki',
    'balance_line' => 'Saldo faktury :number',

    'settings' => [
        'title' => 'Ustawienia',
        'api' => 'Konto Blokbay',
        'api_description' => 'Klucze ze strony Płatności z Twojej witryny w panelu Blokbay.',
        'api_url' => 'Adres API',
        'secret_key' => 'Klucz tajny (sk_live_...)',
        'webhook_secret' => 'Sekret podpisu webhooka (whsec_...)',
        'saved' => 'Zapisano (:hint): zostaw puste, aby zachować',
        'account' => 'Konto bankowe dla płatności',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay informuje Akaunting, gdy faktura zostanie opłacona lub anulowana.',
        'webhook_url' => 'Adres webhooka do skopiowania w panelu Blokbay',
        'webhook_events' => 'Zdarzenia: invoice.paid, invoice.voided. Każde zdarzenie jest podpisane i sprawdzane przez API.',
        'how' => 'Otwórz wysłaną fakturę i kliknij Zapłać przez Blokbay: link do płatności pojawi się na fakturze, w PDF, na stronie klienta i w e-mailu z fakturą. Gdy klient zapłaci, płatność zostanie dodana do faktury na wybranym tutaj koncie.',
    ],

    'messages' => [
        'configure' => 'Dodaj klucze Blokbay, aby przyjmować USDC i USDT na tej fakturze.',
        'create_help' => 'Utwórz link do płatności: klient płaci w USDC lub USDT, a płatność sama zapisuje się tutaj.',
        'created' => 'Utworzono link do płatności Blokbay dla faktury :number.',
        'link_ready' => 'Link do płatności faktury Blokbay :number, także w PDF, na stronie klienta i w e-mailu z fakturą.',
        'paid' => 'Opłacono przez Blokbay (faktura :number).',
        'voided' => 'Poprzedni link do płatności został anulowany.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: najpierw dodaj klucz tajny w ustawieniach.',
        'unreachable' => 'Blokbay: brak połączenia z API, spróbuj ponownie za kilka minut.',
        'api' => 'Żądanie zostało odrzucone.',
        'unexpected' => 'Blokbay: nieoczekiwana odpowiedź API.',
        'currency' => 'Faktury Blokbay obsługują :accepted, nie :currency.',
        'email' => 'Dodaj adres e-mail klienta: Blokbay potrzebuje go do linku płatności.',
        'not_payable' => 'Przez Blokbay można opłacić tylko wysłane i jeszcze nieopłacone faktury sprzedaży.',
        'portal' => 'Ta metoda płatności jest teraz niedostępna. Spróbuj ponownie później.',
        'api_url' => 'Wpisz adres API z https, na przykład https://blokbay.com.',
        'secret_key' => 'Klucz tajny zaczyna się od sk_live_.',
        'webhook_secret' => 'Sekret webhooka zaczyna się od whsec_.',
        'account' => 'Wybierz konto bankowe.',
    ],

];
