<?php

return [

    'name' => 'Blokbay',
    'description' => 'Müşteriniz faturayı Blokbay ödeme sayfasında USDC veya USDT ile öder ve ödeme faturaya kendiliğinden kaydedilir.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Bu faturayı güvenli Blokbay ödeme sayfasında cüzdanınızdan USDC veya USDT ile ödeyin.',
    'pay_title' => 'Bu faturayı USDC veya USDT ile öde',
    'pay_button' => 'USDC/USDT ile öde',
    'create_button' => 'Blokbay ile öde',
    'email_line' => 'Bu faturayı USDC veya USDT ile ödeyebilirsiniz:',
    'taxes' => 'Vergiler',
    'balance_line' => ':number numaralı faturanın kalanı',

    'settings' => [
        'title' => 'Ayarlar',
        'api' => 'Blokbay hesabı',
        'api_description' => 'Anahtarlar Blokbay panelinizdeki Sitenizden ödemeler sayfasındadır.',
        'api_url' => 'API adresi',
        'secret_key' => 'Gizli anahtar (sk_live_...)',
        'webhook_secret' => 'Webhook imza sırrı (whsec_...)',
        'saved' => 'Kaydedildi (:hint): korumak için boş bırakın',
        'account' => 'Ödemeler için banka hesabı',
        'webhook' => 'Webhook',
        'webhook_description' => 'Bir fatura ödendiğinde veya iptal edildiğinde Blokbay, Akaunting\'e bildirir.',
        'webhook_url' => 'Blokbay panelinize kopyalanacak webhook adresi',
        'webhook_events' => 'Olaylar: invoice.paid, invoice.voided. Her olay imzalıdır ve API ile kontrol edilir.',
        'how' => 'Gönderilmiş bir faturayı açın ve Blokbay ile öde\'ye tıklayın: ödeme bağlantısı faturada, PDF\'te, müşteri sayfasında ve fatura e-postasında yer alır. Müşteri ödediğinde ödeme, burada seçilen hesapla faturaya eklenir.',
    ],

    'messages' => [
        'configure' => 'Bu faturada USDC ve USDT kabul etmek için Blokbay anahtarlarınızı ekleyin.',
        'create_help' => 'Ödeme bağlantısını oluşturun: müşteriniz USDC veya USDT ile öder ve ödeme burada kendiliğinden kaydedilir.',
        'created' => ':number numaralı fatura için Blokbay ödeme bağlantısı oluşturuldu.',
        'link_ready' => 'Blokbay faturası :number ödeme bağlantısı; PDF\'te, müşteri sayfasında ve fatura e-postasında da var.',
        'paid' => 'Blokbay ile ödendi (fatura :number).',
        'voided' => 'Önceki ödeme bağlantısı iptal edildi.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: önce ayarlara gizli anahtarı ekleyin.',
        'unreachable' => 'Blokbay: API\'ye ulaşılamıyor, birkaç dakika sonra tekrar deneyin.',
        'api' => 'İstek reddedildi.',
        'unexpected' => 'Blokbay: API\'den beklenmeyen yanıt.',
        'currency' => 'Blokbay faturaları :accepted kabul eder, :currency kabul etmez.',
        'email' => 'Müşteriye bir e-posta adresi ekleyin: Blokbay ödeme bağlantısı için buna ihtiyaç duyar.',
        'not_payable' => 'Yalnızca gönderilmiş ve henüz ödenmemiş satış faturaları Blokbay ile ödenebilir.',
        'portal' => 'Bu ödeme yöntemi şu anda kullanılamıyor. Lütfen daha sonra tekrar deneyin.',
        'api_url' => 'API adresini https ile girin, örneğin https://blokbay.com.',
        'secret_key' => 'Gizli anahtar sk_live_ ile başlar.',
        'webhook_secret' => 'Webhook sırrı whsec_ ile başlar.',
        'account' => 'Bir banka hesabı seçin.',
    ],

];
