<div>
<section class="accrodion-one">
            <div class="container">
                <div class="section-title  text-center">
                    <h5 class="section-title__tagline">
                        {{__('Our Recent FAQS')}}
                        <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                            <g clip-path="url(#clip0_324_36194)">
                                <path d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z"></path>
                                <path d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z"></path>
                                <path d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z"></path>
                                <path d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z"></path>
                            </g>
                        </svg>
                    </h5>
                    <h2 class="section-title__title">{{__('Frequently Asked Question')}} &amp; <br> {{__('Answers Here')}}</h2>
                </div><!-- section-title -->

         
                <div class="accrodion-one__wrapper eduact-accrodion" data-grp-name="eduact-accrodion">
                    @foreach($data as $faq)
                    <div class="accrodion">
                        <span class="accrodion__icon"></span>
                        <div class="accrodion-title">
                            <h4>{{$faq->faq_question}}?</h4>
                        </div><!-- /.accordian-title -->
                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>
                                {{$faq->faq_answer}}
                                </p>
                            </div><!-- /.accordian-content -->
                        </div>
                    </div><!-- /.accordian-item -->
                    @endforeach
                </div><!-- accrodion-one -->
                <div class="">

                </div><!-- accrodion-one -->
            </div>
        </section>
        <section class="cta-faq">
            <div class="container">
                <div class="cta-faq__help text-center">
                    <div class="cta-faq__help__bg" style="background-image: url({{asset('img/frontend/backgrounds/faq-cta.jpg')}});"></div>
                    <div class="cta-faq__help__icon"><span class="icon-Call"></span></div>
                    <h3 class="cta-faq__help__title">Do you Still have Questions?</h3>
                    <div class="cta-faq__help__border"></div>
                    <p class="cta-faq__help__text">Call Anytime<a href="tel:3035550105">(303) 555-0105</a></p>
                </div>
            </div>
        </section>
</div>