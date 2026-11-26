<?php

return [

    'name' => 'Blokbay',
    'description' => 'お客様は Blokbay の支払いページで請求書を USDC または USDT で支払い、入金は請求書に自動で記録されます。',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => '安全な Blokbay の支払いページで、ウォレットからこの請求書を USDC または USDT でお支払いください。',
    'pay_title' => 'この請求書を USDC または USDT で支払う',
    'pay_button' => 'USDC/USDT で支払う',
    'create_button' => 'Blokbay で支払う',
    'email_line' => 'この請求書は USDC または USDT でお支払いいただけます：',
    'taxes' => '税金',
    'balance_line' => '請求書 :number の残高',

    'settings' => [
        'title' => '設定',
        'api' => 'Blokbay アカウント',
        'api_description' => 'キーは Blokbay ダッシュボードの「サイトからの支払い」ページにあります。',
        'api_url' => 'API URL',
        'secret_key' => 'シークレットキー (sk_live_...)',
        'webhook_secret' => 'Webhook 署名シークレット (whsec_...)',
        'saved' => '保存済み (:hint)：変更しない場合は空欄のまま',
        'account' => '入金先の銀行口座',
        'webhook' => 'Webhook',
        'webhook_description' => '請求書が支払われたり取り消されたりすると、Blokbay が Akaunting に通知します。',
        'webhook_url' => 'Blokbay ダッシュボードにコピーする Webhook URL',
        'webhook_events' => 'イベント：invoice.paid、invoice.voided。すべてのイベントは署名され、API で確認されます。',
        'how' => '送信済みの請求書を開き「Blokbay で支払う」をクリックすると、支払いリンクが請求書、PDF、顧客ページ、請求書メールに表示されます。お客様が支払うと、ここで選んだ口座で請求書に入金が記録されます。',
    ],

    'messages' => [
        'configure' => 'Blokbay のキーを追加すると、この請求書で USDC と USDT を受け付けられます。',
        'create_help' => '支払いリンクを作成：お客様が USDC または USDT で支払うと、入金はここに自動で記録されます。',
        'created' => '請求書 :number の Blokbay 支払いリンクを作成しました。',
        'link_ready' => 'Blokbay 請求書 :number の支払いリンク（PDF、顧客ページ、請求書メールにも表示）。',
        'paid' => 'Blokbay で支払い済み（請求書 :number）。',
        'voided' => '以前の支払いリンクは取り消されました。',
    ],

    'errors' => [
        'not_configured' => 'Blokbay：まず設定でシークレットキーを追加してください。',
        'unreachable' => 'Blokbay：API に接続できません。数分後にもう一度お試しください。',
        'api' => 'リクエストは拒否されました。',
        'unexpected' => 'Blokbay：API から予期しない応答がありました。',
        'currency' => 'Blokbay の請求書は :accepted に対応しています（:currency は不可）。',
        'email' => '顧客にメールアドレスを追加してください。Blokbay の支払いリンクに必要です。',
        'not_payable' => 'Blokbay で支払えるのは、送信済みで未払いの売上請求書だけです。',
        'portal' => 'この支払い方法は現在ご利用いただけません。しばらくしてからお試しください。',
        'api_url' => 'API URL を https で入力してください（例：https://blokbay.com）。',
        'secret_key' => 'シークレットキーは sk_live_ で始まります。',
        'webhook_secret' => 'Webhook シークレットは whsec_ で始まります。',
        'account' => '銀行口座を選択してください。',
    ],

];
