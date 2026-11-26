<?php

namespace Modules\Blokbay\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Blokbay invoice linked to an Akaunting sales invoice (one per invoice, the latest link).
 *
 * @property int $company_id
 * @property int $document_id
 * @property string|null $blokbay_id
 * @property string|null $url
 * @property string|null $number
 * @property string $status open|paid|void
 * @property int $attempt
 * @property int|null $transaction_id
 */
class BlokbayInvoice extends Model
{
    protected $table = 'blokbay_invoices';

    protected $fillable = ['company_id', 'document_id', 'blokbay_id', 'url', 'number', 'status', 'attempt', 'transaction_id'];

    protected $casts = [
        'attempt' => 'integer',
        'transaction_id' => 'integer',
    ];

    public static function forDocument($document): ?self
    {
        return static::where('company_id', $document->company_id)->where('document_id', $document->id)->first();
    }

    /**
     * The open payment link of an invoice that still has something to pay, or null.
     */
    public static function openUrl($document): ?string
    {
        if (empty($document) || ($document->type ?? '') !== 'invoice' || in_array($document->status, ['paid', 'cancelled', 'draft'])) {
            return null;
        }

        $row = static::forDocument($document);

        return ($row && $row->status === 'open' && $row->url) ? $row->url : null;
    }
}
