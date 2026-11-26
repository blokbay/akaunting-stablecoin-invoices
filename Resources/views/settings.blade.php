<x-layouts.admin>
    <x-slot name="title">{{ trans('blokbay::general.name') }}</x-slot>

    <x-slot name="favorite"
        title="{{ trans('blokbay::general.name') }}"
        icon="account_balance_wallet"
        route="blokbay.settings.edit"
    ></x-slot>

    <x-slot name="content">
        <x-form.container>
            <x-form id="setting" method="PATCH" route="blokbay.settings.update">
                <x-form.section>
                    <x-slot name="head">
                        <x-form.section.head title="{{ trans('blokbay::general.settings.api') }}" description="{{ trans('blokbay::general.settings.api_description') }}" />
                    </x-slot>

                    <x-slot name="body">
                        <x-form.group.text name="api_url" label="{{ trans('blokbay::general.settings.api_url') }}" :value="$setting['api_url']" form-group-class="sm:col-span-6" />

                        <x-form.group.password
                            name="secret_key"
                            label="{{ trans('blokbay::general.settings.secret_key') }}"
                            placeholder="{{ $has_key ? trans('blokbay::general.settings.saved', ['hint' => $key_hint]) : 'sk_live_...' }}"
                            form-group-class="sm:col-span-6"
                            :not-required="$has_key"
                            autocomplete="new-password"
                        />

                        <x-form.group.password
                            name="webhook_secret"
                            label="{{ trans('blokbay::general.settings.webhook_secret') }}"
                            placeholder="{{ $has_secret ? trans('blokbay::general.settings.saved', ['hint' => 'whsec_...']) : 'whsec_...' }}"
                            form-group-class="sm:col-span-6"
                            not-required
                            autocomplete="new-password"
                        />

                        <x-form.group.select
                            name="account_id"
                            label="{{ trans('blokbay::general.settings.account') }}"
                            :options="$accounts"
                            :selected="$setting['account_id']"
                            :clearable="'false'"
                            form-group-class="sm:col-span-6"
                        />
                    </x-slot>
                </x-form.section>

                <x-form.section>
                    <x-slot name="head">
                        <x-form.section.head title="{{ trans('blokbay::general.settings.webhook') }}" description="{{ trans('blokbay::general.settings.webhook_description') }}" />
                    </x-slot>

                    <x-slot name="body">
                        <div class="sm:col-span-6" id="blokbay-webhook-url">
                            <div class="text-sm font-medium text-black mb-1">{{ trans('blokbay::general.settings.webhook_url') }}</div>
                            <code dir="ltr" class="block w-full break-all rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm select-all" v-pre>{{ $webhook_url }}</code>
                            <div class="text-xs text-gray-500 mt-2">{{ trans('blokbay::general.settings.webhook_events') }}</div>
                        </div>

                        <div class="sm:col-span-6 text-sm">
                            <p>{{ trans('blokbay::general.settings.how') }}</p>
                            <p class="mt-2"><a href="https://blokbay.com/docs/api#invoices" target="_blank" rel="noopener" class="text-purple underline">https://blokbay.com/docs/api#invoices</a></p>
                        </div>
                    </x-slot>
                </x-form.section>

                @can('update-blokbay-settings')
                <x-form.section>
                    <x-slot name="foot">
                        <x-form.buttons :cancel="url()->previous()" />
                    </x-slot>
                </x-form.section>
                @endcan
            </x-form>
        </x-form.container>
    </x-slot>

    <x-script folder="settings" file="settings" />
</x-layouts.admin>
