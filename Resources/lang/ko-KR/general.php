<?php

return [

    'name' => 'Blokbay',
    'description' => '고객이 Blokbay 결제 페이지에서 인보이스를 USDC 또는 USDT로 결제하면 결제가 인보이스에 자동으로 기록됩니다.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => '안전한 Blokbay 결제 페이지에서 지갑으로 이 인보이스를 USDC 또는 USDT로 결제하세요.',
    'pay_title' => '이 인보이스를 USDC 또는 USDT로 결제',
    'pay_button' => 'USDC/USDT로 결제',
    'create_button' => 'Blokbay로 결제',
    'email_line' => '이 인보이스는 USDC 또는 USDT로 결제할 수 있습니다:',
    'taxes' => '세금',
    'balance_line' => '인보이스 :number 잔액',

    'settings' => [
        'title' => '설정',
        'api' => 'Blokbay 계정',
        'api_description' => '키는 Blokbay 대시보드의 "내 사이트 결제" 페이지에 있습니다.',
        'api_url' => 'API URL',
        'secret_key' => '비밀 키 (sk_live_...)',
        'webhook_secret' => '웹훅 서명 비밀 (whsec_...)',
        'saved' => '저장됨 (:hint): 유지하려면 비워 두세요',
        'account' => '결제를 받을 은행 계좌',
        'webhook' => '웹훅',
        'webhook_description' => '인보이스가 결제되거나 취소되면 Blokbay가 Akaunting에 알립니다.',
        'webhook_url' => 'Blokbay 대시보드에 복사할 웹훅 URL',
        'webhook_events' => '이벤트: invoice.paid, invoice.voided. 모든 이벤트는 서명되며 API로 확인합니다.',
        'how' => '발송된 인보이스를 열고 Blokbay로 결제를 클릭하면 결제 링크가 인보이스, PDF, 고객 페이지, 인보이스 이메일에 표시됩니다. 고객이 결제하면 여기서 선택한 계좌로 인보이스에 결제가 추가됩니다.',
    ],

    'messages' => [
        'configure' => 'Blokbay 키를 추가하면 이 인보이스에서 USDC와 USDT를 받을 수 있습니다.',
        'create_help' => '결제 링크 만들기: 고객이 USDC 또는 USDT로 결제하면 결제가 여기에 자동으로 기록됩니다.',
        'created' => '인보이스 :number의 Blokbay 결제 링크를 만들었습니다.',
        'link_ready' => 'Blokbay 인보이스 :number 결제 링크 (PDF, 고객 페이지, 인보이스 이메일에도 표시).',
        'paid' => 'Blokbay로 결제됨 (인보이스 :number).',
        'voided' => '이전 결제 링크가 취소되었습니다.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: 먼저 설정에서 비밀 키를 추가하세요.',
        'unreachable' => 'Blokbay: API에 연결할 수 없습니다. 몇 분 후 다시 시도하세요.',
        'api' => '요청이 거부되었습니다.',
        'unexpected' => 'Blokbay: API의 예상치 못한 응답입니다.',
        'currency' => 'Blokbay 인보이스는 :accepted만 지원합니다(:currency 불가).',
        'email' => '고객 이메일 주소를 추가하세요: Blokbay 결제 링크에 필요합니다.',
        'not_payable' => '발송되었고 아직 결제되지 않은 판매 인보이스만 Blokbay로 결제할 수 있습니다.',
        'portal' => '이 결제 방법은 지금 사용할 수 없습니다. 나중에 다시 시도하세요.',
        'api_url' => 'API URL을 https로 입력하세요. 예: https://blokbay.com.',
        'secret_key' => '비밀 키는 sk_live_로 시작합니다.',
        'webhook_secret' => '웹훅 비밀은 whsec_로 시작합니다.',
        'account' => '은행 계좌를 선택하세요.',
    ],

];
