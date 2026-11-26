# Blokbay for Akaunting

Get your Akaunting sales invoices paid in **USDC or USDT**. One click on a sent invoice creates a Blokbay invoice with the same
lines and total, and puts a **Pay in USDC/USDT** link and button on the invoice page, the PDF, the customer invoice page and the
invoice email. When your customer pays, Blokbay sends a signed webhook, the module reads the invoice again from the Blokbay API and
registers the payment on the Akaunting invoice, which becomes paid.

- Author: Blokbay, <mail@blokbay.com>, https://blokbay.com
- API documentation: https://blokbay.com/docs/api#invoices
- License: GPL-3.0-or-later (see `LICENSE`)
- Tested with Akaunting 3.1.9 and 3.3.2 (Laravel 10, PHP 8.3, MariaDB). Module structure of Akaunting 3.x.

## Requirements

- Akaunting 3.x installed on a server reachable from the internet over https (for the webhook).
- A Blokbay account with an accepting wallet, the secret key (`sk_live_...`) and the webhook signing secret (`whsec_...`)
  from the **Payments from your site** page of the Blokbay dashboard.
- Invoice currency among USD, EUR, GBP, CHF, JPY, CAD, AUD, SGD, HKD, AED.

## Installation

1. Copy the `Blokbay` folder into the `modules/` folder of Akaunting (`modules/Blokbay/module.json` must exist).
2. Install it for your company (replace `1` with your company id):
   `php artisan module:install blokbay 1`
3. Open **Settings > Blokbay**, enter the API URL (`https://blokbay.com`), the secret key, the webhook secret and the bank account
   that receives the payments, then save.
4. Copy the **Webhook URL** shown on the same page (`https://<your-akaunting>/<company_id>/blokbay/webhook`) into the webhook
   settings of your Blokbay dashboard.

The installation creates the table `blokbay_invoices` and gives the admin and manager roles the permissions
`read-blokbay-settings`, `update-blokbay-settings` and `create-blokbay-invoices`.

## How it works

1. Open a sent, unpaid sales invoice. In the **Get paid** box click **Pay with Blokbay**. The module calls
   `POST /api/v1/invoices` with `send: false` (Akaunting sends its own email), the customer, the issue and due dates, the invoice
   number and one line per item with its amount after discounts, plus one **Taxes** line, so the Blokbay total is exactly the
   Akaunting total. A partly paid invoice is sent as one line with the amount due. Web addresses are removed from the texts.
2. The payment link appears:
   - in the **Get paid** box of the invoice page;
   - under the notes of the invoice document: invoice page, print view, PDF (clickable link) and the customer invoice page;
   - on the customer invoice page as the payment method **USDC / USDT (Blokbay)**, with a **Pay in USDC/USDT** button
     (signed link and client portal). If no link exists yet, the customer page creates it;
   - in the invoice email: after the text, or where you put the placeholder `{blokbay_payment_link}` in the email template.
3. When the customer pays, Blokbay sends `invoice.paid` to the webhook. The module checks the `Blokbay-Signature` header
   (HMAC-SHA256 of `<t>.<raw body>`, 300 seconds tolerance, constant time comparison), reads `GET /api/v1/invoices/<id>` and only
   if the API says `paid` it registers one income transaction on the invoice (payment method **USDC / USDT (Blokbay)**, the account
   chosen in the settings, reference `Blokbay inv_...`). The same event delivered again does not create a second payment.
4. `invoice.voided` removes the link. Cancelling the invoice in Akaunting cancels the Blokbay invoice too
   (`POST /api/v1/invoices/<id>/void`). A new link can be created afterwards; if the number is already used by the cancelled
   Blokbay invoice, Blokbay numbers the new one.

Webhook answers: `200` for handled, duplicate and unknown events, `401` for a wrong or old signature, `400` for a bad body,
`503` when the Blokbay API cannot be read (Blokbay delivers the event again later).

## Security

- The secret key and the webhook secret are stored encrypted with the Akaunting application key and never shown again.
- The API is called only from the server (`Authorization: Bearer sk_live_...`), never from the browser.
- The webhook route has no session, cookies or CSRF token: it is accepted only with a valid signature of the company in the URL.
- The payment is registered only after the invoice is read again from the API.

## Translations

`Resources/lang/<locale>/general.php` in en-GB, it-IT, fr-FR, de-DE, es-ES, pt-BR, pt-PT, ru-RU, zh-CN, ja-JP, hi-IN, ko-KR, tr-TR,
id-ID, ar-SA, vi-VN, pl-PL.

## Uninstall

`php artisan module:uninstall blokbay 1`, then delete `modules/Blokbay`. The table `blokbay_invoices` is kept (it is shared by all companies).

## Support

mail@blokbay.com
