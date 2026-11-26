<?php

return [

    'name' => 'Blokbay',
    'description' => 'आपका ग्राहक Blokbay भुगतान पेज पर USDC या USDT में इनवॉइस का भुगतान करता है, और भुगतान अपने आप इनवॉइस पर दर्ज हो जाता है।',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'सुरक्षित Blokbay भुगतान पेज पर अपने वॉलेट से इस इनवॉइस का भुगतान USDC या USDT में करें।',
    'pay_title' => 'इस इनवॉइस का भुगतान USDC या USDT में करें',
    'pay_button' => 'USDC/USDT में भुगतान करें',
    'create_button' => 'Blokbay से भुगतान करें',
    'email_line' => 'आप इस इनवॉइस का भुगतान USDC या USDT में कर सकते हैं:',
    'taxes' => 'कर',
    'balance_line' => 'इनवॉइस :number की बकाया राशि',

    'settings' => [
        'title' => 'सेटिंग्स',
        'api' => 'Blokbay खाता',
        'api_description' => 'कुंजियाँ आपके Blokbay डैशबोर्ड के "आपकी साइट से भुगतान" पेज पर हैं।',
        'api_url' => 'API URL',
        'secret_key' => 'गुप्त कुंजी (sk_live_...)',
        'webhook_secret' => 'वेबहुक साइनिंग सीक्रेट (whsec_...)',
        'saved' => 'सहेजा गया (:hint): बनाए रखने के लिए खाली छोड़ें',
        'account' => 'भुगतान के लिए बैंक खाता',
        'webhook' => 'वेबहुक',
        'webhook_description' => 'इनवॉइस का भुगतान होने या रद्द होने पर Blokbay, Akaunting को बताता है।',
        'webhook_url' => 'Blokbay डैशबोर्ड में कॉपी करने के लिए वेबहुक URL',
        'webhook_events' => 'इवेंट: invoice.paid, invoice.voided. हर इवेंट हस्ताक्षरित है और API से जाँचा जाता है।',
        'how' => 'भेजा गया इनवॉइस खोलें और Blokbay से भुगतान करें पर क्लिक करें: भुगतान लिंक इनवॉइस, उसकी PDF, ग्राहक पेज और इनवॉइस ईमेल में दिखता है। ग्राहक के भुगतान करने पर भुगतान यहाँ चुने गए खाते में इनवॉइस पर जुड़ जाता है।',
    ],

    'messages' => [
        'configure' => 'इस इनवॉइस पर USDC और USDT स्वीकार करने के लिए अपनी Blokbay कुंजियाँ जोड़ें।',
        'create_help' => 'भुगतान लिंक बनाएँ: आपका ग्राहक USDC या USDT में भुगतान करता है और भुगतान यहाँ अपने आप दर्ज हो जाता है।',
        'created' => 'इनवॉइस :number के लिए Blokbay भुगतान लिंक बनाया गया।',
        'link_ready' => 'Blokbay इनवॉइस :number का भुगतान लिंक, PDF, ग्राहक पेज और इनवॉइस ईमेल में भी।',
        'paid' => 'Blokbay से भुगतान हुआ (इनवॉइस :number)।',
        'voided' => 'पिछला भुगतान लिंक रद्द कर दिया गया।',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: पहले सेटिंग्स में गुप्त कुंजी जोड़ें।',
        'unreachable' => 'Blokbay: API तक पहुँच नहीं हो पा रही, कुछ मिनट बाद फिर कोशिश करें।',
        'api' => 'अनुरोध अस्वीकार कर दिया गया।',
        'unexpected' => 'Blokbay: API से अनपेक्षित जवाब।',
        'currency' => 'Blokbay इनवॉइस :accepted स्वीकार करते हैं, :currency नहीं।',
        'email' => 'ग्राहक का ईमेल पता जोड़ें: Blokbay को भुगतान लिंक के लिए इसकी ज़रूरत है।',
        'not_payable' => 'केवल भेजे गए और अभी तक बिना भुगतान वाले बिक्री इनवॉइस का भुगतान Blokbay से हो सकता है।',
        'portal' => 'यह भुगतान तरीका अभी उपलब्ध नहीं है। कृपया बाद में कोशिश करें।',
        'api_url' => 'API URL https के साथ लिखें, जैसे https://blokbay.com।',
        'secret_key' => 'गुप्त कुंजी sk_live_ से शुरू होती है।',
        'webhook_secret' => 'वेबहुक सीक्रेट whsec_ से शुरू होता है।',
        'account' => 'एक बैंक खाता चुनें।',
    ],

];
