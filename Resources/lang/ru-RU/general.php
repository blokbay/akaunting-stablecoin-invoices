<?php

return [

    'name' => 'Blokbay',
    'description' => 'Ваш клиент оплачивает счёт в USDC или USDT на платёжной странице Blokbay, и платёж автоматически отражается в счёте.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Оплатите этот счёт в USDC или USDT из своего кошелька на защищённой платёжной странице Blokbay.',
    'pay_title' => 'Оплатить этот счёт в USDC или USDT',
    'pay_button' => 'Оплатить в USDC/USDT',
    'create_button' => 'Оплатить через Blokbay',
    'email_line' => 'Вы можете оплатить этот счёт в USDC или USDT:',
    'taxes' => 'Налоги',
    'balance_line' => 'Остаток по счёту :number',

    'settings' => [
        'title' => 'Настройки',
        'api' => 'Аккаунт Blokbay',
        'api_description' => 'Ключи со страницы «Платежи с вашего сайта» в панели Blokbay.',
        'api_url' => 'URL API',
        'secret_key' => 'Секретный ключ (sk_live_...)',
        'webhook_secret' => 'Секрет подписи вебхука (whsec_...)',
        'saved' => 'Сохранено (:hint): оставьте пустым, чтобы не менять',
        'account' => 'Банковский счёт для платежей',
        'webhook' => 'Вебхук',
        'webhook_description' => 'Blokbay сообщает Akaunting, когда счёт оплачен или отменён.',
        'webhook_url' => 'URL вебхука для панели Blokbay',
        'webhook_events' => 'События: invoice.paid, invoice.voided. Каждое событие подписано и проверяется через API.',
        'how' => 'Откройте отправленный счёт и нажмите «Оплатить через Blokbay»: ссылка на оплату появится в счёте, в PDF, на странице клиента и в письме со счётом. Когда клиент платит, платёж добавляется к счёту на выбранный здесь счёт.',
    ],

    'messages' => [
        'configure' => 'Добавьте ключи Blokbay, чтобы принимать USDC и USDT по этому счёту.',
        'create_help' => 'Создайте ссылку на оплату: клиент платит в USDC или USDT, и платёж отражается здесь автоматически.',
        'created' => 'Ссылка на оплату Blokbay создана для счёта :number.',
        'link_ready' => 'Ссылка на оплату счёта Blokbay :number, также в PDF, на странице клиента и в письме со счётом.',
        'paid' => 'Оплачено через Blokbay (счёт :number).',
        'voided' => 'Предыдущая ссылка на оплату отменена.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: сначала добавьте секретный ключ в настройках.',
        'unreachable' => 'Blokbay: API недоступен, повторите через несколько минут.',
        'api' => 'Запрос отклонён.',
        'unexpected' => 'Blokbay: неожиданный ответ API.',
        'currency' => 'Счета Blokbay принимают :accepted, а не :currency.',
        'email' => 'Укажите email клиента: он нужен Blokbay для ссылки на оплату.',
        'not_payable' => 'Через Blokbay можно оплатить только отправленные и ещё не оплаченные счета продаж.',
        'portal' => 'Этот способ оплаты сейчас недоступен. Попробуйте позже.',
        'api_url' => 'Введите URL API с https, например https://blokbay.com.',
        'secret_key' => 'Секретный ключ начинается с sk_live_.',
        'webhook_secret' => 'Секрет вебхука начинается с whsec_.',
        'account' => 'Выберите банковский счёт.',
    ],

];
