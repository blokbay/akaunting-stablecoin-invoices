<?php

namespace Modules\Blokbay\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Models\Document\Document;
use Modules\Blokbay\Services\Blokbay;
use Modules\Blokbay\Services\BlokbayException;

class Invoices extends Controller
{
    /**
     * "Pay with Blokbay" on a sent sales invoice: creates the Blokbay invoice and keeps its payment link.
     */
    public function store($document_id)
    {
        $document = Document::invoice()->where('company_id', company_id())->findOrFail($document_id);

        try {
            $row = Blokbay::createInvoice($document);

            flash(trans('blokbay::general.messages.created', ['number' => $row->number ?: $document->document_number]))->success();
        } catch (BlokbayException $e) {
            report($e);

            flash($e->getMessage())->error()->important();
        }

        return redirect()->route('invoices.show', $document->id);
    }
}
