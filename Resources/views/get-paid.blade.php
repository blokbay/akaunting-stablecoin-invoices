<div class="basis-full w-full mt-3 mb-2 rounded-lg border border-purple-100 p-3 text-xs" style="margin-inline-start: 0 !important;" id="blokbay-get-paid" v-pre>
    <div class="font-medium text-sm mb-1">{{ trans('blokbay::general.name') }}</div>

    @if (! $configured)
        <p>{{ trans('blokbay::general.messages.configure') }}
            <a href="{{ route('blokbay.settings.edit') }}" class="text-purple underline">{{ trans('blokbay::general.settings.title') }}</a></p>
    @elseif ($row && $row->status === 'open' && $row->url && $can_pay)
        <p class="mb-2">{{ trans('blokbay::general.messages.link_ready', ['number' => $row->number]) }}</p>
        <a href="{{ $row->url }}" target="_blank" rel="noopener" id="blokbay-pay-link"
           class="inline-block px-3 py-1.5 rounded-lg text-xs font-medium leading-6 bg-purple hover:bg-purple-700 text-white">{{ trans('blokbay::general.pay_button') }}</a>
        <div class="mt-2 break-all text-gray-500" dir="ltr">{{ $row->url }}</div>
    @elseif ($row && $row->status === 'paid')
        <p id="blokbay-paid">{{ trans('blokbay::general.messages.paid', ['number' => $row->number]) }}</p>
    @elseif ($can_pay)
        @if ($row && $row->status === 'void')
            <p class="mb-2">{{ trans('blokbay::general.messages.voided') }}</p>
        @endif
        <p class="mb-2">{{ trans('blokbay::general.messages.create_help') }}</p>
        <form method="POST" action="{{ route('blokbay.invoices.store', $document->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" id="blokbay-create"
                    class="px-3 py-1.5 rounded-lg text-xs font-medium leading-6 bg-purple hover:bg-purple-700 text-white">{{ trans('blokbay::general.create_button') }}</button>
        </form>
    @else
        <p>{{ trans('blokbay::general.errors.not_payable') }}</p>
    @endif
</div>
