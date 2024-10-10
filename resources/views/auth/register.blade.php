<x-layouts.app>
    @push('css')
    <style>
        .form-bg-image {
            background-repeat: no-repeat !important;
            background-position: center center !important;
        }
    </style>
    @endpush
    <main class="" wire:ignore>
        <section class="d-flex align-items-center my-2 py-2 mt-lg-3 mb-lg-2">
            <div class="container">
                <div class="row justify-content-center form-bg-image" data-background-lg="{{asset('img/illustrations/signin.svg')}}">

                    <div class="col-12 d-flex align-items-center justify-content-center ">
                        <div class="bg-white shadow-soft border rounded border-light px-4 pt-3 pb-4 px-lg-5  pt-lg-3  pb-lg-3  w-75 fmxw-600">
                            <div class='d-flex justify-content-end'>
                                <!-- {{__('Language')}} <br> -->
                                <a class="{{ \App::isLocale('fr') ? ' text-success' : ''}} mx-2" href="{{route('language-switcher',['locale'=>'fr'])}} " wire:navigate> <img src="{{asset('img/brand/lang_french_icon.png')}}" alt='' class="icon icon-xs"></a>
                                <a class="{{ \App::isLocale('en') ? ' text-success' : ''}} " href="{{route('language-switcher',['locale'=>'en'])}}" wire:navigate> <img src="{{asset('img/brand/lang_english_icon.png')}}" alt='' class="icon icon-xs"></a>
                            </div>
                            <div class="mb-3 mt-md-0 text-center">
                                <!-- <img src='/img/logo.jpg' class="w-75 h-auto" alt=''> -->
                                <div class="mb-0  py-2"> <span class="text-xl fs-1 fw-bold">{{ __('Wellness')}}</span><span class="text-primary h2 fw-bold bg-success p-1 rounded">{{__('Base')}}</span></div>
                                <p>{{__('Already have an account?')}} <a href="{{route('login')}}" class="fw-bold text-decoration-underline"> {{__('Sign In')}}</a></p>
                            </div>
                            <x-form-items.form wire:submit.prevent="register" class="mt-1 form-modal needs-validation" id="loginForm">
                                <div class="form-group mb-2 row">
                                    <div class="col">
                                        <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror py-2andhalf" wire:model.live="first_name" value="{{ old('first_name') }}" placeholder="{{__('Josephine')}}" required aut="first_name" autofocus>

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror py-2andhalf" wire:model.live="last_name" value="{{ old('last_name') }}" placeholder="{{__('Mbangwa')}}" required autocomplete="last_name" autofocus>

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <div class="col">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror py-2andhalf" wire:model.live="email" value="{{ old('email') }}" placeholder="{{__('josephine.mbangwa@example.com')}}" autocomplete="email" autofocus required>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('PhoneNumber') }}</label>
                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror py-2andhalf" wire:model.live="phone_number" value="{{ old('phone_number') }}" placeholder="{{__('XXXXXXXX')}}" required autocomplete="phone_number" autofocus>

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-1 row">
                                    <div class="col">
                                        <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                        <select wire:model.live='country_id' id='country' class="form-control  @error('country_id') is-invalid @enderror">
                                            <option value=''>{{__('-- Select Country --')}}</option>
                                            @foreach($countries as $country)
                                            <option value='{{$country->iso2}}' selected="{{ old('country_id') }}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                                        <select wire:model.live='state_id' id='state_select' class="form-control  @error('state_id') is-invalid @enderror">
                                        </select>
                                        @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-1 row">
                                    <div class="col">
                                        <label for="occupation" class="col-md-4 col-form-label text-md-right">{{ __('Occupation') }}</label>
                                        <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror py-2andhalf" wire:model.live="occupation" value="{{ old('occupation') }}" placeholder="{{__('Doctor')}}" autocomplete="occupation" autofocus>

                                        @error('occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <div class="col">
                                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                        <select id="gender" class="form-control @error('gender') is-invalid @enderror py-2andhalf" wire:model.live="gender">
                                            <option value='female' selected>{{__('Female')}}</option>
                                            <option value='male'>{{__('Male')}}</option>
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="referred_by" class="col-md-4 col-form-label text-md-right">{{ __('Referred By?') }}</label>
                                        <input id="referred_by" type="text" class="form-control @error('referred_by') is-invalid @enderror py-2andhalf" wire:model.live="referred_by" value="{{ old('referred_by') }}" placeholder="{{__('Jonathan Ngwe')}}" autocomplete="referred_by" autofocus>

                                        @error('referred_by')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-md-6">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror py-2andhalf" wire:model.live="password" placeholder="*************" autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('ConfirmPassword') }}</label>
                                        <input id="password-confirm" type="password" class="form-control py-2andhalf" wire:model.live="password_confirmation" required placeholder="*************" autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="terms_and_conditions" wire:model.live="terms_and_conditions">
                                        <label class="form-check-label fw-normal mb-0 " for="terms_and_conditions">{{__('I agree to the')}}<a href="{{route('client.pages',['slug'=>'terms-adn-conditions'])}}" class="fw-bold">{{__('terms and conditions')}}</a></label> <br>
                                        @error('terms_and_conditions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success px-6" x-data="{loading:false}" x-on:click="loading=true; register()" x-html="loading ? `<i class='uil uil-loding uil-sign-in-alt'></i> {{ __('Please Wait') }} ... : {{ __('Sign Up')}} `" class="disabled:opacity-50" x-bind:disabled="loading"> {{ __('Sign Up') }}</button>

                                </div>
                            </x-form-items.form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
    <script>
        var country = document.getElementById('country');
        var state_option = document.getElementById('state_select');
        state_option.innerHTML = '<option value="" disabled selected>{{__("-- Select State --")}}</option>';
        var states_choices = new Choices(state_option)
        let options = {
            method: 'GET',
            headers: {}
        };
        country.addEventListener('change', function() {
            fetch('api/countries?fields=phone_code,states&filters[iso2]=' + country.value, options)
                .then(response => response.json())
                .then(res => {
                    if (res.success) {
                        console.log(res.data[0].states);

                        states_choices.clearChoices()
                        states_choices.clearStore()

                        states_choices.setChoices(
                            res.data[0].states, 'id', 'name', false
                        )

                    }
                })
        });
    </script>
    @endpush
</x-layouts.app>
