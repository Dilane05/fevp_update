<x-layouts.app>
    @push('css')
    <style>
        .form-bg-image {
            background-repeat: no-repeat !important;
            background-position: center center !important;
        }

        .py-2andhalf {
            padding-top: 11px;
            padding-bottom: 11px;
        }
    </style>
    @endpush
    <main class="pt-3" wire:ignore>
        <section class="d-flex align-items-center my-2 py-5 mt-lg-6 mb-lg-5">
            <div class="container">
                <div class="row justify-content-center form-bg-image" data-background-lg="{{asset('img/illustrations/signin.svg')}}">
                    <div class="col-12 d-flex align-items-center justify-content-center ">
                        <div class="bg-white shadow-soft border rounded border-light px-4 pt-3 pb-4 px-lg-5  pt-lg-3  pb-lg-4  w-100 fmxw-500">
                            <div class='d-flex justify-content-end'>
                                <!-- {{__('Language')}} <br> -->
                                <a class="{{ \App::isLocale('fr') ? ' text-success' : ''}} mx-2" href="{{route('language-switcher',['locale'=>'fr'])}} " wire:navigate> <img src="{{asset('img/brand/lang_french_icon.png')}}" alt='' class="icon icon-xs"></a>
                                <a class="{{ \App::isLocale('en') ? ' text-success' : ''}} " href="{{route('language-switcher',['locale'=>'en'])}}" wire:navigate> <img src="{{asset('img/brand/lang_english_icon.png')}}" alt='' class="icon icon-xs"></a>
                            </div>
                            <div class="mb-3 mt-md-0 text-center">
                                <!-- <img src='/img/logo.jpg' class="w-75 h-auto" alt=''> -->
                                <div class="mb-0  py-2"> <span class="text-xl fs-1 fw-bold">{{ __('Fe')}}</span><span class="text-primary h2 fw-bold bg-success p-1 rounded">{{__('vp')}}</span></div>
                            </div>
                            <x-form-items.form method="POST" action="{{ route('login') }}" class="mt-1 form-modal needs-validation" id="loginForm">
                                <div class='text-center'>
                                    <x-alert />
                                </div>
                                <div class="form-group mb-2"><label for="email">{{ __('E-Mail Address') }}</label>
                                    <div class="input-group ">
                                        <!-- <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </span> -->
                                        <input type="text" name="matricule" class="form-control  @error('matricule') is-invalid @enderror py-2andhalf" value="{{ old('matricule') }}" placeholder="PNZ0001" id="matricule" autofocus="" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label for="password">{{ __('Password') }}</label>
                                        <div class="input-group">
                                            <!-- <span class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span> -->
                                            <input type="password" name="password" placeholder="Password" class="form-control  @error('password') is-invalid @enderror py-2andhalf" id="password" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                        </div>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-between align-items-top mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label mb-0" for="remember">{{ __('Remember Me') }}</label>
                                        </div>
                                        <div>
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="small text-right">
                                                {{ __('Lost Password?') }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid pb-3">
                                    <button type="submit" class="btn btn-success text-primary px-6" x-data="{loading:false}" x-on:click="loading=true; document.getElementById('loginForm').submit();" x-html="loading ? `<i class='uil uil-loding uil-sign-in-alt'></i> {{__('Please Wait ...')}}  : {{__('Sign In')}} `" class="disabled:opacity-50" x-bind:disabled="loading"> {{ __('Sign In') }}</button>
                                </div>
                            </x-form-items.form>
                            <div class='d-flex justify-content-start my-3 flex-wrap'>
                                <!-- <div>
                                    <a class="{{ \App::isLocale('fr') ? ' text-success' : ''}} " href="{{route('language-switcher',['locale'=>'fr'])}}" wire:navigate> <img src="{{asset('img/brand/lang_french_icon.png')}}" alt='' class="icon icon-xs"></a>
                                    <a class="{{ \App::isLocale('en') ? ' text-success' : ''}} " href="{{route('language-switcher',['locale'=>'en'])}}" wire:navigate> <img src="{{asset('img/brand/lang_english_icon.png')}}" alt='' class="icon icon-xs"></a>
                                </div> -->
                                <p>{{__('Don\'t have an account?')}} <a href="{{route('register')}}" class="text-decoration-underline fw-bold"> {{__('Sign Up')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-layouts.app>
