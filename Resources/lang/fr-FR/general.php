<?php

return [

    'name' => 'Blokbay',
    'description' => 'Votre client paie la facture en USDC ou USDT sur la page de paiement Blokbay, et le paiement est enregistré automatiquement sur la facture.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Payez cette facture en USDC ou USDT depuis votre wallet sur la page de paiement sécurisée Blokbay.',
    'pay_title' => 'Payer cette facture en USDC ou USDT',
    'pay_button' => 'Payer en USDC/USDT',
    'create_button' => 'Payer avec Blokbay',
    'email_line' => 'Vous pouvez payer cette facture en USDC ou USDT :',
    'taxes' => 'Taxes',
    'balance_line' => 'Solde de la facture :number',

    'settings' => [
        'title' => 'Paramètres',
        'api' => 'Compte Blokbay',
        'api_description' => 'Clés de la page Paiements depuis votre site de votre tableau de bord Blokbay.',
        'api_url' => 'URL de l\'API',
        'secret_key' => 'Clé secrète (sk_live_...)',
        'webhook_secret' => 'Secret de signature du webhook (whsec_...)',
        'saved' => 'Enregistré (:hint) : laissez vide pour le conserver',
        'account' => 'Compte bancaire des paiements',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay informe Akaunting quand une facture est payée ou annulée.',
        'webhook_url' => 'URL du webhook à copier dans votre tableau de bord Blokbay',
        'webhook_events' => 'Événements : invoice.paid, invoice.voided. Chaque événement est signé et vérifié avec l\'API.',
        'how' => 'Ouvrez une facture envoyée et cliquez sur Payer avec Blokbay : le lien de paiement figure sur la facture, son PDF, la page client et l\'email de la facture. Quand le client paie, le paiement est ajouté à la facture sur le compte choisi ici.',
    ],

    'messages' => [
        'configure' => 'Ajoutez vos clés Blokbay pour accepter USDC et USDT sur cette facture.',
        'create_help' => 'Créez le lien de paiement : votre client paie en USDC ou USDT et le paiement est enregistré ici automatiquement.',
        'created' => 'Lien de paiement Blokbay créé pour la facture :number.',
        'link_ready' => 'Lien de paiement de la facture Blokbay :number, aussi sur le PDF, la page client et l\'email de la facture.',
        'paid' => 'Payée avec Blokbay (facture :number).',
        'voided' => 'Le lien de paiement précédent a été annulé.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay : ajoutez d\'abord la clé secrète dans les paramètres.',
        'unreachable' => 'Blokbay : l\'API est injoignable, réessayez dans quelques minutes.',
        'api' => 'La demande a été refusée.',
        'unexpected' => 'Blokbay : réponse inattendue de l\'API.',
        'currency' => 'Les factures Blokbay acceptent :accepted, pas :currency.',
        'email' => 'Ajoutez une adresse email au client : Blokbay en a besoin pour le lien de paiement.',
        'not_payable' => 'Seules les factures de vente envoyées et non payées peuvent être payées avec Blokbay.',
        'portal' => 'Ce moyen de paiement n\'est pas disponible pour le moment. Réessayez plus tard.',
        'api_url' => 'Saisissez l\'URL de l\'API en https, par exemple https://blokbay.com.',
        'secret_key' => 'La clé secrète commence par sk_live_.',
        'webhook_secret' => 'Le secret du webhook commence par whsec_.',
        'account' => 'Choisissez un compte bancaire.',
    ],

];
