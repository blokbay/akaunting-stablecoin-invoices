<?php

return [

    'name' => 'Blokbay',
    'description' => 'Tu cliente paga la factura en USDC o USDT en la página de pago de Blokbay y el pago se registra solo en la factura.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Paga esta factura en USDC o USDT desde tu wallet en la página de pago segura de Blokbay.',
    'pay_title' => 'Paga esta factura en USDC o USDT',
    'pay_button' => 'Pagar en USDC/USDT',
    'create_button' => 'Pagar con Blokbay',
    'email_line' => 'Puedes pagar esta factura en USDC o USDT:',
    'taxes' => 'Impuestos',
    'balance_line' => 'Saldo de la factura :number',

    'settings' => [
        'title' => 'Ajustes',
        'api' => 'Cuenta de Blokbay',
        'api_description' => 'Claves de la página Pagos desde tu sitio de tu panel de Blokbay.',
        'api_url' => 'URL de la API',
        'secret_key' => 'Clave secreta (sk_live_...)',
        'webhook_secret' => 'Secreto de firma del webhook (whsec_...)',
        'saved' => 'Guardado (:hint): déjalo vacío para conservarlo',
        'account' => 'Cuenta bancaria para los pagos',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay avisa a Akaunting cuando una factura se paga o se anula.',
        'webhook_url' => 'URL del webhook para copiar en tu panel de Blokbay',
        'webhook_events' => 'Eventos: invoice.paid, invoice.voided. Cada evento está firmado y se comprueba con la API.',
        'how' => 'Abre una factura enviada y pulsa Pagar con Blokbay: el enlace de pago aparece en la factura, su PDF, la página del cliente y el email de la factura. Cuando el cliente paga, el pago se añade a la factura en la cuenta elegida aquí.',
    ],

    'messages' => [
        'configure' => 'Añade tus claves de Blokbay para aceptar USDC y USDT en esta factura.',
        'create_help' => 'Crea el enlace de pago: tu cliente paga en USDC o USDT y el pago se registra aquí solo.',
        'created' => 'Enlace de pago de Blokbay creado para la factura :number.',
        'link_ready' => 'Enlace de pago de la factura de Blokbay :number, también en el PDF, la página del cliente y el email de la factura.',
        'paid' => 'Pagada con Blokbay (factura :number).',
        'voided' => 'El enlace de pago anterior se anuló.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: añade primero la clave secreta en los ajustes.',
        'unreachable' => 'Blokbay: no se puede conectar con la API, inténtalo de nuevo en unos minutos.',
        'api' => 'La solicitud fue rechazada.',
        'unexpected' => 'Blokbay: respuesta inesperada de la API.',
        'currency' => 'Las facturas de Blokbay aceptan :accepted, no :currency.',
        'email' => 'Añade un email al cliente: Blokbay lo necesita para el enlace de pago.',
        'not_payable' => 'Solo las facturas de venta enviadas y aún no pagadas se pueden pagar con Blokbay.',
        'portal' => 'Este método de pago no está disponible ahora. Inténtalo más tarde.',
        'api_url' => 'Escribe la URL de la API con https, por ejemplo https://blokbay.com.',
        'secret_key' => 'La clave secreta empieza por sk_live_.',
        'webhook_secret' => 'El secreto del webhook empieza por whsec_.',
        'account' => 'Elige una cuenta bancaria.',
    ],

];
