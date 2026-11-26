<?php

return [

    'name' => 'Blokbay',
    'description' => 'Il tuo cliente paga la fattura in USDC o USDT sulla pagina di pagamento di Blokbay e il pagamento viene registrato da solo sulla fattura.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Paga questa fattura in USDC o USDT dal tuo wallet sulla pagina di pagamento sicura di Blokbay.',
    'pay_title' => 'Paga questa fattura in USDC o USDT',
    'pay_button' => 'Paga in USDC/USDT',
    'create_button' => 'Paga con Blokbay',
    'email_line' => 'Puoi pagare questa fattura in USDC o USDT:',
    'taxes' => 'Imposte',
    'balance_line' => 'Saldo della fattura :number',

    'settings' => [
        'title' => 'Impostazioni',
        'api' => 'Account Blokbay',
        'api_description' => 'Chiavi dalla pagina Pagamenti dal tuo sito del pannello Blokbay.',
        'api_url' => 'URL dell\'API',
        'secret_key' => 'Chiave segreta (sk_live_...)',
        'webhook_secret' => 'Segreto di firma del webhook (whsec_...)',
        'saved' => 'Salvato (:hint): lascia vuoto per mantenerlo',
        'account' => 'Conto bancario per i pagamenti',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay avvisa Akaunting quando una fattura è pagata o annullata.',
        'webhook_url' => 'URL del webhook da copiare nel pannello Blokbay',
        'webhook_events' => 'Eventi: invoice.paid, invoice.voided. Ogni evento è firmato e controllato con l\'API.',
        'how' => 'Apri una fattura inviata e clicca Paga con Blokbay: il link di pagamento va sulla fattura, sul PDF, sulla pagina del cliente e nell\'email della fattura. Quando il cliente paga, il pagamento si aggiunge alla fattura nel conto scelto qui.',
    ],

    'messages' => [
        'configure' => 'Aggiungi le chiavi Blokbay per accettare USDC e USDT su questa fattura.',
        'create_help' => 'Crea il link di pagamento: il cliente paga in USDC o USDT e il pagamento viene registrato qui da solo.',
        'created' => 'Link di pagamento Blokbay creato per la fattura :number.',
        'link_ready' => 'Link di pagamento della fattura Blokbay :number, anche sul PDF, sulla pagina del cliente e nell\'email della fattura.',
        'paid' => 'Pagata con Blokbay (fattura :number).',
        'voided' => 'Il link di pagamento precedente è stato annullato.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: aggiungi prima la chiave segreta nelle impostazioni.',
        'unreachable' => 'Blokbay: l\'API non è raggiungibile, riprova tra qualche minuto.',
        'api' => 'La richiesta è stata rifiutata.',
        'unexpected' => 'Blokbay: risposta inattesa dall\'API.',
        'currency' => 'Le fatture Blokbay accettano :accepted, non :currency.',
        'email' => 'Aggiungi un indirizzo email al cliente: a Blokbay serve per il link di pagamento.',
        'not_payable' => 'Solo le fatture di vendita inviate e non ancora pagate si possono pagare con Blokbay.',
        'portal' => 'Questo metodo di pagamento non è disponibile ora. Riprova più tardi.',
        'api_url' => 'Inserisci l\'URL dell\'API con https, per esempio https://blokbay.com.',
        'secret_key' => 'La chiave segreta inizia con sk_live_.',
        'webhook_secret' => 'Il segreto del webhook inizia con whsec_.',
        'account' => 'Scegli un conto bancario.',
    ],

];
