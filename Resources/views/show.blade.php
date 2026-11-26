<div class="blokbay-method" v-pre>
    @if ($url)
        <p class="text-sm mb-3">{{ trans('blokbay::general.portal_text') }}</p>
        <a href="{{ $url }}" target="_blank" rel="noopener" id="blokbay-portal-pay"
           class="inline-block px-4 py-2 rounded-lg text-sm font-medium bg-green hover:bg-green-700 text-white">{{ trans('blokbay::general.pay_button') }}</a>
    @else
        <p class="text-sm">{{ $error }}</p>
    @endif
</div>
