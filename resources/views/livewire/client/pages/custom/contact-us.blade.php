<div>
<section class="contact-one">
        <div class="container wow fadeInUp animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
            <div class="section-title  text-center">
                <h5 class="section-title__tagline">
                    {{__('Contact with Us')}}
                    <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                        <g clip-path="url(#clip0_324_36194)">
                            <path d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z"></path>
                            <path d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z"></path>
                            <path d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z"></path>
                            <path d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z"></path>
                        </g>
                    </svg>
                </h5>
                <h2 class="section-title__title">{{__('Feel Free to Write us Anytime')}}</h2>
            </div><!-- section-title -->
            @livewire('frontend.pages.partials.contact-form')
        </div>
    </section>
    <section class="contact-info">
        <div class="container">
            <ul class="contact-info__wrapper">
                <li>
                    <div class="contact-info__icon"><span class="icon-Call"></span></div>
                    <p class="contact-info__title">{{__('Have any question?')}}</p>
                    <h4 class="contact-info__text"> <a href="tel:{{!empty($data) ? $data->contact_phone_number : '' }}">{{ !empty($data) ? $data->contact_phone_number : ''}}</a></h4>
                </li>
                <li class="active">
                    <div class="contact-info__icon"><span class="icon-Email"></span></div>
                    <p class="contact-info__title">{{__('Send Email')}}</p>
                    <h4 class="contact-info__text"><a href="mailto:{{ !empty($data) ? $data->contact_email : ''}}">{{ !empty($data) ? $data->contact_email : ''}}</a></h4>
                </li>
                <li>
                    <div class="contact-info__icon"><span class="icon-Location"></span></div>
                    <p class="contact-info__title">{{__('Visit Anytime')}}</p>
                    <h4 class="contact-info__text">{{ !empty($data) ? $data->contact_location : ''}}</h4>
                </li>
            </ul>
        </div>
    </section>
    <section class="google-map">
        <iframe src="{{ !empty($data) ? $data->contact_map_iframe : ''}}" class="google-map__one" allowfullscreen=""></iframe>
    </section>
</div>