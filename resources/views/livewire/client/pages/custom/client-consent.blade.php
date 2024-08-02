<section class="py-4">
    <div class="container">
        <div class="row">
            @if(!empty($data))
            {!! $data->consent_form_content !!}
            @endif
            @livewire('client.pages.partials.client-consent-form')
        </div>
    </div>
</section>