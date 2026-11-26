<?php

return [

    'name' => 'Blokbay',
    'description' => 'Seu cliente paga a fatura em USDC ou USDT na página de pagamento da Blokbay e o pagamento é registrado sozinho na fatura.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Pague esta fatura em USDC ou USDT pela sua carteira na página de pagamento segura da Blokbay.',
    'pay_title' => 'Pague esta fatura em USDC ou USDT',
    'pay_button' => 'Pagar em USDC/USDT',
    'create_button' => 'Pagar com Blokbay',
    'email_line' => 'Você pode pagar esta fatura em USDC ou USDT:',
    'taxes' => 'Impostos',
    'balance_line' => 'Saldo da fatura :number',

    'settings' => [
        'title' => 'Configurações',
        'api' => 'Conta Blokbay',
        'api_description' => 'Chaves da página Pagamentos do seu site no painel da Blokbay.',
        'api_url' => 'URL da API',
        'secret_key' => 'Chave secreta (sk_live_...)',
        'webhook_secret' => 'Segredo de assinatura do webhook (whsec_...)',
        'saved' => 'Salvo (:hint): deixe vazio para manter',
        'account' => 'Conta bancária para os pagamentos',
        'webhook' => 'Webhook',
        'webhook_description' => 'A Blokbay avisa o Akaunting quando uma fatura é paga ou cancelada.',
        'webhook_url' => 'URL do webhook para copiar no painel da Blokbay',
        'webhook_events' => 'Eventos: invoice.paid, invoice.voided. Cada evento é assinado e conferido com a API.',
        'how' => 'Abra uma fatura enviada e clique em Pagar com Blokbay: o link de pagamento vai para a fatura, o PDF, a página do cliente e o email da fatura. Quando o cliente paga, o pagamento é lançado na fatura na conta escolhida aqui.',
    ],

    'messages' => [
        'configure' => 'Adicione suas chaves Blokbay para aceitar USDC e USDT nesta fatura.',
        'create_help' => 'Crie o link de pagamento: seu cliente paga em USDC ou USDT e o pagamento é registrado aqui sozinho.',
        'created' => 'Link de pagamento Blokbay criado para a fatura :number.',
        'link_ready' => 'Link de pagamento da fatura Blokbay :number, também no PDF, na página do cliente e no email da fatura.',
        'paid' => 'Paga com Blokbay (fatura :number).',
        'voided' => 'O link de pagamento anterior foi cancelado.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: adicione primeiro a chave secreta nas configurações.',
        'unreachable' => 'Blokbay: a API não está acessível, tente de novo em alguns minutos.',
        'api' => 'A solicitação foi recusada.',
        'unexpected' => 'Blokbay: resposta inesperada da API.',
        'currency' => 'As faturas Blokbay aceitam :accepted, não :currency.',
        'email' => 'Adicione um email ao cliente: a Blokbay precisa dele para o link de pagamento.',
        'not_payable' => 'Somente faturas de venda enviadas e ainda não pagas podem ser pagas com Blokbay.',
        'portal' => 'Este método de pagamento não está disponível agora. Tente mais tarde.',
        'api_url' => 'Informe a URL da API com https, por exemplo https://blokbay.com.',
        'secret_key' => 'A chave secreta começa com sk_live_.',
        'webhook_secret' => 'O segredo do webhook começa com whsec_.',
        'account' => 'Escolha uma conta bancária.',
    ],

];
