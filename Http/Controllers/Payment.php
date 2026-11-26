<?php

namespace Modules\Blokbay\Http\Controllers;

use App\Abstracts\Http\PaymentController;
use App\Http\Requests\Portal\InvoicePayment as PaymentRequest;
use App\Models\Document\Document;
use Modules\Blokbay\Models\BlokbayInvoice;
use Modules\Blokbay\Services\Blokbay;
use Modules\Blokbay\Services\BlokbayException;

/**
 * Blokbay as a payment method of the customer invoice page (signed link and client portal): a button to the Blokbay payment page.
 * The payment is registered by the signed webhook, never by this page.
 */
class Payment extends PaymentController
{
    public $alias = 'blokbay';

    public $type = 'redirect';

    public function show(Document $invoice, PaymentRequest $request, $cards = [])
    {
        $url = null;
        $error = null;

        if (Blokbay::canPay($invoice)) {
            try {
                $url = Blokbay::createInvoice($invoice)->url;
            } catch (BlokbayException $e) {
                report($e);
                $error = trans('blokbay::general.errors.portal');
            }
        } else {
            $url = BlokbayInvoice::openUrl($invoice);
            $error = $url ? null : trans('blokbay::general.errors.not_payable');
        }

        return response()->json([
            'code' => 'blokbay',
            'name' => trans('blokbay::general.method_name'),
            'description' => trans('blokbay::general.description'),
            'redirect' => false,
            'html' => view('blokbay::show', compact('url', 'error'))->render(),
        ]);
    }
}
