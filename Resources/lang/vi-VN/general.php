<?php

return [

    'name' => 'Blokbay',
    'description' => 'Khách hàng của bạn thanh toán hóa đơn bằng USDC hoặc USDT trên trang thanh toán Blokbay, và khoản thanh toán được tự động ghi vào hóa đơn.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Thanh toán hóa đơn này bằng USDC hoặc USDT từ ví của bạn trên trang thanh toán an toàn của Blokbay.',
    'pay_title' => 'Thanh toán hóa đơn này bằng USDC hoặc USDT',
    'pay_button' => 'Thanh toán bằng USDC/USDT',
    'create_button' => 'Thanh toán với Blokbay',
    'email_line' => 'Bạn có thể thanh toán hóa đơn này bằng USDC hoặc USDT:',
    'taxes' => 'Thuế',
    'balance_line' => 'Số còn lại của hóa đơn :number',

    'settings' => [
        'title' => 'Cài đặt',
        'api' => 'Tài khoản Blokbay',
        'api_description' => 'Khóa nằm ở trang Thanh toán từ trang web của bạn trong bảng điều khiển Blokbay.',
        'api_url' => 'URL API',
        'secret_key' => 'Khóa bí mật (sk_live_...)',
        'webhook_secret' => 'Bí mật ký webhook (whsec_...)',
        'saved' => 'Đã lưu (:hint): để trống để giữ nguyên',
        'account' => 'Tài khoản ngân hàng nhận thanh toán',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay báo cho Akaunting khi hóa đơn được thanh toán hoặc bị hủy.',
        'webhook_url' => 'URL webhook để sao chép vào bảng điều khiển Blokbay',
        'webhook_events' => 'Sự kiện: invoice.paid, invoice.voided. Mỗi sự kiện đều được ký và kiểm tra qua API.',
        'how' => 'Mở một hóa đơn đã gửi và bấm Thanh toán với Blokbay: liên kết thanh toán xuất hiện trên hóa đơn, PDF, trang khách hàng và email hóa đơn. Khi khách hàng thanh toán, khoản tiền được ghi vào hóa đơn với tài khoản chọn ở đây.',
    ],

    'messages' => [
        'configure' => 'Thêm khóa Blokbay để nhận USDC và USDT cho hóa đơn này.',
        'create_help' => 'Tạo liên kết thanh toán: khách hàng trả bằng USDC hoặc USDT và khoản thanh toán được tự động ghi tại đây.',
        'created' => 'Đã tạo liên kết thanh toán Blokbay cho hóa đơn :number.',
        'link_ready' => 'Liên kết thanh toán của hóa đơn Blokbay :number, cũng có trên PDF, trang khách hàng và email hóa đơn.',
        'paid' => 'Đã thanh toán bằng Blokbay (hóa đơn :number).',
        'voided' => 'Liên kết thanh toán trước đó đã bị hủy.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: hãy thêm khóa bí mật trong cài đặt trước.',
        'unreachable' => 'Blokbay: không kết nối được API, hãy thử lại sau vài phút.',
        'api' => 'Yêu cầu đã bị từ chối.',
        'unexpected' => 'Blokbay: API trả lời không như mong đợi.',
        'currency' => 'Hóa đơn Blokbay chấp nhận :accepted, không chấp nhận :currency.',
        'email' => 'Hãy thêm email cho khách hàng: Blokbay cần email để tạo liên kết thanh toán.',
        'not_payable' => 'Chỉ hóa đơn bán hàng đã gửi và chưa thanh toán mới có thể thanh toán bằng Blokbay.',
        'portal' => 'Phương thức thanh toán này hiện không khả dụng. Vui lòng thử lại sau.',
        'api_url' => 'Nhập URL API bắt đầu bằng https, ví dụ https://blokbay.com.',
        'secret_key' => 'Khóa bí mật bắt đầu bằng sk_live_.',
        'webhook_secret' => 'Bí mật webhook bắt đầu bằng whsec_.',
        'account' => 'Chọn một tài khoản ngân hàng.',
    ],

];
