<?php

return [

    'name' => 'Blokbay',
    'description' => 'يدفع عميلك الفاتورة بعملة USDC أو USDT في صفحة الدفع من Blokbay، ويُسجَّل الدفع على الفاتورة تلقائيًا.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'ادفع هذه الفاتورة بعملة USDC أو USDT من محفظتك في صفحة الدفع الآمنة من Blokbay.',
    'pay_title' => 'ادفع هذه الفاتورة بعملة USDC أو USDT',
    'pay_button' => 'ادفع بـ USDC/USDT',
    'create_button' => 'الدفع عبر Blokbay',
    'email_line' => 'يمكنك دفع هذه الفاتورة بعملة USDC أو USDT:',
    'taxes' => 'الضرائب',
    'balance_line' => 'رصيد الفاتورة :number',

    'settings' => [
        'title' => 'الإعدادات',
        'api' => 'حساب Blokbay',
        'api_description' => 'المفاتيح في صفحة "المدفوعات من موقعك" في لوحة Blokbay.',
        'api_url' => 'عنوان API',
        'secret_key' => 'المفتاح السري (sk_live_...)',
        'webhook_secret' => 'سر توقيع الويب هوك (whsec_...)',
        'saved' => 'محفوظ (:hint): اتركه فارغًا للإبقاء عليه',
        'account' => 'الحساب البنكي للمدفوعات',
        'webhook' => 'الويب هوك',
        'webhook_description' => 'تُبلغ Blokbay برنامج Akaunting عند دفع الفاتورة أو إلغائها.',
        'webhook_url' => 'عنوان الويب هوك لنسخه في لوحة Blokbay',
        'webhook_events' => 'الأحداث: invoice.paid و invoice.voided. كل حدث موقَّع ويُتحقق منه عبر API.',
        'how' => 'افتح فاتورة مُرسلة واضغط "الدفع عبر Blokbay": يظهر رابط الدفع على الفاتورة وملف PDF وصفحة العميل وبريد الفاتورة. عندما يدفع العميل، يُضاف الدفع إلى الفاتورة في الحساب المختار هنا.',
    ],

    'messages' => [
        'configure' => 'أضف مفاتيح Blokbay لقبول USDC و USDT على هذه الفاتورة.',
        'create_help' => 'أنشئ رابط الدفع: يدفع عميلك بعملة USDC أو USDT ويُسجَّل الدفع هنا تلقائيًا.',
        'created' => 'تم إنشاء رابط دفع Blokbay للفاتورة :number.',
        'link_ready' => 'رابط دفع فاتورة Blokbay رقم :number، ويظهر أيضًا في PDF وصفحة العميل وبريد الفاتورة.',
        'paid' => 'مدفوعة عبر Blokbay (الفاتورة :number).',
        'voided' => 'تم إلغاء رابط الدفع السابق.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: أضف المفتاح السري في الإعدادات أولًا.',
        'unreachable' => 'Blokbay: تعذّر الوصول إلى API، حاول مرة أخرى بعد دقائق.',
        'api' => 'تم رفض الطلب.',
        'unexpected' => 'Blokbay: استجابة غير متوقعة من API.',
        'currency' => 'تقبل فواتير Blokbay العملات :accepted وليس :currency.',
        'email' => 'أضف بريدًا إلكترونيًا للعميل: تحتاجه Blokbay لرابط الدفع.',
        'not_payable' => 'يمكن الدفع عبر Blokbay لفواتير المبيعات المُرسلة وغير المدفوعة فقط.',
        'portal' => 'طريقة الدفع هذه غير متاحة الآن. يُرجى المحاولة لاحقًا.',
        'api_url' => 'أدخل عنوان API بـ https، مثل https://blokbay.com.',
        'secret_key' => 'يبدأ المفتاح السري بـ sk_live_.',
        'webhook_secret' => 'يبدأ سر الويب هوك بـ whsec_.',
        'account' => 'اختر حسابًا بنكيًا.',
    ],

];
