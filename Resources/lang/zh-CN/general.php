<?php

return [

    'name' => 'Blokbay',
    'description' => '您的客户在 Blokbay 支付页面用 USDC 或 USDT 支付发票，付款会自动登记到发票上。',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => '在安全的 Blokbay 支付页面用您的钱包以 USDC 或 USDT 支付此发票。',
    'pay_title' => '用 USDC 或 USDT 支付此发票',
    'pay_button' => '用 USDC/USDT 支付',
    'create_button' => '通过 Blokbay 支付',
    'email_line' => '您可以用 USDC 或 USDT 支付此发票：',
    'taxes' => '税费',
    'balance_line' => '发票 :number 的余额',

    'settings' => [
        'title' => '设置',
        'api' => 'Blokbay 账户',
        'api_description' => '密钥位于 Blokbay 控制台的“来自您网站的付款”页面。',
        'api_url' => 'API 地址',
        'secret_key' => '密钥 (sk_live_...)',
        'webhook_secret' => 'Webhook 签名密钥 (whsec_...)',
        'saved' => '已保存 (:hint)：留空即保持不变',
        'account' => '收款银行账户',
        'webhook' => 'Webhook',
        'webhook_description' => '发票付款或作废时，Blokbay 会通知 Akaunting。',
        'webhook_url' => '复制到 Blokbay 控制台的 Webhook 地址',
        'webhook_events' => '事件：invoice.paid、invoice.voided。每个事件都经过签名并通过 API 核对。',
        'how' => '打开已发送的发票并点击“通过 Blokbay 支付”：支付链接会出现在发票、PDF、客户页面和发票邮件中。客户付款后，款项会登记到此处所选账户的发票上。',
    ],

    'messages' => [
        'configure' => '添加您的 Blokbay 密钥，即可在此发票上接受 USDC 和 USDT。',
        'create_help' => '创建支付链接：客户用 USDC 或 USDT 支付，付款会自动登记在这里。',
        'created' => '已为发票 :number 创建 Blokbay 支付链接。',
        'link_ready' => 'Blokbay 发票 :number 的支付链接，也在 PDF、客户页面和发票邮件中。',
        'paid' => '已通过 Blokbay 支付（发票 :number）。',
        'voided' => '之前的支付链接已作废。',
    ],

    'errors' => [
        'not_configured' => 'Blokbay：请先在设置中添加密钥。',
        'unreachable' => 'Blokbay：无法连接 API，请几分钟后重试。',
        'api' => '请求被拒绝。',
        'unexpected' => 'Blokbay：API 返回了意外的响应。',
        'currency' => 'Blokbay 发票接受 :accepted，不接受 :currency。',
        'email' => '请为客户添加邮箱：Blokbay 需要它来生成支付链接。',
        'not_payable' => '只有已发送且尚未付款的销售发票才能通过 Blokbay 支付。',
        'portal' => '此支付方式暂时不可用，请稍后再试。',
        'api_url' => '请输入 https 开头的 API 地址，例如 https://blokbay.com。',
        'secret_key' => '密钥以 sk_live_ 开头。',
        'webhook_secret' => 'Webhook 密钥以 whsec_ 开头。',
        'account' => '请选择一个银行账户。',
    ],

];
